<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\StatisticsCacheKeys;

class BeerObserver extends CacheInvalidationObserver
{
    protected function getCacheKeysToForget(): array
    {
        return StatisticsCacheKeys::forBeer();
    }
}