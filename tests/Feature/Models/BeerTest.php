<?php

declare(strict_types=1);

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Style;

it('should exist and have the correct attributes', function () {
    $beer = Beer::factory()->create([
        'name' => 'Test Beer',
        'brewery_id' => Brewery::factory(),
        'style_id' => Style::factory(),
        'abv' => 5.0,
    ]);

    expect($beer->name)->toBe('Test Beer')
        ->and($beer->brewery_id)->toBe(1)
        ->and($beer->style_id)->toBe(1)
        ->and($beer->abv)->toBe('5.00');
});

it('should create a beer with abv cast to decimal', function () {
    $beer = Beer::factory()->create([
        'name' => 'Test Beer',
        'brewery_id' => Brewery::factory(),
        'style_id' => Style::factory(),
        'abv' => 5.0,
    ]);

    expect($beer->abv)->toBe('5.00');
});

it('should mass assign beer attributes', function () {
    $beer = Beer::create([
        'name' => 'Test Beer',
        'brewery_id' => Brewery::factory()->create()->first()->id,
        'style_id' => Style::factory()->create()->first()->id,
        'abv' => 5.0,
    ]);

    expect($beer->exists)->toBeTrue()
        ->and($beer->name)->toBe('Test Beer')
        ->and($beer->brewery_id)->toBe(1)
        ->and($beer->style_id)->toBe(1)
        ->and($beer->abv)->toBe('5.00');
});