<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\StatisticsCacheKeys;

class StyleObserver extends CacheInvalidationObserver
{
    protected function getCacheKeysToForget(): array
    {
        return StatisticsCacheKeys::forStyle();
    }
}