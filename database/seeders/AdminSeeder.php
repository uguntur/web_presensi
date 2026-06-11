<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $email = 'admin@example.com';

        if (!User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Admin Test',
                'email' => $email,
                'password' => Hash::make('Password123!'),
                'role' => 'admin',
            ]);
        }
    }
}
