<?php

namespace App\Livewire;

use Livewire\Component;

class SearchableSelect extends Component
{
    public $selectedOption = '';
    public $options = [];
    public $name;
    public $placeholder = "Select an option...";
    public $optionKey = 'id';
    public $optionLabel = 'name';
    public $initialValue; // To hold the initial selected value

    public function mount($options, $initialValue = null)
    {
        $this->initialValue = $initialValue; // Set the initial selected value
        $this->options = collect($options)->map(function ($item) {
            return [
                'id' => $item[$this->optionKey],
                'name' => $item[$this->optionLabel]
            ];
        })->toArray();

        if ($initialValue) {
            // Set the initial selected value if provided
            $selectedOption = collect($this->options)->firstWhere('id', $initialValue);
            $this->selectedOption = $selectedOption['id'] ?? '';
        }
    }

    public function render()
    {
        return view('livewire.searchable-select');
    }

    public function updateSelectedOption($value)
    {
        $this->selectedOption = $value;
        $this->dispatch('option-selected', $value);
    }
}
