<?php

namespace App\Traits;

use App\Enums\StatisticsCacheKeys;
use Illuminate\Support\Facades\Cache;

trait ClearsCachedStatistics
{
    protected function clearCachedStatistics(): void
    {
        foreach (StatisticsCacheKeys::cases() as $key) {
            Cache::forget($key->value);
        }
    }

    public function created($model): void
    {
        $this->clearCachedStatistics($model);
    }

    public function updated($model): void
    {
        $this->clearCachedStatistics($model);
    }

    public function deleted($model): void
    {
        $this->clearCachedStatistics($model);
    }
}
