<?php

namespace Database\Factories;

use App\Models\Brewery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brewery>
 */
class BreweryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Brewery::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'country' => $this->faker->country,
        ];
    }
}
