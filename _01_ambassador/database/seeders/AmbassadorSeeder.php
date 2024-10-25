<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AmbassadorSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(30)->create([
            'is_admin' => 0,
        ]);
    }
}
