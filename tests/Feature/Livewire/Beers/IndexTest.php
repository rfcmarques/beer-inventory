<?php

use App\Livewire\Beers\Index;
use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Country;
use App\Models\Style;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Index::class)
        ->assertStatus(200);
});

it('filters beers by country', function () {
    $countryA = Country::factory()->create(['name' => 'Country A']);
    $countryB = Country::factory()->create(['name' => 'Country B']);

    $breweryA = Brewery::factory()->create(['country_id' => $countryA->id]);
    $breweryB = Brewery::factory()->create(['country_id' => $countryB->id]);

    $beerA = Beer::factory()->create(['brewery_id' => $breweryA->id, 'name' => 'Beer A']);
    $beerB = Beer::factory()->create(['brewery_id' => $breweryB->id, 'name' => 'Beer B']);

    Livewire::test(Index::class)
        ->set('selectedCountries', [$countryA->id])
        ->assertViewHas('beers', function ($beers) use ($beerA, $beerB) {
            return $beers->contains($beerA) && !$beers->contains($beerB);
        });
});

it('filters available breweries by country', function () {
    $countryA = Country::factory()->create(['name' => 'Country A']);
    $countryB = Country::factory()->create(['name' => 'Country B']);

    $breweryA = Brewery::factory()->create(['country_id' => $countryA->id, 'name' => 'Brewery A']);
    $breweryB = Brewery::factory()->create(['country_id' => $countryB->id, 'name' => 'Brewery B']);

    // Breweries must have beers to show up in available lists usually, but check implementation.
    // Index.php implementation of availableBreweries uses `whereHas('beers', ...)`.
    // So we must create beers for them.
    Beer::factory()->create(['brewery_id' => $breweryA->id]);
    Beer::factory()->create(['brewery_id' => $breweryB->id]);

    Livewire::test(Index::class)
        ->set('selectedCountries', [$countryA->id])
        ->assertViewHas('breweries', function ($breweries) use ($breweryA, $breweryB) {
            return $breweries->contains('id', $breweryA->id) && !$breweries->contains('id', $breweryB->id);
        });
});

it('filters available styles by country', function () {
    $countryA = Country::factory()->create();
    $countryB = Country::factory()->create();

    $breweryA = Brewery::factory()->create(['country_id' => $countryA->id]);
    $breweryB = Brewery::factory()->create(['country_id' => $countryB->id]);

    $styleA = Style::factory()->create(['name' => 'Style A']);
    $styleB = Style::factory()->create(['name' => 'Style B']);

    Beer::factory()->create(['brewery_id' => $breweryA->id, 'style_id' => $styleA->id]);
    Beer::factory()->create(['brewery_id' => $breweryB->id, 'style_id' => $styleB->id]);

    Livewire::test(Index::class)
        ->set('selectedCountries', [$countryA->id])
        ->assertViewHas('styles', function ($styles) use ($styleA, $styleB) {
            return $styles->contains('id', $styleA->id) && !$styles->contains('id', $styleB->id);
        });
});

it('filters available countries by brewery', function () {
    $countryA = Country::factory()->create(['name' => 'C-A']);
    $countryB = Country::factory()->create(['name' => 'C-B']);

    $breweryA = Brewery::factory()->create(['country_id' => $countryA->id]);
    $breweryB = Brewery::factory()->create(['country_id' => $countryB->id]);

    Beer::factory()->create(['brewery_id' => $breweryA->id]);
    Beer::factory()->create(['brewery_id' => $breweryB->id]);

    Livewire::test(Index::class)
        ->set('selectedBreweries', [$breweryA->id])
        ->assertViewHas('countries', function ($countries) use ($countryA, $countryB) {
            return $countries->contains('id', $countryA->id) && !$countries->contains('id', $countryB->id);
        });
});

it('filters available countries by style', function () {
    $countryA = Country::factory()->create();
    $countryB = Country::factory()->create();

    $breweryA = Brewery::factory()->create(['country_id' => $countryA->id]);
    $breweryB = Brewery::factory()->create(['country_id' => $countryB->id]);

    $styleA = Style::factory()->create();
    $styleB = Style::factory()->create();

    Beer::factory()->create(['brewery_id' => $breweryA->id, 'style_id' => $styleA->id]);
    Beer::factory()->create(['brewery_id' => $breweryB->id, 'style_id' => $styleB->id]);

    Livewire::test(Index::class)
        ->set('selectedStyles', [$styleA->id])
        ->assertViewHas('countries', function ($countries) use ($countryA, $countryB) {
            return $countries->contains('id', $countryA->id) && !$countries->contains('id', $countryB->id);
        });
});
