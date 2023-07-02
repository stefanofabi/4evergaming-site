<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;

use App\Models\Server;

use App\Traits\ServerInfo;

use DateTime;

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

            try {
                $server->hostname = $server_info['var']['gq_hostname'];
                $server->map = $server_info['var']['gq_mapname'];
                $server->num_players = $server_info['var']['gq_numplayers'];
                $server->max_players = $server_info['var']['gq_maxplayers'];
                $server->status = $server_info['var']['gq_online'];
                $server->vars = $server_info['var'];
                $server->players = $server_info['players'];
                
                $server->saveOrFail();
            } catch (Exception $e) {
                return response()->json(['errors' => true, 'message' => 'Falló al actualizar los datos del servidor']);
            }
        }

        return response()->json($server);
    }
}