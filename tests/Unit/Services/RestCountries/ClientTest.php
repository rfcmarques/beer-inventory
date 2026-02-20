<?php

declare(strict_types=1);

use App\DTOs\CountryDTO;
use App\Services\RestCountries\Client;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

uses(TestCase::class);

it('fetches and maps countries successfully', function () {
    Http::fake([
        'restcountries.com/v3.1/all*' => Http::response([
            [
                'name' => ['common' => 'Portugal', 'official' => 'Portuguese Republic'],
                'cca2' => 'PT',
                'capital' => ['Lisbon'],
                'flags' => ['svg' => 'https://flag.svg'],
            ],
            [
                'name' => ['common' => 'Spain', 'official' => 'Kingdom of Spain'],
                'cca2' => 'ES',
                'capital' => ['Madrid'],
                'flags' => ['svg' => 'https://es-flag.svg'],
            ]
        ], 200)
    ]);

    $client = new Client();
    $countries = $client->fetchAll();

    expect($countries)->toHaveCount(2)
        ->and($countries->first())->toBeInstanceOf(CountryDTO::class)
        ->and($countries->first()->name)->toBe('Portugal')
        ->and($countries->last()->name)->toBe('Spain');
});

it('throws an exception when the API returns an error', function () {
    Http::fake([
        'restcountries.com/v3.1/all*' => Http::response(null, 500)
    ]);

    $client = new Client();
    $client->fetchAll();
})->throws(RequestException::class);