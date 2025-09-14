<?php

namespace App\Http\Middleware\Tournaments;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationRequirements
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tournament = $request->tournament;

        $user = auth()->user();

        if ($tournament->type == 'team' && ! $user->team) {
            return back();
        }

        if ($tournament->type == 'community' && ! $user->community) {
            return back();
        }

        return $next($request);
    }
}
