<?php

declare(strict_types=1);

use App\Models\Beer;
use App\Models\Container;
use App\Models\Item;

it('should exist and have correct attributes', function () {
    $item = Item::factory()->create();

    expect($item->id)->toBeInt()
        ->and($item->beer_id)->toBeInt()
        ->and($item->container_id)->toBeInt();

    $this->assertDatabaseHas('items', [
        'id' => $item->id,
        'beer_id' => $item->beer_id,
        'container_id' => $item->container_id,
    ]);
});

it('should create an item with nullable consumed_at', function () {
    $item = Item::factory()->create(['consumed_at' => null]);

    expect($item->consumed_at)->toBeNull();

    $this->assertDatabaseHas('items', ['id' => $item->id, 'consumed_at' => null]);
});

it('should mass assign item attributes', function () {
    $beer = Beer::factory()->create();
    $container = Container::factory()->create();
    $data = [
        'beer_id' => $beer->id,
        'container_id' => $container->id,
        'consumed_at' => '2023-10-27',
        'expiration_date' => '2024-10-27',
    ];

    $item = Item::create($data);

    expect($item->id)->toBeInt()
        ->and($item->beer_id)->toBe($beer->id)
        ->and($item->container_id)->toBe($container->id);

    $this->assertDatabaseHas('items', [
        'id' => $item->id,
        'beer_id' => $beer->id,
        'container_id' => $container->id,
    ]);
});
