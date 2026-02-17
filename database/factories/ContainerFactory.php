<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Container>
 */
class ContainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $combinations = [
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

        $combination = $this->faker->randomElement($combinations);

        return [
            'type' => $combination['type'],
            'capacity' => $combination['capacity']
        ];
    }
}
