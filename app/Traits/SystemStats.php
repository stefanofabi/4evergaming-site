<?php 

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait SystemStats {

    public function getSystemStats($node, $fromDate)
    {
        return DB::connection($node)
            ->table('system_stats')
            ->select(DB::raw('CONCAT(DAYNAME(timestamp), " ", DAY(timestamp), " ", DATE_FORMAT(timestamp, "%H:%i")) as measurement_date'), 'cpu', 'memory', 'disk', 'disk_read', 'disk_write', 'network_receive', 'network_transmit', 'cpu_temp', 'timestamp')
            ->where('timestamp', '>=', $fromDate)
            ->orderBy('timestamp', 'asc')
            ->get();
    }

    public function getSensors($node, $fromDate)
    {
        return DB::connection($node)
            ->table('latencies')
            ->select(DB::raw('CONCAT(DAYNAME(timestamp), " ", DAY(timestamp), " ", DATE_FORMAT(timestamp, "%H:%i")) as measurement_date'), 'sensor_name', 'response_time', 'timestamp')
            ->where('timestamp', '>=', $fromDate)
            ->orderBy('timestamp', 'asc')
            ->get();
    }
}