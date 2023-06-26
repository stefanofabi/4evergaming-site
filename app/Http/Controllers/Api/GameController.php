<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;

use App\Models\Server;

use App\Traits\ServerInfo;

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

        
        $server_info = $this->getServerInfo($request->game, $request->ip, $request->port);

        Server::where('ip', $request->ip)
        ->where('port', $request->port)
        ->update([
            'hostname' => $server_info['var']['gq_hostname'],
            'map' => $server_info['var']['gq_mapname'],
            'max_players' => $server_info['var']['gq_maxplayers'],
            'users_online' => $server_info['var']['gq_numplayers'],
            'status' => $server_info['var']['gq_online'],
            'vars' => json_encode($server_info['var']),
        ]);

        return response()->json($server_info);
    }
}