<?php

declare(strict_types=1);

namespace App\Livewire\Beers;

use App\Contracts\Livewire\PersistableForm;
use App\Livewire\FormModal;
use App\Livewire\Forms\BeerForm;
use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Style;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Modal extends FormModal
{
    public BeerForm $form;

    public function getForm(): PersistableForm
    {
        return $this->form;
    }

    public function render()
    {
        return view('livewire.beers.modal', [
            'breweries' => $this->breweries->toArray(),
            'styles' => $this->styles->toArray(),
        ]);
    }

    #[On('edit-beer')]
    public function editBeer(Beer $beer): void
    {
        parent::edit($beer);
    }

    #[Computed]
    protected function breweries(): Collection
    {
        return Brewery::select('id', 'name')
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    protected function styles(): Collection
    {
        return Style::select('id', 'name')
            ->orderBy('name')
            ->get();
    }
}
