@extends('layouts.admin')

@section('title', 'Laporan Keuangan - Admin')

@section('content')

@php
    // Tangkap perintah filter dari URL
    $period = request('period');
    $startDate = request('start_date');
    $endDate = request('end_date');

    // 1. Siapkan mesin pencari untuk VIP & Regular (Hanya ambil yang Lunas/ACC)
    $vipQuery = \App\Models\PlanSubscription::with(['user', 'pricingPlan'])->whereIn('status', ['Completed', 'completed', 'active', 'Active', 'Approved', 'approved']);
    $regQuery = \App\Models\Booking::with(['user', 'playstation'])->whereIn('status', ['Completed', 'completed', 'active', 'Active', 'Approved', 'approved']);

    // 2. Jalankan Filter berdasarkan permintaan user
    if ($period == 'day') {
        $today = \Carbon\Carbon::today('Asia/Jakarta');
        $vipQuery->whereDate('created_at', $today);
        $regQuery->whereDate('created_at', $today);
        $reportTitle = 'Laporan Transaksi Hari Ini';
    } elseif ($period == 'month') {
        $now = \Carbon\Carbon::now('Asia/Jakarta');
        $vipQuery->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year);
        $regQuery->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year);
        $reportTitle = 'Laporan Transaksi Bulan Ini';
    } elseif ($period == 'year') {
        $year = \Carbon\Carbon::now('Asia/Jakarta')->year;
        $vipQuery->whereYear('created_at', $year);
        $regQuery->whereYear('created_at', $year);
        $reportTitle = 'Laporan Transaksi Tahun Ini';
    } elseif ($startDate && $endDate) {
        $start = $startDate . ' 00:00:00';
        $end = $endDate . ' 23:59:59';
        $vipQuery->whereBetween('created_at', [$start, $end]);
        $regQuery->whereBetween('created_at', [$start, $end]);
        $reportTitle = 'Laporan Kustom: ' . \Carbon\Carbon::parse($startDate)->format('d M Y') . ' - ' . \Carbon\Carbon::parse($endDate)->format('d M Y');
    } else {
        $reportTitle = 'Laporan Keseluruhan (Sepanjang Waktu)';
    }

    // 3. Tarik datanya dari Database
    $vipData = $vipQuery->get();
    $regData = $regQuery->get();

    // 4. Gabungkan datanya jadi satu
    $mergedReports = collect();

    foreach($regData as $b) {
        $mergedReports->push((object)[
            'date_sort' => $b->created_at,
            'date_display' => \Carbon\Carbon::parse($b->created_at)->format('d M Y'),
            'id_display' => '#TRX-' . str_pad($b->id, 4, '0', STR_PAD_LEFT),
            'user_name' => $b->user->name ?? 'Unknown',
            'item_name' => 'Sewa ' . ($b->playstation->name ?? 'PS Unit'),
            'price' => $b->total_price,
            'color' => 'text-[#00e5ff]'
        ]);
    }

    foreach($vipData as $v) {
        $mergedReports->push((object)[
            'date_sort' => $v->created_at,
            'date_display' => \Carbon\Carbon::parse($v->created_at)->format('d M Y'),
            'id_display' => '#VIP-' . str_pad($v->id, 4, '0', STR_PAD_LEFT),
            'user_name' => $v->user->name ?? 'Unknown',
            'item_name' => 'Langganan: ' . ($v->pricingPlan->title ?? 'VIP Plan'),
            'price' => $v->price_snapshot,
            'color' => 'text-[#f59e0b]'
        ]);
    }

    // 5. Urutkan dari yang terbaru & Hitung Total Uang
    $mergedReports = $mergedReports->sortByDesc('date_sort');
    $realTotalTransactions = $mergedReports->count();
    $realTotalRevenue = $mergedReports->sum('price');
@endphp


