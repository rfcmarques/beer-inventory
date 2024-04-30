<?php

namespace App\Observers;

use App\Models\Container;
use Illuminate\Support\Facades\Cache;

class ContainerObserver
{
    public function created(Container $container): void
    {
        Cache::forget('containers');
    }

    public function updated(Container $container): void
    {
        Cache::forget('containers');
    }

    public function deleted(Container $container): void
    {
        Cache::forget('containers');
    }
}
