<?php

namespace App\Contracts;

interface CRUDObserverContract
{
    public function created($model);
    public function updated($model);
    public function deleted($model);
}
