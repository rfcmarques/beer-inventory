<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait ClearsStatisticsCache
{
    public function clearStatisticsCache(array $keys): void
    {
        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }
}
