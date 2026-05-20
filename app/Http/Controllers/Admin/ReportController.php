<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PlanSubscription; // Pastikan Model VIP dipanggil
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
            'bookings'          => $data['bookings'], // Berisi data gabungan Regular & VIP
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

        return Excel::download(new ReportExport($data['bookings']), $filename);
    }

    /**
     * LOGIKA FILTER (Private Method) - SUPER UPDATE (REGULAR + VIP)
     * Dibuat terpisah agar hasil di Dashboard, PDF, dan Excel selalu Sinkron.
     */
    private function getReportData(Request $request)
    {
        // 1. Siapkan Kueri untuk Regular dan VIP (Sertakan huruf besar dan kecil untuk cegah bug)
        $bookingQuery = Booking::with(['user', 'playstation'])
                        ->whereIn('status', ['Active', 'Completed', 'active', 'completed']);

        $vipQuery = PlanSubscription::with(['user', 'pricingPlan'])
                        ->whereIn('status', ['Active', 'Completed', 'active', 'completed']);

        $period = $request->period ?? 'month';
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $title = "";

        // 2. Terapkan Filter Tanggal ke KEDUA Kueri
        if ($startDate && $endDate) {
            $period = 'custom';
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();

            $bookingQuery->whereBetween('created_at', [$start, $end]);
            $vipQuery->whereBetween('created_at', [$start, $end]);
            $title = "Laporan Kustom: " . $start->format('d M Y') . " - " . $end->format('d M Y');
        } else {
            if ($period == 'day') {
                $bookingQuery->whereDate('created_at', Carbon::today());
                $vipQuery->whereDate('created_at', Carbon::today());
                $title = "Laporan Hari Ini (" . Carbon::today()->format('d M Y') . ")";
            } elseif ($period == 'year') {
                $bookingQuery->whereYear('created_at', Carbon::now()->year);
                $vipQuery->whereYear('created_at', Carbon::now()->year);
                $title = "Laporan Tahun Ini (" . Carbon::now()->year . ")";
            } else {
                $bookingQuery->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                $vipQuery->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                $title = "Laporan Bulan Ini (" . Carbon::now()->format('F Y') . ")";
            }
        }

        // 3. Ambil Datanya
        $bookingsData = $bookingQuery->latest()->get();
        $vipsData = $vipQuery->latest()->get();

        // 4. MAPPING: Seragamkan struktur datanya agar bisa digabung
        $mappedBookings = $bookingsData->map(function ($b) {
            return (object) [
                'id_transaksi'   => '#TRX-' . str_pad($b->id, 4, '0', STR_PAD_LEFT),
                'nama_pelanggan' => $b->user->name ?? 'Gamer',
                'detail_sewa'    => ($b->playstation->name ?? 'Console') . ' (' . $b->duration_hours . ' Jam)',
                'tipe'           => 'REGULAR',
                'total_price'    => $b->total_price, // Kunci (key) dipertahankan
                'tanggal'        => Carbon::parse($b->created_at)->format('d M Y'),
                'created_at'     => $b->created_at,
            ];
        });

        $mappedVips = $vipsData->map(function ($v) {
            return (object) [
                'id_transaksi'   => '#VIP-' . str_pad($v->id, 4, '0', STR_PAD_LEFT),
                'nama_pelanggan' => $v->user->name ?? 'Gamer',
                'detail_sewa'    => 'Paket VIP: ' . ($v->pricingPlan->title ?? 'Premium'),
                'tipe'           => 'VIP',
                'total_price'    => $v->price_snapshot, // Samakan nama key dengan regular
                'tanggal'        => Carbon::parse($v->created_at)->format('d M Y'),
                'created_at'     => $v->created_at,
            ];
        });

        // 5. Gabungkan kedua data dan urutkan berdasarkan yang paling baru
        $allTransactions = $mappedBookings->merge($mappedVips)->sortByDesc('created_at')->values();

        // Kembalikan dalam bentuk array seperti kode lama Anda
        return [
            'bookings'          => $allTransactions, // Sekarang berisi Regular + VIP
            'totalRevenue'      => $allTransactions->sum('total_price'),
            'totalTransactions' => $allTransactions->count(),
            'period'            => $period,
            'title'             => $title,
            'generatedAt'       => Carbon::now()->format('d M Y H:i')
        ];
    }
}
