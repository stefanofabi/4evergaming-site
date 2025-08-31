<?php

namespace App\Http\Middleware\Tournaments;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Tournament;

class VerifyTournamentOrganizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tournament = $request->tournament ?? Tournament::findOrFail($request->id);

        $user = auth()->user();

        if ($tournament->organizer_id == $user->id)
                return $next($request);

        // or is it stefano (owner) who wants to access
        if ($user->steam_id == '76561198259502796')
            return $next($request);

        return back();
    }
}
