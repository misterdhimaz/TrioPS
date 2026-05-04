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
     * Menyimpan data booking baru dari Landing Page.
     */
    // app/Http/Controllers/BookingController.php

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

    $booking->update([
        'booking_date' => $request->booking_date,
        'start_time' => $request->selected_times,
        'duration_hours' => count($times),
        'total_price' => $totalPrice,
    ]);

    return back()->with('success', 'Jadwal berhasil diperbarui!');
}

// ... fungsi index() dan updateStatus() ...

    public function destroy(Booking $booking)
    {
        // Hapus file gambar bukti transfer jika ada
        if ($booking->payment_proof) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($booking->payment_proof);
        }

        // Hapus data dari database
        $booking->delete();

        return back()->with('success', 'Transaksi #TRX-' . str_pad($booking->id, 4, '0', STR_PAD_LEFT) . ' berhasil dihapus permanen dari Radar!');
    }


public function store(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'product_id'     => 'required|exists:playstations,id',
        'booking_date'   => 'required|date',
        'selected_times' => 'required',
    ]);

    // 2. Olah Data Jam & Durasi
    $times = json_decode($request->selected_times);
    if (empty($times)) {
        return back()->with('error', 'Silakan pilih minimal satu jam bermain.');
    }

    // 3. Cari Data Konsol & Hitung Total Harga
    $playstation = Product::findOrFail($request->product_id);
    $duration    = count($times); // Variabel ini sudah ada
    $totalPrice  = $duration * $playstation->price_per_hour;

    // 4. Simpan ke Database
    Booking::create([
        'user_id'        => Auth::id(),
        'playstation_id' => $request->product_id,
        'booking_date'   => $request->booking_date,
        'start_time'     => $request->selected_times,
        'end_time'       => '-',
        'duration_hours' => $duration, // TAMBAHKAN BARIS INI
        'total_price'    => $totalPrice,
        'status'         => 'Pending',
    ]);

    // 5. Redirect dengan Notifikasi
    return redirect()->route('dashboard')->with('booking_success', 'Booking telah berhasil! Silakan lakukan pembayaran dan upload bukti transfer di dashboard Anda.');
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
     * Menampilkan daftar booking (Opsional jika Anda butuh halaman khusus).
     */
    public function index()
    {
        $activeBookings = Booking::with('playstation')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard', compact('activeBookings'));
    }



}
