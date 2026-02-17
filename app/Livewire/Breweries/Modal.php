<?php

namespace App\Livewire\Breweries;

use App\Contracts\Livewire\PersistableForm;
use App\Livewire\FormModal;
use App\Livewire\Forms\BreweryForm;
use App\Models\Brewery;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class Modal extends FormModal
{
    use WithFileUploads;
    public BreweryForm $form;

    protected function getForm(): PersistableForm
    {
        return $this->form;
    }

    #[On('edit-brewery')]
    public function editBrewery(Brewery $brewery): void
    {
        parent::edit($brewery);
    }

    public function render()
    {
        return view('livewire.breweries.modal', [
            'countries' => $this->countries()
        ]);
    }

    #[Computed]
    protected function countries(): Collection
    {
        return Country::orderBy('name')->get();
    }
}
