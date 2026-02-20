<?php

declare(strict_types=1);
use App\DTOs\CountryDTO;

it('creates DTO from standard array', function () {
    $data = [
        'name' => 'Portugal',
        'official_name' => 'Portuguese Republic',
        'code' => 'PT',
        'capital' => 'Lisbon',
        'flag_url' => 'https://flag.svg',
    ];

    $dto = CountryDTO::fromArray($data);

    expect($dto->name)->toBe('Portugal')
        ->and($dto->officialName)->toBe('Portuguese Republic')
        ->and($dto->code)->toBe('PT')
        ->and($dto->capital)->toBe('Lisbon')
        ->and($dto->flagUrl)->toBe('https://flag.svg');
});

it('creates DTO from API response array', function () {
    $apiData = [
        'name' => [
            'common' => 'Portugal',
            'official' => 'Portuguese Republic',
        ],
        'cca2' => 'PT',
        'capital' => ['Lisbon'],
        'flags' => [
            'png' => 'https://flag.png',
            'svg' => 'https://flag.svg',
        ],
    ];

    $dto = CountryDTO::fromApi($apiData);

    expect($dto->name)->toBe('Portugal')
        ->and($dto->officialName)->toBe('Portuguese Republic')
        ->and($dto->code)->toBe('PT')
        ->and($dto->capital)->toBe('Lisbon')
        ->and($dto->flagUrl)->toBe('https://flag.svg');
});

it('handles missing capital in API response', function () {
    $apiData = [
        'name' => [
            'common' => 'Antarctica',
            'official' => 'Antarctica',
        ],
        'cca2' => 'AQ',
        'flags' => [
            'png' => 'https://flag.png',
        ],
    ];

    $dto = CountryDTO::fromApi($apiData);

    expect($dto->capital)->toBeNull()
        ->and($dto->flagUrl)->toBe('https://flag.png');
});

it('converts DTO to array correctly', function () {
    $dto = new CountryDTO(
        name: 'Portugal',
        officialName: 'Portuguese Republic',
        code: 'PT',
        capital: 'Lisbon',
        flagUrl: 'https://flag.svg'
    );

    expect($dto->toArray())->toBe([
        'name' => 'Portugal',
        'official_name' => 'Portuguese Republic',
        'code' => 'PT',
        'capital' => 'Lisbon',
        'flag_url' => 'https://flag.svg',
    ]);
});