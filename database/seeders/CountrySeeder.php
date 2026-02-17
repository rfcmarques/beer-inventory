<?php

namespace Database\Seeders;

use App\Actions\Country\SyncCountries;
use App\Models\Country;
use App\Services\RestCountries\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $action = new SyncCountries(new Client());
        $action->handle();
    }
}
