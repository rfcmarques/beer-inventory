<?php

declare(strict_types=1);

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Country;
use App\Models\Item;
use App\Models\Style;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('should convert model to array with expected keys', function () {
    $beer = Beer::factory()->create()->fresh();

    expect(array_keys($beer->toArray()))->toBe([
        'id',
        'name',
        'brewery_id',
        'style_id',
        'abv',
        'created_at',
        'updated_at',
    ]);
});

it('should have correct fillable attributes', function () {
    $beer = new Beer();

    expect($beer->getFillable())->toBe([
        'name',
        'brewery_id',
        'style_id',
        'abv',
    ]);
});

it('should have correct casts', function () {
    $beer = new Beer();

    expect($beer->getCasts())->toHaveKey('id', 'int');
});

it('should cast abv to decimal', function () {
    $beer = Beer::factory()->create(['abv' => 5.5]);

    expect($beer->getCasts())->toHaveKey('abv', 'decimal:2');
});

it('should belong to a brewery', function () {
    $beer = Beer::factory()->create();

    expect($beer->brewery)->toBeInstanceOf(Brewery::class);
});

it('should belong to a style', function () {
    $beer = Beer::factory()->create();

    expect($beer->style)->toBeInstanceOf(Style::class);
});

it('should have many items', function () {
    $beer = Beer::factory()->create();
    Item::factory()->count(3)->create(['beer_id' => $beer->id]);

    expect($beer->items)->toHaveCount(3)
        ->and($beer->items->first())->toBeInstanceOf(Item::class);
});

it('should scope to available beers', function () {
    $beer = Beer::factory()->create();

    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    $consumedBeer = Beer::factory()->create();
    Item::factory()->create([
        'beer_id' => $consumedBeer->id,
        'consumed_at' => now(),
    ]);

    $results = Beer::available()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($beer->id);
});

it('filters by breweries', function () {
    $breweryA = Brewery::factory()->create();
    $breweryB = Brewery::factory()->create();
    $beerA = Beer::factory()->create(['brewery_id' => $breweryA->id]);
    $beerB = Beer::factory()->create(['brewery_id' => $breweryB->id]);

    $results = Beer::filterByBreweries([$breweryA->id])->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($beerA->id);
});

it('filters by styles', function () {
    $styleA = Style::factory()->create();
    $styleB = Style::factory()->create();
    $beerA = Beer::factory()->create(['style_id' => $styleA->id]);
    $beerB = Beer::factory()->create(['style_id' => $styleB->id]);

    $results = Beer::filterByStyles([$styleA->id])->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($beerA->id);
});

it('filters by countries', function () {
    $countryA = Country::factory()->create();
    $countryB = Country::factory()->create();
    $breweryA = Brewery::factory()->create(['country_id' => $countryA->id]);
    $breweryB = Brewery::factory()->create(['country_id' => $countryB->id]);
    $beerA = Beer::factory()->create(['brewery_id' => $breweryA->id]);
    $beerB = Beer::factory()->create(['brewery_id' => $breweryB->id]);

    $results = Beer::filterByCountries([$countryA->id])->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($beerA->id);
});

it('searches by name, brewery name, and style name', function () {
    $beer = Beer::factory()->create(['name' => 'UniqueName']);
    $beerByBrewery = Beer::factory()->create([
        'brewery_id' => Brewery::factory()->create(['name' => 'UniqueBrewery'])->id
    ]);
    $beerByStyle = Beer::factory()->create([
        'style_id' => Style::factory()->create(['name' => 'UniqueStyle'])->id
    ]);

    expect(Beer::search('UniqueName')->get())->toHaveCount(1)
        ->and(Beer::search('UniqueBrewery')->get())->toHaveCount(1)
        ->and(Beer::search('UniqueStyle')->get())->toHaveCount(1);
});

it('applies multiple filters via general filter method', function () {
    $country = Country::factory()->create();
    $brewery = Brewery::factory()->create(['country_id' => $country->id]);
    $style = Style::factory()->create();
    $beer = Beer::factory()->create([
        'brewery_id' => $brewery->id,
        'style_id' => $style->id,
        'name' => 'TargetBeer'
    ]);

    Beer::factory()->create(); // Noise

    $filters = [
        'breweries' => [$brewery->id],
        'styles' => [$style->id],
        'countries' => [$country->id],
        'search' => 'Target',
    ];

    $results = Beer::filter($filters)->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($beer->id);
});