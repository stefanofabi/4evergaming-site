<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Node;
use App\Models\OnlinePlayerHistory;
use App\Models\Server;
use App\Models\Game;
use App\Models\Payment;

use App\Traits\WHMCS;
use App\Traits\SystemStats;

class AdminController extends Controller
{
    //

    use WHMCS;
    use SystemStats;

    private const MY_COLLECTOR_ID = 169507153;

    private const MY_EMAIL = "cobranzas@4evergaming.com.ar";

    public function index()
    {
        return view('admin.index');
    }

    public function payments()
    {
        $payments = Payment::where('verified', false)->orderBy('date', 'asc')->get();
        
        return view('admin.payments')
            ->with('payments', $payments);
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

        $getMoreFrequentPaymentMethods = $this->getMoreFrequentPaymentMethods();
        
        return view('admin.billing')
            ->with('billingToday', $billingToday)
            ->with('moreFrequentPaymentMethods', $getMoreFrequentPaymentMethods)
            ->with('billing', $this->getDatasets($billing))
            ->with('billingByYear', $this->getDatasets($billingByYear));
    }

    public function nodes(Request $request) 
    {
        $nodes = Node::all();

        $node = Node::where('name', $request->node)->first();

        $view = view('admin.nodes')
            ->with('nodes', $nodes)
            ->with('node', $node);

        if (! empty($node) && $node->enable_monitor) 
        { 
            $now = Carbon::now();
            $twentyFourHoursAgo = $now->subHours(24);
            
            $data = $this->getSystemStats($node->mysql_connection, $twentyFourHoursAgo);

            // Preparar los datos para enviar a la vista
            $timestamps = $data->pluck('measurement_date');
            $cpu = $data->pluck('cpu');
            $memory = $data->pluck('memory');
            $disk = $data->pluck('disk');
            $disk_read = $data->pluck('disk_read');
            $disk_write = $data->pluck('disk_write');
            $network_receive = $data->pluck('network_receive');
            $network_transmit = $data->pluck('network_transmit');
            $cpu_temp = $data->pluck('cpu_temp');
            

            // Last stats
            $lastRecord = $data->last();
            $current_cpu = round($lastRecord->cpu);
            $current_memory = round($lastRecord->memory);
            $current_disk = round($lastRecord->disk);
            $current_network = round($lastRecord->network_transmit);
            $current_measurement_date = $lastRecord->measurement_date;

            $view
            ->with('timestamps', $timestamps)
            ->with('cpu', $cpu)
            ->with('memory', $memory)
            ->with('disk', $disk)
            ->with('disk_read', $disk_read)
            ->with('disk_write', $disk_write)
            ->with('network_receive', $network_receive)
            ->with('network_transmit', $network_transmit)
            ->with('cpu_temp', $cpu_temp)
            ->with('current_cpu', $current_cpu)
            ->with('current_memory', $current_memory)
            ->with('current_disk', $current_disk)
            ->with('current_network', $current_network)
            ->with('current_measurement_date', $current_measurement_date);
        }

        return $view;
    }

    public function sensors(Request $request) 
    {
        $nodes = Node::all();

        $node = Node::where('name', $request->node)->first();

        $view = view('admin.sensors')
        ->with('nodes', $nodes)
        ->with('node', $node);

        if (! empty($node) ) {
            $sensors = $this->getSensors($node->mysql_connection);
            $sensor = $sensors->where('name', $request->sensor)->first();
            
            if (! empty($sensor)) 
            {   
                $now = Carbon::now();
                $twentyFourHoursAgo = $now->subHours(24);

                $latencies = $this->getLatencies($node->mysql_connection, $sensor->id, $twentyFourHoursAgo);
                
                $view->with('latencies', $latencies);
            }
            
            $view->with('sensors', $sensors);
            $view->with('sensor', $sensor);
        }

        return $view;
    }
    
