<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StyleController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home.index');

Route::resource('beers', BeerController::class)->except('show');

Route::controller(BreweryController::class)->group(function () {
    Route::get('/breweries', 'index');

    Route::get('/breweries/create', 'create')
        ->can('create', 'App\Models\Brewery');

    Route::post('/breweries', 'store');

    Route::get('/breweries/{brewery}/edit', 'edit')
        ->can('edit', 'brewery');

    Route::put('/breweries/{brewery}', 'update')
        ->can('update', 'brewery');

    Route::delete('/breweries/{brewery}', 'delete')
        ->can('delete', 'brewery');
});

Route::resource('items', ItemController::class)->except('show');
Route::resource('styles', StyleController::class)->except('show');

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->middleware('guest')->name('login');
    Route::post('/login', 'store')->middleware('guest');
    Route::delete('/login', 'destroy')->middleware('auth');
});
