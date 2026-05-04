<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // PS5 DISC EDITION (3 UNIT)
            [
                'name' => 'PS5 Disc Edition - Alpha',
                'version' => 'Disc Edition',
                'slug' => Str::slug('PS5 Disc Edition - Alpha'),
                'category' => 'PS5',
                'status' => 'Available',
                'cpu' => 'x86-64-AMD Ryzen Zen 2',
                'resolution' => '4K / 120FPS',
                'storage' => '825GB SSD',
                'connectivity' => 'HDMI 2.1, WiFi 6, Bluetooth 5.1',
                'included_games' => 'EA FC 24, Tekken 8, Spider-Man 2, GTA V',
                'price_per_hour' => 15000,
            ],
            [
                'name' => 'PS5 Disc Edition - Beta',
                'version' => 'Disc Edition',
                'slug' => Str::slug('PS5 Disc Edition - Beta'),
                'category' => 'PS5',
                'status' => 'Available',
                'cpu' => 'x86-64-AMD Ryzen Zen 2',
                'resolution' => '4K / 120FPS',
                'storage' => '1TB SSD',
                'connectivity' => 'HDMI 2.1, WiFi 6, Bluetooth 5.1',
                'included_games' => 'EA FC 24, God of War Ragnarok, Resident Evil 4',
                'price_per_hour' => 15000,
            ],
            [
                'name' => 'PS5 Disc Edition - Gamma',
                'version' => 'Disc Edition',
                'slug' => Str::slug('PS5 Disc Edition - Gamma'),
                'category' => 'PS5',
                'status' => 'Available',
                'cpu' => 'x86-64-AMD Ryzen Zen 2',
                'resolution' => '4K / 120FPS',
                'storage' => '825GB SSD',
                'connectivity' => 'HDMI 2.1, WiFi 6, Bluetooth 5.1',
                'included_games' => 'EA FC 24, NBA 2K24, Mortal Kombat 1',
                'price_per_hour' => 15000,
            ],

            // PS5 DIGITAL EDITION (2 UNIT)
            [
                'name' => 'PS5 Digital - Delta',
                'version' => 'Digital Edition',
                'slug' => Str::slug('PS5 Digital - Delta'),
                'category' => 'PS5',
                'status' => 'Available',
                'cpu' => 'x86-64-AMD Ryzen Zen 2',
                'resolution' => '4K / 120FPS',
                'storage' => '825GB SSD',
                'connectivity' => 'HDMI 2.1, WiFi 6, Bluetooth 5.1',
                'included_games' => 'EA FC 24, Apex Legends, Fortnite',
                'price_per_hour' => 13000,
            ],
            [
                'name' => 'PS5 Digital - Epsilon',
                'version' => 'Digital Edition',
                'slug' => Str::slug('PS5 Digital - Epsilon'),
                'category' => 'PS5',
                'status' => 'Maintenance',
                'cpu' => 'x86-64-AMD Ryzen Zen 2',
                'resolution' => '4K / 120FPS',
                'storage' => '825GB SSD',
                'connectivity' => 'HDMI 2.1, WiFi 6, Bluetooth 5.1',
                'included_games' => 'Cyberpunk 2077, The Last of Us Part I',
                'price_per_hour' => 13000,
            ],

            // PS4 PRO (2 UNIT)
            [
                'name' => 'PS4 Pro - Zeta',
                'version' => 'Pro Edition',
                'slug' => Str::slug('PS4 Pro - Zeta'),
                'category' => 'PS4',
                'status' => 'Available',
                'cpu' => 'AMD Jaguar 8-Core',
                'resolution' => '4K Upscaled',
                'storage' => '1TB HDD',
                'connectivity' => 'HDMI 2.0, WiFi 5, Bluetooth 4.0',
                'included_games' => 'PES 2021, Ghost of Tsushima, Tekken 7',
                'price_per_hour' => 10000,
            ],
            [
                'name' => 'PS4 Pro - Eta',
                'version' => 'Pro Edition',
                'slug' => Str::slug('PS4 Pro - Eta'),
                'category' => 'PS4',
                'status' => 'Available',
                'cpu' => 'AMD Jaguar 8-Core',
                'resolution' => '4K Upscaled',
                'storage' => '1TB HDD',
                'connectivity' => 'HDMI 2.0, WiFi 5, Bluetooth 4.0',
                'included_games' => 'PES 2021, Red Dead Redemption 2, Naruto Storm 4',
                'price_per_hour' => 10000,
            ],

            // PS4 SLIM (2 UNIT)
            [
                'name' => 'PS4 Slim - Theta',
                'version' => 'Slim Edition',
                'slug' => Str::slug('PS4 Slim - Theta'),
                'category' => 'PS4',
                'status' => 'Available',
                'cpu' => 'AMD Jaguar 8-Core',
                'resolution' => '1080p / 60FPS',
                'storage' => '500GB HDD',
                'connectivity' => 'HDMI 1.4, WiFi 4, Bluetooth 2.1',
                'included_games' => 'PES 2021, Minecraft, CTR Nitro-Fueled',
                'price_per_hour' => 8000,
            ],
            [
                'name' => 'PS4 Slim - Iota',
                'version' => 'Slim Edition',
                'slug' => Str::slug('PS4 Slim - Iota'),
                'category' => 'PS4',
                'status' => 'Available',
                'cpu' => 'AMD Jaguar 8-Core',
                'resolution' => '1080p / 60FPS',
                'storage' => '500GB HDD',
                'connectivity' => 'HDMI 1.4, WiFi 4, Bluetooth 2.1',
                'included_games' => 'PES 2021, It Takes Two, Mortal Kombat 11',
                'price_per_hour' => 8000,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
