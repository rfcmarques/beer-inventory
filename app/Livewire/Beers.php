<?php

namespace App\Livewire;

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
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%'])
                    ->orWhereHas('brewery', function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
                    })
                    ->orWhereHas('style', function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ['%' . $search . '%']);
                    });
            });
        });

        $beers = $query->take($this->amount)->get();

        return view('livewire.beers', [
            'beers' => $beers,
            'breweries' => $this->availableBreweries,
            'styles' => $this->availableStyles,
        ]);
    }

    public function getAvailableStylesProperty()
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

    public function getAvailableBreweriesProperty()
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

    public function toggleAccordion($accordion)
    {
        $this->openAccordions[$accordion] = ! $this->openAccordions[$accordion];
    }
}
