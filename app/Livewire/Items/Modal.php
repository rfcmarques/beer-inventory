<?php

namespace App\Livewire\Items;

use App\Contracts\Livewire\PersistableForm;
use App\Livewire\FormModal;
use App\Livewire\Forms\ItemForm;
use App\Models\Beer;
use App\Models\Container;
use App\Models\Item;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Modal extends FormModal
{
    public ItemForm $form;

    protected function getForm(): PersistableForm
    {
        return $this->form;
    }

    public function render()
    {
        return view('livewire.items.modal', [
            'beers' => $this->beers,
            'containers' => $this->containers,
        ]);
    }

    #[On('edit-item')]
    public function editItem(Item $item): void
    {
        parent::edit($item);
    }

    #[Computed]
    protected function beers(): array
    {
        return Beer::select('id', 'name')
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    #[Computed]
    protected function containers(): array
    {
        return Container::orderBy('type')
            ->get()
            ->map(fn(Container $container) => [
                'id' => $container->id,
                'name' => $container->label,
            ])->toArray();
    }
}
