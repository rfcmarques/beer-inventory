<?php

namespace Database\Seeders;

use App\Models\Brewery;
use App\Models\Country;
use Illuminate\Database\Seeder;

class BrewerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Country::count() === 0) {
            $this->call(CountrySeeder::class);
        }

        $countries = Country::all();

        Brewery::factory(50)->make([
            'country_id' => fn() => $countries->random()->id,
        ])->each(function ($brewery) {
            Brewery::firstOrCreate(
                ['name' => $brewery->name],
                ['country_id' => $brewery->country_id, 'logo' => $brewery->logo]
            );
        });
    }
}
