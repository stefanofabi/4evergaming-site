<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Server;
use App\Models\Game;
use App\Models\Community;
use App\Models\Country;

use App\Traits\ServerInfo;
use App\Traits\UpdateServer;

use Exception;

class ServerController extends Controller
{
    //

    private const MAX_FAILED_ATTEMPTS = 2000; 

    use ServerInfo;
    use UpdateServer;

    public function show(Request $request)
    {
        $request->validate([
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $server = Server::where('ip', $request->ip)->where('port', $request->port)->first();

        if (! $server) {
            return response()->json(['message' => 'No existe este servidor en nuestra base de datos'], 404);
        }

        $gameTags = $server->serverTags->map(function ($serverTag) {
            return $serverTag->gameTag->name;
        });

        $favoriteMaps = $server->favoriteMaps->pluck('map')->unique();

        return response()->json([
            'hostname' => $server->hostname,
            'ip' => $server->ip .':'. $server->port, 
            'game' => $server->game->name,
            'rank' => $server->rank,
            'map' => $server->map,
            'num_players' => $server->num_players,
            'max_players' => $server->max_players,
            'status' => $server->status,
            'join_link' => $server->join_link,
            'community' => $server->community->name,
            'country' => $server->country->name,
            'vars' => $server->vars,
            'server_tags' => $gameTags,
            'favorite_maps' => $this->getTopMapsStatistics($server->id),
            'online_players_history' => [
                '30_days' => $server->stats_30_days,
                '1_year' => $server->stats_1_year,
                '3_years' => $server->stats_3_years,
                '5_years' => $server->stats_5_years,
                '10_years' => $server->stats_10_years,
            ],
            'player_ranking' => $this->getRankings($server->id)
        ]);
    }

    public function updateAll(Request $request) 
    {
        $games = Game::get();

        $now = Carbon::now();

        echo 'Hora de comienzo: ' . $now->format('d-m-Y H:i:s') . '<br />';

        foreach ($games as $game) 
        {
            $servers = Server::where('game_id', $game->id)->orderBy('updated_at', 'ASC')->get();

            echo "Comenzando actualizacion del juego $game->name <br />";
            echo "Total de servidores a actualizar: ".$servers->count(). " <br />";

            foreach ($servers as $server) {
                if ($server->failed_attempts > self::MAX_FAILED_ATTEMPTS) {
                    $server->delete();

                    // go to next server
                    continue;
                }
                
                $server_info = $this->getServerInfo($game->protocol, $server->ip, $server->port);
    
                if (empty($server_info['var']['gq_hostname'])) {
                    $server->status = false;
                    $server->num_players = 0;
                    $server->players = [];
                    $server->failed_attempts++;

                    // punish if server is offline
                    $server->rank_points -= $server->max_players;
                        
                    $server->save();

                    echo "<div style='color: red'> Servidor ".$server->server_address ." Status: OFFLINE </div>";
                } else {
                    if ($this->updateServer($server, $server_info)) {
                        echo "<div style='color: green'> Servidor $server->server_address actualizado </div>";
                    } else {
                        echo "<div style='color: red'> Error al actualizar el servidor ".$server->server_address ." </div>";
                    }
                }
            }

            // update ranks
            DB::transaction(function () use ($game) {
                echo "Actualizando Nro. de Rankings <br />";

                // set null for all
                Server::where('game_id', $game->id)->update(['rank' => null]);

                // get servers order by rank points desc
                $servers = Server::where('game_id', $game->id)->orderBy('rank_points', 'DESC')->get();
                $next = 1;
                foreach ($servers as $server) {
                    $server->rank = $next;
                    $server->save();
                    $next++;
                }
            });

            echo "Actualizacion completada <br />";
            echo "============================ <br />";
        }

        echo "Actualizacion completada <br />";
    }

    /**
     * Get the statistics of the top 9 most played maps of a server and the "others" category.
     *
     * @param int $serverId The ID of the server.
     * @return array An array containing the names of the maps and their percentages, including the "others" category.
     */
    function getTopMapsStatistics($serverId)
    {
        $server = Server::find($serverId); // Assumes you have the server's ID

        $favoriteMaps = $server->favoriteMaps;

        // Count the occurrences of each map
        $mapCounts = $favoriteMaps->groupBy('map')->map(function ($group) {
            return $group->count(); // Count how many times each map appears
        });

        // Sort the maps by their count in descending order
        $sortedMaps = $mapCounts->sortDesc();

        // Get the top 9 most played maps
        $topMaps = $sortedMaps->take(9);

        // Sum the count of the remaining maps as "others"
        $otherMapsCount = $sortedMaps->slice(9)->sum();

        // Get the total number of maps
        $totalMaps = $favoriteMaps->count();

        // Calculate the percentage for each map
        $mapPercentages = $topMaps->mapWithKeys(function ($count, $map) use ($totalMaps) {
            return [$map => round(($count / $totalMaps) * 100, 2)]; 
        });

        // Add the "others" category with its percentage
        $mapPercentages['others'] = round(($otherMapsCount / $totalMaps) * 100, 2);

        // Return the statistics as an array
        return $mapPercentages->toArray();
    }

    /**
     * Get the player rankings for the specific server, ordered by score descending.
     *
     * @param $serverId
     * @param int $limit - (Optional) Limit the number of rankings to return
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRankings($serverId, $limit = 10)
    {
        $server = Server::findOrFail($serverId);

        $rankings = $server->playerRankings()
            ->orderByDesc('score')
            ->limit($limit) 
            ->get(['name', 'score', 'time']); 

        return $rankings;
    }

    public function synchronize(Request $request) 
    {
        $game = Game::where('protocol', $request->protocol)->firstOrFail();
        
        $community = Community::where('name', '4evergaming')->firstOrFail();

        $country = Country::where('short_name', 'AR')->firstOrFail();

        switch ($game->protocol) {
            case 'cs16': {
                $servers = DB::connection('tcadmin')
                    ->table('tc_game_services')
                    ->select('ip_address', 'game_port')
                    ->whereIn('game_id', [120, 121, 122])
                    ->get();

                break;
            }

            default: {
                echo 'Protocolo no disponible para sincronizar <br />';
            }
        }

        $rank = Server::selectRaw('MAX(rank) as max_rank')->where('game_id', $game->id)->first()->max_rank + 1;
    
        foreach ($servers as $iServer) 
        {
            $exists = Server::where('ip', $iServer->ip_address)->where('port', $iServer->game_port)->first();

            if ($exists) 
            {
                echo 'El servidor ya está registrado en la plataforma  <br />';
                continue;
            }

            echo "Obteniendo datos del servidor $iServer->ip_address:$iServer->game_port  <br />";

            $server_info = $this->getServerInfo($game->protocol, $iServer->ip_address, $iServer->game_port);

            if (isset($server_info['errors']) || is_null($server_info['var']['gq_hostname'])) 
            {
                echo "Error al obtener la informacion del servidor  <br />";
                continue;
            }
            
            try {
                
                $server = new Server();
                $server->ip = $iServer->ip_address;
                $server->port = $iServer->game_port;
                $server->server_address = $server_info['id'];
                $server->hostname = $server_info['var']['gq_hostname'];
                $server->map = $server_info['var']['gq_mapname'];
                $server->num_players = $server_info['var']['gq_numplayers'];
                $server->max_players = $server_info['var']['gq_maxplayers'];
                $server->status = $server_info['var']['gq_online'];
                $server->vars = $server_info['var'];
                $server->players = $server_info['players'];
                $server->join_link = $server_info['var']['gq_joinlink'];
                $server->country_id = $country->id;
                $server->game_id = $game->id;
                $server->rank = ++$rank;
                $server->community_id = $community->id;
    
                $server->save();
    

                echo 'Servidor guardado exitosamente <br />';
            } catch (Exception $e) {
                echo 'Error al registrar el servidor en la plataforma <br />';
                echo $e->getMessage() . '<br />';

                continue;
            } 
        }

        echo "Servidores sincronizados";
    }
}