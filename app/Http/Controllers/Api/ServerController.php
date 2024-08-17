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
            'game' => 'required',
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $server = Server::where('ip', $request->ip)->where('port', $request->port)->first();

        if (! $server) {
            return response()->json(['message' => 'No existe este servidor en nuestra base de datos'], 404);
        }

        return response()->json($server);
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
}