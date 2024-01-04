<?php

namespace App\Http\Middleware\Servers;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

use App\Models\Server;

class CheckLastUpdate
{
    private const REFRESH_PERIOD = 300; 

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $server = Server::where('ip', $request->ip)->where('port', $request->port)->first();

        $lastUpdate = Carbon::parse($server->updated_at);
        $now = Carbon::now();	

        $diffSeconds = $now->diffInSeconds($lastUpdate);
        
        if ($diffSeconds > self::REFRESH_PERIOD || $request->force_update == 1) {
            return $next($request);
        }
        
        return response()->json($server, 200);        
    }
}
