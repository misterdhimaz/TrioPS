<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi - #{{ $booking->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: white !important; color: black !important; }
        @media print {
            @page { margin: 0; size: A4; }
            body { -webkit-print-color-adjust: exact; }
            .print-no-shadow { text-shadow: none !important; box-shadow: none !important; }
        }
    </style>
</head>
<body class="bg-white text-black font-['Inter'] min-h-screen flex items-start justify-center p-0 md:p-6">

    @php
        $waktuSewa = json_decode($booking->start_time, true) ?? [];
        $listJam = !empty($waktuSewa) ? implode(', ', $waktuSewa) : '-';
        $durasiSewa = $booking->duration ?? count($waktuSewa);
    @endphp

    <div class="bg-white text-gray-900 w-full max-w-[800px] p-[30px] md:p-[50px] shadow-none print-no-shadow">

        <div class="flex justify-between items-start border-b-2 border-gray-100 pb-8 mb-8">
            <div>
                <h1 class="font-['Orbitron'] text-3xl font-bold text-gray-900 tracking-wider">TRIO INFINITY <span class="text-[#00e5ff] print:text-gray-900">PS</span></h1>
                <p class="text-gray-500 text-sm mt-2 font-medium">Rental PlayStation Premium</p>
                <p class="text-gray-500 text-sm">Pagar Alam, Sumatera Selatan</p>
            </div>
            <div class="text-right">
                <div class="inline-block px-4 py-1.5 rounded-lg bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#0088cc] print:bg-gray-100 print:text-black font-bold text-sm tracking-widest uppercase mb-3">
                    LUNAS / ACC
                </div>
                <p class="text-2xl font-bold text-gray-800 tracking-tight">INVOICE</p>
                <p class="text-gray-500 text-sm font-mono mt-1">#INV-{{ date('Ymd') }}-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 mb-10 bg-gray-50 print:bg-white p-6 rounded-xl border border-gray-100">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-widest font-bold mb-2">Ditagihkan Kepada:</p>
                <p class="font-bold text-lg text-gray-800">{{ $booking->user->name }}</p>
                <p class="text-gray-600 text-sm mt-1">{{ $booking->user->email }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase tracking-widest font-bold mb-2">Detail Transaksi:</p>
                <p class="text-gray-800 text-sm font-medium">Tgl Order: {{ date('d M Y', strtotime($booking->created_at)) }}</p>
                <p class="text-gray-800 text-sm font-medium mt-1">Tgl Main: {{ date('d M Y', strtotime($booking->booking_date)) }}</p>
            </div>
        </div>

        <table class="w-full text-left border-collapse mb-10">
            <thead>
                <tr class="bg-gray-900 print:bg-gray-200 text-white print:text-black text-xs uppercase tracking-widest">
                    <th class="py-4 px-5 rounded-tl-xl print:rounded-none">Layanan / Konsol</th>
                    <th class="py-4 px-5">Durasi</th>
                    <th class="py-4 px-5 text-right rounded-tr-xl print:rounded-none">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b-2 border-gray-100">
                    <td class="py-5 px-5">
                        <p class="font-bold text-gray-800 text-lg">Sewa {{ $booking->playstation->name ?? 'PlayStation' }}</p>
                        <p class="text-gray-500 text-sm mt-1 font-mono">Sesi: {{ $listJam }} WIB</p>
                    </td>
                    <td class="py-5 px-5 font-mono text-gray-700 font-medium">
                        {{ $durasiSewa }} Jam
                    </td>
                    <td class="py-5 px-5 text-right font-bold text-gray-800 font-mono text-lg">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-end mb-16">
            <div class="w-1/2 bg-gray-50 print:bg-white p-6 rounded-xl border border-gray-100">
                <div class="flex justify-between pt-2 items-center">
                    <span class="text-gray-800 font-bold tracking-wide">TOTAL KESELURUHAN</span>
                    <span class="text-2xl text-[#0066ff] print:text-black font-['Orbitron'] font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-end pt-8">
            <div class="w-1/2 print:w-2/3">
                <p class="text-gray-400 text-xs leading-relaxed uppercase tracking-widest font-bold mb-2">Perhatian:</p>
                <p class="text-gray-500 text-xs leading-relaxed">Nota ini adalah bukti pembayaran yang sah. Harap tunjukkan kepada Admin Trio Infinity PS saat kedatangan. Keterlambatan bermain menjadi tanggung jawab penyewa.</p>
            </div>
            <div class="text-center">
                <p class="text-gray-500 text-sm mb-16 font-medium">Tanda Terima,</p>
                <p class="font-bold text-gray-800 border-t-2 border-gray-300 pt-3 px-8 tracking-wider uppercase text-sm">Admin Trio Infinity</p>
            </div>
        </div>

    </div>
</body>
</html>
