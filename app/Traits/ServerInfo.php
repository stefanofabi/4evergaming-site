<?php 

namespace App\Traits;

trait ServerInfo {

    public function getServerInfo($game, $server_ip, $server_port)
    {
        try {

            $ip = $server_ip . ':' . $server_port;

            $GameQ = new \GameQ\GameQ();

            $GameQ->addServer([
                'type' => $game,
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

                return [
                    'id' => $id,
                    'var' => $var,
                    'players' => $players,
                ];
            }
        } catch (Exception $e) {
            return ['errors' => $e->getMessage()];
        }
    }
}