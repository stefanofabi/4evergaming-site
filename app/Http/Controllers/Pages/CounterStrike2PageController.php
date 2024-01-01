<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterStrike2PageController extends Controller
{
    //

    use \App\Traits\WHMCS;

    function index(Request $request)
    {
        return view('pages/counter-strike-2/index')
        ->with('dollar_price', $this->getCurrencyPrice('ARS'))
        //->with('slot_64tickrate_price', 0.60)
        ->with('slot_128tickrate_price', 1.00);
    }

}
