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
    return view('index')
    ->with('cs_servers', [
        ['45.235.98.67', '27025'],
        ['45.235.98.61', '27015'],
        ['45.235.98.41', '27015'],
        ['45.235.98.44', '27015'],
        ['45.235.98.41', '27098']
    ]);
})->name('index');

Route::post('/ping/gameservers', [PingController::class, 'pingGameServers'])->name('ping/gameservers');

Route::get('/api/games', [GameController::class, 'getGameState'])->name('api/games');
