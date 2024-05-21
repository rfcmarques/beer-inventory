<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StyleController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home.index');

Route::controller(StyleController::class)->group(function () {
    Route::get('/styles', 'index');

    Route::get('/styles/create', 'create')
        ->can('create', 'App\Models\Style');

    Route::post('/styles', 'store');

    Route::get('/styles/{style}/edit', 'edit')
        ->can('edit', 'style');

    Route::put('/styles/{style}', 'update')
        ->can('update', 'style');

    Route::delete('/styles/{style}', 'delete')
        ->can('delete', 'style');
});

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

Route::controller(BeerController::class)->group(function () {
    Route::get('/beers', 'index');

    Route::get('/beers/create', 'create')
        ->can('create', 'App\Models\Beer');

    Route::post('/beers', 'store');

    Route::get('/beers/{beer}/edit', 'edit')
        ->can('edit', 'beer');

    Route::put('/beers/{beer}', 'update')
        ->can('update', 'beer');

    Route::delete('/beers/{beer}', 'delete')
        ->can('delete', 'beer');
});

Route::resource('items', ItemController::class)->except('show');

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->middleware('guest')->name('login');
    Route::post('/login', 'store')->middleware('guest');
    Route::delete('/login', 'destroy')->middleware('auth');
});
