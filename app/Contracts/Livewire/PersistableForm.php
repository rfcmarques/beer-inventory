<?php

declare(strict_types=1);

namespace App\Contracts\Livewire;

use Illuminate\Database\Eloquent\Model;

interface PersistableForm
{
    public function save(): void;
    public function setModel(Model $model): void;
    public function reset(...$properties);
}
