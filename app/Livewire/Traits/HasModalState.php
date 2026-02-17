<?php

declare(strict_types=1);

namespace App\Livewire\Traits;

trait HasModalState
{
    public bool $modalOpen = false;

    public function open(): void
    {
        $this->resetErrorBag();
        $this->modalOpen = true;
    }

    public function close(): void
    {
        $this->modalOpen = false;
        $this->reset();
    }
}
