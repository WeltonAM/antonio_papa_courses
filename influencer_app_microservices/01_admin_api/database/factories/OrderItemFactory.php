<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_title' => fake()->text(30),
            'price' => fake()->numberBetween(10, 100),
            'quantity' => fake()->numberBetween(1, 5),
        ];
    }
}
