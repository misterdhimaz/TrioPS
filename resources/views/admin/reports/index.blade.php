@extends('layouts.admin')

@section('title', 'Laporan Keuangan - Admin')

@section('content')
<!-- Ambient Glow Background (Hidden on Print) -->
<div class="fixed top-0 right-0 w-[600px] h-[400px] bg-[#10b981]/5 blur-[120px] pointer-events-none -z-10 print:hidden"></div>

<div class="max-w-[1400px] mx-auto pb-12 print:p-0 print:m-0 print:max-w-full">

    <!-- HEADER SECTION (Hidden on Print) -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10 print:hidden">

        <!-- Left Side: Title & Badge -->
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

        <!-- Right Side: Action Buttons Group -->
        <div class="flex flex-wrap items-center gap-3">
            <!-- Export Excel -->
            <a href="{{ route('admin.reports.excel') }}"
               class="flex items-center gap-2 bg-[#10b981]/10 border border-[#10b981]/50 text-[#10b981] px-5 py-3 rounded-xl font-bold text-[12px] uppercase tracking-[1px] hover:bg-[#10b981] hover:text-black transition-all duration-300">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                Excel
            </a>

            <!-- Export PDF -->
            <a href="{{ route('admin.reports.pdf') }}"
               class="flex items-center gap-2 bg-[#ff3366]/10 border border-[#ff3366]/50 text-[#ff3366] px-5 py-3 rounded-xl font-bold text-[12px] uppercase tracking-[1px] hover:bg-[#ff3366] hover:text-white transition-all duration-300">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                PDF
            </a>

            <!-- Print Canvas -->
            <button onclick="window.print()"
                    class="flex items-center gap-2 bg-gradient-to-r from-[#10b981] to-[#00e5ff] text-black px-6 py-3 rounded-xl text-[12px] font-black uppercase tracking-[2px] shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] transition-all transform hover:-translate-y-1">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                Print Laporan
            </button>
        </div>
    </div>

    <!-- Kotak Konten Laporan Anda (Table, dsb) akan mulai di sini -->
    <div class="print:border-0 print:shadow-none">
        <!-- Letakkan table laporan Anda di sini -->
    </div>

