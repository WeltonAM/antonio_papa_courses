<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => fake()->slug(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
