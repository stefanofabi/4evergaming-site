<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;

use App\Models\Server;
use App\Models\FavoriteMap;

use App\Traits\ServerInfo;

use DateTime;
use DB;

class GameController extends Controller
{
    //

    use ServerInfo;

    public function getGameState(Request $request)
    {
        $request->validate([
            'game' => 'required',
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $server = Server::where('ip', $request->ip)
        ->where('port', $request->port)->first();

        if (! $server) {
            return response()->json(['errors' => true, 'message' => 'No existe este servidor en nuestra base de datos']);
        }

        $lastUpdate = strtotime($server->updated_at);
        $now = time();	

        $diffSeconds = $now - $lastUpdate;
	
        if ($diffSeconds > 300) {
        
            $server_info = $this->getServerInfo($request->game, $request->ip, $request->port);
            DB::beginTransaction();

            try {
                $server->hostname = $server_info['var']['gq_hostname'];
                $server->map = $server_info['var']['gq_mapname'];
                $server->num_players = $server_info['var']['gq_numplayers'];
                $server->max_players = $server_info['var']['gq_maxplayers'];
                $server->status = $server_info['var']['gq_online'];
                $server->vars = $server_info['var'];
                $server->players = $server_info['players'];
                
                $server->save();

                $lastMapUpdated = $server->favoriteMaps()->orderBy('updated_at', 'DESC')->first();

                if (is_null($lastMapUpdated) || $lastMapUpdated->map != $server->map) {
                    FavoriteMap::updateOrCreate([
                            'server_id' => $server->id,
                            'map' => $server->map,
                        ], [
                            'count' => DB::raw('count + 1')
                        ]
                    );
                }

                FavoriteMap::where('updated_at', '<=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))->delete();
                
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();

                return response()->json(['errors' => true, 'message' => 'Falló al actualizar los datos del servidor']);
            }

        }

        return response()->json($server);
    }
}