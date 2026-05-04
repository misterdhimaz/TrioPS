<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use Illuminate\Support\Facades\Route;
use App\Models\Playstation;
use App\Models\Booking;
use App\Http\Controllers\CatalogController;
use Carbon\Carbon;


// 1. HALAMAN LANDING PAGE (Welcome Screen)
Route::get('/', function () {
    return view('welcome');
});
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');


// 2. AREA PENGGUNA TERDAFTAR (Dashboard & Fitur Member)
Route::middleware(['auth', 'verified'])->group(function () {

    // --- UBAH BAGIAN INI ---
    // Halaman Dashboard Member (User Biasa)
    Route::get('/dashboard', function () {
        // Ambil data transaksi khusus untuk user yang sedang login
        $activeBookings = \App\Models\Booking::with('playstation')
                            ->where('user_id', auth()->id())
                            ->latest()
                            ->get();

        // Lempar ke tampilan dashboard user (bukan admin)
        return view('dashboard', compact('activeBookings'));
    })->name('dashboard'); // <-- INI DIA KUNCI JAWABANNYA!
    // -----------------------

    // Fitur Booking PS
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // Fitur Upload Bukti Pembayaran
    Route::post('/bookings/{booking}/payment', [BookingController::class, 'uploadPayment'])->name('bookings.payment');

    // Manajemen Profil (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. AREA KHUSUS ADMIN (Prefix: admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard Utama Admin
    Route::get('/dashboard', function () {
        // Ambil Data Widget Atas
        $totalProducts = \App\Models\Product::count();
        $totalUsers = \App\Models\User::where('is_admin', 0)->count();
        $activeBookings = \App\Models\Booking::whereIn('status', ['Pending', 'Active'])->count();

        // Pendapatan Bulan Ini
        $revenueThisMonth = \App\Models\Booking::whereMonth('created_at', \Carbon\Carbon::now()->month)
                            ->whereIn('status', ['Completed', 'Active'])
                            ->sum('total_price');

        // Ambil 5 Transaksi Terakhir untuk Tabel
        $recentBookings = \App\Models\Booking::with(['user', 'playstation'])
                            ->latest()
                            ->take(5)
                            ->get();

        // Siapkan Data untuk Grafik (7 Hari Terakhir)
        $chartDates = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $chartDates[] = $date->format('d M');
            $chartData[] = \App\Models\Booking::whereDate('created_at', $date)
                            ->whereIn('status', ['Completed', 'Active'])
                            ->sum('total_price');
        }

        return view('admin.dashboard', compact(
            'totalProducts', 'totalUsers', 'activeBookings', 'revenueThisMonth',
            'recentBookings', 'chartDates', 'chartData'
        ));
    })->name('admin.dashboard');

    // CRUD Katalog & Pricing
    Route::resource('products', ProductController::class);
    Route::resource('pricing', PricingController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    // Manajemen Transaksi & Verifikasi Pembayaran
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.status');
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');
    });

// 4. AUTHENTICATION ROUTES (Login, Register, dsb)
require __DIR__.'/auth.php';
