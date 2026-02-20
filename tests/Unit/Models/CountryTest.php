<?php

declare(strict_types=1);

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Country;
use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('should convert model to array with expected keys', function () {
    $country = Country::factory()->create()->fresh();

    expect(array_keys($country->toArray()))
        ->toBe([
            'id',
            'code',
            'name',
            'official_name',
            'capital',
            'flag_url',
            'created_at',
            'updated_at',
        ]);
});

it('should have correct fillable attributes', function () {
    $country = new Country();

    expect($country->getFillable())->toBe([
        'code',
        'name',
        'official_name',
        'capital',
        'flag_url',
    ]);
});

it('should have correct casts', function () {
    $country = new Country();

    expect($country->getCasts())->toHaveKey('id', 'int');
});

it('should have many breweries', function () {
    $country = Country::factory()->create();
    Brewery::factory()->create(['country_id' => $country->id]);

    expect($country->breweries())->toBeInstanceOf(HasMany::class);
});

it('should scope to countries with available items', function () {
    $country = Country::factory()->create();
    $brewery = Brewery::factory()->create(['country_id' => $country->id]);
    $beer = Beer::factory()->create(['brewery_id' => $brewery->id]);
    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    $otherCountry = Country::factory()->create();
    $otherBrewery = Brewery::factory()->create(['country_id' => $otherCountry->id]);
    $otherBeer = Beer::factory()->create(['brewery_id' => $otherBrewery->id]);
    Item::factory()->create([
        'beer_id' => $otherBeer->id,
        'consumed_at' => now(),
    ]);

    $results = Country::query()->available()->get();

    expect($results)->toHaveCount(1)
        ->and($results->firstWhere('id', $country->id)->id)->toBe($country->id)
        ->and($results->first()->breweries->first()->items->first()->consumed_at)->toBeNull();
});

it('should scope to countries with consumed items', function () {
    $country = Country::factory()->create();
    $brewery = Brewery::factory()->create(['country_id' => $country->id]);
    $beer = Beer::factory()->create(['brewery_id' => $brewery->id]);
    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => now(),
    ]);

    $otherCountry = Country::factory()->create();
    $otherBrewery = Brewery::factory()->create(['country_id' => $otherCountry->id]);
    $otherBeer = Beer::factory()->create(['brewery_id' => $otherBrewery->id]);
    Item::factory()->create([
        'beer_id' => $otherBeer->id,
        'consumed_at' => null,
    ]);

    $results = Country::query()->consumed()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($country->id)
        ->and($results->first()->breweries->first()->items->first()->consumed_at)->not->toBeNull();
});