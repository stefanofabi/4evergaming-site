<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Server;
use App\Models\Game;
use App\Models\Country;
use App\Models\ServerTag;

use App\Traits\ServerInfo;

use Exception;
use DB;

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
        
        DB::beginTransaction();

        try {
            $rank = Server::selectRaw('MAX(rank) as max_rank')->where('game_id', $request->game_id)->first()->max_rank + 1;

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
            $server->country_id = $request->country_id;
            $server->game_id = $game->id;
            $server->rank = $rank;
            $server->community_id = auth()->user()->community->id;
            $server->description = Purify::clean($request->description);

            $server->save();

            ServerTag::where('server_id', $server->id)->delete();

            if ($request->has('server_tags') && is_array($request->server_tags)) {
                foreach ($request->server_tags as $server_tag) {
                    ServerTag::create(['server_id' => $server->id, 'game_tag_id' => $server_tag]);
                }            
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['errors' => true, 'message' => 'El servidor ya está registrado en la plataforma'], 412);
        }
        
        return response()->json($server, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $server = Server::findOrFail($id);
        
        DB::beginTransaction();

        try {
            $server->game_id = $request->game_id;
            $server->country_id = $request->country_id;
            $server->description = Purify::clean($request->description);

            $server->save();
            
            ServerTag::where('server_id', $server->id)->delete();

            if ($request->has('server_tags') && is_array($request->server_tags)) {
                foreach ($request->server_tags as $server_tag) {
                    ServerTag::create(['server_id' => $server->id, 'game_tag_id' => $server_tag]);
                }            
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['errors' => true, 'message' => 'El servidor no se puedo actualizar'], 500);
        }
        

        return response()->json($server, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $server = Server::findOrFail($id);
        
        $server->delete();

        return redirect()->route('servers/search', ['game' => $server->game->protocol]);
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

        return view('servers.search.index')
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

        $countries = Country::orderBy('name', 'ASC')->get();

        return view('servers.info.index')
            ->with('server', $server)
            ->with('games', $games)
            ->with('countries', $countries);
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

    public function uploadMap(Request $request)
    {
        //

        $request->validate([
            'mapname' => 'required|string',
            'map' => 'required|mimes:jpg,jpeg|max:1048',
        ]);

        $server = Server::findOrFail($request->server_id);

        if ($request->mapname != $server->map) {
            return response()->json(['errors' => true, 'message' => 'El mapa del servidor no corresponde con el mapa subido'], 412);
        }

        if (Storage::disk('public')->exists('maps/'. $server->game->protocol .'/'.$server->map .'.jpg')) {
            return response()->json(['errors' => true, 'message' => 'Ya tenemos una imágen para este mapa. Gracias por colaborar!'], 412);
        }

        Storage::disk('public')->put('maps/'. $server->game->protocol .'/'.$server->map .'.jpg',  File::get($request->file('map')));      

        return response()->json(['message' => 'Imagen cargada con éxito. Gracias por colaborar.'], 200);
    }
}
