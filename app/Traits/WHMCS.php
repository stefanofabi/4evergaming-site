<?php 

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait WHMCS {

    function getCurrencyPrice($currency_code) 
    {
        return DB::connection('whmcs')
        ->table('tblcurrencies')
        ->where('code', $currency_code)
        ->first()
        ->rate;
    }

    function getTotalClients() 
    {
        return DB::connection('whmcs')
        ->table('tblclients')
        ->where('status', 'Active')
        ->get()
        ->count();
    }

    function getTotalHostingAmount()
    {
        return DB::connection('whmcs')
        ->table('tblhosting')
        ->select('packageid', 'billingcycle', DB::raw('SUM(amount) as total_amount'))
        ->where('domainstatus', 'Active')
        ->groupBy('packageid')
        ->groupBy('billingcycle')
        ->get();
    }

    function getTotalAddonsAmount() 
    {
        return DB::connection('whmcs')
        ->table('tblhostingaddons')
        ->select('addonid', 'billingcycle', DB::raw('SUM(recurring) as total_amount'))
        ->where('status', 'Active')
        ->groupBy('addonid')
        ->groupBy('billingcycle')
        ->get();
    }

    function getHostingAccounts($packageids = [])
    {   
        return DB::connection('whmcs')
        ->table('tblhosting')
        ->select('packageid', 'domain', 'amount')
        ->where('domainstatus', 'Active')
        ->where(function ($query) use ($packageids) {
            if (count($packageids))
            {
                foreach ($packageids as $packageid) {
                    $query->orWhere('packageid', $packageid);
                }
            }
            
        })
        ->orderBy('packageid')
        ->get();
    }
}