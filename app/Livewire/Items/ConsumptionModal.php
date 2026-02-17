<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ConsumptionModal extends Component
{
    public Item $item;
    public bool $showModal = false;

    #[Validate('required|date')]
    public string $consumedAt;

    public function render()
    {

        $this->consumedAt = now()->format('Y-m-d');

        return view('livewire.items.consumption-modal');
    }

    public function save()
    {
        $this->validate();

        $this->item->update([
            'consumed_at' => $this->consumedAt,
        ]);

        $this->reset();
    }
}
