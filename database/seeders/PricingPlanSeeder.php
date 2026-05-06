<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingPlan;

class PricingPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'title' => 'Paket Harian',
                'subtitle' => 'Per Hari',
                'badge' => null, // Paket harian tidak pakai badge di desain
                'price' => 100000,
                'duration_text' => 'per hari',
                'color_theme' => 'purple',
                'description' => "1 Konsol (PS4 Slim)\nTermasuk 2 Stik\n3 Game pilihan Anda\nSemua kabel & aksesori\nPustaka game standar\nDukungan standar",
                'features' => json_encode([
                    "1 Konsol (PS4 Slim)",
                    "Termasuk 2 Stik",
                    "3 Game pilihan Anda",
                    "Semua kabel & aksesori",
                    "Pustaka game standar",
                    "Dukungan standar"
                ])
            ],
            [
                'title' => 'Paket Akhir Pekan',
                'subtitle' => 'Untuk 3 Hari',
                'badge' => 'Paling Populer',
                'price' => 500000,
                'duration_text' => 'untuk 3 hari',
                'color_theme' => 'cyan',
                'description' => "PS4 Pro atau PS5 Digital\nTermasuk 2 Stik\nPustaka game tanpa batas\nSemua kabel & aksesori\nPrioritas jemput/antar\nDukungan prioritas 24/7\nTermasuk akses online",
                'features' => json_encode([
                    "PS4 Pro atau PS5 Digital",
                    "Termasuk 2 Stik",
                    "Pustaka game tanpa batas",
                    "Semua kabel & aksesori",
                    "Prioritas jemput/antar",
                    "Dukungan prioritas 24/7",
                    "Termasuk akses online"
                ])
            ],
            [
                'title' => 'Paket Mingguan Elite',
                'subtitle' => 'Per Minggu',
                'badge' => 'Nilai Terbaik',
                'price' => 1200000,
                'duration_text' => 'per minggu',
                'color_theme' => 'amber',
                'description' => "PS5 Disc Edition\nTermasuk 3 Stik\nPustaka game lengkap (50+ judul)\nSemua kabel & aksesori\nGratis antar ke rumah\nDukungan VIP 24/7\nTambahan HDMI & headset",
                'features' => json_encode([
                    "PS5 Disc Edition",
                    "Termasuk 3 Stik",
                    "Pustaka game lengkap (50+ judul)",
                    "Semua kabel & aksesori",
                    "Gratis antar ke rumah",
                    "Dukungan VIP 24/7",
                    "Tambahan HDMI & headset"
                ])
            ]
        ];

        foreach ($plans as $plan) {
            PricingPlan::create($plan);
        }
    }
}
