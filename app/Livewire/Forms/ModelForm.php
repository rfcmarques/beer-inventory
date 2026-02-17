<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Contracts\Livewire\PersistableForm;
use Illuminate\Database\Eloquent\Model;
use Livewire\Form;

abstract class ModelForm extends Form implements PersistableForm
{
    public ?Model $model = null;

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function save(): void
    {
        if ($this->model && $this->model->exists) {
            $this->update();
        } else {
            $this->store();
        }

        $this->reset();
    }

    abstract protected function store(): void;
    abstract protected function update(): void;
}