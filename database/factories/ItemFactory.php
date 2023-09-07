<?php

namespace Database\Factories;

use App\Models\System;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'Item_ID' => fake()->unique()->randomNumber(),
            'name' => fake()->word(),
            'stock' => fake()->numberBetween(1, 100),
            'serial_N' => fake()->ean13(),
            'price' => fake()->numberBetween(1, 100),
            'calibration_date' => fake()->date(),
            'part_number' => fake()->ean13(),
            'system_id' => function () {
                return System::inRandomOrder()->first()->id;
            },

        ];
    }
}