<div class="print:hidden">
    <div class="fixed top-0 right-0 w-[600px] h-[400px] bg-[#10b981]/5 blur-[120px] pointer-events-none -z-10"></div>

    <div class="max-w-[1400px] mx-auto pb-12">

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#10b981]/10 border border-[#10b981]/30 mb-4 shadow-[0_0_15px_rgba(16,185,129,0.1)]">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    <span class="text-[#10b981] text-[10px] font-black uppercase tracking-[2px]">Financial Protocol</span>
                </div>

                <h1 class="text-3xl md:text-[40px] font-black text-white font-['Orbitron'] tracking-tight leading-none">
                    LAPORAN <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#10b981] to-[#00e5ff]">KEUANGAN</span>
                </h1>
                <p class="text-[#8A99B5] text-sm mt-3 font-['Inter'] max-w-md leading-relaxed">
                    Pantau omset masuk dan cetak laporan untuk rekapitulasi bisnis Anda secara real-time.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.reports.excel') }}?period={{ $period }}&start_date={{ $startDate }}&end_date={{ $endDate }}" class="flex items-center gap-2 bg-[#10b981]/10 border border-[#10b981]/50 text-[#10b981] px-5 py-3 rounded-xl font-bold text-[12px] uppercase tracking-[1px] hover:bg-[#10b981] hover:text-black transition-all duration-300">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                    Excel
                </a>

                <a href="{{ route('admin.reports.pdf') }}?period={{ $period }}&start_date={{ $startDate }}&end_date={{ $endDate }}" class="flex items-center gap-2 bg-[#ff3366]/10 border border-[#ff3366]/50 text-[#ff3366] px-5 py-3 rounded-xl font-bold text-[12px] uppercase tracking-[1px] hover:bg-[#ff3366] hover:text-white transition-all duration-300">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    PDF
                </a>

                <button onclick="window.print()" class="flex items-center gap-2 bg-gradient-to-r from-[#10b981] to-[#00e5ff] text-black px-6 py-3 rounded-xl text-[12px] font-black uppercase tracking-[2px] shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] transition-all transform hover:-translate-y-1">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    Print Laporan
                </button>
            </div>
        </div>

        <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] p-6 mb-8">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-col lg:flex-row gap-6 items-end">
                <div class="flex-1 w-full">
                    <label class="block text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-3">Filter Cepat</label>
                    <div class="flex flex-wrap gap-2">
                        <button type="submit" name="period" value="day" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all {{ $period == 'day' ? 'bg-[#10b981] text-black shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'bg-[#03060D] border border-[#1A233A] text-[#8A99B5] hover:border-[#10b981]/50 hover:text-white' }}">Hari Ini</button>
                        <button type="submit" name="period" value="month" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all {{ $period == 'month' ? 'bg-[#10b981] text-black shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'bg-[#03060D] border border-[#1A233A] text-[#8A99B5] hover:border-[#10b981]/50 hover:text-white' }}">Bulan Ini</button>
                        <button type="submit" name="period" value="year" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all {{ $period == 'year' ? 'bg-[#10b981] text-black shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'bg-[#03060D] border border-[#1A233A] text-[#8A99B5] hover:border-[#10b981]/50 hover:text-white' }}">Tahun Ini</button>
                    </div>
                </div>

                <div class="hidden lg:block w-[1px] h-[50px] bg-[#1A233A]"></div>

                <div class="flex-1 w-full flex flex-col md:flex-row gap-3">
                    <div class="flex-1 relative">
                        <label class="block text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-3">Dari Tanggal</label>
                        <div class="relative group">
                            <input type="date" name="start_date" value="{{ $startDate }}" class="w-full bg-[#03060D] border border-[#1A233A] text-white text-[12px] px-4 py-2.5 pr-10 rounded-xl outline-none focus:border-[#10b981] group-hover:border-[#10b981]/50 transition-colors uppercase font-['Rajdhani'] cursor-pointer [color-scheme:dark] [&::-webkit-calendar-picker-indicator]:opacity-0 [&::-webkit-calendar-picker-indicator]:absolute [&::-webkit-calendar-picker-indicator]:inset-0 [&::-webkit-calendar-picker-indicator]:w-full [&::-webkit-calendar-picker-indicator]:h-full [&::-webkit-calendar-picker-indicator]:cursor-pointer">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#8A99B5] group-hover:text-[#10b981] transition-colors">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 relative">
                        <label class="block text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-3">Sampai Tanggal</label>
                        <div class="relative group">
                            <input type="date" name="end_date" value="{{ $endDate }}" class="w-full bg-[#03060D] border border-[#1A233A] text-white text-[12px] px-4 py-2.5 pr-10 rounded-xl outline-none focus:border-[#10b981] group-hover:border-[#10b981]/50 transition-colors uppercase font-['Rajdhani'] cursor-pointer [color-scheme:dark] [&::-webkit-calendar-picker-indicator]:opacity-0 [&::-webkit-calendar-picker-indicator]:absolute [&::-webkit-calendar-picker-indicator]:inset-0 [&::-webkit-calendar-picker-indicator]:w-full [&::-webkit-calendar-picker-indicator]:h-full [&::-webkit-calendar-picker-indicator]:cursor-pointer">
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#8A99B5] group-hover:text-[#10b981] transition-colors">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="px-5 py-2.5 bg-[#1A233A] border border-[#1A233A] text-white hover:bg-[#10b981] hover:text-black rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all h-[42px] flex items-center justify-center shadow-[0_0_10px_rgba(0,0,0,0.2)]">
                            Filter
                        </button>

                        @if($period || $startDate)
                            <a href="{{ route('admin.reports.index') }}" title="Reset Pencarian" class="px-3 py-2.5 bg-[#ff3366]/10 text-[#ff3366] hover:bg-[#ff3366] hover:text-white rounded-xl transition-all h-[42px] flex items-center justify-center border border-[#ff3366]/30">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><polyline points="3 3 3 8 8 8"></polyline></svg>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-[#0B1221]/90 border border-[#1A233A] p-6 rounded-[20px]">
                <div class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-2">Total Transaksi Lunas</div>
                <div class="text-white font-['Orbitron'] font-bold text-[32px]">{{ $realTotalTransactions }} <span class="text-[12px] text-[#8A99B5] font-['Inter']">Sesi & Paket</span></div>
            </div>
            <div class="bg-[#0B1221]/90 border border-[#10b981]/50 p-6 rounded-[20px] shadow-[0_0_20px_rgba(16,185,129,0.1)]">
                <div class="text-[#10b981] text-[11px] uppercase tracking-[2px] font-bold mb-2">Total Pendapatan Bersih</div>
                <div class="text-white font-['Orbitron'] font-bold text-[32px]">Rp {{ number_format($realTotalRevenue, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)]">
            <div class="p-6 border-b border-[#1A233A]">
                <h3 class="font-['Orbitron'] text-white font-bold text-[18px]">{{ $reportTitle }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="bg-[#03060D] border-b border-[#1A233A] text-[#8A99B5] text-[10px] font-bold font-['Rajdhani'] uppercase tracking-[2px]">
                        <tr>
                            <th class="px-6 py-5">Tanggal</th>
                            <th class="px-6 py-5">Order ID</th>
                            <th class="px-6 py-5">Pelanggan</th>
                            <th class="px-6 py-5">Unit / Layanan</th>
                            <th class="px-6 py-5 text-right">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13px] text-white">
                        @forelse($mergedReports as $item)
                        <tr class="border-b border-[#1A233A]/40 hover:bg-[#1A233A]/20">
                            <td class="px-6 py-4">{{ $item->date_display }}</td>
                            <td class="px-6 py-4 font-['Orbitron'] {{ $item->color }} font-bold text-[13px]">{{ $item->id_display }}</td>
                            <td class="px-6 py-4 font-bold">{{ $item->user_name }}</td>
                            <td class="px-6 py-4">{{ $item->item_name }}</td>
                            <td class="px-6 py-4 text-right font-['Orbitron'] font-bold text-[#10b981]">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <p class="text-[#8A99B5] text-[12px] uppercase tracking-[1px]">Tidak ada transaksi yang tercatat pada periode ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="print-section" class="hidden print:block w-full bg-white text-black font-['Inter']">

    <div class="border-b-4 border-gray-900 pb-4 mb-6 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-black uppercase tracking-widest text-gray-900 font-['Orbitron']">
                TRIO INFINITY <span class="text-[#00e5ff]" style="-webkit-print-color-adjust: exact;">PS</span>
            </h1>
            <p class="text-sm text-gray-700 font-bold mt-1 uppercase">{{ $reportTitle }}</p>
            <p class="text-xs text-gray-500 mt-1">Laporan Gabungan Omset Regular & Layanan VIP</p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-500">Dicetak pada:</p>
            <p class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y - H:i') }} WIB</p>
            <p class="text-xs text-gray-500 mt-1">Oleh: {{ Auth::user()->name }}</p>
        </div>
    </div>

    <div class="flex gap-6 mb-8">
        <div class="flex-1 bg-gray-50 border border-gray-200 p-5 rounded-xl" style="-webkit-print-color-adjust: exact;">
            <p class="text-gray-500 text-[10px] uppercase tracking-[2px] font-bold mb-1">Total Transaksi Lunas</p>
            <p class="text-gray-900 font-bold text-2xl font-['Orbitron']">{{ $realTotalTransactions }} <span class="text-sm text-gray-500 font-['Inter']">Sesi & Paket</span></p>
        </div>
        <div class="flex-1 bg-[#10b981]/10 border border-[#10b981]/30 p-5 rounded-xl" style="-webkit-print-color-adjust: exact;">
            <p class="text-[#059669] text-[10px] uppercase tracking-[2px] font-bold mb-1">Total Pendapatan Bersih</p>
            <p class="text-gray-900 font-bold text-2xl font-['Orbitron']">Rp {{ number_format($realTotalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100" style="-webkit-print-color-adjust: exact;">
                <th class="py-3 px-4 border border-gray-300 text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</th>
                <th class="py-3 px-4 border border-gray-300 text-xs font-bold text-gray-700 uppercase tracking-wider">Order ID</th>
                <th class="py-3 px-4 border border-gray-300 text-xs font-bold text-gray-700 uppercase tracking-wider">Pelanggan</th>
                <th class="py-3 px-4 border border-gray-300 text-xs font-bold text-gray-700 uppercase tracking-wider">Unit / Layanan</th>
                <th class="py-3 px-4 border border-gray-300 text-xs font-bold text-gray-700 uppercase tracking-wider text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mergedReports as $item)
            <tr class="break-inside-avoid">
                <td class="py-3 px-4 border border-gray-300 text-sm text-gray-800">{{ $item->date_display }}</td>
                <td class="py-3 px-4 border border-gray-300 text-sm font-bold text-gray-900 font-['Orbitron']">{{ $item->id_display }}</td>
                <td class="py-3 px-4 border border-gray-300 text-sm text-gray-800 font-bold">{{ $item->user_name }}</td>
                <td class="py-3 px-4 border border-gray-300 text-sm text-gray-600">{{ $item->item_name }}</td>
                <td class="py-3 px-4 border border-gray-300 text-sm font-bold text-gray-900 font-['Orbitron'] text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-8 text-center border border-gray-300 text-gray-500 text-sm">Tidak ada transaksi yang tercatat pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-12 text-center text-xs text-gray-400 font-medium">
        <p>Dokumen ini dihasilkan secara otomatis oleh Sistem Trio Infinity PS.</p>
        <p>Valid dan sah tanpa memerlukan tanda tangan basah.</p>
    </div>
</div>

<style>
    @media print {
        @page { size: A4 portrait; margin: 1.5cm; }

        body * { visibility: hidden; }

        #print-section, #print-section * { visibility: visible; }
        #print-section { position: absolute; left: 0; top: 0; width: 100%; background: white !important; }

        .break-inside-avoid { page-break-inside: avoid; break-inside: avoid; }
    }
</style>
@endsection
