<?php

namespace App\Livewire\Beers;

use App\Enums\BeersSortOptions;
use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Country;
use App\Models\Style;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url]
    public string $sort = BeersSortOptions::OLDEST->value;

    #[Url(as: 'q', except: '')]
    public ?string $search = null;
    public int $amount = 12;
    public array $selectedBreweries = [];
    public array $selectedStyles = [];
    public array $selectedCountries = [];
    public bool $consumed = false;
    public bool $available = false;

    #[On('refresh-list')]
    public function render(): View
    {
        return view('livewire.beers.index', [
            'beers' => $this->beers,
            'breweries' => $this->availableBreweries,
            'beerStyles' => $this->availableStyles,
            'countries' => $this->availableCountries,
            'sortOptions' => BeersSortOptions::toArray(),
        ]);
    }

    #[Computed]
    protected function beers(): Collection
    {
        $query = Beer::with(['brewery', 'style']);

        $query->withQuantityAvailable()
            ->withQuantityConsumed();

        $query->when($this->available, fn(Builder $q) => $q->available());
        $query->when($this->consumed, fn(Builder $q) => $q->consumed());

        $query->filter([
            'breweries' => $this->selectedBreweries,
            'styles' => $this->selectedStyles,
            'countries' => $this->selectedCountries,
            'search' => $this->search,
        ]);

        $sortColumn = BeersSortOptions::from($this->sort)->sortColumn();
        $sortType = BeersSortOptions::from($this->sort)->sortType();

        match ($sortColumn) {
            'breweries.name' => $query->join('breweries', 'beers.brewery_id', 'breweries.id')
                ->orderBy($sortColumn, $sortType)
                ->select('beers.*'),
            'styles.name' => $query->join('styles', 'beers.style_id', 'styles.id')
                ->orderBy($sortColumn, $sortType)
                ->select('beers.*'),
            default => $query->orderBy($sortColumn, $sortType),
        };

        return $query->take($this->amount)->get();
    }

    #[Computed]
    protected function availableBreweries(): Collection
    {
        return Brewery::query()
            ->whereHas('beers', function (Builder $q) {
                if (!empty($this->selectedStyles)) {
                    $q->filterByStyles($this->selectedStyles);
                }

                if ($this->search) {
                    $q->search($this->search);
                }
            })
            ->when(
                !empty($this->selectedCountries),
                fn(Builder $q) => $q->whereIn('country_id', $this->selectedCountries)
            )
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    protected function availableStyles(): Collection
    {
        return Style::query()
            ->whereHas('beers', function (Builder $q) {
                if (!empty($this->selectedBreweries)) {
                    $q->filterByBreweries($this->selectedBreweries);
                }

                if (!empty($this->selectedCountries)) {
                    $q->filterByCountries($this->selectedCountries);
                }

                if ($this->search) {
                    $q->search($this->search);
                }
            })
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    protected function availableCountries(): Collection
    {
        return Country::query()
            ->whereHas('breweries', function (Builder $q) {
                if (!empty($this->selectedBreweries)) {
                    $q->whereIn('id', $this->selectedBreweries);
                }

                $q->whereHas('beers', function (Builder $b) {
                    if (!empty($this->selectedStyles)) {
                        $b->filterByStyles($this->selectedStyles);
                    }

                    if ($this->search) {
                        $b->search($this->search);
                    }
                });
            })
            ->orderBy('name')
            ->get();
    }

    public function delete(Beer $beer): void
    {
        $beer->delete();
    }

    public function load(): void
    {
        $this->amount += 6;
    }

    public function toggleAvailable(): void
    {
        if (!$this->available)
            return;
        $this->available = !$this->available;
    }

    public function toggleConsumed(): void
    {
        if (!$this->consumed)
            return;
        $this->consumed = !$this->consumed;
    }
}
