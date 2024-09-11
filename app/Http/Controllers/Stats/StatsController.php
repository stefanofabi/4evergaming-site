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
        return view('stats.index');
    }

    public function billing()
    {
        $currentYear = Carbon::now()->year;
        
        $billingToday = $this->getBillingForToday();
        
        // Attach colors to each payment
        $billingToday = $billingToday->map(function ($payment) {
            $payment->color = $this->getColorForCurrency($payment->currency_code);
            return $payment;
        });

        $billing = $this->getBilling($currentYear);

        $billingByYear = $this->getBillingByYear();

        $getMoreFrequentPaymentMethods = $this->GetMoreFrequentPaymentMethods();
        
        return view('stats.billing')
            ->with('billingToday', $billingToday)
            ->with('moreFrequentPaymentMethods', $getMoreFrequentPaymentMethods)
            ->with('billing', $this->getDatasets($billing))
            ->with('billingByYear', $this->getDatasets($billingByYear));
    }
    
    private function getDatasets($billing) 
    {
        $timeline = $billing->pluck('label')->unique()->sort()->values();
        $currencies = $billing->pluck('currency_code')->unique();
        $datasets = $currencies->map(function($currency) use ($billing, $timeline) {
            return [
                'label' => $currency,
                'backgroundColor' => $this->getColorForCurrency($currency),
                'borderColor' => $this->getColorForCurrency($currency),
                'data' => $timeline->map(function($year) use ($currency, $billing) {
                    $filteredData = $billing->filter(function($item) use ($year, $currency) {
                        return $item->label == $year && $item->currency_code == $currency;
                    });
                    return $filteredData->first()->total ?? 0;
                })->values()
            ];
        })->values();

        return ['timeline' => $timeline, 'datasets' => $datasets];
    }

    private function getColorForCurrency($currency)
    {
        // Define unique colors for each currency
        $colors = [
            'ARS' => 'rgba(0, 137, 209, 1)', 
            'CLP' => 'rgba(255, 0, 0, 1)',   
            'USD' => 'rgba(0, 0, 255, 1)',  
            'PYG' => 'rgba(139, 0, 0, 1)',    
            'BRL' => 'rgba(0, 128, 0, 1)',   
            'UYU' => 'rgba(0, 0, 139, 1)'    
        ];

        return $colors[$currency] ?? 'rgba(75, 192, 192, 1)'; // Default color if currency not found
    }

}
