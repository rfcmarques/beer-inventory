<?php

declare(strict_types=1);

use App\Models\Brewery;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('should convert model to array with expected keys', function () {
    $brewery = Brewery::factory()->create()->fresh();

    expect(array_keys($brewery->toArray()))->toBe([
        'id',
        'name',
        'country_id',
        'logo',
        'created_at',
        'updated_at',
    ]);
});

it('should have correct fillable attributes', function () {
    $brewery = new Brewery();

    expect($brewery->getFillable())->toBe([
        'name',
        'country_id',
        'logo',
    ]);
});

it('should have correct casts', function () {
    $brewery = new Brewery();

    expect($brewery->getCasts())->toHaveKey('id', 'int');
});

it('should belong to a country', function () {
    $brewery = Brewery::factory()->create();

    expect($brewery->country)->toBeInstanceOf(Country::class);
});
