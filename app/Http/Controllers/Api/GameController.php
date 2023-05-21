<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Exception;

class GameController extends Controller
{
    //

    public function getGameState(Request $request)
    {
        try {
            $request->validate([
                'game' => 'required',
                'ip' => 'required|ip',
                'port' => 'required|numeric|min:0|max:65535',
            ]);

            $ip = $request->ip . ':' . $request->port;

            $GameQ = new \GameQ\GameQ();

            $GameQ->addServer([
                'type' => $request->game,
                'host' => $ip,
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
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
}