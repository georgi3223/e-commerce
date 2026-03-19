<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567890',
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create regular test user
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'phone' => '+1987654321',
            'role' => 'user',
            'is_active' => true,
        ]);

        // Create another regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'phone' => '+1122334455',
            'role' => 'user',
            'is_active' => true,
        ]);

        // Create Jane Smith user
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'phone' => '+1555666777',
            'role' => 'user',
            'is_active' => true,
        ]);

        // Create inactive user (for testing middleware)
        User::create([
            'name' => 'Inactive User',
            'email' => 'inactive@example.com',
            'password' => Hash::make('password'),
            'phone' => '+1999888777',
            'role' => 'user',
            'is_active' => false,
        ]);
    }
}