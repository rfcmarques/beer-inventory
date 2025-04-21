<?php

namespace App\Livewire;

use App\Enums\BeerSortingOption;
use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Style;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Beers extends Component
{
    public int $amount = 20;

    public string $search = '';

    public array $selectedBreweries = [];

    public array $selectedStyles = [];

    public array $openAccordions = [
        'breweries' => false,
        'styles' => false,
    ];

    public string $sortOption = BeerSortingOption::CREATED_AT_ASC->value;

    public array $sortOptions = [];

    public function mount(): void
    {
        $this->sortOptions = BeerSortingOption::cases();
    }

    public function render()
    {
        $query = Beer::query();

        $query->when(!empty($this->selectedBreweries), function (Builder $query) {
            $query->whereIn('brewery_id', $this->selectedBreweries);
        });

        $query->when(!empty($this->selectedStyles), function (Builder $query) {
            $query->whereIn('style_id', $this->selectedStyles);
        });

        $query->when(strlen($this->search) >= 1, function (Builder $query) {
            $search = strtolower($this->search);
            $query->where(function (Builder $query) use ($search) {
                $query->whereRaw('LOWER(beers.name) LIKE ?', ['%' . $search . '%'])
                    ->orWhereHas('brewery', function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(breweries.name) LIKE ?', ['%' . $search . '%']);
                    })
                    ->orWhereHas('style', function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(styles.name) LIKE ?', ['%' . $search . '%']);
                    });
            });
        });

        $query = $this->applySorting($query);

        $beers = $query->take($this->amount)->get();

        return view('livewire.beers', [
            'beers' => $beers,
            'breweries' => $this->availableBreweries,
            'styles' => $this->availableStyles,
        ]);
    }

    public function getAvailableStylesProperty(): \Illuminate\Database\Eloquent\Collection
    {
        $query = Beer::query();

        if (!empty($this->selectedBreweries)) {
            $query->whereIn('brewery_id', $this->selectedBreweries);
        }

        if ($this->search) {
            $search = strtolower($this->search);
            $query->where(function (Builder $query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%'])
                    ->orWhereHas('brewery', function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
                    })
                    ->orWhereHas('style', function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
                    });
            });
        }

        $styleIds = $query->distinct()->pluck('style_id');

        return Style::whereIn('id', $styleIds)->orderBy('name')->get();
    }

    public function getAvailableBreweriesProperty(): \Illuminate\Database\Eloquent\Collection
    {
        $query = Beer::query();

        if (!empty($this->selectedStyles)) {
            $query->whereIn('style_id', $this->selectedStyles);
        }

        if ($this->search) {
            $search = strtolower($this->search);
            $query->where(function (Builder $query) use ($search) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%'])
                    ->orWhereHas('brewery', function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
                    })
                    ->orWhereHas('style', function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
                    });
            });
        }

        $breweryIds = $query->distinct()->pluck('brewery_id');

        return Brewery::whereIn('id', $breweryIds)->orderBy('name')->get();
    }

    public function load(): void
    {
        $this->amount += 10;
    }

    public function toggleAccordion($accordion): void
    {
        $this->openAccordions[$accordion] = ! $this->openAccordions[$accordion];
    }


    public function applySorting(Builder $query): Builder
    {
        $sortOption = BeerSortingOption::from($this->sortOption);
        $sortDirection = $sortOption->direction();

        if ($sortOption->isBrewery()) {
            return $query
                ->leftJoin('breweries', 'beers.brewery_id', '=', 'breweries.id')
                ->orderBy('breweries.name', $sortDirection)
                ->select('beers.*');
        }

        if ($sortOption->isStyle()) {
            return $query
                ->leftJoin('styles', 'beers.style_id', '=', 'styles.id')
                ->orderBy('styles.name', $sortDirection)
                ->select('beers.*');
        }

        return $query->orderBy($sortOption->column(), $sortDirection);
    }
}
