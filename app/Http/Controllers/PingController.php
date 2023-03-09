<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PingController extends Controller
{
    //

    function pingGameServers() 
    {
        // Server on windows
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $pingreply = exec("ping gameservers.4evergaming.com.ar");
            //$ping = substr($pingreply, 28, 4);
            $ping = substr($pingreply, 30, 4);          // Windows 11
        } else {
            $pingreply = exec("ping -c 1 gameservers.4evergaming.com.ar");
            $ping = substr($pingreply, 22, 5);
        }

        if (empty($ping))
            return response()->json(['message' => 'Status Offline'], 500);

        return intval($ping)." ms";
    }
}
