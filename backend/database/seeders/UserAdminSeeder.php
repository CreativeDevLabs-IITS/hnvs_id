<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Jaevoy',
            'lastname' => 'Seloterio',
            'contact' => '0000000000',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@123!'),
            'role' => 0,
        ]);
    }
}
