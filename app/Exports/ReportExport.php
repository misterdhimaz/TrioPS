<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize, WithStyles
{
    protected $bookings;
    protected $rowNumber = 0;

    /**
     * Menangkap data bookings yang sudah difilter dari Controller
     */
    public function __construct($bookings)
    {
        $this->bookings = $bookings;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->bookings;
    }

    /**
     * Menentukan header kolom di Excel
     */
    public function headings(): array
    {
        return [
            'NO',
            'ID BOOKING',
            'NAMA PELANGGAN',
            'UNIT PLAYSTATION',
            'TANGGAL TRANSAKSI',
            'STATUS',
            'TOTAL PEMBAYARAN'
        ];
    }

    /**
     * Memetakan data dari model ke kolom Excel
     * Ditambahkan proteksi ?? (null coalescing) agar tidak error jika data dihapus
     */
    public function map($booking): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $booking->id,
            $booking->user->name ?? 'User Tidak Ditemukan',
            $booking->playstation->name ?? 'Unit Telah Dihapus',
            $booking->created_at->format('d/m/Y H:i'),
            $booking->status,
            $booking->total_price,
        ];
    }

    /**
     * Mengatur format kolom (Kolom G untuk Total Pembayaran diformat Rupiah)
     */
    public function columnFormats(): array
    {
        return [
            'G' => '"Rp "#,##0',
        ];
    }

    /**
     * Memberikan styling pada sheet Excel
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Baris 1 (Header) dibuat Bold dengan background hijau emerald
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '10B981']
                ],
            ],
        ];
    }
}
