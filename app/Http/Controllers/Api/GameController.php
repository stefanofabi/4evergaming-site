<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;

use Exception;

use App\Models\Server;
use App\Models\FavoriteMap;
use App\Models\OnlinePlayerHistory;
use App\Models\PlayerRanking;

use App\Traits\ServerInfo;

use DateTime;
use DB;

class GameController extends Controller
{
    //

    private const MAX_FAILED_ATTEMPTS = 2000; 

    use ServerInfo;

    public function getGameState(Request $request)
    {
        $request->validate([
            'game' => 'required',
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $server = Server::where('ip', $request->ip)->where('port', $request->port)->first();

        if (! $server) {
            return response()->json(['message' => 'No existe este servidor en nuestra base de datos'], 404);
        }

        if ($server->failed_attempts > self::MAX_FAILED_ATTEMPTS) {
            $server->delete();
            
            return response()->json(['message' => 'No existe este servidor en nuestra base de datos'], 404);
        }

        $lastUpdate = Carbon::parse($server->updated_at);
        $now = Carbon::now();	

        $diffSeconds = $now->diffInSeconds($lastUpdate);
        
        if ($diffSeconds > 300) 
        {
            $server_info = $this->getServerInfo($request->game, $request->ip, $request->port);

            if (empty($server_info['var']['gq_hostname'])) {
                $server->status = false;
                $server->num_players = 0;
                $server->players = [];
                $server->failed_attempts++;

                $server->save();

                return response()->json($server);
            }

            DB::beginTransaction();

            try {
                // save old players
                $lastPlayers = $server->players;

                // reset failed attempts
                $server->failed_attempts = 0;
                
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

                $server->favoriteMaps()->where('updated_at', '<=', Carbon::now()->subDays(7)->toDateString())->delete();

                $lastHistoricalOnlinePlayer = $server->onlinePlayerHistories()->where('updated_at', '>', Carbon::now()->subMinutes(15)->toDateTimeString())->first();

                if (is_null($lastHistoricalOnlinePlayer)) {
                    OnlinePlayerHistory::create(['server_id' => $server->id, 'count' => $server->num_players]);
                }
                
                $server->onlinePlayerHistories()->where('updated_at', '<=', Carbon::now()->subDays(30)->toDateString())->delete();

                $playersCollection = new Collection($server->players);
                
                foreach ($lastPlayers as $player) 
                {
                    if (! in_array($player['gq_name'], $playersCollection->pluck('gq_name')->toArray())) {
                        PlayerRanking::updateOrCreate([
                                'server_id' => $server->id,
                                'name' => $player['gq_name'],
                            ], [
                                'score' => DB::raw('score + '. $player['gq_score']),
                                'time' => DB::raw('time + '. ceil($player['gq_time'] / 60)),
                            ]
                        );
                    }
                }

                $server->playerRankings()->where('updated_at', '<=', Carbon::now()->subDays(30)->toDateString())->delete();

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();

                return response()->json(['errors' => true, 'message' => 'Falló al actualizar los datos del servidor'], 500);
            }

        }

        return response()->json($server);
    }
}