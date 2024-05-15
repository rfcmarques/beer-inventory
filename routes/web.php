<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StyleController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home.index');

Route::resource('beers', BeerController::class)->except('show');
Route::resource('breweries', BreweryController::class)->except('show');
Route::resource('items', ItemController::class)->except('show');
Route::resource('styles', StyleController::class)->except('show');

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->middleware('guest');
    Route::post('/login', 'store')->middleware('guest');
    Route::delete('/login', 'destroy')->middleware('auth');
});
