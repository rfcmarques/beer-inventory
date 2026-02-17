<?php

declare(strict_types=1);

use App\Enums\ContainerType;
use App\Models\Container;

it('should exist and have the correct attributes', function () {
    $container = Container::factory()->create([
        'type' => ContainerType::BOTTLE->value,
        'capacity' => 500,
    ]);

    expect($container)->toBeInstanceOf(Container::class)
        ->and($container->type)->toBe(ContainerType::BOTTLE->value)
        ->and($container->capacity)->toBe(500)
        ->and($container->label)->toBe('Bottle 500ml');
});

it('should mass assign container attributes', function () {
    $container = Container::create([
        'type' => ContainerType::BOTTLE->value,
        'capacity' => 500,
    ]);

    expect($container->exists)->toBeTrue()
        ->and($container->type)->toBe(ContainerType::BOTTLE->value)
        ->and($container->capacity)->toBe(500)
        ->and($container->label)->toBe('Bottle 500ml');
});
