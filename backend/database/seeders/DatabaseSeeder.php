<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstname' => 'Admin',
            'middlename' => null,
            'lastname' => 'User',
            'suffix' => null,
            'contact' => '09123456789',
            'image' => null,
            'email' => 'cj@admin.com',
            'role' => 1,
            'password' => Hash::make('password'),
        ]);
    }
}
