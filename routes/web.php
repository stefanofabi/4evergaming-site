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

const DOLLAR_PRICE = 170;

Route::get('/', function () {
    return view('pages/home/index')
    ->with('cs_servers', [
        ['45.235.98.67', '27025'],
        ['45.235.98.61', '27015'],
        ['45.235.98.41', '27015'],
        ['45.235.98.44', '27015'],
        ['45.235.98.66', '27038']
    ])
    ->with('csgo_servers', [
        ['45.235.98.65', '27025'],
        ['45.235.98.69', '27033'],
        ['45.235.98.42', '27021'],
        ['45.235.98.74', '27019'],
        ['45.235.98.61', '27020']
    ])
    ->with('mta_servers', [
        ['45.235.98.42', '22003'],
        ['45.235.98.42', '22043'],
        ['45.235.98.40', '22053'],
        ['45.235.98.66', '22023'],
        ['45.235.98.42', '22033']
    ])
    ->with('minecraft_servers', [
        ['45.235.98.42', '25565'],
        ['45.235.98.48', '25565'],
        ['45.235.98.61', '25575'],
        ['45.235.98.62', '25565']
    ]);
})->name('index');

require('old_urls.php');

Route::get('/games/counter-strike', function () {
    return view('pages/counter-strike/index')
    ->with('dollar_price', DOLLAR_PRICE)
    ->with('slot_300fps_price', 0.35)
    ->with('slot_500fps_price', 0.45)
    ->with('slot_1000fps_price', 0.50);
})->name('games/counter-strike');

Route::get('/games/counter-strike-global-offensive', function () {
    return view('pages/counter-strike-global-offensive/index')
    ->with('dollar_price', DOLLAR_PRICE)
    ->with('slot_64tickrate_price', 0.90)
    ->with('slot_128tickrate_price', 1.05);
})->name('games/counter-strike-global-offensive');


Route::group([
    'middleware' => ['throttle:100,1'],
    'prefix' => 'api',
    'as' => 'api/',
], function () {
    Route::post('ping/gameservers', [PingController::class, 'pingGameServers'])->name('ping/gameservers');
    Route::get('games', [GameController::class, 'getGameState'])->name('games');
});