<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Node;

use DB;

use App\Traits\SystemStats;

use Exception;

class ServerStatusController extends Controller
{
    use SystemStats;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $nodes = Node::all();

        $node = Node::where('name', $request->node)->first();

        $measurements = [];
        
        $view = view('pages.server-status.index')
            ->with('nodes', $nodes)
            ->with('node', $node); 
       
        foreach ($nodes as $iNode)
        {
            if (! $iNode->enable_monitor)
                continue;

                try 
                {
                    $now = Carbon::now();
                    $FourHoursAgo = $now->subHours(4);
                    
                    $data = $this->getSystemStats($iNode->mysql_connection, $FourHoursAgo);

                    if (! empty($node) && $node->id == $iNode->id) {
                        $timestamps = $data->pluck('measurement_date');
                        $cpu = $data->pluck('cpu');
                        $memory = $data->pluck('memory');
                        $disk = $data->pluck('disk');
                        $disk_read = $data->pluck('disk_read');
                        $disk_write = $data->pluck('disk_write');
                        $network_receive = $data->pluck('network_receive');
                        $network_transmit = $data->pluck('network_transmit');
                        $cpu_temp = $data->pluck('cpu_temp');

                        $view
                            ->with('timestamps', $timestamps)
                            ->with('cpu', $cpu)
                            ->with('memory', $memory)
                            ->with('disk', $disk)
                            ->with('disk_read', $disk_read)
                            ->with('disk_write', $disk_write)
                            ->with('network_receive', $network_receive)
                            ->with('network_transmit', $network_transmit)
                            ->with('cpu_temp', $cpu_temp);
                    }

                    $last_measurement = $data->last();
                    $measurements[$iNode->name] = [
                        'cpu' => $last_measurement->cpu,
                        'memory' => $last_measurement->memory,
                        'disk' => $last_measurement->disk,
                        'network' => $last_measurement->network_transmit,
                        'timestamp' => $last_measurement->timestamp,
                    ];
            
                } catch (Exception $e) 
                {
                    $measurements[$iNode->name] = [
                        'cpu' => null,
                        'memory' => null,
                        'disk' => null,
                        'network' => null,
                        'timestamp' => null
                    ];
                }
        }
        
        return $view
            ->with('measurements', $measurements);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
