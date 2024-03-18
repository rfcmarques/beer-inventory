<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'beer_id' => Beer::factory(),
            'container' => $this->faker->randomElement(['Bottle 330ml', 'Bottle 375ml', 'Bottle 750ml', 'Can 330ml', 'Can 440ml', 'Can 473ml']),
            'expiration_date' => $this->faker->dateTime(),
        ];
    }
}
