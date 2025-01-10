<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MultiTheftAutoPageController extends Controller
{
    //

    use \App\Traits\WHMCS;

    function index(Request $request)
    {
        return view('pages.games.multi-theft-auto.index')
        ->with('dollar_price', $this->getCurrencyPrice('ARS'));
    }
}
