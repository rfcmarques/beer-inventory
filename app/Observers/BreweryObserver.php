<?php

namespace App\Observers;

use App\Models\Brewery;
use Illuminate\Support\Facades\Cache;

class BreweryObserver
{
    public function created(Brewery $brewery): void
    {
        Cache::forget('breweries');
        Cache::forget('beers');
        Cache::forget('items');
    }

    public function updated(Brewery $brewery): void
    {
        Cache::forget('breweries');
        Cache::forget('beers');
        Cache::forget('items');
    }

    public function deleted(Brewery $brewery): void
    {
        Cache::forget('breweries');
        Cache::forget('beers');
        Cache::forget('items');
    }
}
