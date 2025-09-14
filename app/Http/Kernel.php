<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        
        // CSRF Token not generated in error pages
        \Illuminate\Session\Middleware\StartSession::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'user_have_community' => \App\Http\Middleware\Communities\UserHaveCommunity::class,
        'verify_community_owner' => \App\Http\Middleware\Communities\VerifyCommunityOwner::class,
        'verify_server_owner' => \App\Http\Middleware\Servers\VerifyServerOwner::class,
        'check_if_exists_server' => \App\Http\Middleware\Servers\CheckIfExistsServer::class,
        'check_maximum_failed_attempts' => \App\Http\Middleware\Servers\CheckMaximumFailedAttempts::class,
        'check_last_update' => \App\Http\Middleware\Servers\CheckLastUpdate::class,
        'is_admin' => \App\Http\Middleware\IsAdmin::class,
        'register_server_if_official' => \App\Http\Middleware\Servers\RegisterServerIfOfficial::class,
        'check_firewall_rule' => \App\Http\Middleware\Firewall\CheckFirewallRule::class,
        'verify_tournament_organizer' => \App\Http\Middleware\Tournaments\VerifyTournamentOrganizer::class,
        'tournament_in_progress' => \App\Http\Middleware\Tournaments\TournamentInProgress::class,
        'tournament_is_upcoming' => \App\Http\Middleware\Tournaments\TournamentIsUpcoming::class,
        'tournament_not_completed' => \App\Http\Middleware\Tournaments\TournamentNotCompleted::class,
        'check_registration_requirements' => \App\Http\Middleware\Tournaments\CheckRegistrationRequirements::class,

    ];
}
