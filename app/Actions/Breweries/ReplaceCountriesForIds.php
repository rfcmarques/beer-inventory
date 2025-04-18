<?php

namespace App\Actions\Breweries;

use App\Models\Brewery;
use App\Models\Country;

class ReplaceCountriesForIds
{
    public function __construct(
        protected Brewery $brewery,
        protected Country $country
    ) {}

    public function handle(): void
    {
        $this->brewery->country_id = $this->country->id;
        $this->brewery->save();
    }
}
