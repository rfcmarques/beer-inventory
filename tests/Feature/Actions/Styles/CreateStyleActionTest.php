<?php

declare(strict_types=1);

use App\Actions\Styles\CreateStyleAction;
use App\Models\Style;

it('should create a style with name and srm', function () {
    app(CreateStyleAction::class)->handle('IPA', 12);

    $style = Style::where('name', 'IPA')->first();

    expect($style)
        ->not->toBeNull()
        ->name->toBe('IPA')
        ->srm->toBe(12);
});

it('should create a style with null srm', function () {
    app(CreateStyleAction::class)->handle('Lager', null);

    $style = Style::where('name', 'Lager')->first();

    expect($style)
        ->not->toBeNull()
        ->srm->toBeNull();
});

it('should return the created style instance', function () {
    $result = app(CreateStyleAction::class)->handle('Stout', 30);

    expect($result)
        ->toBeInstanceOf(Style::class)
        ->id->not->toBeNull()
        ->exists->toBeTrue();
});
