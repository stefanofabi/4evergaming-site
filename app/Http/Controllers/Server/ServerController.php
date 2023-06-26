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
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //

        $game = Game::where('protocol', $request->game)->first();

        $games = Game::orderBy('name', 'ASC')->get();
        
        $countries = Country::orderBy('name', 'ASC')->get();

        return view('servers.create')
            ->with('games', $games)
            ->with('game', $game)
            ->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
      
        $request->validate([
            'ip' => 'required|string',
            'port' => 'required|numeric|min:0|max:65535',
        ]);

        $game = Game::findOrFail($request->game_id);

        $server_info = $this->getServerInfo($game->protocol, $request->ip, $request->port);

        if (isset($server_info['errors'])) 
        {
            return back()->withInput($request->all())->withErrors('No se pudo obtener los datos del servidor. Verifique que el servidor esté encendido y acepte conexiones');
        }
        
        try {
            $rank = Server::where('game_id', $request->game_id)->count() + 1;

            Server::updateOrCreate(
                [
                    'ip' => $request->ip,
                    'port' => $request->port,
                    'community_id' => auth()->user()->community->id
                ], 
                [
                    'server_address' => $server_info['id'],
                    'hostname' => $server_info['var']['gq_hostname'],
                    'map' => $server_info['var']['gq_mapname'],
                    'max_players' => $server_info['var']['gq_maxplayers'],
                    'users_online' => $server_info['var']['gq_numplayers'],
                    'status' => $server_info['var']['gq_online'],
                    'join_link' => $server_info['var']['gq_joinlink'],
                    'vars' => json_encode($server_info['var']),
                    'country_id' => $request->country_id,
                    'game_id' => $game->id,
                    'rank' => $rank
                ]
            );
        } catch (Exception $e) {
            return back()->withInput($request->all())->withErrors('No se pudo guardar el servidor en la base de datos');
        }
        
        return redirect()->route('servers/search', ['game' => $game->protocol]);
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

        return view('servers.search')
            ->with('game', $game)
            ->with('games', $games)
            ->with('servers', $servers)
            ->with('top_servers', $top_servers)
            ->with('filter', $request->filter);
    }

    public function showInfo() 
    {
        return back();
    }
}
