<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\PlanSubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Models\Playstation;
use App\Models\Booking;
use App\Http\Controllers\CatalogController;
use App\Models\PricingPlan;
use Carbon\Carbon;



// 1. HALAMAN LANDING PAGE (Welcome Screen)
Route::get('/', function () {
    // Ambil semua data paket dari database
    $pricing_plans = PricingPlan::all();

    // Lempar variabel tersebut ke landing page
    return view('welcome', compact('pricing_plans'));
});


Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

Route::get('/about', function () {
    return view('about');
})->name('about');

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

        $vipSubscriptions = \App\Models\PlanSubscription::with('pricingPlan')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get();

        // Lempar ke tampilan dashboard user (bukan admin)
        return view('dashboard', compact('activeBookings', 'vipSubscriptions'));
     })->middleware(['auth', 'verified'])->name('dashboard');
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
    Route::post('/plan-subscriptions', [PlanSubscriptionController::class, 'store'])->name('plan.subscriptions.store');
    Route::post('/plan-subscriptions/{subscription}/payment', [PlanSubscriptionController::class, 'uploadPayment'])->name('plan.subscriptions.payment');
    Route::delete('/plan-subscriptions/{subscription}', [PlanSubscriptionController::class, 'destroy'])->name('plan.subscriptions.destroy');

});

// 3. AREA KHUSUS ADMIN (Prefix: admin)
// 3. AREA KHUSUS ADMIN (Prefix: admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard Utama Admin
    Route::get('/dashboard', function () {
    // 1. Ambil Data Widget Atas
    $totalProducts = \App\Models\Product::count();
    $totalUsers = \App\Models\User::where('is_admin', 0)->count();

    // TOTAL ANTREAN (Untuk Widget Angka): Gabungan status Pending & Active dari semua user
    // Gunakan nama 'activeBookings' agar sesuai dengan widget di Blade Admin Anda
    $activeBookingsCount = \App\Models\Booking::whereIn('status', ['Pending', 'Active'])->count();
    $activeVipCount = \App\Models\PlanSubscription::whereIn('status', ['Pending', 'Active'])->count();
    $activeBookings = $activeBookingsCount + $activeVipCount;

    // 2. Pendapatan Bulan Ini (Regular + VIP)
    $revenueRegular = \App\Models\Booking::whereMonth('created_at', \Carbon\Carbon::now()->month)
                        ->whereIn('status', ['Completed', 'Active'])
                        ->sum('total_price');

    $revenueVip = \App\Models\PlanSubscription::whereMonth('created_at', \Carbon\Carbon::now()->month)
                        ->whereIn('status', ['Active', 'Completed'])
                        ->sum('price_snapshot');

    $revenueThisMonth = $revenueRegular + $revenueVip;

    // 3. Ambil Data Transaksi Terbaru (Untuk Tabel)
    $recentBookings = \App\Models\Booking::with(['user', 'playstation'])
                        ->latest()
                        ->take(5)
                        ->get();

    $recentVip = \App\Models\PlanSubscription::with(['user', 'pricingPlan'])
                        ->latest()
                        ->take(5)
                        ->get();

    // 4. Siapkan Data untuk Grafik (Total Gabungan 7 Hari Terakhir)
    $chartDates = [];
    $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = \Carbon\Carbon::today()->subDays($i);
        $chartDates[] = $date->format('d M');

        $dailyRegular = \App\Models\Booking::whereDate('created_at', $date)
                            ->whereIn('status', ['Completed', 'Active'])
                            ->sum('total_price');

        $dailyVip = \App\Models\PlanSubscription::whereDate('created_at', $date)
                        ->whereIn('status', ['Active', 'Completed'])
                        ->sum('price_snapshot');

        $chartData[] = $dailyRegular + $dailyVip;
    }

    return view('admin.dashboard', compact(
        'totalProducts', 'totalUsers', 'activeBookings', 'revenueThisMonth',
        'recentBookings', 'recentVip', 'chartDates', 'chartData'
    ));
})->name('admin.dashboard');

    // CRUD Katalog & Pricing
    Route::resource('products', ProductController::class);
    Route::resource('pricing', PricingController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');

    // Manajemen Transaksi Regular
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.status');
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

    // Export Reports
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('admin.reports.pdf');
    Route::get('/reports/excel', [ReportController::class, 'exportExcel'])->name('admin.reports.excel');


    // CRUD Katalog & Pricing
    Route::resource('products', ProductController::class);
    Route::resource('pricing', PricingController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    // Manajemen Transaksi & Verifikasi Pembayaran
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.status');
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('admin.reports.pdf');
Route::get('/reports/excel', [ReportController::class, 'exportExcel'])->name('admin.reports.excel');
    });

// 4. AUTHENTICATION ROUTES (Login, Register, dsb)
require __DIR__.'/auth.php';
