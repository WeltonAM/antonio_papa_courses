<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->text(30),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'price' => fake()->numberBetween(10, 100),
        ];
    }
}
