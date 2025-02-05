<?php

namespace App\Http\Middleware\Servers;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyServerOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // it stefano (owner) who wants to access
        if ($user->steam_id == '76561198259502796')
            return $next($request);

        foreach ($user->community->servers as $server) {
            if ($server->id == $request->id) {
                return $next($request);
            }
        }
        
        return response()->json(['errors' => true, 'message' => 'No sos el propietario del servidor'], 412);
    }
}
