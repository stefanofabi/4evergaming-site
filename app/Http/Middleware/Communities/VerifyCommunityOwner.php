<?php

namespace App\Http\Middleware\Communities;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCommunityOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user->community->id == $request->id)
            return $next($request);

        // or is it stefano (owner) who wants to access
        if ($user->steam_id == '76561198259502796')
            return $next($request);

        return response()->json(['errors' => true, 'message' => 'No sos el propietario de la Comunidad'], 412);
    }
}
