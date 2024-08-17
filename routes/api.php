<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PingController;
use App\Http\Controllers\Api\ServerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => ['throttle:100,1'],
    'prefix' => 'api',
    'as' => 'api/',
], function () {
    Route::get('ping/gameservers', [PingController::class, 'pingGameServers'])->name('ping/gameservers');
    
    Route::get('servers/show', [ServerController::class, 'show'])->name('servers/show');

    Route::get('servers/update-all', [ServerController::class, 'updateAll'])->name('servers/update_all')
    ->middleware('throttle:100,1');
});
