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
                    $fourHoursAgo = $now->subHours(4);
                    
                    $data = $this->getSystemStats($iNode->mysql_connection, $fourHoursAgo);

                    if (! empty($node) && $node->id == $iNode->id) {
                        $timestamps = $data->pluck('measurement_date');
                        $cpu = $data->pluck('cpu');
                        $memory = $data->pluck('memory');
                        $swap = $data->pluck('swap');
                        $disk = $data->pluck('disk');
                        $disk_read = $data->pluck('disk_read');
                        $disk_write = $data->pluck('disk_write');
                        $disk_wait = $data->pluck('disk_wait');
                        $network_receive = $data->pluck('network_receive');
                        $network_transmit = $data->pluck('network_transmit');
                        $cpu_temp = $data->pluck('cpu_temp');

                        $view
                            ->with('timestamps', $timestamps)
                            ->with('cpu', $cpu)
                            ->with('memory', $memory)
                            ->with('swap', $swap)
                            ->with('disk', $disk)
                            ->with('disk_read', $disk_read)
                            ->with('disk_write', $disk_write)
                            ->with('disk_wait', $disk_wait)
                            ->with('network_receive', $network_receive)
                            ->with('network_transmit', $network_transmit)
                            ->with('cpu_temp', $cpu_temp);

                            $sensors = $this->getSensors($node->mysql_connection);
                            $sensor = $sensors->where('name', $request->sensor)->first();

                            if (! empty($sensor)) 
                            {                  
                                $latencies = $this->getLatencies($node->mysql_connection, $sensor->id, $fourHoursAgo);

                                $view->with('latencies', $latencies);
                            }
                            
                            $view->with('sensors', $sensors);
                            $view->with('sensor', $sensor);

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

        if (empty($node)) {
            $totalOnlinePlayers = $this->getTotalOnlinePlayers();        
            $view->with('totalOnlinePlayers', $totalOnlinePlayers);
        }
        
        return $view->with('measurements', $measurements);
            
    }

    private function getTotalOnlinePlayers() 
    {
        return DB::table('servers')
            ->select(
                DB::raw("STR_TO_DATE(JSON_UNQUOTE(JSON_EXTRACT(json_obj, '$.date')), '%Y-%m-%d') AS original_date"),
                DB::raw("DATE_FORMAT(STR_TO_DATE(JSON_UNQUOTE(JSON_EXTRACT(json_obj, '$.date')), '%Y-%m-%d'), '%d %b %Y') AS date"),
                DB::raw("SUM(CAST(JSON_UNQUOTE(JSON_EXTRACT(json_obj, '$.count')) AS UNSIGNED)) AS total_count")
            )
            ->join(
                DB::raw('JSON_TABLE(servers.stats_30_days, "$[*]" COLUMNS (json_obj JSON PATH "$")) AS jt'),
                DB::raw('1'),
                '=',
                DB::raw('1')
            )
            ->groupBy(DB::raw("original_date, date"))
            ->orderBy(DB::raw("original_date"))
            ->get();
    }


}
