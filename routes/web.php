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

Route::get('/', function () {
    return view('pages/index/index')
    ->with('cs_servers', [
        ['45.235.98.67', '27025'],
        ['45.235.98.61', '27015'],
        ['45.235.98.41', '27015'],
        ['45.235.98.44', '27015'],
        ['45.235.98.41', '27098']
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
    ]);
})->name('index');

Route::group([
    'middleware' => ['throttle:100,1'],
    'prefix' => 'api',
    'as' => 'api/',
], function () {
    Route::post('ping/gameservers', [PingController::class, 'pingGameServers'])->name('ping/gameservers');
    Route::get('games', [GameController::class, 'getGameState'])->name('games');
});