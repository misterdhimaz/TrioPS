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
    $pricing_plans = PricingPlan::all();
    return view('welcome', compact('pricing_plans'));
});

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

Route::get('/about', function () {
    return view('about');
})->name('about');

// 2. AREA PENGGUNA TERDAFTAR (Dashboard & Fitur Member)
// Rute di sini bisa diakses oleh USER maupun ADMIN yang sudah login
Route::middleware(['auth', 'verified', \App\Http\Middleware\AutoUpdateBookingStatus::class])->group(function () {

    // Halaman Dashboard Member (User Biasa)
    Route::get('/dashboard', function () {
        $activeBookings = \App\Models\Booking::with('playstation')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get();

        $vipSubscriptions = \App\Models\PlanSubscription::with('pricingPlan')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get();

        return view('dashboard', compact('activeBookings', 'vipSubscriptions'));
    })->name('dashboard');

    // Fitur Booking PS Regular
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/{booking}/payment', [BookingController::class, 'uploadPayment'])->name('bookings.payment');

    // Fitur Langganan VIP
    Route::post('/plan-subscriptions', [PlanSubscriptionController::class, 'store'])->name('plan.subscriptions.store');
    Route::post('/plan-subscriptions/{subscription}/payment', [PlanSubscriptionController::class, 'uploadPayment'])->name('plan.subscriptions.payment');
    Route::delete('/plan-subscriptions/{subscription}', [PlanSubscriptionController::class, 'destroy'])->name('plan.subscriptions.destroy');

    // ==========================================
    // RUTE NOTA TRANSAKSI (Bisa diakses User & Admin)
    // ==========================================
    Route::get('/booking/{booking}/receipt', [BookingController::class, 'receipt'])->name('booking.receipt');
    Route::get('/vip/{id}/receipt', [App\Http\Controllers\PlanSubscriptionController::class, 'vipReceipt'])->name('vip.receipt');

    // Manajemen Profil (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. AREA KHUSUS ADMIN (Prefix: admin)
Route::middleware(['auth', 'admin', \App\Http\Middleware\AutoUpdateBookingStatus::class])->prefix('admin')->group(function () {

    // Dashboard Utama Admin
    Route::get('/dashboard', function () {
        $totalProducts = \App\Models\Product::count();
        $totalUsers = \App\Models\User::where('is_admin', 0)->count();

        $activeBookingsCount = \App\Models\Booking::whereIn('status', ['Pending', 'Active'])->count();
        $activeVipCount = \App\Models\PlanSubscription::whereIn('status', ['Pending', 'Active'])->count();
        $activeBookings = $activeBookingsCount + $activeVipCount;

        $revenueRegular = \App\Models\Booking::whereMonth('created_at', Carbon::now()->month)
                        ->whereIn('status', ['Completed', 'Active'])
                        ->sum('total_price');

        $revenueVip = \App\Models\PlanSubscription::whereMonth('created_at', Carbon::now()->month)
                        ->whereIn('status', ['Active', 'Completed'])
                        ->sum('price_snapshot');

        $revenueThisMonth = $revenueRegular + $revenueVip;

        $recentBookings = \App\Models\Booking::with(['user', 'playstation'])
                        ->latest()->take(5)->get();

        $recentVip = \App\Models\PlanSubscription::with(['user', 'pricingPlan'])
                        ->latest()->take(5)->get();

        $chartDates = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
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

    // Manajemen Transaksi Regular
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.status');
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

    // Export Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('admin.reports.pdf');
    Route::get('/reports/excel', [ReportController::class, 'exportExcel'])->name('admin.reports.excel');

    // Manajemen Status & Hapus VIP (Untuk Dashboard Admin)
    Route::patch('/vip-subscriptions/{id}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateVipStatus'])->name('admin.vip.status');
    Route::delete('/vip-subscriptions/{id}', [App\Http\Controllers\Admin\BookingController::class, 'destroyVip'])->name('admin.vip.destroy');
});

// 4. AUTHENTICATION ROUTES (Login, Register, dsb)
require __DIR__.'/auth.php';
