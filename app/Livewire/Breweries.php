<?php

namespace App\Livewire;

use App\Models\Brewery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Str;

class Breweries extends Component
{
    public Collection $breweries;
    public int $amount = 21;
    public string $search = '';

    public function render(): View
    {
        if (Str::length($this->search) > 0) {
            $this->searchBreweries();
        } else {
            $this->getBreweries();
        }

        return view('livewire.breweries');
    }

    public function getBreweries(): void
    {
        $this->breweries = Brewery::orderBy('name')->take($this->amount)->get();
    }

    public function searchBreweries(): void
    {
        $this->breweries = Brewery::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('country', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function load(): void
    {
        $this->amount += 6;
    }
}
