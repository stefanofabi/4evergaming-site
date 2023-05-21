<?php

namespace App\Http\Controllers\Communities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Community;

class CommunityController extends Controller
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
        //

        $request->validate([
            'name' => 'required',
            'contact_url' => 'required|url',
            'logo' => 'required|mimes:jpg,jpeg,png|max:1048',
        ]);

        $user = auth()->user();

        $logo = $request->file('logo');
        $ext = $logo->guessExtension();
        $logo_name = "logo_$user->id.$ext";

        $community = Community::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'name' => $request->name,
            'contact_url' => $request->contact_url,
            'logo' => $logo_name,
        ]);

        Storage::disk('public')->put("communities/$logo_name",  File::get($logo));

        return response()->json($community, 200);
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
