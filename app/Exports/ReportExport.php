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
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize, WithStyles, WithEvents
{
    protected $transactions;
    protected $rowNumber = 0;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->transactions;
    }

    /**
     * Header Tabel Excel
     */
    public function headings(): array
    {
        return [
            'NO',
            'ID TRANSAKSI',
            'NAMA PELANGGAN',
            'DETAIL SEWA / PAKET',
            'TIPE',
            'TANGGAL TRANSAKSI',
            'TOTAL PEMBAYARAN'
        ];
    }

    /**
     * Mapping data ke baris Excel
     */
    public function map($tx): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $tx->id_transaksi,
            $tx->nama_pelanggan,
            $tx->detail_sewa,
            $tx->tipe,
            $tx->tanggal,
            $tx->total_price,
        ];
    }

    /**
     * Format Kolom G menjadi Rupiah
     */
    public function columnFormats(): array
    {
        return [
            'G' => '"Rp "#,##0',
        ];
    }

    /**
     * Memberikan styling pada header tabel utama
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '10B981'] // Hijau Emerald
                ],
            ],
        ];
    }

    /**
     * Manipulasi Ekstra Setelah Data Selesai Dirender (Tambah Total & Kunci Sheet)
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // 1. Hitung Total Keseluruhan Pendapatan
                $totalKeseluruhan = $this->transactions->sum('total_price');

                // 2. Cari tahu baris mana yang kosong di paling bawah
                $barisTotal = $this->rowNumber + 2; // +1 untuk header, +1 untuk baris baru setelah data

                // 3. Tulis teks "TOTAL PENDAPATAN" dan nominalnya
                $event->sheet->setCellValue('A' . $barisTotal, 'TOTAL PENDAPATAN BERSIH:');
                $event->sheet->setCellValue('G' . $barisTotal, $totalKeseluruhan);

                // 4. Gabungkan (Merge) Cell A sampai F untuk tulisan total
                $event->sheet->mergeCells('A' . $barisTotal . ':F' . $barisTotal);

                // 5. Rata kanan (Align Right) untuk tulisan total agar menempel dengan angka
                $event->sheet->getStyle('A' . $barisTotal)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

                // 6. Beri Styling (Warna & Font Tebal) pada baris Total agar terlihat mencolok
                $event->sheet->getStyle('A' . $barisTotal . ':G' . $barisTotal)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF']
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '0F172A'] // Warna dark/slate sesuai tema sistem Anda
                    ],
                ]);

                // 7. Kunci Sheet agar tidak bisa diedit secara sepihak
                $event->sheet->getDelegate()->getProtection()->setSheet(true);
            },
        ];
    }
}
