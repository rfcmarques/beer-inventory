<?php

namespace Database\Seeders;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Style;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Brewery::count() === 0) {
            $this->call(BrewerySeeder::class);
        }

        if (Style::count() === 0) {
            $this->call(StyleSeeder::class);
        }

        $breweries = Brewery::all();
        $styles = Style::all();

        Beer::factory(50)->create([
            'brewery_id' => fn() => $breweries->random()->id,
            'style_id' => fn() => $styles->random()->id,
        ]);
    }
}
