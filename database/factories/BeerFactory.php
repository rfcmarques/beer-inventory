<?php

namespace Database\Factories;

use App\Models\Brewery;
use App\Models\Style;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beer>
 */
class BeerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Beer ' . \Illuminate\Support\Str::random(5),
            'brewery_id' => Brewery::factory(),
            'style_id' => Style::factory(),
            'abv' => rand(5, 140) / 10,
        ];
    }
}
