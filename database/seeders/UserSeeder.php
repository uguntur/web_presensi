<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Test',
                'password' => Hash::make('User1234!'),
                'role' => 'user',
                'phone' => '081234567890',
            ]
        );
    }
}
