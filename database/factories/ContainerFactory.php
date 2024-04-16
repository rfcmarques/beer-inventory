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
        static $combinations = null;

        if ($combinations === null) {
            $combinations = [
                ['type' => 'Can', 'capacity' => 330],
                ['type' => 'Can', 'capacity' => 355],
                ['type' => 'Can', 'capacity' => 440],
                ['type' => 'Can', 'capacity' => 473],
                ['type' => 'Bottle', 'capacity' => 250],
                ['type' => 'Bottle', 'capacity' => 330],
                ['type' => 'Bottle', 'capacity' => 375],
                ['type' => 'Bottle', 'capacity' => 500],
                ['type' => 'Bottle', 'capacity' => 750],
            ];
        }

        $combination = array_pop($combinations);

        return [
            'type' => $combination['type'],
            'capacity' => $combination['capacity']
        ];
    }
}
