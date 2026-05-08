<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar booking di Dashboard User.
     */
    public function index()
    {
        $activeBookings = Booking::with('playstation')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard', compact('activeBookings'));
    }

    /**
     * Menyimpan data booking baru dari Katalog dengan Protokol Keamanan.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Pastikan add-ons masuk radar)
        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'booking_date'     => 'required|date|after_or_equal:today',
            'selected_times'   => 'required',
            'extra_controller' => 'nullable', // Menangkap checkbox controller
            'gaming_headset'   => 'nullable',   // Menangkap checkbox headset
        ]);

        // 2. Olah Data Jam & Durasi
        $requestedSlots = json_decode($request->selected_times, true);
        if (empty($requestedSlots)) {
            return back()->with('error', 'Silakan pilih minimal satu jam bermain.');
        }

        // 3. PROTOKOL ANTI-DOUBLE BOOKING (Pengecekan Bentrok Jadwal)
        // Mengecek apakah jam yang dipilih baru saja di-booking oleh orang lain
        $existingBookings = Booking::where('playstation_id', $request->product_id)
            ->where('booking_date', $request->booking_date)
            ->whereIn('status', ['Approved', 'Active', 'Completed'])
            ->get();

        foreach ($existingBookings as $b) {
            $bookedSlots = json_decode($b->start_time, true) ?? [];
            $bentrok = array_intersect($requestedSlots, $bookedSlots);

            if (count($bentrok) > 0) {
                return back()->with('error', 'Peringatan: Ada slot jam yang baru saja diamankan oleh player lain. Silakan refresh dan pilih jam lain.');
            }
        }

        // 4. Cari Data Konsol & Hitung Harga Dasar
        $playstation = Product::findOrFail($request->product_id);
        $duration = count($requestedSlots);

        // Perhitungan Harga Dasar
        $totalPrice = $duration * $playstation->price_per_hour;

        // Tambahkan Add-ons jika dicentang
        if ($request->has('extra_controller')) {
            $totalPrice += 20000;
        }
        if ($request->has('gaming_headset')) {
            $totalPrice += 25000;
        }

        // 5. Injeksi ke Database
        Booking::create([
            'user_id'        => Auth::id(),
            'playstation_id' => $request->product_id,
            'booking_date'   => $request->booking_date,
            'start_time'     => $request->selected_times, // Tetap gunakan format JSON string
            'duration_hours' => $duration,
            'total_price'    => $totalPrice,
            'status'         => 'Pending',
        ]);

        return redirect()->route('dashboard')->with('booking_success', 'Booking berhasil diamankan! Silakan upload bukti pembayaran.');
    }

    /**
     * Memperbarui jadwal pesanan.
     */
    public function update(Request $request, Booking $booking)
    {
        // Cek: Hanya boleh edit jika status masih Pending
        if ($booking->status !== 'Pending') {
            return back()->with('error', 'Pesanan sudah di-ACC, tidak bisa diubah lagi.');
        }

        $request->validate([
            'booking_date' => 'required|date',
            'selected_times' => 'required',
        ]);

        $times = json_decode($request->selected_times);
        $totalPrice = count($times) * $booking->playstation->price_per_hour;

        // Catatan: Jika saat edit Add-ons ingin dipertahankan, Anda bisa menambahkan ulang nominalnya di sini.
        // Untuk sekarang, kita ikuti alur lama Anda (hanya update jam & harga dasar).

        $booking->update([
            'booking_date' => $request->booking_date,
            'start_time' => $request->selected_times,
            'duration_hours' => count($times),
            'total_price' => $totalPrice,
        ]);

        return back()->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Mengunggah bukti pembayaran dari Dashboard User.
     */
    public function uploadPayment(Request $request, Booking $booking)
    {
        // 1. Validasi File (Maksimal 2MB)
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // 2. Proses Unggah File
        if ($request->hasFile('payment_proof')) {
            // Hapus foto lama jika user melakukan upload ulang
            if ($booking->payment_proof) {
                Storage::disk('public')->delete($booking->payment_proof);
            }

            // Simpan file ke folder public/payments
            $path = $request->file('payment_proof')->store('payments', 'public');

            // 3. Update Data Booking
            $booking->update([
                'payment_proof' => $path,
                'status'        => 'Pending' // Tetap pending untuk diverifikasi Admin
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu konfirmasi dari Admin.');
    }

    /**
     * Menghapus pesanan.
     */
    public function destroy(Booking $booking)
    {
        // Hapus file gambar bukti transfer jika ada
        if ($booking->payment_proof) {
            Storage::disk('public')->delete($booking->payment_proof);
        }

        // Hapus data dari database
        $booking->delete();

        return back()->with('success', 'Transaksi #TRX-' . str_pad($booking->id, 4, '0', STR_PAD_LEFT) . ' berhasil dihapus permanen dari Radar!');
    }

  public function receipt(Booking $booking)
{
    // 1. Keamanan: Cek apakah yang akses adalah Admin atau User pemilik pesanan
    if (auth()->user()->is_admin !== 1 && auth()->id() !== $booking->user_id) {
        abort(403, 'Akses Ditolak: Anda tidak memiliki izin melihat nota ini.');
    }

    // 2. Validasi Status: Gunakan strtolower() agar kebal terhadap perbedaan huruf besar/kecil
    if (!in_array(strtolower($booking->status), ['active', 'completed'])) {
        abort(404, 'Nota Belum Tersedia: Transaksi ini belum di-ACC oleh Admin.');
    }

    // Muat relasi yang diperlukan untuk ditampilkan di nota
    $booking->load(['user', 'playstation']);

    return view('pages.receipt', compact('booking'));
}


}
