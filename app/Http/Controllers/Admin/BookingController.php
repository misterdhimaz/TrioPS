<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    // 1. Menampilkan Semua Data Transaksi beserta Filternya
    public function index(Request $request)
    {
        // A. Ambil SEMUA data untuk Widget Statistik atas agar angkanya tetap global
        $allBookings = Booking::all();

        // B. Siapkan query dasar untuk tabel
        $query = Booking::with(['user', 'playstation'])->latest();

        // C. Cek apakah ada request filter status dari tombol UI
        if ($request->filled('status') && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        // D. Eksekusi query khusus untuk tabel
        $bookings = $query->get();

        // E. Simpan status filter saat ini untuk menandai tombol mana yang sedang aktif
        $currentFilter = $request->status ?? 'All';

        return view('admin.bookings.index', compact('bookings', 'allBookings', 'currentFilter'));
    }

    // 2. Mengubah Status Transaksi (Pending/Active/Completed/Cancelled)
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:Pending,Active,Completed,Cancelled'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status TRX-' . str_pad($booking->id, 4, '0', STR_PAD_LEFT) . ' berhasil diupdate!');
    }

    // 3. Menghapus Transaksi Permanen
    public function destroy(Booking $booking)
    {
        if ($booking->payment_proof) {
            Storage::disk('public')->delete($booking->payment_proof);
        }

        $booking->delete();

        return back()->with('success', 'Transaksi #TRX-' . str_pad($booking->id, 4, '0', STR_PAD_LEFT) . ' berhasil dihapus permanen dari Radar!');
    }
}
