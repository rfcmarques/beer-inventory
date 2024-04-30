<?php

namespace App\Observers;

use App\Models\Item;
use Illuminate\Support\Facades\Cache;

class ItemObserver
{
    public function created(Item $item): void
    {
        Cache::forget('items');
    }

    public function updated(Item $item): void
    {
        Cache::forget('items');
    }

    public function deleted(Item $item): void
    {
        Cache::forget('items');
    }
}