</div>

    <!-- FILTER PANEL (Hidden on Print) -->
    <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] p-6 mb-8 print:hidden">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-col lg:flex-row gap-6 items-end">
            <!-- Filter Cepat -->
            <div class="flex-1 w-full">
                <label class="block text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-3">Filter Cepat</label>
                <div class="flex flex-wrap gap-2">
                    <button type="submit" name="period" value="day" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all {{ $period == 'day' ? 'bg-[#10b981] text-black shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'bg-[#03060D] border border-[#1A233A] text-[#8A99B5] hover:border-[#10b981]/50 hover:text-white' }}">Hari Ini</button>
                    <button type="submit" name="period" value="month" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all {{ $period == 'month' ? 'bg-[#10b981] text-black shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'bg-[#03060D] border border-[#1A233A] text-[#8A99B5] hover:border-[#10b981]/50 hover:text-white' }}">Bulan Ini</button>
                    <button type="submit" name="period" value="year" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all {{ $period == 'year' ? 'bg-[#10b981] text-black shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'bg-[#03060D] border border-[#1A233A] text-[#8A99B5] hover:border-[#10b981]/50 hover:text-white' }}">Tahun Ini</button>
                </div>
            </div>

            <div class="hidden lg:block w-[1px] h-[50px] bg-[#1A233A]"></div>

            <!-- Filter Kustom Kalender -->
            <div class="flex-1 w-full flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <label class="block text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-3">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="w-full bg-[#03060D] border border-[#1A233A] text-white text-[12px] px-4 py-2.5 rounded-xl outline-none focus:border-[#10b981] uppercase font-['Rajdhani']">
                </div>
                <div class="flex-1">
                    <label class="block text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-3">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="w-full bg-[#03060D] border border-[#1A233A] text-white text-[12px] px-4 py-2.5 rounded-xl outline-none focus:border-[#10b981] uppercase font-['Rajdhani']">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="px-5 py-2.5 bg-[#1A233A] border border-[#1A233A] text-white hover:bg-[#10b981] hover:text-black rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all h-[42px] flex items-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- PRINT HEADER (Hanya muncul saat diprint) -->
    <div class="hidden print:block mb-8 border-b-2 border-black pb-6 text-center">
        <h1 class="text-2xl font-bold uppercase tracking-widest text-black">TRIO INFINITY PLAYSTATION</h1>
        <p class="text-sm text-gray-600 uppercase">{{ $title }}</p>
        <p class="text-xs text-gray-500 mt-2">Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y - H:i') }} oleh {{ Auth::user()->name }}</p>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 print:flex print:gap-10 print:mb-6">
        <div class="bg-[#0B1221]/90 border border-[#1A233A] p-6 rounded-[20px] print:border-none print:p-0 print:bg-transparent">
            <div class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-2 print:text-black">Total Transaksi Selesai</div>
            <div class="text-white font-['Orbitron'] font-bold text-[32px] print:text-black">{{ $totalTransactions }} <span class="text-[12px] text-[#8A99B5] font-['Inter'] print:text-gray-600">Sesi</span></div>
        </div>

        <div class="bg-[#0B1221]/90 border border-[#10b981]/50 p-6 rounded-[20px] shadow-[0_0_20px_rgba(16,185,129,0.1)] print:border-none print:p-0 print:bg-transparent print:shadow-none">
            <div class="text-[#10b981] text-[11px] uppercase tracking-[2px] font-bold mb-2 print:text-black">Total Pendapatan Bersih</div>
            <div class="text-white font-['Orbitron'] font-bold text-[32px] print:text-black">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- REPORT TABLE -->
    <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)] print:shadow-none print:border-none print:bg-transparent print:rounded-none">

        <div class="p-6 border-b border-[#1A233A] print:hidden">
            <h3 class="font-['Orbitron'] text-white font-bold text-[18px]">{{ $title }}</h3>
        </div>

        <div class="overflow-x-auto print:overflow-visible">
            <table class="w-full text-left whitespace-nowrap print:border-collapse print:border print:border-black print:w-full">
                <thead class="bg-[#03060D] border-b border-[#1A233A] text-[#8A99B5] text-[10px] font-bold font-['Rajdhani'] uppercase tracking-[2px] print:bg-gray-200 print:text-black print:border-black">
                    <tr>
                        <th class="px-6 py-5 print:py-3 print:border print:border-black">Tanggal</th>
                        <th class="px-6 py-5 print:py-3 print:border print:border-black">Order ID</th>
                        <th class="px-6 py-5 print:py-3 print:border print:border-black">Pelanggan</th>
                        <th class="px-6 py-5 print:py-3 print:border print:border-black">Unit Konsol</th>
                        <th class="px-6 py-5 text-right print:py-3 print:border print:border-black">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] text-white print:text-black">
                    @forelse($bookings as $item)
                    <tr class="border-b border-[#1A233A]/40 hover:bg-[#1A233A]/20 print:border-black print:hover:bg-transparent">
                        <td class="px-6 py-4 print:py-2 print:border print:border-black">
                            {{ \Carbon\Carbon::parse($item->booking_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 font-['Orbitron'] text-[#00e5ff] font-bold text-[13px] print:text-black print:py-2 print:border print:border-black">
                            #TRX-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-6 py-4 print:py-2 print:border print:border-black">
                            <div class="font-bold">{{ $item->user->name ?? 'Unknown' }}</div>
                        </td>
                        <td class="px-6 py-4 print:py-2 print:border print:border-black">
                            {{ $item->playstation->name ?? 'Unit Dihapus' }}
                        </td>
                        <td class="px-6 py-4 text-right font-['Orbitron'] font-bold text-[#10b981] print:text-black print:py-2 print:border print:border-black">
                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center print:border print:border-black print:py-8">
                            <p class="text-[#8A99B5] text-[12px] uppercase tracking-[1px] print:text-black">Tidak ada transaksi yang tercatat pada periode ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- CSS KHUSUS UNTUK PRINTER -->
<style>
    @media print {
        @page { size: A4 portrait; margin: 1.5cm; }
        body * { visibility: hidden; }
        .print\:max-w-full { max-width: 100% !important; }
        .print\:p-0 { padding: 0 !important; }
        .print\:m-0 { margin: 0 !important; }
        .print\:border-none { border: none !important; }
        .print\:bg-transparent { background: transparent !important; }
        .print\:shadow-none { box-shadow: none !important; }
        .print\:hidden { display: none !important; }
        .print\:block { display: block !important; visibility: visible; }
        .print\:flex { display: flex !important; visibility: visible; }
        .print\:text-black { color: #000 !important; visibility: visible; }
        .print\:text-gray-500 { color: #6b7280 !important; visibility: visible; }
        .print\:text-gray-600 { color: #4b5563 !important; visibility: visible; }
        .print\:bg-gray-200 { background-color: #e5e7eb !important; visibility: visible; }
        .print\:border-black { border-color: #000 !important; }

        /* Render specific elements visible */
        .max-w-\[1400px\] { visibility: visible; position: absolute; left: 0; top: 0; width: 100%; }
        .max-w-\[1400px\] * { visibility: visible; }

        /* Force background white and text black to save ink */
        body { background-color: white !important; }
        table { width: 100% !important; }
        th, td { border: 1px solid black !important; color: black !important; }
    }
</style>
@endsection
