<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Container;
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
            'container_id' => Container::factory(),
            'expiration_date' => $this->faker->dateTime(),
        ];
    }
}
