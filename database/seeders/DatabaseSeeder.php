<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'User@example.com',
            'password' => Hash::make('123456789'), // Ensure to hash the password
        ]);
            \App\Models\Admin::create([
            'name' => 'Test Admin',
            'email' => 'Admin@example.com',
            'password' => Hash::make('123456789'), // Ensure to hash the password
        ]);
            \App\Models\Freelancer::create([
            'name' => 'Test User',
            'email' => 'Freelancer@example.com',
            'password' => Hash::make('123456789'), // Ensure to hash the password
        ]);
    }
}
