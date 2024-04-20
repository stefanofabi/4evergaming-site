<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Traits\WHMCS;

class StatsController extends Controller
{
    //

    use WHMCS;

    public function index()
    {
        $currentYear = Carbon::now()->year;
        $totalPaid = $this->getBilling($currentYear);
      
        return view('stats.index')
            ->with('totalPaid', $totalPaid);
    }
    
}
