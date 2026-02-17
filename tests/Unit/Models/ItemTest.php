<?php

declare(strict_types=1);

use App\Models\Beer;
use App\Models\Container;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('should convert model to array with expected keys', function () {
    $item = Item::factory()->create();

    expect($item->toArray())->toHaveKeys([
        'id',
        'beer_id',
        'container_id',
        'consumed_at',
        'expiration_date',
        'created_at',
        'updated_at',
    ]);
});

it('should have correct fillable attributes', function () {
    $item = new Item();

    expect($item->getFillable())->toBe([
        'beer_id',
        'container_id',
        'consumed_at',
        'expiration_date',
    ]);
});

it('should have correct casts', function () {
    $item = new Item();

    expect($item->getCasts())
        ->toHaveKey('id', 'int')
        ->toHaveKey('consumed_at', 'datetime:Y-m-d')
        ->toHaveKey('expiration_date', 'datetime:Y-m-d');
});

it('should belong to a beer', function () {
    $item = Item::factory()->create();

    expect($item->beer)->toBeInstanceOf(Beer::class);
});

it('should belong to a container', function () {
    $item = Item::factory()->create();

    expect($item->container)->toBeInstanceOf(Container::class);
});
