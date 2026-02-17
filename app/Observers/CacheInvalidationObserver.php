<?php

declare(strict_types=1);

namespace App\Observers;

use App\Traits\ClearsStatisticsCache;
use Illuminate\Database\Eloquent\Model;

abstract class CacheInvalidationObserver
{
    use ClearsStatisticsCache;

    abstract protected function getCacheKeysToForget(): array;

    protected function invalidateCache(): void
    {
        $this->clearStatisticsCache($this->getCacheKeysToForget());
    }

    public function created(Model $model): void
    {
        $this->invalidateCache();
    }

    public function updated(Model $model): void
    {
        $this->invalidateCache();
    }

    public function deleted(Model $model): void
    {
        $this->invalidateCache();
    }

    public function restored(Model $model): void
    {
        $this->invalidateCache();
    }

    public function forceDeleted(Model $model): void
    {
        $this->invalidateCache();
    }
}