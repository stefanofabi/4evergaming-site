<?php

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
use App\Http\Controllers\Pages\MultiTheftAutoPageController;

use App\Http\Controllers\Communities\CommunityController;

use App\Http\Controllers\Api\PingController;
use App\Http\Controllers\Api\GameController;

use App\Http\Controllers\Server\ServerController;

require('old_urls.php');

Route::get('login', [SteamAuthController::class, 'login'])->name('login');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/games/counter-strike', [CounterStrikePageController::class, 'index'])->name('games/counter-strike');

Route::get('/games/counter-strike-global-offensive', [CounterStrikeGlobalOffensivePageController::class, 'index'])->name('games/counter-strike-global-offensive');

Route::get('/games/multi-theft-auto', [MultiTheftAutoPageController::class, 'index'])->name('games/multi-theft-auto');

Route::group([
    'middleware' => ['throttle:100,1'],
    'prefix' => 'api',
    'as' => 'api/',
], function () {
    Route::get('ping/gameservers', [PingController::class, 'pingGameServers'])->name('ping/gameservers');
    Route::get('games', [GameController::class, 'getGameState'])->name('games');
});

Route::group([
    'prefix' => 'communities',
    'as' => 'communities/',
], function () {
    Route::post('store', [CommunityController::class, 'store'])->name('store')->middleware('auth');
});

Route::group([
    'prefix' => 'servers',
    'as' => 'servers/',
], function () {
    
    Route::get('create', [ServerController::class, 'create'])->name('create');

    Route::post('store', [ServerController::class, 'store'])->name('store');

    Route::get('search/{game}', [ServerController::class, 'search'])->name('search');

    Route::get('info', [ServerController::class, 'showInfo'])->name('info');
});