<?php 

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait SystemStats {

    public function getSystemStats($node, $fromDate)
    {
        return DB::connection($node)
            ->table('system_stats')
            ->select(DB::raw('CONCAT(DAYNAME(timestamp), " ", DAY(timestamp), " ", DATE_FORMAT(timestamp, "%H:%i")) as measurement_date'), 'cpu', 'memory', 'swap', 'disk', 'disk_read', 'disk_write', 'disk_wait', 'network_receive', 'network_transmit', 'cpu_temp', 'timestamp')
            ->where('timestamp', '>=', $fromDate)
            ->orderBy('timestamp', 'asc')
            ->get();
    }

    public function getSensors($node)
    {
        return DB::connection($node)
            ->table('sensors')
            ->select(
                'sensors.id',
                'sensors.name',
                'sensors.ip',
                'sensors.active',
                DB::raw('(SELECT response_time FROM latencies WHERE sensor_id = sensors.id ORDER BY timestamp DESC LIMIT 1) as last_response_time')
            )
            ->get();
    }

    public function getLatencies($node, $sensor, $fromDate)
    {
        return DB::connection($node)
            ->table('latencies')
            ->select(DB::raw('CONCAT(DAYNAME(timestamp), " ", DAY(timestamp), " ", DATE_FORMAT(timestamp, "%H:%i")) as measurement_date'), 'response_time', 'timestamp')
            ->where('timestamp', '>=', $fromDate)
            ->where('sensor_id', $sensor)
            ->orderBy('timestamp', 'asc')
            ->get();
    }
}