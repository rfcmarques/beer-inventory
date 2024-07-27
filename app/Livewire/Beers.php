<?php

namespace App\Livewire;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Style;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Beers extends Component
{
    public Collection $beers;

    public Collection $breweries;

    public Collection $styles;

    public int $amount = 20;

    public string $search = '';

    public array $selectedBreweries = [];

    public array $selectedStyles = [];

    public function render()
    {
        if (strlen($this->search) >= 1) {
            $this->searchBeers();
        } else if (!empty($this->selectedBreweries)) {
            $this->beersByBrewery();
        } else if (!empty($this->selectedStyles)) {
            $this->beersByStyle();
        } else {
            $this->getBeers();
        }

        $this->breweries = Brewery::orderBy('name')->get();
        $this->styles = Style::orderBy('name')->get();

        return view('livewire.beers');
    }

    public function getBeers(): void
    {
        $this->beers = Beer::take($this->amount)->get();
    }

    public function searchBeers(): void
    {
        $this->beers = Beer::with('brewery')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('brewery', function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('style', function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();
    }

    public function beersByBrewery(): void
    {
        $this->beers = Beer::whereIn('brewery_id', $this->selectedBreweries)
            ->orderBy('name')
            ->get();
    }

    public function beersByStyle(): void
    {
        $this->beers = Beer::whereIn('style_id', $this->selectedStyles)
            ->orderBy('name')
            ->get();
    }

    public function load(): void
    {
        $this->amount += 10;
    }
}
