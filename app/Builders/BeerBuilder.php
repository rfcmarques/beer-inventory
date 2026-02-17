<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class BeerBuilder extends Builder
{
    public function available(): self
    {
        return $this->whereHas('items', fn(Builder $q) => $q->available());
    }

    public function consumed(): self
    {
        return $this->whereHas('items', fn(Builder $q) => $q->consumed());
    }

    public function withQuantityAvailable(): self
    {
        return $this->withCount([
            'items as quantity_available' => fn(Builder $q) => $q->available(),
        ]);
    }

    public function withQuantityConsumed(): self
    {
        return $this->withCount([
            'items as quantity_consumed' => fn(Builder $q) => $q->consumed(),
        ]);
    }

    public function filterByBreweries(array $breweryIds): self
    {
        return $this->whereIn('brewery_id', $breweryIds);
    }

    public function filterByStyles(array $styleIds): self
    {
        return $this->whereIn('style_id', $styleIds);
    }

    public function filterByCountries(array $countryIds): self
    {
        return $this->whereHas('brewery', fn(Builder $q) => $q->whereIn('country_id', $countryIds));
    }

    public function search(string $search): self
    {
        $search = strtolower($search);

        return $this->where(function (Builder $q) use ($search) {
            $q->whereRaw('LOWER(beers.name) LIKE ?', ["%{$search}%"])
                ->orWhereHas('brewery', fn(Builder $q) => $q->whereRaw('LOWER(breweries.name) LIKE ?', ["%{$search}%"]))
                ->orWhereHas('style', fn(Builder $q) => $q->whereRaw('LOWER(styles.name) LIKE ?', ["%{$search}%"]));
        });
    }

    public function filter(array $filters): self
    {
        if (!empty($filters['breweries'])) {
            $this->filterByBreweries($filters['breweries']);
        }

        if (!empty($filters['styles'])) {
            $this->filterByStyles($filters['styles']);
        }

        if (!empty($filters['countries'])) {
            $this->filterByCountries($filters['countries']);
        }

        if (!empty($filters['search'])) {
            $this->search($filters['search']);
        }

        return $this;
    }
}