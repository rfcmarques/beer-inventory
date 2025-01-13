<?php

namespace App\Observers;

use App\Contracts\CRUDObserverContract;
use App\Traits\ClearsCachedStatistics;

abstract class ClearsCachedStatsObserver implements CRUDObserverContract
{
    use ClearsCachedStatistics;
}
