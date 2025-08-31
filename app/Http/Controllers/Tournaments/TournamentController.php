<?php

namespace App\Http\Controllers\Tournaments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Tournament;
use App\Models\Participant;
use App\Models\Game;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $my_tournaments = auth()->check() ? auth()->user()->tournaments : collect([]);
        $upcoming_tournaments = Tournament::where('status', 'upcoming')->orderBy('created_at', 'DESC')->get();

        $completed_tournaments = Tournament::where('status', 'completed')->orderBy('updated_at', 'DESC')->get();

        $games = Game::orderBy('name', 'ASC')->get();

        return view('gametracker.tournaments.index')
            ->with('my_tournaments', $my_tournaments)
            ->with('upcoming_tournaments', $upcoming_tournaments)
            ->with('completed_tournaments', $completed_tournaments)
            ->with('games', $games);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
            'name' => 'required',
            'start_date' => 'required|date',
            'type' => 'in:single,team'
        ]);

        $user = auth()->user();

        $tournament = new Tournament();
        $tournament->name = $request->name;
        $tournament->slug = Str::slug($request->name);
        $tournament->start_date = $request->start_date;
        $tournament->type = $request->type;
        $tournament->organizer_id = $user->id;
        $tournament->game_id = $request->game_id;
        
        $tournament->save();

        return response()->json($tournament, 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        //

        $tournament = Tournament::where('slug', $slug)->first();

        if (! $tournament)
            return redirect()->route('tournaments/index');

        $isRegistered = Participant::where('user_id', auth()->user()->id ?? null)
            ->where('tournament_id', $tournament->id)
            ->exists();
        
        return view('gametracker.tournaments.show')
            ->with('tournament', $tournament)
            ->with('isRegistered', $isRegistered);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function register($id) 
    {
        $tournament = Tournament::findOrFail($id);

        $participant = new Participant();
        $participant->user_id = auth()->user()->id;      // asigna el id del usuario
        $participant->tournament_id = $tournament->id;   // asigna el id del torneo
        $participant->save();

        return redirect()->route('tournaments/show', ['slug' => $tournament->slug]);
    }
    
    public function incrementPoints(Tournament $tournament, Participant $participant)
    {
        $participant->increment('points');
        return back();
    }

    public function decrementPoints(Tournament $tournament, Participant $participant)
    {
        $participant->decrement('points');
        return back();
    }

    public function removeParticipant(Tournament $tournament, Participant $participant)
    {
        $participant->delete();
        return back();
    }
}
