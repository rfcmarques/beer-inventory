<?php

namespace Database\Factories;

use App\Models\Style;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Style>
 */
class StyleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Style::class;

    public function definition(): array
    {
        return [
            'style' => $this->faker->unique()->randomElement(['IPA', 'APA', 'Porter', 'Stout', 'Sour', 'Hefeweizen', 'Dunkelweizen', 'Lager', 'Pilsner', 'Helles Lager', 'Barleywine', 'Pale Ale', 'Lambic',]),
        ];
    }
}
