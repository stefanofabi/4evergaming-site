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

        return response()->json(['errors' => true, 'message' => 'No sos el propietario de la Comunidad'], 412);
    }
}
