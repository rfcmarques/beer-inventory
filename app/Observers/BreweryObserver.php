<?php

namespace App\Observers;

use App\Models\Brewery;
use Illuminate\Support\Facades\Cache;

class BreweryObserver
{
    public function created(Brewery $brewery): void
    {
        Cache::forget('breweries');
    }

    public function updated(Brewery $brewery): void
    {
        Cache::forget('breweries');
    }

    public function deleted(Brewery $brewery): void
    {
        Cache::forget('breweries');
    }
}
