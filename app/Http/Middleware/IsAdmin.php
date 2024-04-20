<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    
    	$user = auth()->user();
    	
    	if ($user->steam_id != "76561198259502796")
    		return redirect()->back()->withErrors('Acceso no autorizado');
    
        return $next($request);
    }
}
