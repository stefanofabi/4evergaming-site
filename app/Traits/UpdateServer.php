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
            //$server->onlinePlayerHistories()->where('updated_at', '<=', Carbon::now()->subDays(30)->toDateString())->delete();

            $this->runStadistics($server);
            
            // save data of offline players since the last update
            $playersCollection = new Collection($server->players);
                
            foreach ($lastPlayers as $player) 
            {
                if  (! isset($player['gq_time'])) continue;

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

            // calculate points
            //$server->rank_points += $server->num_players;
            //$server->rank_points = round(($server->rank_points + $server->num_players) / 2); 
            //$server->rank_points = round(($server->rank_points + $server->onlinePlayerHistories()->avg('count')) / 2);
            $statsHourly= $server->stats_hourly ?? [];

            if (!empty($statsHourly)) {
                $averageCount = round(collect($statsHourly)->pluck('count')->avg());
                $server->rank_points = round(($server->rank_points + $averageCount) / 2);
            }

            $server->saveOrFail();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }

        return $server;
    }


    public function runStadistics(Server $server)
    {
        $now = Carbon::now()->minute(0)->second(0);

        // --- 1. Estadísticas por hora (últimas 24h)
        $hourly = collect($server->stats_hourly ?? []);
        $hourly->push([
            'date'  => $now->format('Y-m-d H:00:00'),
            'count' => $server->num_players
        ]);

        $hourly = $hourly
            ->filter(fn($r) => Carbon::parse($r['date'])->diffInHours($now) < 24)
            ->groupBy(fn($r) => Carbon::parse($r['date'])->format('Y-m-d H:00:00'))
            ->map(fn($grp, $hour) => [
                'date'  => $hour,
                'count' => ceil(collect($grp)->avg('count'))
            ])
            ->sortBy('date')
            ->values();

        $server->stats_hourly = $hourly->toArray();

        // --- 2. Estadísticas diarias (últimos 30 días)
        $daily = $hourly
            ->groupBy(fn($r) => Carbon::parse($r['date'])->format('Y-m-d'))
            ->map(fn($grp, $day) => [
                'date'  => $day,
                'count' => ceil(collect($grp)->avg('count'))
            ])
            ->sortBy('date')
            ->values();

        $existingDaily = collect($server->stats_daily ?? [])
            ->groupBy(fn($r) => $r['date'])
            ->map(fn($grp, $date) => [
                'date'  => $date,
                'count' => ceil(collect($grp)->avg('count'))
            ]);

        $today = $now->toDateString();
        $existingDaily->put($today, [
            'date'  => $today,
            'count' => ceil($daily->avg('count'))
        ]);

        $server->stats_daily = $existingDaily
            ->sortBy('date')
            ->filter(fn($r) => Carbon::parse($r['date'])->diffInDays($now) < 30)
            ->values()
            ->toArray();

        // --- 3. Estadísticas mensuales (últimos 5–10 años, hasta 120 meses)
        $monthly = $daily
            ->groupBy(fn($r) => Carbon::parse($r['date'])->format('Y-m'))
            ->map(fn($grp, $month) => [
                'date'  => $month,
                'count' => ceil(collect($grp)->avg('count'))
            ])
            ->sortBy('date')
            ->values();

        $existingMonthly = collect($server->stats_monthly ?? [])
            ->groupBy(fn($r) => $r['date'])
            ->map(fn($grp, $date) => [
                'date'  => $date,
                'count' => ceil(collect($grp)->avg('count'))
            ]);

        $currentMonth = $now->format('Y-m');
        $existingMonthly->put($currentMonth, [
            'date'  => $currentMonth,
            'count' => ceil($monthly->avg('count'))
        ]);

        $server->stats_monthly = $existingMonthly
            ->sortBy('date')
            ->slice(-120)
            ->values()
            ->toArray();
    }
}