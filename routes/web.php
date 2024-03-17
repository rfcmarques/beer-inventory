<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StyleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/beers', [BeerController::class, 'index']);

Route::get('/styles', [StyleController::class, 'index']);

Route::get('/breweries', [BreweryController::class, 'index']);

Route::get('/items', [ItemController::class, 'index']);
