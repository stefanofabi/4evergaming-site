<?php 

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Collection;

use App\Models\Server;
use App\Models\FavoriteMap;
use App\Models\OnlinePlayerHistory;
use App\Models\PlayerRanking;

use DB;
use Exception;

trait UpdateServer {

    public function updateServer($server, $server_info)
    {
       
        DB::beginTransaction();

        try {
            // save old players
            $lastPlayers = new Collection($server->players);
            
            // reset failed attempts
            $server->failed_attempts = 0;

            $server->hostname = $server_info['var']['gq_hostname'];
            $server->map = $server_info['var']['gq_mapname'];
            $server->num_players = $server_info['var']['gq_numplayers'];
            $server->max_players = $server_info['var']['gq_maxplayers'];
            $server->status = $server_info['var']['gq_online'];
            $server->vars = $server_info['var'];
            $server->players = $server_info['players'];

            // calculate points
            //$server->rank_points += $server->num_players;
            $server->rank_points = round($server->rank_points + $server->num_players) / 2;      

            // add to the favorite maps counter
            $lastMapUpdated = $server->favoriteMaps()->orderBy('updated_at', 'DESC')->first();
            $map_changed = is_null($lastMapUpdated) || $lastMapUpdated->map != $server->map;
            
            if ($map_changed) {
                FavoriteMap::create([
                    'server_id' => $server->id,
                    'map' => $server->map
                ]);
            }

            // delete history of favorite maps from the last days
            $server->favoriteMaps()->where('updated_at', '<=', Carbon::now()->subDays(30)->toDateString())->delete();

            
            // add to the historial online players
            OnlinePlayerHistory::create([
                'server_id' => $server->id, 
                'count' => $server->num_players
            ]);

            // delete history of connected players from the last 30 days
            $server->onlinePlayerHistories()->where('updated_at', '<=', Carbon::now()->subDays(30)->toDateString())->delete();

            // save data of offline players since the last update
            $playersCollection = new Collection($server->players);
                
            foreach ($lastPlayers as $player) 
            {
                $player_playing= $playersCollection->firstWhere('gq_name', $player['gq_name']);
                
                if ($player_playing) {
                    $player_reconnect = $player['gq_time'] > $player_playing['gq_time'];
                } else {
                    $player_reconnect = false;
                }

                if (! $player_playing || $map_changed || $player_reconnect) {
                    PlayerRanking::updateOrCreate([
                            'server_id' => $server->id,
                            'name' => $player['gq_name'],
                        ], [
                            'score' => DB::raw('score + '. intval($player['gq_score'])),
                            'time' => DB::raw('time + '. ceil(intval($player['gq_time']) / 60)),
                        ]
                    );
                }
            }

            // delete records of players who have not entered in the last 30 days
            $server->playerRankings()->where('updated_at', '<=', Carbon::now()->subDays(30)->toDateString())->delete();

            $server->saveOrFail();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            
            return false;
        }

        return $server;
    }
}