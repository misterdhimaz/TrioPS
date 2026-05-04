<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Hanya hitung transaksi yang Active (Sedang main) atau Completed (Selesai)
        $query = Booking::with(['user', 'playstation'])->whereIn('status', ['Active', 'Completed']);

        $period = $request->period ?? 'month';
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Logika Filter Kustom Kalender
        if ($startDate && $endDate) {
            $period = 'custom';
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
            $title = "Laporan Kustom: " . $start->format('d M Y') . " - " . $end->format('d M Y');
        } else {
            // Logika Filter Cepat (Hari/Bulan/Tahun)
            if ($period == 'day') {
                $query->whereDate('created_at', Carbon::today());
                $title = "Laporan Hari Ini (" . Carbon::today()->format('d M Y') . ")";
            } elseif ($period == 'year') {
                $query->whereYear('created_at', Carbon::now()->year);
                $title = "Laporan Tahun Ini (" . Carbon::now()->year . ")";
            } else {
                $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
                $title = "Laporan Bulan Ini (" . Carbon::now()->format('F Y') . ")";
            }
        }

        $bookings = $query->latest()->get();
        $totalRevenue = $bookings->sum('total_price');
        $totalTransactions = $bookings->count();

        return view('admin.reports.index', compact('bookings', 'totalRevenue', 'totalTransactions', 'period', 'title', 'startDate', 'endDate'));
    }
}
