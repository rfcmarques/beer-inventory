<?php

declare(strict_types=1);

namespace App\Livewire\Styles;

use App\Contracts\Livewire\PersistableForm;
use App\Livewire\FormModal;
use App\Livewire\Forms\StyleForm;
use App\Models\Style;
use Illuminate\View\View;
use Livewire\Attributes\On;

class Modal extends FormModal
{
    public StyleForm $form;

    protected function getForm(): PersistableForm
    {
        return $this->form;
    }

    #[On('edit-style')]
    public function editStyle(Style $style): void
    {
        parent::edit($style);
    }

    public function render(): View
    {
        return view('livewire.styles.modal');
    }
}
