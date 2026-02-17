<?php

use App\Livewire\Dashboard\Index as Dashboard;
use App\Livewire\Items\Index as Items;
use App\Livewire\Beers\Index as Beers;
use App\Livewire\Breweries\Index as Breweries;
use App\Livewire\Styles\Index as Styles;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::get("/", Dashboard::class)->name('home');
Route::get("/login", Login::class)->name('login');
Route::get("/items", Items::class)->name('items');
Route::get("/beers", Beers::class)->name('beers');
Route::get('/breweries', Breweries::class)->name('breweries');
Route::get('/styles', Styles::class)->name('styles');

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');
