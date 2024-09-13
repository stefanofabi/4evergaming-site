<?php 

namespace App\Traits;

use Carbon\Carbon;
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

    function getTotalClients($status = null) 
    {
        $clients = DB::connection('whmcs')
        ->table('tblclients');

        if (! is_null($status)) $clients = $clients->where('status', $status);
        
        return $clients
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

    function getNetworkIssues() 
    {
        return DB::connection('whmcs')
        ->table('tblnetworkissues')
        ->where('status', '<>', 'Resolved')
        ->get();  
    }

    function getGamePrices($configid, $currency) {
        return DB::connection('whmcs')
        ->table('tblproductconfigoptionssub')
        ->select('tblproductconfigoptionssub.optionname', 'tblpricing.monthly', 'tblproductconfigoptionssub.sortorder')
        ->join('tblpricing', 'tblpricing.relid', '=', 'tblproductconfigoptionssub.id')
        ->where('tblproductconfigoptionssub.configid', $configid)
        ->where('tblproductconfigoptionssub.hidden', 0)
        ->where('tblpricing.currency', $currency)
        ->where('tblpricing.type', 'configoptions')
        ->orderBy('tblproductconfigoptionssub.sortorder', 'ASC')
        ->get();
    }

    function getLastOrders() {
        return DB::connection('whmcs')
        ->table('tblorders')
        ->select('tblorders.id', 'tblorders.date', 'tblclients.firstname', 'tblclients.lastname', 'tblclients.city', 'tblclients.state', 'tblclients.country', 'tblproducts.name as product')
        ->selectRaw('TIMESTAMPDIFF(MINUTE, tblorders.date, NOW()) AS diff_minutes')
        ->join('tblclients', 'tblclients.id', '=', 'tblorders.userid')
        ->join('tblhosting', 'tblhosting.orderid', '=', 'tblorders.id')
        ->join('tblproducts', 'tblproducts.id', '=', 'tblhosting.packageid')
        ->whereRaw('tblorders.date >= DATE_SUB(NOW(), INTERVAL 7 DAY)')
        ->orderBy('tblorders.date', 'ASC')
        ->get();
    }

    function getBillingForToday() 
    {
        return DB::connection('whmcs')
            ->table('tblinvoices')
            ->join('tblclients', 'tblinvoices.userid', '=', 'tblclients.id')
            ->join('tblcurrencies', 'tblclients.currency', '=', 'tblcurrencies.id')
            ->selectRaw("
                tblcurrencies.code as currency_code,
                SUM(tblinvoices.total) as total
            ")
            ->where('tblinvoices.status', 'Paid')
            ->whereDate('tblinvoices.datepaid', '=', now()->toDateString())
            ->groupBy('currency_code')
            ->get();
    }

    function getBilling(int $year) 
    {
        return DB::connection('whmcs')
        ->table('tblinvoices')
        ->join('tblclients', 'tblinvoices.userid', '=', 'tblclients.id')
        ->join('tblcurrencies', 'tblclients.currency', '=', 'tblcurrencies.id')
        ->selectRaw("
            DATE_FORMAT(tblinvoices.date, '%M %Y') as label, 
            MONTH(tblinvoices.date) AS month, 
            YEAR(tblinvoices.date) AS year, 
            tblcurrencies.code as currency_code, 
            SUM(tblinvoices.total) as total
        ")
        ->where('tblinvoices.status', 'Paid')
        ->whereRaw("YEAR(tblinvoices.date) = $year")
        ->groupBy('label', 'month', 'year', 'currency_code')
        ->orderBy('year', 'ASC')
        ->orderBy('month', 'ASC')
        ->get();
    }

    function getBillingByYear() 
    {
        return DB::connection('whmcs')
            ->table('tblinvoices')
            ->join('tblclients', 'tblinvoices.userid', '=', 'tblclients.id')
            ->join('tblcurrencies', 'tblclients.currency', '=', 'tblcurrencies.id')
            ->selectRaw("
                DATE_FORMAT(tblinvoices.date, '%Y') as label, 
                tblcurrencies.code as currency_code, 
                SUM(tblinvoices.total) as total
            ")
            ->where('tblinvoices.status', 'Paid')
            ->groupBy('label', 'currency_code')
            ->orderBy('label', 'ASC')
            ->orderBy('currency_code', 'ASC')
            ->get();
    }


    function getMoreFrequentPaymentMethods() 
    {
        $startDate = Carbon::now()->subDays(365)->toDateString();
        
        return DB::connection('whmcs')
            ->table('tblinvoices')
            ->selectRaw('paymentmethod as label, count(*) as count')
            ->where('status', 'Paid')
            ->whereDate('date', '>=', $startDate)
            ->groupBy('paymentmethod')
            ->get();
    }
}