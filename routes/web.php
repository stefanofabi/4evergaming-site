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
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'getHomePage'])->name('index');

require('old_urls.php');

Route::get('/games/counter-strike', [PageController::class, 'getCounterStrikePage'])->name('games/counter-strike');

Route::get('/games/counter-strike-global-offensive', [PageController::class, 'getCounterStrikeGlobalOffensivePage'])->name('games/counter-strike-global-offensive');

Route::group([
    'middleware' => ['throttle:100,1'],
    'prefix' => 'api',
    'as' => 'api/',
], function () {
    Route::get('ping/gameservers', [PingController::class, 'pingGameServers'])->name('ping/gameservers');
    Route::get('games', [GameController::class, 'getGameState'])->name('games');
});