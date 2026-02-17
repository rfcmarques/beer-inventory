<?php

declare(strict_types=1);

use App\Models\Container;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('should convert model to array with expected keys', function () {
    $container = Container::factory()->create()->fresh();

    expect(array_keys($container->toArray()))
        ->toBe([
            'id',
            'type',
            'capacity',
            'created_at',
            'updated_at',
        ]);
});

it('should have correct fillable attributes', function () {
    $container = new Container();

    expect($container->getFillable())->toBe([
        'type',
        'capacity',
    ]);
});

it('should have correct casts', function () {
    $container = new Container();

    expect($container->getCasts())->toHaveKey('id', 'int');
});

it('should have label attribute', function () {
    $container = Container::factory()->create();

    expect($container->label)->toBeString();
});
