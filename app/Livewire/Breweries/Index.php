<?php

namespace App\Livewire\Breweries;

use App\Models\Brewery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public int $amount = 21;
    public ?string $search = null;

    #[On('refresh-list')]
    public function render()
    {
        return view('livewire.breweries.index', [
            'breweries' => $this->breweries
        ]);
    }

    #[Computed]
    protected function breweries(): Collection
    {
        $query = Brewery::with('country');

        $query->when($this->search, fn(Builder $query) => $query->search($this->search));

        $query->orderBy('name', 'asc');

        return $query->take($this->amount)->get();
    }

    public function delete(Brewery $brewery): void
    {
        $brewery->delete();
    }

    public function load(): void
    {
        $this->amount += 12;
    }
}
