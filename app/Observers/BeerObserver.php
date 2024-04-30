<?php

namespace App\Observers;

use App\Models\Beer;
use Illuminate\Support\Facades\Cache;

class BeerObserver
{
    public function created(Beer $beer): void
    {
        Cache::forget('beers');
    }

    public function updated(Beer $beer): void
    {
        Cache::forget('beers');
    }

    public function deleted(Beer $beer): void
    {
        Cache::forget('beers');
    }
}
