<?php

namespace Database\Seeders;

use App\Models\Beer;
use App\Models\Container;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Beer::count() === 0) {
            $this->call(BeerSeeder::class);
        }

        if (Container::count() === 0) {
            $this->call(ContainerSeeder::class);
        }

        $beers = Beer::all();
        $containers = Container::all();

        Item::factory(100)->create([
            'beer_id' => fn() => $beers->random()->id,
            'container_id' => fn() => $containers->random()->id,
        ]);
    }
}
