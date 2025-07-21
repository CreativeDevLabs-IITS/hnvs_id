<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\AccessToken;

class AccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccessToken::create([
            'token' => Str::random(60),
            'origin' => 'http://hnvs_system.test'
        ]);
    }
}
