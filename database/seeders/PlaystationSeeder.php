<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Playstation;

class PlaystationSeeder extends Seeder
{
    public function run(): void
    {
        Playstation::insert([
            ['name' => 'PS5 Pro - Room A', 'category' => 'PS5', 'price_per_hour' => 15000, 'status' => 'available'],
            ['name' => 'PS5 Slim - Room B', 'category' => 'PS5', 'price_per_hour' => 15000, 'status' => 'available'],
            ['name' => 'PS4 Pro - VIP', 'category' => 'PS4', 'price_per_hour' => 10000, 'status' => 'available'],
            ['name' => 'PS4 Reguler', 'category' => 'PS4', 'price_per_hour' => 8000, 'status' => 'available'],
        ]);
    }
}
