<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'beer_id' => Beer::factory(),
            'container_id' => Container::factory(),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'consumed_at' => $this->faker->optional(0.2)->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
