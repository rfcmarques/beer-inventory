<?php

declare(strict_types=1);

use App\Models\Style;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    expect($style->getCasts())->toHaveKey('srm', 'integer');
});

it('should have many beers', function () {
    $style = new Style();

    expect($style->beers())->toBeInstanceOf(HasMany::class);
});

it('should count available and consumed items', function () {
    $style = Style::factory()->create();
    $beer = \App\Models\Beer::factory()->create(['style_id' => $style->id]);

    \App\Models\Item::factory()->count(3)->create([
        'beer_id' => $beer->id,
        'consumed_at' => null,
    ]);

    \App\Models\Item::factory()->count(2)->create([
        'beer_id' => $beer->id,
        'consumed_at' => now(),
    ]);

    $styleWithCounts = Style::query()
        ->withQuantityAvailable()
        ->withQuantityConsumed()
        ->find($style->id);

    expect($styleWithCounts->quantity_available)->toBe(3)
        ->and($styleWithCounts->quantity_consumed)->toBe(2);
});
