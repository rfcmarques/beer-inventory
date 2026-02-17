<?php

namespace App\Builders;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;

class CountryBuilder extends Builder
{
    public function available(): self
    {
        return $this->whereHas(
            'breweries.beers.items',
            fn($query) => $query->available()
        );
    }

    public function consumed(): self
    {
        return $this->whereHas(
            'breweries.beers.items',
            fn($query) => $query->consumed()
        );
    }
}