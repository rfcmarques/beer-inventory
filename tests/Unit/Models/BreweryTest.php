<?php

declare(strict_types=1);

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Country;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('should convert model to array with expected keys', function () {
    $brewery = Brewery::factory()->create()->fresh();

    expect(array_keys($brewery->toArray()))->toBe([
        'id',
        'name',
        'country_id',
        'logo',
        'created_at',
        'updated_at',
    ]);
});

it('should have correct fillable attributes', function () {
    $brewery = new Brewery();

    expect($brewery->getFillable())->toBe([
        'name',
        'country_id',
        'logo',
    ]);
});

it('should have correct casts', function () {
    $brewery = new Brewery();

    expect($brewery->getCasts())->toHaveKey('id', 'int');
});

it('should belong to a country', function () {
    $brewery = Brewery::factory()->create();

    expect($brewery->country)->toBeInstanceOf(Country::class);
});

it('should have many beers', function () {
    $brewery = Brewery::factory()->create();
    Beer::factory()->count(2)->create(['brewery_id' => $brewery->id]);

    expect($brewery->beers)->toHaveCount(2)
        ->and($brewery->beers->first())->toBeInstanceOf(Beer::class);
});

it('should scope to available breweries', function () {
    $brewery = Brewery::factory()->create();
    $beer = Beer::factory()->create(['brewery_id' => $brewery->id]);
    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    $consumedBrewery = Brewery::factory()->create();
    $consumedBeer = Beer::factory()->create(['brewery_id' => $consumedBrewery->id]);
    Item::factory()->create([
        'beer_id' => $consumedBeer->id,
        'consumed_at' => now(),
    ]);

    $results = Brewery::available()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($brewery->id);
});

it('should scope to consumed breweries', function () {
    $brewery = Brewery::factory()->create();
    $beer = Beer::factory()->create(['brewery_id' => $brewery->id]);
    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => now(),
    ]);

    $availableBrewery = Brewery::factory()->create();
    $availableBeer = Beer::factory()->create(['brewery_id' => $availableBrewery->id]);
    Item::factory()->create([
        'beer_id' => $availableBeer->id,
        'consumed_at' => null,
    ]);

    $results = Brewery::consumed()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($brewery->id);
});

it('should count the amount of items available with this brewery', function () {
    $brewery = Brewery::factory()->create();
    $beer = Beer::factory()->create(['brewery_id' => $brewery->id]);
    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => null
    ]);

    $consumedBrewery = Brewery::factory()->create();
    $consumedBeer = Beer::factory()->create(['brewery_id' => $consumedBrewery->id]);
    Item::factory()->create([
        'beer_id' => $consumedBeer->id,
        'consumed_at' => now()
    ]);

    $results = Brewery::withQuantityAvailable()->get();

    expect($results)->toHaveCount(2)
        ->and($results->firstWhere('id', $brewery->id)->quantity_available)->toBe(1);
});

it('should count the amount of items consumed with this brewery', function () {
    $brewery = Brewery::factory()->create();
    $beer = Beer::factory()->create(['brewery_id' => $brewery->id]);
    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => now()
    ]);

    $availableBrewery = Brewery::factory()->create();
    $availableBeer = Beer::factory()->create(['brewery_id' => $availableBrewery->id]);
    Item::factory()->create([
        'beer_id' => $availableBeer->id,
        'consumed_at' => null,
    ]);

    $results = Brewery::withQuantityConsumed()->get();

    expect($results)->toHaveCount(2)
        ->and($results->firstWhere('id', $brewery->id)->quantity_consumed)->toBe(1);
});

it('should count the amount of beers with this brewery', function () {
    $brewery = Brewery::factory()->create();
    Beer::factory()->count(2)->create(['brewery_id' => $brewery->id]);

    $otherBrewery = Brewery::factory()->create();
    Beer::factory()->count(3)->create(['brewery_id' => $otherBrewery->id]);

    $results = Brewery::withQuantityBeers()->get();

    expect($results)->toHaveCount(2)
        ->and($results->firstWhere('id', $brewery->id)->quantity_beers)->toBe(2)
        ->and($results->firstWhere('id', $otherBrewery->id)->quantity_beers)->toBe(3);
});

it('should search breweries based on their name and country name', function () {
    Brewery::factory()->create(['name' => 'UniqueName']);
    Brewery::factory()->create([
        'country_id' => Country::factory()->create(['name' => 'UniqueCountry'])->id
    ]);

    expect(Brewery::search('UniqueName')->get())->toHaveCount(1)
        ->and(Brewery::search('UniqueCountry')->get())->toHaveCount(1);
});