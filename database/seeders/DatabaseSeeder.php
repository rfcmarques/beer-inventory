<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => env('ADMIN_USR'),
        ], [
            'name' => 'Rui Marques',
            'password' => env('ADMIN_PWD'),
            'admin' => now(),
        ]);

        $this->call([
            CountrySeeder::class,
            BrewerySeeder::class,
            StyleSeeder::class,
            BeerSeeder::class,
            ContainerSeeder::class,
            ItemSeeder::class,
        ]);
    }
}
