<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Server;

use App\Traits\ServerInfo;
use App\Traits\UpdateServer;

class GameController extends Controller
{
    //

    use ServerInfo;
    use UpdateServer;
    
    public function getGameState(Request $request)
    {
        $request->validate([
            'game' => 'required',
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $server = Server::where('ip', $request->ip)->where('port', $request->port)->first();

        $server_info = $this->getServerInfo($request->game, $request->ip, $request->port);

        if (empty($server_info['var']['gq_hostname'])) {
            $server->status = false;
            $server->num_players = 0;
            $server->players = [];
            $server->failed_attempts++;

            $server->save();

            return response()->json($server);
        }

        if (! $server_updated = $this->updateServer($server, $server_info)) {
            return response()->json(['message' => 'Fallo al actualizar los datos del servidor', 'errors' => $e->getMessage()], 500);
        }

        return response()->json($server_updated);
    }
}