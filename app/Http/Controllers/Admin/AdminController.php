<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Node;

use App\Traits\WHMCS;
use DB;

class AdminController extends Controller
{
    //

    use WHMCS;

    public function index()
    {
        return view('admin.index');
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
        
        return view('admin.billing')
            ->with('billingToday', $billingToday)
            ->with('moreFrequentPaymentMethods', $getMoreFrequentPaymentMethods)
            ->with('billing', $this->getDatasets($billing))
            ->with('billingByYear', $this->getDatasets($billingByYear));
    }

    public function nodes(Request $request) 
    {
        $billing = $this->getBilling(2024);
        
        $nodes = Node::all();

        $node = Node::find($request->node);

        $view = view('admin.nodes')
            ->with('nodes', $nodes)
            ->with('node', $node);

        if (! empty($node) && $node->enable_monitor) 
        { 
            $now = Carbon::now();
            $twentyFourHoursAgo = $now->subHours(24);

            $data = DB::connection($node->mysql_connection)
                        ->table('system_stats')
                        ->select('timestamp', 'cpu_total', 'memory_used', 'disk_read', 'disk_write', 'network_receive_mbps', 'network_transmit_mbps')
                        ->where('timestamp', '>=', $twentyFourHoursAgo)
                        ->orderBy('timestamp', 'asc')
                        ->get();

            // Preparar los datos para enviar a la vista
            $timestamps = $data->pluck('timestamp');
            $cpu_total = $data->pluck('cpu_total');
            $memory_used = $data->pluck('memory_used');
            $disk_read = $data->pluck('disk_read');
            $disk_write = $data->pluck('disk_write');
            $network_receive_mbps = $data->pluck('network_receive_mbps');
            $network_transmit_mbps = $data->pluck('network_transmit_mbps');
            
            $view
            ->with('timestamps', $timestamps)
            ->with('cpu_total', $cpu_total)
            ->with('memory_used', $memory_used)
            ->with('disk_read', $disk_read)
            ->with('disk_write', $disk_write)
            ->with('network_receive_mbps', $network_receive_mbps)
            ->with('network_transmit_mbps', $network_transmit_mbps);
        }

        return $view->with('billing', $this->getDatasets($billing));
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
