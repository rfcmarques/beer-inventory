<?php

declare(strict_types=1);

use App\Models\Country;

it('should exist and have the correct attributes', function () {
    $country = Country::factory()->create([
        'code' => 'US',
        'name' => 'United States',

    ]);

    expect($country)->toBeInstanceOf(Country::class)
        ->and($country->code)->toBe('US')
        ->and($country->name)->toBe('United States');
});

it('should create a country with unique code', function () {
    Country::factory()->create([
        'code' => 'US',
        'name' => 'United States',
    ]);

    expect(fn() => Country::factory()->create([
        'code' => 'US',
        'name' => 'Other Name',
    ]))->toThrow(\Illuminate\Database\QueryException::class);
});

it('should create a country with unique name', function () {
    Country::factory()->create([
        'code' => 'US',
        'name' => 'United States',
    ]);

    expect(fn() => Country::factory()->create([
        'code' => 'Other Code',
        'name' => 'United States',
    ]))->toThrow(\Illuminate\Database\QueryException::class);
});

it('should create a country with unique official_name', function () {
    Country::factory()->create([
        'code' => 'US',
        'name' => 'United States',
        'official_name' => 'United States of America',
    ]);

    expect(fn() => Country::factory()->create([
        'code' => 'Other Code',
        'name' => 'Other Name',
        'official_name' => 'United States of America',
    ]))->toThrow(\Illuminate\Database\QueryException::class);
});

it('should create a country with a nullable capital', function () {
    $country = Country::factory()->create([
        'code' => 'US',
        'name' => 'United States',
        'capital' => null,
    ]);

    expect($country->capital)->toBeNull();
});

it('should mass assign country attributes', function () {
    $country = Country::create([
        'code' => 'US',
        'name' => 'United States',
        'official_name' => 'United States of America',
        'capital' => 'Washington, D.C.',
        'flag_url' => 'https://example.com/flag.png',
    ]);

    expect($country->exists)->toBeTrue()
        ->and($country->code)->toBe('US')
        ->and($country->name)->toBe('United States')
        ->and($country->official_name)->toBe('United States of America')
        ->and($country->capital)->toBe('Washington, D.C.')
        ->and($country->flag_url)->toBe('https://example.com/flag.png');
});
