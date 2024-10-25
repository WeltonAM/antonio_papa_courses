<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'price' => fake()->randomFloat(2, 100, 1000),
        ];
    }
}
