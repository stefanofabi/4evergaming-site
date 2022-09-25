<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PingController extends Controller
{
    //

    function pingGameServers() 
    {
        $pingreply = exec("ping gameservers.4evergaming.com.ar");
        $ping = substr($pingreply, 28, 4);

        if (empty($ping))
            return response()->json(['message' => 'Status Offline'], 500);

        return $ping;
    }
}
