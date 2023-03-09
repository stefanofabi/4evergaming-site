<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterStrikePageController extends Controller
{
    //

    use \App\Traits\WHMCS;

    function index(Request $request)
    {
        return view('pages/counter-strike/index')
        ->with('dollar_price', $this->getCurrencyPrice('ARS'))
        ->with('slot_300fps_price', 0.35)
        ->with('slot_500fps_price', 0.45)
        ->with('slot_1000fps_price', 0.50);
    }
}
