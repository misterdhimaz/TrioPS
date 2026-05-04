@extends('layouts.admin')

@section('title', 'Command Center - Admin')

@section('content')
<!-- Ambient Glow Background -->
<div class="fixed top-0 right-0 w-[800px] h-[400px] bg-[#00e5ff]/5 blur-[120px] pointer-events-none -z-10"></div>

<div class="max-w-[1400px] mx-auto pb-12">

    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#00e5ff]/10 border border-[#00e5ff]/30 mb-3">
                </div>
            <h1 class="text-3xl md:text-[36px] font-black text-white font-['Orbitron'] tracking-wide">
                TRANSACTION <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">RADAR</span>
            </h1>
            <p class="text-[#8A99B5] text-[13px] mt-1 font-['Inter']">Pantau semua antrean, verifikasi pembayaran, dan atur status unit.</p>
        </div>
    </div>

    <!-- QUICK STATS WIDGET (Menggunakan $allBookings agar tidak berubah saat filter) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 rounded-2xl flex items-center justify-between group hover:border-[#00e5ff]/30 transition-colors">
            <div>
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-1">Total Orders</div>
                <div class="text-white font-['Orbitron'] font-bold text-[24px]">{{ $allBookings->count() }}</div>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] flex items-center justify-center group-hover:bg-[#00e5ff]/10 group-hover:text-[#00e5ff] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </div>
        </div>

        <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 rounded-2xl flex items-center justify-between group hover:border-[#f59e0b]/30 transition-colors">
            <div>
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-1">Need Verify</div>
                <div class="text-[#f59e0b] font-['Orbitron'] font-bold text-[24px]">{{ $allBookings->where('status', 'Pending')->count() + $allBookings->where('status', 'pending')->count() }}</div>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] flex items-center justify-center group-hover:bg-[#f59e0b]/10 group-hover:text-[#f59e0b] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
        </div>

        <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 rounded-2xl flex items-center justify-between group hover:border-[#10b981]/30 transition-colors">
            <div>
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-1">Active Now</div>
                <div class="text-[#10b981] font-['Orbitron'] font-bold text-[24px]">{{ $allBookings->where('status', 'Active')->count() + $allBookings->where('status', 'active')->count() }}</div>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] flex items-center justify-center group-hover:bg-[#10b981]/10 group-hover:text-[#10b981] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
            </div>
        </div>

        <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 rounded-2xl flex items-center justify-between group hover:border-[#00e5ff]/30 transition-colors">
            <div>
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-1">Total Revenue</div>
                <div class="text-white font-['Orbitron'] font-bold text-[20px] truncate max-w-[100px]">
                    @php
                        $revenue = $allBookings->filter(function($q) {
                            return in_array(strtolower($q->status), ['completed', 'active']);
                        })->sum('total_price');
                    @endphp
                    {{ number_format($revenue / 1000, 0) }}K
                </div>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] flex items-center justify-center group-hover:bg-[#00e5ff]/10 group-hover:text-[#00e5ff] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
        </div>
    </div>

    <!-- GLOBAL ALERTS -->
    @if(session('success'))
    <div class="bg-[#10b981]/10 border border-[#10b981]/30 text-[#10b981] p-4 rounded-xl mb-6 text-[13px] font-bold flex items-center gap-3">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- FILTER TABS SYSTEM -->
    <div class="flex flex-wrap items-center gap-2 mb-6">
        <a href="{{ route('admin.bookings.index') }}"
           class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all {{ $currentFilter == 'All' ? 'bg-[#00e5ff] text-black shadow-[0_0_15px_rgba(0,229,255,0.3)]' : 'bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#00e5ff]/50 hover:text-white' }}">
            Semua Data
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'Pending']) }}"
           class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all flex items-center gap-2 {{ $currentFilter == 'Pending' ? 'bg-[#f59e0b] text-black shadow-[0_0_15px_rgba(245,158,11,0.3)]' : 'bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#f59e0b]/50 hover:text-white' }}">
           @if($currentFilter == 'Pending') <span class="w-1.5 h-1.5 rounded-full bg-black"></span> @endif Booking Masuk
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'Active']) }}"
           class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all flex items-center gap-2 {{ $currentFilter == 'Active' ? 'bg-[#10b981] text-black shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#10b981]/50 hover:text-white' }}">
           @if($currentFilter == 'Active') <span class="w-1.5 h-1.5 rounded-full bg-black"></span> @endif Active
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'Completed']) }}"
           class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all flex items-center gap-2 {{ $currentFilter == 'Completed' ? 'bg-[#00e5ff] text-black shadow-[0_0_15px_rgba(0,229,255,0.3)]' : 'bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#00e5ff]/50 hover:text-white' }}">
           @if($currentFilter == 'Completed') <span class="w-1.5 h-1.5 rounded-full bg-black"></span> @endif Selesai
        </a>
    </div>

    <!-- MAIN DATA TABLE -->
    <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)] relative">
        <!-- Overlay jika sedang loading (opsional, untuk kosmetik) -->
        <div class="absolute inset-0 bg-[#0B1221]/50 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity" id="table-loader">
            <div class="w-8 h-8 border-2 border-[#00e5ff] border-t-transparent rounded-full animate-spin"></div>
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
                    @forelse($bookings as $item)
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

                                    <button type="submit" onclick="document.getElementById('table-loader').classList.remove('opacity-0')" class="p-2 bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#00e5ff] hover:bg-[#00e5ff] hover:text-black rounded-lg transition-all" title="Update Status">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    </button>
                                </form>

                                <form action="{{ route('admin.bookings.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Sistem Peringatan: Anda yakin ingin menghapus permanen data transaksi ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="document.getElementById('table-loader').classList.remove('opacity-0')" class="p-2 bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] hover:bg-[#ff3366] hover:text-white rounded-lg transition-all" title="Hapus Transaksi">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <!-- EMPTY STATE SCIFI DESIGN -->
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-full bg-[#1A233A]/30 border border-[#1A233A] flex items-center justify-center mb-4 text-[#8A99B5]">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line></svg>
                                </div>
                                <h3 class="text-white font-['Orbitron'] font-bold text-[16px] tracking-[1px] mb-1">TIDAK ADA DATA</h3>
                                <p class="text-[#8A99B5] text-[12px] uppercase tracking-[1px]">
                                    @if($currentFilter == 'All')
                                        Belum ada riwayat transaksi masuk.
                                    @else
                                        Tidak ada transaksi dengan status <span class="text-white font-bold">{{ $currentFilter }}</span>.
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
