<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CatalogController extends Controller
{
    public function index(Request $request)
{
    // 1. Inisialisasi Query Produk
    $query = Product::query();

    // 2. Filter Berdasarkan Pencarian Nama (Search)
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // 3. Filter Berdasarkan Kategori (PS4 / PS5)
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }

    $products = $query->latest()->get();

    // --- Logika Slot Jadwal (Tetap Sama) ---
    $today = Carbon::today()->toDateString();
    $lusa = Carbon::today()->addDays(2)->toDateString();
    $bookings = Booking::whereBetween('booking_date', [$today, $lusa])
                ->whereIn('status', ['Pending', 'Active'])
                ->get();

    $bookedSlots = [];
    foreach ($bookings as $booking) {
        $times = json_decode($booking->start_time);
        if (is_array($times)) {
            foreach ($times as $timeStr) {
                $dateKey = $booking->booking_date->format('Y-m-d');
                $bookedSlots[$booking->playstation_id][$dateKey][] = $timeStr;
            }
        }
    }

    return view('catalog.index', compact('products', 'bookedSlots'));
}
}
