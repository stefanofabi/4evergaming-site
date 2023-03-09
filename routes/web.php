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

use App\Http\Controllers\PingController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Pages\CounterStrikePageController;
use App\Http\Controllers\Pages\CounterStrikeGlobalOffensivePageController;

Route::get('/', [PageController::class, 'index'])->name('index');

require('old_urls.php');

Route::get('/games/counter-strike', [CounterStrikePageController::class, 'index'])->name('games/counter-strike');

Route::get('/games/counter-strike-global-offensive', [CounterStrikeGlobalOffensivePageController::class, 'index'])->name('games/counter-strike-global-offensive');

Route::group([
    'middleware' => ['throttle:100,1'],
    'prefix' => 'api',
    'as' => 'api/',
], function () {
    Route::get('ping/gameservers', [PingController::class, 'pingGameServers'])->name('ping/gameservers');
    Route::get('games', [GameController::class, 'getGameState'])->name('games');
});