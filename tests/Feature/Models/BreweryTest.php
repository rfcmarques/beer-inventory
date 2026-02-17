<?php

declare(strict_types=1);

use App\Models\Brewery;
use App\Models\Country;

it('should exist and have the correct attributes', function () {
    $brewery = Brewery::factory()->create([
        'name' => 'Brewery 1',
        'country_id' => Country::factory(),
        'logo' => 'logo.png',
    ]);

    expect($brewery->name)->toBe('Brewery 1');
    expect($brewery->country_id)->toBe(1);
    expect($brewery->logo)->toBe('logo.png');
});

it('should create a brewery with unique name', function () {
    Brewery::factory()->create([
        'name' => 'Brewery 1',
        'country_id' => Country::factory(),
        'logo' => 'logo.png',
    ]);

    expect(fn () => Brewery::factory()->create([
        'name' => 'Brewery 1',
        'country_id' => Country::factory(),
        'logo' => 'logo.png',
    ]))->toThrow(\Illuminate\Database\QueryException::class);
});

it('should create a brewery with nullable logo', function () {
    $brewery = Brewery::factory()->create([
        'name' => 'Brewery 1',
        'country_id' => Country::factory(),
        'logo' => null,
    ]);

    expect($brewery->logo)->toBeNull();
});

it('should mass assign brewery attributes', function () {
    $brewery = Brewery::create([
        'name' => 'Brewery 1',
        'country_id' => Country::factory()->create()->first()->id,
        'logo' => 'logo.png',
    ]);

    expect($brewery->exists)->toBeTrue()
        ->and($brewery->name)->toBe('Brewery 1')
        ->and($brewery->country_id)->toBe(1)
        ->and($brewery->logo)->toBe('logo.png');
});
