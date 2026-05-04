@extends('layouts.admin')

@section('title', 'Main Dashboard - Admin')

@section('content')
<!-- Ambient Glow Background -->
<div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-[#00e5ff]/5 blur-[120px] pointer-events-none -z-10"></div>

<div class="max-w-[1400px] mx-auto pb-12">

    <!-- WELCOME BANNER -->
    <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-8 rounded-[24px] mb-8 relative overflow-hidden group">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#00e5ff]/10 blur-[60px] rounded-full group-hover:bg-[#00e5ff]/20 transition-all duration-700"></div>
        <div class="relative z-10">
            <h1 class="text-3xl md:text-[32px] font-black text-white font-['Orbitron'] tracking-wide mb-2">
                Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">{{ Auth::user()->name }}!</span>
            </h1>
            <p class="text-[#8A99B5] text-[14px] max-w-[600px] leading-relaxed">
                Semoga hari ini berjalan lancar. Sistem rental beroperasi normal. Ada <strong class="text-white">{{ \App\Models\Booking::whereIn('status', ['Pending', 'pending'])->count() }} transaksi baru</strong> yang menunggu konfirmasi Anda.
            </p>
        </div>
    </div>

    <!-- QUICK STATS WIDGET -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#03060D] border border-[#1A233A] p-6 rounded-[20px] relative overflow-hidden">
            <div class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-2">Total Unit</div>
            <div class="text-white font-['Orbitron'] font-bold text-[32px]">{{ $totalProducts }} <span class="text-[12px] text-[#8A99B5] font-['Inter']">Unit</span></div>
        </div>

        <div class="bg-[#03060D] border border-[#1A233A] p-6 rounded-[20px] relative overflow-hidden">
            <div class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-2">Booking Aktif/Pending</div>
            <div class="text-[#f59e0b] font-['Orbitron'] font-bold text-[32px]">{{ $activeBookings }} <span class="text-[12px] text-[#8A99B5] font-['Inter']">Sesi</span></div>
        </div>

        <div class="bg-[#03060D] border border-[#1A233A] p-6 rounded-[20px] relative overflow-hidden shadow-[0_0_20px_rgba(0,229,255,0.05)] border-b-2 border-b-[#00e5ff]">
            <div class="text-[#00e5ff] text-[11px] uppercase tracking-[2px] font-bold mb-2">Pendapatan Bulan Ini</div>
            <div class="text-white font-['Orbitron'] font-bold text-[32px] truncate">
                Rp
                @php
                    if ($revenueThisMonth >= 1000000) {
                        echo number_format($revenueThisMonth / 1000000, 1) . '<span class="text-[14px] text-[#8A99B5] font-[\'Inter\'] ml-1">M</span>';
                    } elseif ($revenueThisMonth >= 1000) {
                        echo number_format($revenueThisMonth / 1000, 0) . '<span class="text-[14px] text-[#8A99B5] font-[\'Inter\'] ml-1">K</span>';
                    } else {
                        echo number_format($revenueThisMonth, 0, ',', '.');
                    }
                @endphp
            </div>
        </div>

        <div class="bg-[#03060D] border border-[#1A233A] p-6 rounded-[20px] relative overflow-hidden">
            <div class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-2">Total Pelanggan</div>
            <div class="text-white font-['Orbitron'] font-bold text-[32px]">{{ $totalUsers }} <span class="text-[12px] text-[#8A99B5] font-['Inter']">User</span></div>
        </div>
    </div>

    <!-- MAIN DASHBOARD CONTENT (STACKED VERTICALLY) -->
    <div class="flex flex-col gap-8">

        <!-- CHART SECTION (FULL WIDTH) -->
        <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] p-6 shadow-[0_10px_40px_rgba(0,0,0,0.3)]">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="font-['Orbitron'] text-white font-bold text-[18px]">Grafik Pendapatan</h3>
                    <p class="text-[#8A99B5] text-[12px]">Performa omset rental 7 hari terakhir.</p>
                </div>
                <div class="px-4 py-1.5 bg-[#00e5ff]/10 text-[#00e5ff] border border-[#00e5ff]/30 rounded-lg text-[10px] font-bold uppercase tracking-[1px]">7 Days</div>
            </div>
            <div class="relative h-[320px] w-full">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- RECENT BOOKINGS TABLE (FULL WIDTH) -->
        <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)]">
            <div class="p-6 border-b border-[#1A233A] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="font-['Orbitron'] text-white font-bold text-[18px] flex items-center gap-3">
                        Aktivitas Terkini
                        <span class="flex h-2.5 w-2.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#10b981] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#10b981]"></span>
                        </span>
                    </h3>
                    <p class="text-[#8A99B5] text-[12px] mt-1">5 transaksi terakhir yang baru saja masuk ke sistem.</p>
                </div>
                <a href="{{ route('admin.bookings.index') }}" class="px-5 py-2.5 bg-[#1A233A] border border-[#1A233A] text-[#8A99B5] hover:border-[#00e5ff]/50 hover:text-white rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all flex items-center gap-2">
                    Lihat Semua Data
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="bg-[#03060D] border-b border-[#1A233A] text-[#8A99B5] text-[10px] font-bold font-['Rajdhani'] uppercase tracking-[2px]">
                        <tr>
                            <th class="px-6 py-5">Order ID</th>
                            <th class="px-6 py-5">Pelanggan</th>
                            <th class="px-6 py-5">Detail Sewa</th>
                            <th class="px-6 py-5 text-center">Payment</th>
                            <th class="px-6 py-5 text-right">Manajemen Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13px] text-white">
                        @forelse($recentBookings as $item)
                        <tr class="border-b border-[#1A233A]/40 hover:bg-[#1A233A]/20 transition-colors group">
                            <!-- 1. Order ID & Date -->
                            <td class="px-6 py-5">
                                <div class="font-['Orbitron'] text-[#00e5ff] font-bold text-[14px] group-hover:drop-shadow-[0_0_8px_rgba(0,229,255,0.5)] transition-all">#TRX-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</div>
                                <div class="text-[#8A99B5] text-[10px] mt-1.5 flex items-center gap-1.5">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    {{ $item->created_at->diffForHumans() }}
                                </div>
                            </td>

                            <!-- 2. Pelanggan -->
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1A233A] flex items-center justify-center text-[#8A99B5] font-bold text-[11px] uppercase">
                                        {{ substr($item->user->name ?? '?', 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-[13px]">{{ $item->user->name ?? 'Unknown User' }}</div>
                                        <div class="text-[#8A99B5] text-[11px]">{{ $item->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- 3. Konsol & Jam -->
                            <td class="px-6 py-5">
                                <div class="font-bold text-[14px] mb-1.5 text-white">{{ $item->playstation->name ?? 'Unit Dihapus' }}</div>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-[#8A99B5] text-[11px]"><strong class="text-white">{{ \Carbon\Carbon::parse($item->booking_date)->format('d M') }}</strong></span>
                                    <span class="w-1 h-1 bg-[#1A233A] rounded-full"></span>
                                    <span class="text-[#00e5ff] text-[11px] font-['Orbitron'] font-bold">Rp {{ number_format($item->total_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex gap-1.5 flex-wrap w-[200px]">
                                    @foreach(json_decode($item->start_time) ?? [] as $jam)
                                        <span class="bg-[#03060D] border border-[#1A233A] px-2 py-0.5 rounded-md text-[10px] text-[#8A99B5] font-bold font-['Rajdhani']">{{ $jam }}</span>
                                    @endforeach
                                </div>
                            </td>

                            <!-- 4. Bukti Bayar -->
                            <td class="px-6 py-5 text-center">
                                @if($item->payment_proof)
                                    <a href="{{ asset('storage/' . $item->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 bg-[#00e5ff]/10 text-[#00e5ff] border border-[#00e5ff]/30 rounded-lg text-[10px] font-bold uppercase tracking-[1px] hover:bg-[#00e5ff] hover:text-black hover:shadow-[0_0_15px_rgba(0,229,255,0.4)] transition-all">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                        Lihat Struk
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#03060D] border border-[#1A233A] text-[#8A99B5]/50 rounded-lg text-[10px] uppercase font-bold tracking-[1px]">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                        Waiting
                                    </span>
                                @endif
                            </td>

                            <!-- 5. Aksi Status & Delete -->
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.bookings.status', $item->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf @method('PATCH')
                                        <div class="relative">
                                            @php
                                                $dotColor = 'bg-[#8A99B5]';
                                                if(strtolower($item->status) == 'pending') $dotColor = 'bg-[#f59e0b]';
                                                if(strtolower($item->status) == 'active') $dotColor = 'bg-[#10b981] shadow-[0_0_10px_#10b981]';
                                                if(strtolower($item->status) == 'cancelled' || strtolower($item->status) == 'dibatalkan') $dotColor = 'bg-[#ff3366]';
                                                if(strtolower($item->status) == 'completed') $dotColor = 'bg-[#00e5ff]';
                                            @endphp
                                            <div class="absolute left-3 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full {{ $dotColor }}"></div>
                                            <select name="status" class="pl-7 pr-8 py-2 bg-[#03060D] border border-[#1A233A] text-white text-[11px] font-bold uppercase tracking-[1px] rounded-lg outline-none focus:border-[#00e5ff] appearance-none cursor-pointer hover:border-[#8A99B5] transition-colors">
                                                <option value="Pending" {{ strtolower($item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Active" {{ strtolower($item->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="Completed" {{ strtolower($item->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="Cancelled" {{ strtolower($item->status) == 'cancelled' || strtolower($item->status) == 'dibatalkan' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#8A99B5]">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                            </div>
                                        </div>
                                        <button type="submit" class="p-2 bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#00e5ff] hover:bg-[#00e5ff] hover:text-black rounded-lg transition-all" title="Update Status">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.bookings.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus permanen data transaksi ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] hover:bg-[#ff3366] hover:text-white rounded-lg transition-all" title="Hapus Transaksi">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-[#1A233A]/30 border border-[#1A233A] flex items-center justify-center mb-4 text-[#8A99B5]">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line></svg>
                                    </div>
                                    <h3 class="text-white font-['Orbitron'] font-bold text-[16px] tracking-[1px] mb-1">RADAR BERSIH</h3>
                                    <p class="text-[#8A99B5] text-[12px] uppercase tracking-[1px]">Belum ada aktivitas terbaru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- IMPORT CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($chartDates);
    const dataValues = @json($chartData);

    const ctx = document.getElementById('revenueChart').getContext('2d');

    let gradient = ctx.createLinearGradient(0, 0, 0, 320);
    gradient.addColorStop(0, 'rgba(0, 229, 255, 0.5)');
    gradient.addColorStop(1, 'rgba(0, 229, 255, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: dataValues,
                borderColor: '#00e5ff',
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#0B1221',
                pointBorderColor: '#00e5ff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0B1221',
                    titleColor: '#8A99B5',
                    bodyColor: '#00e5ff',
                    borderColor: '#1A233A',
                    borderWidth: 1,
                    padding: 10,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            let value = context.raw || 0;
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: '#1A233A', drawBorder: false },
                    ticks: { color: '#8A99B5', font: { family: 'Rajdhani', size: 11 } }
                },
                y: {
                    grid: { color: '#1A233A', drawBorder: false, borderDash: [5, 5] },
                    ticks: {
                        color: '#8A99B5',
                        font: { family: 'Rajdhani', size: 11 },
                        callback: function(value) {
                            if(value >= 1000000) return (value / 1000000) + 'M';
                            if(value >= 1000) return (value / 1000) + 'K';
                            return value;
                        }
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
