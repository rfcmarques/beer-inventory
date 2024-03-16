<?php

namespace Database\Factories;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Style;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beer>
 */
class BeerFactory extends Factory
{

    protected $model = Beer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'brewery_id' => Brewery::factory(),
            'style_id' => Style::factory(),
        ];
    }
}
