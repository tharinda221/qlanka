<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@quiz.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // User::create([
        //     'name' => 'Test User',
        //     'email' => 'test@quiz.com',
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
    }
}
