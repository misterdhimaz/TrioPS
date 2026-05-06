<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #10b981;
            padding-bottom: 20px;
        }
        .header h1 {
            text-transform: uppercase;
            color: #05080f;
            margin: 0;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #f8fafc;
            color: #0f172a;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
        }
        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .total-row {
            background-color: #008659 !important;
            color: white;
            font-weight: bold;
        }
        .total-label {
            text-align: right;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 50px;
            font-size: 9px;
            color: #94a3b8;
            text-align: right;
            font-style: italic;
        }
        .status-badge {
            font-weight: bold;
            color: #10b981;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>TRIO INFINITY PS - LAPORAN KEUANGAN</h1>
        <p>{{ $title }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Pelanggan</th>
                <th width="25%">Unit PlayStation</th>
                <th width="25%">Waktu Transaksi</th>
                <th width="25%">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $index => $booking)
            <tr>
                <td>{{ $index + 1 }}</td>
                {{-- Menggunakan ?? sebagai fallback jika data User/Unit sudah dihapus --}}
                <td>{{ $booking->user->name ?? 'User Tidak Ditemukan' }}</td>
                <td>{{ $booking->playstation->name ?? 'Unit Telah Dihapus' }}</td>
                <td>{{ $booking->created_at->format('d/m/Y | H:i') }}</td>
                <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 30px;">Tidak ada data transaksi pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="total-label">Total Omset Pendapatan</td>
                <td>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Laporan ini dihasilkan secara otomatis oleh sistem Trio Infinity PS</p>
        <p>Waktu Cetak: {{ $generatedAt ?? date('d M Y H:i') }}</p>
    </div>
</body>
</html>
