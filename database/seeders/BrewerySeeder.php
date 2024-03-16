<?php

namespace Database\Seeders;

use App\Models\Brewery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrewerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brewery::factory(20)->create();
    }
}