    private function getDatasets($billing) 
    {
        $timeline = $billing->pluck('label')->unique()->values();
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

    public function gameHistory(Request $request)
    {   
        $games = Game::all();

        $game = Game::find($request->game);

        $gameHistory = [
            'day' => [],
            'count' => [],
        ];

        if (! empty($game)) 
        {
            $subquery = OnlinePlayerHistory::selectRaw('DATE(created_at) AS day, server_id, MAX(count) AS count')
            ->groupBy('day', 'server_id');
        
            $serversSubquery = Server::selectRaw('oph.day, servers.game_id, SUM(count) AS count')
                ->joinSub($subquery, 'oph', function($join) {
                    $join->on('oph.server_id', '=', 'servers.id');
                })
                ->where('servers.game_id', $game->id)
                ->groupBy('oph.day', 'servers.game_id');
            
            $results = Game::select('servers.day', 'games.name', 'servers.count')
                ->joinSub($serversSubquery, 'servers', function($join) {
                    $join->on('servers.game_id', '=', 'games.id');
                })
                ->orderBy('games.name')
                ->orderBy('servers.day')
                ->get();
                
            
            foreach ($results as $result) 
            {
                $gameHistory['day'][] = $result->day;
                $gameHistory['count'][] = (int)$result->count;
            }
        }

        return view('admin.game_history')
            ->with('games', $games)
            ->with('game', $game)
            ->with('gameHistory', $gameHistory);
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

    public function fetchAndStorePayments()
    {
        // Obtener el token desde .env
        $accessToken = env('MERCADOPAGO_ACCESS_TOKEN');

        if (empty($accessToken)) {
            return response()->json(['error' => 'Token de acceso de MercadoPago no configurado'], 500);
        }

        $url = "https://api.mercadopago.com/v1/payments/search";
        $params = [
            'status'         => 'approved',
            'begin_date'     => 'NOW-3DAYS',
            'end_date'       => 'NOW',
            'range'          => 'date_last_updated',
            'sort'           => 'date_last_updated',
            'criteria'       => 'desc',
        ];

        $response = Http::withHeaders([
            'Authorization'     => 'Bearer ' . $accessToken,
            'Content-Type'      => 'application/json',
            'x-integrator-id'   => 'dev_ea52525a0a6e11eb98420242ac130004',
        ])->get($url, $params);

        if (!$response->successful()) {
            return response()->json(['error' => 'Error al consultar pagos en MercadoPago'], 500);
        }

        $pagos = $response->json()['results'];
        $creados = 0;
        $actualizados = 0;

        foreach ($pagos as $pago) {
            // no es un pago que haya recibido 
            if (!isset($pago['collector_id']) || $pago['collector_id'] != self::MY_COLLECTOR_ID)
                continue;

            // recibí un pago pero fue un depósito mío
            if (!isset($pago['payer']['email']) || $pago['payer']['email'] == self::MY_EMAIL)
                continue;

            // recibí un pago pero fue un crédito solicitado
            if ($pago['payer']['email'] == "creditos@mercadopago.com")
                continue;

            $firstName = $pago['payer']['first_name'] ?? null;
            $lastName = $pago['payer']['last_name'] ?? null;
            $email = $pago['payer']['email'] ?? null;

            // verificar email en WHMCS
            $clientWhmcs = DB::connection('whmcs')
                ->table('tblclients')
                ->where('email', $email)
                ->first();

            if ($clientWhmcs) {
                $firstName = $clientWhmcs->firstname;
                $lastName = $clientWhmcs->lastname;
            }

            $description = $pago['description'] ?? null;
            $transactionId = $pago['id'];
            $paymentMethod = $pago['payment_method_id'] ?? null;
            $paymentType = $pago['payment_type_id'] ?? null;
            $external_reference = $pago['external_reference'] ?? null;
            $date = substr($pago['date_approved'], 0, 10);
            $amount = $pago['transaction_amount'];
            $status = ucfirst($pago['status']);

            $verified = DB::connection('whmcs')
                ->table('tblaccounts')
                ->where('transid', $transactionId)
                ->first();

            $existingPayment = Payment::where('transaction', $transactionId)->first();

            if ($existingPayment) {
                $actualizados++;
            } else {
                $creados++;
            }

            Payment::updateOrCreate(
                ['transaction' => $transactionId],
                [
                    'first_name'    => $firstName,
                    'last_name'     => $lastName,
                    'email'         => $email,
                    'description'   => $description,
                    'payment_method'=> $paymentMethod,
                    'payment_type'  => $paymentType,
                    'external_reference' => $external_reference,
                    'date'          => $date,
                    'amount'        => $amount,
                    'status'        => $status,
                    'verified'      => $verified ? true : false,
                    'client_id'     => $clientWhmcs->id ?? null,
                ]
            );
        }

        return response()->json([
            'mensaje'      => 'Proceso completado',
            'creados'      => $creados,
            'actualizados' => $actualizados,
        ]);
    }

}