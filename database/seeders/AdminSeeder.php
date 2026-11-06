<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\DatabaseSeeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@tuanparfum.com'],
            ['name' => 'Admin Tuan Parfum', 'password' => Hash::make('123'), 'role' => 'admin']
        );

        User::firstOrCreate(
            ['email' => 'kurir@tuanparfum.com'],
            ['name' => 'Kurir Tuan Parfum', 'password' => Hash::make('123'), 'role' => 'kurir']
        );
    }
}