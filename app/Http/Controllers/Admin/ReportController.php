<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    /**
     * Tampilan Utama Laporan Dashboard
     */
    public function index(Request $request)
    {
        $data = $this->getReportData($request);

        return view('admin.reports.index', [
            'bookings'          => $data['bookings'],
            'totalRevenue'      => $data['totalRevenue'],
            'totalTransactions' => $data['totalTransactions'],
            'period'            => $data['period'],
            'title'             => $data['title'],
            'startDate'         => $request->start_date,
            'endDate'           => $request->end_date
        ]);
    }

    /**
     * Fungsi Ekspor ke PDF
     */
    public function exportPdf(Request $request)
    {
        $data = $this->getReportData($request);

        // Memuat view khusus untuk PDF (pastikan file resources/views/admin/reports/pdf.blade.php sudah ada)
        $pdf = Pdf::loadView('admin.reports.pdf', $data)
                  ->setPaper('a4', 'landscape');

        $filename = 'Laporan_TrioInfinity_' . now()->format('Ymd_His') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Fungsi Ekspor ke Excel
     */
    public function exportExcel(Request $request)
    {
        $data = $this->getReportData($request);

        $filename = 'Laporan_TrioInfinity_' . now()->format('Ymd_His') . '.xlsx';

        // Mengirimkan koleksi bookings ke class ReportExport
        return Excel::download(new ReportExport($data['bookings']), $filename);
    }

    /**
     * LOGIKA FILTER (Private Method)
     * Dibuat terpisah agar hasil di Dashboard, PDF, dan Excel selalu Sinkron.
     */
    private function getReportData(Request $request)
    {
        // Hanya ambil transaksi yang statusnya Active atau Completed
        $query = Booking::with(['user', 'playstation'])
                        ->whereIn('status', ['Active', 'Completed']);

        $period = $request->period ?? 'month';
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $title = "";

        // 1. Filter Kustom berdasarkan Tanggal Kalender
        if ($startDate && $endDate) {
            $period = 'custom';
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();

            $query->whereBetween('created_at', [$start, $end]);
            $title = "Laporan Kustom: " . $start->format('d M Y') . " - " . $end->format('d M Y');
        }
        // 2. Filter Berdasarkan Periode Cepat
        else {
            if ($period == 'day') {
                $query->whereDate('created_at', Carbon::today());
                $title = "Laporan Hari Ini (" . Carbon::today()->format('d M Y') . ")";
            } elseif ($period == 'year') {
                $query->whereYear('created_at', Carbon::now()->year);
                $title = "Laporan Tahun Ini (" . Carbon::now()->year . ")";
            } else {
                // Default: Bulan ini
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                $title = "Laporan Bulan Ini (" . Carbon::now()->format('F Y') . ")";
            }
        }

        $bookings = $query->latest()->get();

        return [
            'bookings'          => $bookings,
            'totalRevenue'      => $bookings->sum('total_price'),
            'totalTransactions' => $bookings->count(),
            'period'            => $period,
            'title'             => $title,
            'generatedAt'       => Carbon::now()->format('d M Y H:i')
        ];
    }
}
