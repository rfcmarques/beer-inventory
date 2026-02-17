<?php

declare(strict_types=1);

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('should convert model to array with expected keys', function () {
    $country = Country::factory()->create()->fresh();

    expect(array_keys($country->toArray()))
        ->toBe([
            'id',
            'code',
            'name',
            'official_name',
            'capital',
            'flag_url',
            'created_at',
            'updated_at',
        ]);
});

it('should have correct fillable attributes', function () {
    $country = new Country();

    expect($country->getFillable())->toBe([
        'code',
        'name',
        'official_name',
        'capital',
        'flag_url',
    ]);
});

it('should have correct casts', function () {
    $country = new Country();

    expect($country->getCasts())->toHaveKey('id', 'int');
});

// test('it has expected columns', function () {
//     $country = Country::factory()->create([
//         'code' => 'US',
//         'name' => 'United States',
//         'official_name' => 'United States of America',
//         'capital' => 'Washington, D.C.',
//         'flag_url' => 'http://example.com/us.png',
//     ]);

//     expect($country)
//         ->code->toBe('US')
//         ->name->toBe('United States')
//         ->official_name->toBe('United States of America')
//         ->capital->toBe('Washington, D.C.')
//         ->flag_url->toBe('http://example.com/us.png')
//         ->created_at->not->toBeNull()
//         ->updated_at->not->toBeNull();
// });
