<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    //

    public function getGameState(Request $request)
    {
        $type = $request->game;
        $ip = $request->ip;
        $port = $request->port;

        $GameQ = new \GameQ\GameQ();

        $GameQ->addServer([
            'type' => $type,
            'host' => $ip . ':' . $port,
        ]);

        $GameQ->addFilter('secondstohuman');
        $results = $GameQ->process();

        foreach ($results as $id => $var) {
            $players = $var['players'];
            $players = collect($var['players'])->sortBy('score')->reverse()->toArray();
            unset(
                $var['players'],
            );
            $var['ip'] = $ip;

            return array([
                'id' => $id,
                'var' => $var,
                'players' => $players,
            ]);
        }
    }
}