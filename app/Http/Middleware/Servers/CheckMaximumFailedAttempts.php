<?php

namespace App\Http\Middleware\Servers;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Server;

class CheckMaximumFailedAttempts
{
    private const MAX_FAILED_ATTEMPTS = 2000; 
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $server = Server::where('ip', $request->ip)->where('port', $request->port)->first();

        if ($server->failed_attempts > self::MAX_FAILED_ATTEMPTS) {
            $server->delete();
            
            return response()->json(['message' => 'No existe este servidor en nuestra base de datos'], 404);
        }

        return $next($request);
    }
}
