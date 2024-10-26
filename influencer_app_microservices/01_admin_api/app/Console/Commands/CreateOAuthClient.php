<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateOAuthClient extends Command
{
    protected $signature = 'oauth:create {name} {--personal} {--password}';
    protected $description = 'Create a new OAuth client';

    public function handle()
    {
        $clientData = [
            'name' => $this->argument('name'),
            'secret' => Str::random(40),
            'redirect' => 'http://localhost',
            'personal_access_client' => $this->option('personal') ? 1 : 0,
            'password_client' => $this->option('password') ? 1 : 0,
            'revoked' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('oauth_clients')->insert($clientData);

        $this->info('OAuth client created successfully!');
    }
}

// php artisan oauth:create "My Personal Access Client" --personal
// php artisan oauth:create "My Password Grant Client" --password
