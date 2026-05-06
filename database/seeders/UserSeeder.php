<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. AKUN ADMIN (Akses Radar Pusat)
        User::create([
            'name' => 'Admin Trio Infinity',
            'email' => 'admin@trio.com',
            'password' => Hash::make('admin123'),
            'is_admin' => 1,
        ]);

        // 2. AKUN USER (Mr. James / Player)
        User::create([
            'name' => 'Mr. Dhimaz',
            'email' => 'james@player.com',
            'password' => Hash::make('user123'),
            'is_admin' => 0,
        ]);
    }
}
