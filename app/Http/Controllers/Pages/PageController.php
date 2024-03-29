<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\WHMCS;
use App\Models\Community;

class PageController extends Controller
{
    //

    use WHMCS;

    function index(Request $request)
    {
        $communities = Community::orderBy('calification', 'DESC')->limit(15)->get();

        $network_issues = $this->getNetworkIssues();

        $last_orders = $this->getLastOrders();

        return view('pages/home/index')
        ->with('dollar_price', $this->getCurrencyPrice('ARS'))
        ->with('total_clients', ceil($this->getTotalClients() / 1000) * 1000)
        ->with('communities', $communities)
        ->with('network_issues', $network_issues)
        ->with('last_orders', $last_orders);

        /*
        ->with('total_cs_servers', $this->getHostingAccounts([1,2,3])->count())
        ->with('total_mta_servers', $this->getHostingAccounts([22])->count())
        ->with('total_csgo_servers', $this->getHostingAccounts([28, 29])->count())
        ->with('total_minecraft_servers', $this->getHostingAccounts([41, 85])->count())
        ->with('cs_servers', [
            ['45.235.98.67', '27025'],
            ['45.235.98.61', '27015'],
            ['45.235.98.41', '27015'],
            ['45.235.98.44', '27015'],
            ['45.235.98.66', '27038']
        ])
        ->with('csgo_servers', [
            ['45.235.98.65', '27025'],
            ['45.235.98.69', '27033'],
            ['45.235.98.42', '27021'],
            ['45.235.98.74', '27019'],
            ['45.235.98.61', '27020']
        ])
        ->with('mta_servers', [
            ['45.235.98.42', '22003'],
            ['45.235.98.42', '22043'],
            ['45.235.98.40', '22053'],
            ['45.235.98.66', '22023'],
            ['45.235.98.42', '22033']
        ])
        ->with('minecraft_servers', [
            ['45.235.98.42', '25565'],
            ['45.235.98.48', '25565'],
            ['45.235.98.61', '25575'],
            ['45.235.98.62', '25565']
        ]);
        */
    }
}
