<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Alice Tanaka',  'email' => 'alice@example.com'],
            ['name' => 'Bob Suzuki',    'email' => 'bob@example.com'],
            ['name' => 'Carol Yamada',  'email' => 'carol@example.com'],
            ['name' => 'Dave Sato',     'email' => 'dave@example.com'],
            ['name' => 'Eve Watanabe',  'email' => 'eve@example.com'],
        ];

        foreach ($users as $user) {
            User::create([
                ...$user,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
