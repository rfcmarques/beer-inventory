<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StyleController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home.index');

Route::resource('beers', BeerController::class)->except('show');
Route::resource('breweries', BreweryController::class)->except('show');
Route::resource('items', ItemController::class);
Route::resource('styles', StyleController::class)->except('show');
