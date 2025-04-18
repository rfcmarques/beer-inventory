<?php

namespace App\Livewire;

use App\Models\Brewery;
use Illuminate\Database\Eloquent\Builder;
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
        $query = $this->buildBreweriesQuery();

        $this->breweries = $query->take($this->amount)->get();

        return view('livewire.breweries');
    }

    protected function buildBreweriesQuery(): Builder
    {
        $query = Brewery::with('country')->orderBy('name');

        if (Str::length($this->search) > 0) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhereHas('country', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
        }

        return $query;
    }

    public function load(): void
    {
        $this->amount += 6;
    }
}
