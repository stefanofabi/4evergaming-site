<?php

namespace App\Http\Middleware\Communities;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserHaveCommunity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $community = auth()->user()->community;

        if (is_null($community)) {
            return response()->json(['errors' => true, 'message' => 'No registraste tu comunidad en la plataforma']);
        }
        
        return $next($request);
    }
}
