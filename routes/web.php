<?php

// force all routes to https
if (app()->environment('production')) {
    URL::forceScheme('https');
}

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Auth\SteamAuthController;
use App\Http\Controllers\Auth\LogoutController;

use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Pages\CounterStrikePageController;
use App\Http\Controllers\Pages\CounterStrikeGlobalOffensivePageController;
use App\Http\Controllers\Pages\CounterStrike2PageController;
use App\Http\Controllers\Pages\MultiTheftAutoPageController;
use App\Http\Controllers\Pages\ServerStatusController;
use App\Http\Controllers\Pages\VirtualPrivateServerController;
use App\Http\Controllers\Pages\WebHostingController;

use App\Http\Controllers\Communities\CommunityController;

use App\Http\Controllers\Tournaments\TournamentController;

use App\Http\Controllers\Server\ServerController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\FirewallController;

require('old_urls.php');
require('api.php');

Route::get('login', SteamAuthController::class)->name('login');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('status', [ServerStatusController::class, 'index'])->name('server-status');

Route::get('/games/counter-strike', [CounterStrikePageController::class, 'index'])->name('games/counter-strike');

Route::get('/games/counter-strike-global-offensive', [CounterStrikeGlobalOffensivePageController::class, 'index'])->name('games/counter-strike-global-offensive');

Route::get('/games/counter-strike-2', [CounterStrike2PageController::class, 'index'])->name('games/counter-strike-2');

Route::get('/games/multi-theft-auto', [MultiTheftAutoPageController::class, 'index'])->name('games/multi-theft-auto');

Route::get('vps-hosting',  [VirtualPrivateServerController::class, 'index'])->name('vps-hosting');

Route::get('web-hosting',  [WebHostingController::class, 'index'])->name('web-hosting');

Route::group([
    'prefix' => 'communities',
    'as' => 'communities/',
], function () {
    Route::get('', [CommunityController::class, 'index'])->name('index');
    Route::get('{slug}', [CommunityController::class, 'show'])->name('show');

    Route::post('store', [CommunityController::class, 'store'])->name('store')->middleware('auth');
    Route::put('update/{id}', [CommunityController::class, 'update'])->name('update')
    ->middleware('auth')
    ->middleware('user_have_community')
    ->middleware('verify_community_owner');
});

Route::group([
    'prefix' => 'servers',
    'as' => 'servers/',
], function () {

    Route::get('', [ServerController::class, 'index'])->name('index');
    
    Route::post('store', [ServerController::class, 'store'])->name('store')->middleware('auth');

    Route::post('update/{id}', [ServerController::class, 'update'])->name('update')
    ->where('id', '[1-9][0-9]*')
    ->middleware('auth')
    ->middleware('user_have_community')
    ->middleware('verify_server_owner');

    Route::delete('delete/{id}', [ServerController::class, 'destroy'])->name('destroy')
    ->where('id', '[1-9][0-9]*')
    ->middleware('auth')
    ->middleware('user_have_community')
    ->middleware('verify_server_owner');

    Route::get('search/{game?}', [ServerController::class, 'search'])->name('search');

    Route::get('info', [ServerController::class, 'showInfo'])->name('info')->middleware('register_server_if_official');

    Route::post('claim-server', [ServerController::class, 'claimServer'])->name('claim_server')
    ->middleware('auth')
    ->middleware('user_have_community');

    Route::post('upload-map', [ServerController::class, 'uploadMap'])->name('upload_map')
    ->middleware('auth');
});

Route::group([
    'prefix' => 'tournaments',
    'as' => 'tournaments/',
], function () {

    Route::get('', [TournamentController::class, 'index'])->name('index');
    
    Route::post('store', [TournamentController::class, 'store'])->name('store')
    ->middleware('auth');

    Route::get('{slug}', [TournamentController::class, 'show'])->name('show');

    Route::post('register/{id}', [TournamentController::class, 'register'])->name('register')
        ->middleware('auth');

    Route::post('{tournament}/participants/{participant}/increment', [TournamentController::class, 'incrementPoints'])->name('participants/increment')
        ->middleware('auth')
        ->middleware('verify_tournament_organizer');

    Route::post('{tournament}/participants/{participant}/decrement', [TournamentController::class, 'decrementPoints'])->name('participants/decrement')
        ->middleware('auth')
        ->middleware('verify_tournament_organizer');

    Route::delete('{tournament}/participants/{participant}', [TournamentController::class, 'removeParticipant'])->name('participants/remove')
        ->middleware('auth')
        ->middleware('verify_tournament_organizer');

});

Route::group([
    'middleware' => ['auth', 'is_admin'],
    'prefix' => 'admin',
    'as' => 'admin/',
], function () {

    Route::get('', function () {
        return redirect()->route('admin/index');
    });

    Route::get('index', [AdminController::class, 'index'])->name('index');

    Route::get('payments', [AdminController::class, 'payments'])->name('payments');
   
    Route::get('billing', [AdminController::class, 'billing'])->name('billing');

    Route::get('nodes', [AdminController::class, 'nodes'])->name('nodes');

    Route::get('sensors', [AdminController::class, 'sensors'])->name('sensors');

    Route::get('game-history', [AdminController::class, 'gameHistory'])->name('game_history');

    Route::group([
        'prefix' => 'subscriptions',
        'as' => 'subscriptions/',
    ], function () {
        Route::get('', [SubscriptionController::class, 'index'])->name('index');

        Route::post('synchronize', [SubscriptionController::class, 'synchronize'])->name('synchronize');

        Route::post('renew', [SubscriptionController::class, 'renew'])->name('renew');

        Route::delete('cancel', [SubscriptionController::class, 'cancel'])->name('cancel');
    });

    Route::group([
        'prefix' => 'firewall',
        'as' => 'firewall/',
    ], function () {
    
        Route::get('', [FirewallController::class, 'index'])->name('index');
        Route::post('store', [FirewallController::class, 'store'])->name('store')->middleware('check_firewall_rule');
        Route::delete('destroy/{id}', [FirewallController::class, 'destroy'])->name('destroy');
    
    });
});


