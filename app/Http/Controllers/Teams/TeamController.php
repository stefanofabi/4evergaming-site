<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Models\Team;

class TeamController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:teams,name',
            'logo' => 'required|image|max:2048', 
        ]);

        $user = auth()->user();
        
        $logo = $request->file('logo');
        $ext = $logo->guessExtension();
        $logo_name = "logo_$user->id.$ext";

        Storage::disk('public')->put("teams/logos/$logo_name", File::get($logo));

        $team = Team::create([
            'name' => $validated['name'],
            'logo' => $logo_name,
            'slug' => Str::slug($validated['name']),
            'owner_id' => $user->id,
        ]);

        return redirect()->back()->with('success', '¡Equipo creado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
