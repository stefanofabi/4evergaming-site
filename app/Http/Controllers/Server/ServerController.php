<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Server;
use App\Models\Game;
use App\Models\Country;

use App\Traits\ServerInfo;

use Exception;

class ServerController extends Controller
{
    use ServerInfo;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
      
        $request->validate([
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $game = Game::findOrFail($request->game_id);
        
        $server_info = $this->getServerInfo($game->protocol, $request->ip, $request->port);

        if (isset($server_info['errors']) || is_null($server_info['var']['gq_hostname'])) 
        {
            return response()->json(['errors' => true, 'message' => 'No se pudo obtener los datos del servidor. Verifique que el servidor esté encendido y acepte conexiones'], 500);
        }
        
        try {
            $rank = Server::selectRaw('MAX(rank) as max_rank')->where('game_id', $request->game_id)->first()->max_rank + 1;

            $server = Server::create(
                [
                    'ip' => $request->ip,
                    'port' => $request->port,
                    'server_address' => $server_info['id'],
                    'hostname' => $server_info['var']['gq_hostname'],
                    'map' => $server_info['var']['gq_mapname'],
                    'num_players' => $server_info['var']['gq_numplayers'],
                    'max_players' => $server_info['var']['gq_maxplayers'],
                    'status' => $server_info['var']['gq_online'],
                    'vars' => $server_info['var'],
                    'players' => $server_info['players'],
                    'join_link' => $server_info['var']['gq_joinlink'],
                    'country_id' => $request->country_id,
                    'game_id' => $game->id,
                    'rank' => $rank,
                    'community_id' => auth()->user()->community->id,
                    'description' => $request->description,

                ]
            );
        } catch (Exception $e) {
            return response()->json(['errors' => true, 'message' => 'El servidor ya está registrado en la plataforma'], 412);
        }
        
        return response()->json($server, 200);
    }

    public function search(Request $request, string $game)
    {
        $game = Game::where('protocol', $game)->firstOrFail();

        $games = Game::orderBy('name', 'ASC')->get();

        $filter = $request->filter;

        $servers = Server::where('game_id', $game->id)
        ->where(function ($query) use ($filter) {
            if (! empty($filter)) {
                $query->orWhere("servers.server_address", "like", "%$filter%")
                    ->orWhere("servers.hostname", "like", "%$filter%");
            }
        })->orderBy('rank', 'ASC')
        ->get()->skip(3);
        
        $top_servers = Server::where('game_id', $game->id)->orderBy('rank', 'ASC')->limit(3)->get();
        
        $countries = Country::orderBy('name', 'ASC')->get();

        return view('servers.search')
            ->with('game', $game)
            ->with('games', $games)
            ->with('servers', $servers)
            ->with('top_servers', $top_servers)
            ->with('filter', $request->filter)
            ->with('countries', $countries);
    }

    public function showInfo(Request $request) 
    {
        $request->validate([
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $server = Server::where('ip', $request->ip)->where('port', $request->port)->firstOrFail();

        $games = Game::orderBy('name', 'ASC')->get();

        return view('servers.info')
            ->with('server', $server)
            ->with('games', $games);
    }

    public function claimServer(Request $request) 
    {
        $request->validate([
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $server = Server::where('ip', $request->ip)->where('port', $request->port)->first();

        if (is_null($server)) {
            return response()->json(['errors' => true, 'message' => 'Servidor no encontrado'], 404);
        }

        $server_info = $this->getServerInfo($server->game->protocol, $server->ip, $server->port);

        if ($server_info['var']['gq_hostname'] != "GameTrackerClaimServer") {
            return response()->json(['errors' => true, 'message' => 'El nombre del servidor no coincide con GameTrackerClaimServer'], 412);
        }

        $server->community_id = auth()->user()->community->id;
        $server->save();

        return response()->json(['message' => 'Reclamaste exitosamente este servidor']);
    }
}
