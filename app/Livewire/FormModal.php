<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Contracts\Livewire\PersistableForm;
use App\Livewire\Traits\HasModalState;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

abstract class FormModal extends Component
{
    use HasModalState;

    abstract protected function getForm(): PersistableForm;

    public function save(): void
    {
        $this->getForm()->save();

        $this->success();
    }

    public function edit(Model $model): void
    {
        $this->getForm()->setModel($model);
        $this->open();
    }

    protected function success(string $message = "Saved successfully"): void
    {
        $this->close();
        $this->dispatch('refresh-list');
        $this->dispatch('notify', $message);
    }
}