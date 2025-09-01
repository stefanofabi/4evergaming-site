<?php

namespace App\Http\Middleware\Tournaments;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TournamentIsUpcoming
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tournament = $request->tournament;

        if ($tournament->status != 'upcoming')
            return back();

        return $next($request);
    }
}
