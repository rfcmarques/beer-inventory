<?php

declare(strict_types=1);

use App\Models\Beer;
use App\Models\Item;
use App\Models\Style;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);


it('should convert model to array with expected keys', function () {
    $style = Style::factory()->create()->fresh();

    expect(array_keys($style->toArray()))->toBe([
        'id',
        'name',
        'srm',
        'created_at',
        'updated_at',
    ]);
});

it('should have correct fillable attributes', function () {
    $style = new Style();

    expect($style->getFillable())->toBe([
        'name',
        'srm',
    ]);
});

it('should have correct casts', function () {
    $style = new Style();

    expect($style->getCasts())->toHaveKey('id', 'int');
    expect($style->getCasts())->toHaveKey('srm', 'integer');
});

it('should have many beers', function () {
    $style = new Style();

    expect($style->beers())->toBeInstanceOf(HasMany::class);
});

it('should belong to many items', function () {
    $style = new Style();

    expect($style->items())->toBeInstanceOf(HasManyThrough::class);
});

it('should scope to styles with available items', function () {
    $style = Style::factory()->create();
    $beer = Beer::factory()->create(['style_id' => $style->id]);
    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    $otherStyle = Style::factory()->create();
    $otherBeer = Beer::factory()->create(['style_id' => $otherStyle->id]);
    Item::factory()->create([
        'beer_id' => $otherBeer->id,
        'consumed_at' => now(),
    ]);

    $results = Style::available()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($style->id);
});

it('should scope to styles with consumed items', function () {
    $style = Style::factory()->create();
    $beer = Beer::factory()->create(['style_id' => $style->id]);
    Item::factory()->create([
        'beer_id' => $beer->id,
        'consumed_at' => now(),
    ]);

    $otherStyle = Style::factory()->create();
    $otherBeer = Beer::factory()->create(['style_id' => $otherStyle->id]);
    Item::factory()->create([
        'beer_id' => $otherBeer->id,
        'consumed_at' => null,
    ]);

    $results = Style::consumed()->get();

    expect($results)->toHaveCount(1)
        ->and($results->first()->id)->toBe($style->id);
});

it('should count available and consumed items', function () {
    $style = Style::factory()->create();
    $beer = Beer::factory()->create(['style_id' => $style->id]);

    Item::factory()->count(3)->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    Item::factory()->count(2)->create([
        'beer_id' => $beer->id,
        'consumed_at' => now(),
    ]);

    $otherStyle = Style::factory()->create();
    $otherBeer = Beer::factory()->create(['style_id' => $otherStyle->id]);
    Item::factory()->create([
        'beer_id' => $otherBeer->id,
        'consumed_at' => null,
    ]);

    $results = Style::query()
        ->withQuantityAvailable()
        ->withQuantityConsumed()
        ->get();

    expect($results->first()->quantity_available)->toBe(3)
        ->and($results->first()->quantity_consumed)->toBe(2);
});

it('should count the amount of beers with this style', function () {
    $style = Style::factory()->create();
    Beer::factory()->count(5)->create(['style_id' => $style->id]);

    $otherStyle = Style::factory()->create();
    Beer::factory()->count(2)->create(['style_id' => $otherStyle->id]);

    $results = Style::query()
        ->withQuantityBeers()
        ->get();

    expect($results->first()->quantity_beers)->toBe(5);
});

it('should search styles by name', function () {
    Style::factory()->create(['name' => 'Test Style']);
    Style::factory()->create(['name' => 'Other Style']);

    $result = Style::query()->search('Test')->get();

    expect($result)->toHaveCount(1);
});
