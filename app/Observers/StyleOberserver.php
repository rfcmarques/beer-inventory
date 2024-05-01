<?php

namespace App\Observers;

use App\Models\Style;
use Illuminate\Support\Facades\Cache;

class StyleOberserver
{
    public function created(Style $style): void
    {
        Cache::forget('beers');
        Cache::forget('items');
    }

    public function updated(Style $style): void
    {
        Cache::forget('beers');
        Cache::forget('items');
    }

    public function deleted(Style $style): void
    {
        Cache::forget('beers');
        Cache::forget('items');
    }
}
