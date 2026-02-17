<?php

namespace Database\Seeders;

use App\Models\Container;
use Illuminate\Database\Seeder;

class ContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $containers = [
            ['type' => 'Can', 'capacity' => 330],
            ['type' => 'Can', 'capacity' => 355],
            ['type' => 'Can', 'capacity' => 440],
            ['type' => 'Can', 'capacity' => 473],
            ['type' => 'Can', 'capacity' => 500],
            ['type' => 'Bottle', 'capacity' => 250],
            ['type' => 'Bottle', 'capacity' => 330],
            ['type' => 'Bottle', 'capacity' => 375],
            ['type' => 'Bottle', 'capacity' => 500],
            ['type' => 'Bottle', 'capacity' => 750],
        ];

        foreach ($containers as $container) {
            Container::firstOrCreate(
                ['type' => $container['type'], 'capacity' => $container['capacity']],
                $container
            );
        }
    }
}
