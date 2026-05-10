<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class AutoUpdateBookingStatus
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Ambil waktu saat ini persis di zona waktu Indonesia (WIB)
        $now = Carbon::now('Asia/Jakarta');

        // 2. Ambil SEMUA transaksi yang statusnya belum dibatalkan/selesai
        $bookings = Booking::whereIn('status', ['Pending', 'pending', 'Approved', 'approved', 'Active', 'active'])->get();

        foreach ($bookings as $b) {
            // Ubah JSON array jam (misal: ["10:00", "11:00"]) menjadi Array PHP
            $jamArray = is_string($b->start_time) ? json_decode($b->start_time, true) : $b->start_time;

            // Lewati jika data jam rusak atau kosong
            if (!$jamArray || !is_array($jamArray)) continue;

            $jamMulai = $jamArray[0];
            $durasi = $b->duration ?? count($jamArray);

            // ==========================================
            // PERBAIKAN BUG WAKTU DI SINI
            // ==========================================
            // Ambil tanggalnya saja (Y-m-d) membuang 00:00:00 bawaan database
            $tanggalSaja = Carbon::parse($b->booking_date)->toDateString();

            // Rangkai tanggal bersih dan jam menjadi format waktu utuh
            $waktuMulai = Carbon::parse($tanggalSaja . ' ' . $jamMulai, 'Asia/Jakarta');
            $waktuSelesai = $waktuMulai->copy()->addHours($durasi);

            $currentStatus = strtolower($b->status);

            // ==========================================
            // LOGIKA OTOMATISASI STATUS
            // ==========================================

            // KONDISI 1: Jika waktu sekarang sudah MELEWATI jam selesai -> Selesai
            if ($now->greaterThanOrEqualTo($waktuSelesai)) {
                $b->update(['status' => 'Completed']);
            }
            // KONDISI 2: Jika sudah di-ACC (Approved) & masuk jam mulai -> Active (Sedang Main)
            elseif ($now->greaterThanOrEqualTo($waktuMulai) && in_array($currentStatus, ['approved', 'active'])) {
                if ($currentStatus !== 'active') {
                    $b->update(['status' => 'Active']);
                }
            }
        }

        // Lanjutkan perjalanan loading halaman
        return $next($request);
    }
}
