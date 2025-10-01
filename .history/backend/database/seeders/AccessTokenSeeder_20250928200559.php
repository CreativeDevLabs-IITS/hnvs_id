<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Log;
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
        $token: Str::random(60);

        AccessToken::create([
            'token' => $token,
            'origin' => 'http://hnvs_system.test'
        ]);

        Log::info('token: ' . $token);
    }
}
