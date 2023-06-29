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

        $now = new DateTime();
        $lastUpdate = new DateTime($server->updated_at);
        $diff = $now->diff($lastUpdate);

        if ($diff->s > 300) {
        
            $server_info = $this->getServerInfo($request->game, $request->ip, $request->port);

            try {
                $server->update([
                    'hostname' => $server_info['var']['gq_hostname'],
                    'map' => $server_info['var']['gq_mapname'],
                    'num_players' => $server_info['var']['gq_numplayers'],
                    'max_players' => $server_info['var']['gq_maxplayers'],
                    'status' => $server_info['var']['gq_online'],
                    'vars' => json_encode($server_info['var']),
                    'players' => json_encode($server_info['players']),
                ]);
            } catch (Exception $e) {
                return response()->json(['errors' => true, 'message' => 'Falló al actualizar los datos del servidor']);
            }
        }

        return response()->json($server);
    }
}