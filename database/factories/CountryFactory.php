<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(\Illuminate\Support\Str::random(2)),
            'name' => 'Country ' . \Illuminate\Support\Str::random(5),
            'official_name' => 'Official ' . \Illuminate\Support\Str::random(5),
            'capital' => 'Capital ' . \Illuminate\Support\Str::random(5),
            'flag_url' => 'https://example.com/flag.png',
        ];
    }
}
