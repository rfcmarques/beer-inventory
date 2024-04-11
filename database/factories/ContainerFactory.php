<?php

namespace Database\Factories;

use App\Models\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Container>
 */
class ContainerFactory extends Factory
{
    protected $model = Container::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['Can', 'Bottle']);
        $capacity = $type === 'Can'
            ? $this->faker->unique(true)->randomElement([330, 355, 440, 473])
            : $this->faker->unique(true)->randomElement([250, 330, 375, 500, 750]);

        return [
            'type' => $type,
            'capacity' => $capacity
        ];
    }
}
