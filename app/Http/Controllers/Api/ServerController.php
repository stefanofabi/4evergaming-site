<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Server;
use App\Models\Game;

use App\Traits\ServerInfo;
use App\Traits\UpdateServer;

use DB;

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
            'online_players_history' => $this->getOnlinePlayerStatistics($server->id),
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

    public function getOnlinePlayerStatistics($serverId)
    {
        $server = Server::findOrFail($serverId);

        $dailyStats = $this->getStatsByPeriod($server, 'day');
        $monthlyStats = $this->getStatsByPeriod($server, 'month');
        $yearlyStats = $this->getStatsByPeriod($server, 'year');
        
        return [
            'daily' => $dailyStats,
            'monthly' => $monthlyStats,
            'yearly' => $yearlyStats,
        ];
    }

    /**
     * Get statistics grouped by the given period (day, month, year).
     *
     * @param $server
     * @param $period
     * @return array
     */
    private function getStatsByPeriod($server, $period)
    {
        $query = $server->onlinePlayerHistories();

        switch ($period) {
            case 'day':
                $stats = $query->select(DB::raw('DATE(created_at) as date'), DB::raw('CEIL(AVG(count)) as avg_count'))
                            ->groupBy(DB::raw('DATE(created_at)'))
                            ->orderBy('date')
                            ->get()
                            ->pluck('avg_count', 'date');
                break;

            case 'month':
                $stats = $query->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('CEIL(AVG(count)) as avg_count'))
                            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
                            ->orderBy('month')
                            ->get()
                            ->pluck('avg_count', 'month');
                break;

            case 'year':
                $stats = $query->select(DB::raw('YEAR(created_at) as year'), DB::raw('CEIL(AVG(count)) as avg_count'))
                            ->groupBy(DB::raw('YEAR(created_at)'))
                            ->orderBy('year')
                            ->get()
                            ->pluck('avg_count', 'year');
                break;
        }

        return $stats->toArray();
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

}