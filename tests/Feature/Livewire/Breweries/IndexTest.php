<?php

use App\Livewire\Breweries\Index;
use App\Models\Brewery;
use App\Models\Country;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders the breweries page', function () {
    $this->get(route('breweries'))
        ->assertOk()
        ->assertSeeLivewire(Index::class);
});

it('can load more breweries', function () {
    $component = Livewire::test(Index::class);

    $component->assertSet('amount', 21);

    $component->call('load');

    $component->assertSet('amount', 33);
});

it('loads breweries correctly', function () {
    $country = Country::factory()->create();
    Brewery::factory()->count(25)->create(['country_id' => $country->id]);

    Livewire::test(Index::class)
        ->assertViewHas('breweries', function ($breweries) {
            return $breweries->count() === 21;
        })
        ->call('load')
        ->assertViewHas('breweries', function ($breweries) {
            return $breweries->count() === 25;
        });
});
