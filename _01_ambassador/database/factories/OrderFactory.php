<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $link = Link::inRandomOrder()->first();

        return [
            'code' => $link->code,
            'user_id' => $link->user->id,
            'ambassador_email' => $link->user->email,
            'first_name' => $link->user->first_name,
            'last_name' => $link->user->second_name,
            'email' => $link->user->email,
            'complete' => 1,
        ];
    }
}
