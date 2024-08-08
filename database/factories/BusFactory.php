<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bus_no' => fake()->regexify('[A-Z]{2}[0-9]{3}[A-Z]'),
            'status' => fake()->numberBetween(1, 0),
        ];
    }
}
