<?php

namespace App\Http\Controllers\Tournaments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
    public function update(Request $request, Tournament $tournament)
    {
        //

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'max_participants' => 'nullable|integer|min:1',
            'max_participants_per_team' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'prize' => 'nullable|string|max:255',
            'entry_fee' => 'nullable|numeric|min:0',
            'event_url' => 'nullable|url|max:255',
        ]);

        $tournament->update($validated);

        return $tournament;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function register(Tournament $tournament) 
    {
        $participant = new Participant();
        $participant->user_id = auth()->user()->id;     
        $participant->tournament_id = $tournament->id; 
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

    public function updateBanner(Request $request, Tournament $tournament)
    {
        $request->validate([
            'tournament_image' => 'required|image|max:2048',
        ]);

        if ($tournament->tournament_image && Storage::disk('public')->exists('tournaments/' . $tournament->tournament_image)) {
            Storage::disk('public')->delete('tournaments/' . $tournament->tournament_image);
        }

        $path = $request->file('tournament_image')->store('tournaments', 'public');
        $filename = basename($path);

        $tournament->tournament_image = $filename;
        $tournament->save();

        return $tournament;
    }
}
