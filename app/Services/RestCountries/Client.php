<?php

declare(strict_types=1);

namespace App\Services\RestCountries;

use App\DTOs\CountryDTO;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

final class Client
{
    protected const BASE_URL = 'https://restcountries.com/v3.1';
    protected const TIMEOUT_SECONDS = 15;

    public function fetchAll(): Collection
    {
        $response = Http::timeout(self::TIMEOUT_SECONDS)
            ->retry(
                times: 3,
                sleepMilliseconds: 100
            )
            ->get(
                url: self::BASE_URL . '/all',
                query: [
                    'fields' => 'name,cca2,flags,capital'
                ]
            );

        $response->throw();

        return $response->collect()
            ->map(fn (array $country) => CountryDTO::fromApi($country));
    }
}