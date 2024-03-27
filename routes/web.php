<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StyleController;
use App\Models\Brewery;
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
    return view('home.index');
});

Route::resource('beers', BeerController::class)->except('show');
Route::resource('styles', StyleController::class)->except('show');
Route::resource('breweries', BreweryController::class)->except('show');
Route::resource('items', ItemController::class);
