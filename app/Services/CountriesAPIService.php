<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CountriesAPIService
{
    protected static $url = "https://restcountries.com/v3.1";

    public static function getCountriesByName(): array
    {
        return Cache::remember('countries', 60 * 60 * 24, function () {
            $response = Http::get(static::$url . '/all', ['fields' => 'name']);

            if ($response->successful()) {
                $json = $response->json();

                $countries = array_values(Arr::sort(
                    Arr::map($json, function ($country) {
                        return $country['name']['common'];
                    })
                ));

                return $countries;
            }

            return [];
        });
    }
}
