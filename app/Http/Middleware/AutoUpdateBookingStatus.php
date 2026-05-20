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

        // 2. Ambil transaksi yang berstatus pending atau active (Gunakan huruf kecil sesuai ENUM)
        $bookings = Booking::whereIn('status', ['pending', 'active'])->get();

        foreach ($bookings as $b) {
            // Ubah JSON array jam menjadi Array PHP
            $jamArray = is_string($b->start_time) ? json_decode($b->start_time, true) : $b->start_time;

            if (!$jamArray || !is_array($jamArray)) continue;

            $jamMulai = $jamArray[0];
            // Pastikan menggunakan nama kolom yang sesuai di database: duration_hours
            $durasi = $b->duration_hours ?? count($jamArray);

            $tanggalSaja = Carbon::parse($b->booking_date)->toDateString();

            // Rangkai waktu mulai dan selesai secara presisi
            $waktuMulai = Carbon::parse($tanggalSaja . ' ' . $jamMulai, 'Asia/Jakarta');
            $waktuSelesai = $waktuMulai->copy()->addHours($durasi);

            $currentStatus = strtolower($b->status);

            // ==========================================
            // LOGIKA OTOMATISASI STATUS (REVISI)
            // ==========================================

            // KONDISI 1: Jika waktu sekarang sudah MELEWATI jam selesai -> Otomatis selesai (completed)
            if ($now->greaterThanOrEqualTo($waktuSelesai)) {
                $b->update(['status' => 'completed']);
            }

            // KONDISI 2: Jika jam main sudah masuk, tapi statusnya MASIH 'pending' (belum bayar/belum di-ACC)
            // JANGAN diubah ke active! Biarkan tetap 'pending' agar user bisa upload bukti transfer.

            // KONDISI 3: Jika sudah masuk jam mulai DAN statusnya memang sudah 'active' (sudah di-ACC Admin)
            elseif ($now->greaterThanOrEqualTo($waktuMulai) && $currentStatus === 'active') {
                // Pertahankan status tetap active huruf kecil sesuai ENUM
                if ($b->status !== 'active') {
                    $b->update(['status' => 'active']);
                }
            }
        }

        return $next($request);
    }
}
