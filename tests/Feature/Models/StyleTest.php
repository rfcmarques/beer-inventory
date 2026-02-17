<?php

declare(strict_types=1);

use App\Models\Style;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should exist and have correct attributes', function () {
    $style = Style::factory()->create([
        'name' => 'IPA',
        'srm' => 10,
    ]);

    expect($style)->toBeInstanceOf(Style::class)
        ->and($style->name)->toBe('IPA')
        ->and($style->srm)->toBe(10);
});

it('should create a style with unique name', function () {
    Style::factory()->create(['name' => 'Stout']);

    expect(fn () => Style::factory()->create(['name' => 'Stout']))
        ->toThrow(Illuminate\Database\QueryException::class);
});

it('should create a style with nullable srm', function () {
    $style = Style::factory()->create(['srm' => null]);

    expect($style->srm)->toBeNull();
});

it('should create a style with srm cast to integer', function () {
    $style = Style::factory()->create(['srm' => '15']);

    expect($style->srm)->toBe(15)
        ->and($style->srm)->toBeInt();
});

it('should mass assign style attributes', function () {
    $style = Style::create([
        'name' => 'Pilsner',
        'srm' => 5,
    ]);

    expect($style->exists)->toBeTrue()
        ->and($style->name)->toBe('Pilsner');
});
