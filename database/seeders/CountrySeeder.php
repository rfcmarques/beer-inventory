<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Services\CountriesAPIService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = CountriesAPIService::getCountriesByName();

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['name' => $country['name']]
            );
        }
    }
}
