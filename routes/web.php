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
use App\Http\Controllers\Pages\CounterStrike2PageController;
use App\Http\Controllers\Pages\MultiTheftAutoPageController;

use App\Http\Controllers\Communities\CommunityController;

use App\Http\Controllers\Server\ServerController;

use App\Http\Controllers\Admin\AdminController;

require('old_urls.php');
require('api.php');

Route::get('login', [SteamAuthController::class, 'login'])->name('login');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/games/counter-strike', [CounterStrikePageController::class, 'index'])->name('games/counter-strike');

Route::get('/games/counter-strike-global-offensive', [CounterStrikeGlobalOffensivePageController::class, 'index'])->name('games/counter-strike-global-offensive');

Route::get('/games/counter-strike-2', [CounterStrike2PageController::class, 'index'])->name('games/counter-strike-2');

Route::get('/games/multi-theft-auto', [MultiTheftAutoPageController::class, 'index'])->name('games/multi-theft-auto');

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
    
    Route::post('store', [ServerController::class, 'store'])->name('store')->middleware('auth');

    Route::post('update/{id}', [ServerController::class, 'update'])->name('update')
    ->where('id', '[1-9][0-9]*')
    ->middleware('auth')
    ->middleware('user_have_community')
    ->middleware('verify_owner');

    Route::delete('delete/{id}', [ServerController::class, 'destroy'])->name('destroy')
    ->where('id', '[1-9][0-9]*')
    ->middleware('auth')
    ->middleware('user_have_community')
    ->middleware('verify_owner');

    Route::get('search/{game}', [ServerController::class, 'search'])->name('search');

    Route::get('info', [ServerController::class, 'showInfo'])->name('info')->middleware('register_server_if_official');

    Route::post('claim-server', [ServerController::class, 'claimServer'])->name('claim_server')
    ->middleware('auth')
    ->middleware('user_have_community');

    Route::post('upload-map', [ServerController::class, 'uploadMap'])->name('upload_map')
    ->middleware('auth');
});

Route::group([
    'middleware' => ['auth', 'is_admin'],
    'prefix' => 'admin',
    'as' => 'admin/',
], function () {

    Route::get('index', [AdminController::class, 'index'])->name('index');
   
    Route::get('billing', [AdminController::class, 'billing'])->name('billing');
    
    Route::get('nodes', [AdminController::class, 'nodes'])->name('nodes');
});
