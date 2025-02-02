<?php

namespace App\Http\Controllers\Communities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Stevebauman\Purify\Facades\Purify;

use App\Models\Community;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $communities = Community::has('servers')->orderBy('calification', 'desc')->get();

        return view('communities.index.index')
            ->with('communities', $communities);
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
        $request->validate([
            'name' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|max:1048|nullable',
        ]);

        $user = auth()->user();

        if ($request->has('logo')) 
        {
            $logo = $request->file('logo');
            $ext = $logo->guessExtension();
            $logo_name = "logo_$user->id.$ext";

            Storage::disk('public')->put("communities/$logo_name", File::get($logo));
        } else 
        {
            $logo_name = "default.png";
        }

        $community = new Community();
        $community->name = $request->name;
        $community->description = Purify::clean($request->description);
        $community->logo = $logo_name;
        $community->user_id = $user->id;
        $community->save();

        return response()->json($community, 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $community = Community::findOrFail($id);
        $servers = $community->servers()->orderBy('rank', 'ASC')->get();

        return view('communities.show.show')
            ->with('community', $community)
            ->with('servers', $servers);
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
        $community = Community::find($id);

        if (!$community) {
            return response()->json(['error' => 'Comunidad no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|min:2',
            'description' => 'sometimes|string|nullable',
            'whatsapp' => 'sometimes|string|nullable',
            'instagram' => 'sometimes|string|nullable',
            'tiktok' => 'sometimes|string|nullable',
            'youtube' => 'sometimes|string|nullable',
            'discord' => 'sometimes|string|nullable',
            'website' => 'sometimes|string|nullable',
            'logo' => 'sometimes|required|mimes:jpg,jpeg,png|max:1048'
        ]);
        
        if ($request->has('logo')) {
            $user = auth()->user();

            $logo = $request->file('logo');
            $ext = $logo->guessExtension();
            $logo_name = "logo_$user->id.$ext";

            Storage::disk('public')->put("communities/$logo_name",  File::get($logo));
            
            $community->logo = $logo_name;
        } else {
            $logo_name = $community->logo ?: 'default.png';
        }

        unset($validatedData['logo']);

        $validatedData['description'] = Purify::clean($request->description);

        $community->update($validatedData);

        return response()->json($community, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
