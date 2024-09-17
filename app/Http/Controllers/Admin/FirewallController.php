<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Rules\ValidIpPrefix;

use App\Models\FirewallRule;
use App\Models\NetworkAddress;

class FirewallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $firewallRules = FirewallRule::all();
        $networkAddresses = NetworkAddress::all();

        return view('admin.firewall.index')
            ->with('firewallRules', $firewallRules)
            ->with('networkAddresses', $networkAddresses);
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
            'source_ip' => ['required', new ValidIpPrefix],
            'flow' => 'required|in:INPUT,OUTPUT',
            'destination_port' => 'numeric|min:0|max:65535|nullable',
            'protocol' => 'required|in:ANY,TCP,UDP',
            'action' => 'required|in:ACCEPT,DROP',

        ]);

        $firewallRule = FirewallRule::create($request->all());

        if (! $firewallRule ) {
            return response()->json(['errors' => true, 'message' => 'Hubo un error al crear la regla'], 500);
        }

        return response()->json($firewallRule, 200);
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

        $firewallRule = FirewallRule::findOrFail($id);
        
        $firewallRule->delete();

        return redirect()->back();
    }
}
