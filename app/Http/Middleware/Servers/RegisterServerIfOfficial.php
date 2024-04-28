<?php

namespace App\Http\Middleware\Servers;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Server;
use App\Models\Game;
use App\Models\Country;
use App\Models\User;

use App\Traits\ServerInfo;

use DB;
use Exception;

class RegisterServerIfOfficial
{
    use ServerInfo;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $request->validate([
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        if (empty($request->game))
            return $next($request);

        $exists = Server::where('ip', $request->ip)->where('port', $request->port)->get()->first();

        if ($exists)
            return $next($request);

        $user = User::where('steam_id', '76561198259502796')->firstOrFail();

        if (! $user)
            return $next($request);

        $country = Country::where('short_name', 'AR')->get()->firstOrFail();

        if (! $country)
            return $next($request);

        $game = Game::where('protocol', $request->game)->get()->firstOrFail();
        
        if (! $game)
            return $next($request);

        $server_info = $this->getServerInfo($game->protocol, $request->ip, $request->port);

        if (isset($server_info['errors']) || is_null($server_info['var']['gq_hostname'])) 
        {
            return redirect()->route('servers/search', ['game' => $game->protocol]);
        }

        DB::beginTransaction();

        try {
            $rank = Server::selectRaw('MAX(rank) as max_rank')->where('game_id', $game->id)->first()->max_rank + 1;

            $server = new Server();
            $server->ip = $request->ip;
            $server->port = $request->port;
            $server->server_address = $server_info['id'];
            $server->hostname = $server_info['var']['gq_hostname'];
            $server->map = $server_info['var']['gq_mapname'];
            $server->num_players = $server_info['var']['gq_numplayers'];
            $server->max_players = $server_info['var']['gq_maxplayers'];
            $server->status = $server_info['var']['gq_online'];
            $server->vars = $server_info['var'];
            $server->players = $server_info['players'];
            $server->join_link = $server_info['var']['gq_joinlink'];
            $server->country_id = $country->id;
            $server->game_id = $game->id;
            $server->rank = $rank;
            $server->community_id = $user->community->id;

            $server->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->route('servers/search', ['game' => $game->protocol]);
        }
        
        return $next($request);
    }
}
