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
	$communities = Community::with('servers')
    	->whereHas('servers')
    	->orderBy('calification', 'DESC')
    	->limit(10)
    	->get();	
	
	$last_orders = $this->getLastOrders();

	return view('nuevositio/index')
	->with('dollar_price', $this->getCurrencyPrice('ARS'))
	->with('communities', $communities)
        ->with('last_orders', $last_orders);



        $communities = Community::orderBy('calification', 'DESC')->limit(15)->get();

        $network_issues = $this->getNetworkIssues();

        $last_orders = $this->getLastOrders();

        return view('pages/home/index')
        ->with('dollar_price', $this->getCurrencyPrice('ARS'))
        ->with('total_clients', ceil($this->getTotalClients() / 1000) * 1000)
        ->with('communities', $communities)
        ->with('network_issues', $network_issues)
        ->with('last_orders', $last_orders);
    }
}
