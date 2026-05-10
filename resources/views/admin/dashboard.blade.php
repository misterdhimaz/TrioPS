@extends('layouts.admin')

@section('title', 'Main Dashboard - Admin')

@section('content')

@php
    // Hitung Gabungan Stats Akurat
    $allBookings = \App\Models\Booking::all();
    $allVips = \App\Models\PlanSubscription::all();

    $activeBookingsCount = $allBookings->whereIn('status', ['Pending', 'pending', 'Active', 'active'])->count();
    $activeVipsCount = $allVips->whereIn('status', ['Pending', 'pending', 'Active', 'active'])->count();
    $realActiveSesi = $activeBookingsCount + $activeVipsCount;

    $now = \Carbon\Carbon::now('Asia/Jakarta');
    $revReg = $allBookings->filter(function($q) use ($now) {
        return in_array(strtolower($q->status), ['completed', 'active']) && \Carbon\Carbon::parse($q->created_at)->isSameMonth($now);
    })->sum('total_price');
    $revVip = $allVips->filter(function($q) use ($now) {
        return in_array(strtolower($q->status), ['completed', 'active']) && \Carbon\Carbon::parse($q->created_at)->isSameMonth($now);
    })->sum('price_snapshot');
    $realRevenueThisMonth = $revReg + $revVip;

    // Tarik 5 Aktivitas Terbaru Gabungan
    $recentCombined = collect();
    foreach(\App\Models\Booking::with(['user', 'playstation'])->latest()->take(5)->get() as $b) {
        $recentCombined->push((object)[
            'type' => 'regular',
            'id' => $b->id,
            'sort_date' => $b->created_at,
            'created_at' => $b->created_at,
            'status' => $b->status,
            'user' => $b->user,
            'item_name' => $b->playstation->name ?? 'Unit Dihapus',
            'booking_date' => $b->booking_date,
            'start_time' => $b->start_time,
            'price' => $b->total_price,
            'payment_proof' => $b->payment_proof,
            'color' => 'text-[#00e5ff]',
            'badge' => 'TRX'
        ]);
    }
    foreach(\App\Models\PlanSubscription::with(['user', 'pricingPlan'])->latest()->take(5)->get() as $v) {
        $recentCombined->push((object)[
            'type' => 'vip',
            'id' => $v->id,
            'sort_date' => $v->created_at,
            'created_at' => $v->created_at,
            'status' => $v->status,
            'user' => $v->user,
            'item_name' => $v->pricingPlan->title ?? 'VIP Plan',
            'booking_date' => $v->start_date,
            'start_time' => '["VIP"]',
            'price' => $v->price_snapshot,
            'payment_proof' => $v->payment_proof,
            'color' => 'text-[#f59e0b]',
            'badge' => 'VIP'
        ]);
    }
    $recentCombined = $recentCombined->sortByDesc('sort_date')->take(5);
@endphp

<div class="fixed top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-[#00e5ff]/5 blur-[120px] pointer-events-none -z-10"></div>

<div class="max-w-[1400px] mx-auto pb-12">

    <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-8 rounded-[24px] mb-8 relative overflow-hidden group shadow-[0_10px_40px_rgba(0,0,0,0.3)]">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#00e5ff]/10 blur-[60px] rounded-full group-hover:bg-[#00e5ff]/20 transition-all duration-700"></div>
        <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-[#00e5ff] to-[#0066ff]"></div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="text-3xl md:text-[32px] font-black text-white font-['Orbitron'] tracking-wide mb-2">
                    Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">{{ Auth::user()->name }}!</span>
                </h1>
                <p class="text-[#8A99B5] text-[14px] max-w-[600px] leading-relaxed">
                    Sistem Radar Trio Infinity beroperasi normal. Ada <strong class="text-white">{{ \App\Models\Booking::whereIn('status', ['Pending', 'pending'])->count() + \App\Models\PlanSubscription::whereIn('status', ['Pending', 'pending'])->count() }} transaksi baru</strong> yang menunggu konfirmasi Anda hari ini.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 bg-[#03060D] border border-[#1A233A] rounded-xl flex items-center gap-3 shadow-inner">
                    <div class="w-2.5 h-2.5 rounded-full bg-[#10b981] animate-pulse shadow-[0_0_10px_#10b981]"></div>
                    <span class="text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px]">System Online</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#03060D] border border-[#1A233A] p-6 rounded-[20px] relative overflow-hidden group hover:border-[#10b981]/50 transition-all">
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity"><svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/></svg></div>
            <div class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-2">Total Unit Konsol</div>
            <div class="text-white font-['Orbitron'] font-bold text-[32px]">{{ $totalProducts }} <span class="text-[12px] text-[#8A99B5] font-['Inter']">Unit</span></div>
        </div>

        <div class="bg-[#03060D] border border-[#1A233A] p-6 rounded-[20px] relative overflow-hidden group hover:border-[#f59e0b]/50 transition-all">
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity"><svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></div>
            <div class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-2">Sesi Aktif / Pending</div>
            <div class="text-[#f59e0b] font-['Orbitron'] font-bold text-[32px]">{{ $realActiveSesi }} <span class="text-[12px] text-[#8A99B5] font-['Inter']">Sesi</span></div>
        </div>

        <div class="bg-[#03060D] border border-[#1A233A] p-6 rounded-[20px] relative overflow-hidden shadow-[0_0_20px_rgba(0,229,255,0.05)] border-b-2 border-b-[#00e5ff] group">
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity"><svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#00e5ff" stroke-width="2"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
            <div class="text-[#00e5ff] text-[11px] uppercase tracking-[2px] font-bold mb-2">Pendapatan Bulan Ini</div>
            <div class="text-white font-['Orbitron'] font-bold text-[32px] truncate">
                Rp
                @php
                    if ($realRevenueThisMonth >= 1000000) {
                        echo number_format($realRevenueThisMonth / 1000000, 1) . '<span class="text-[14px] text-[#8A99B5] font-[\'Inter\'] ml-1">M</span>';
                    } elseif ($realRevenueThisMonth >= 1000) {
                        echo number_format($realRevenueThisMonth / 1000, 0) . '<span class="text-[14px] text-[#8A99B5] font-[\'Inter\'] ml-1">K</span>';
                    } else {
                        echo number_format($realRevenueThisMonth, 0, ',', '.');
                    }
                @endphp
            </div>
        </div>

        <div class="bg-[#03060D] border border-[#1A233A] p-6 rounded-[20px] relative overflow-hidden group hover:border-[#ff3366]/50 transition-all">
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity"><svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#ff3366" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
            <div class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-2">Total Pelanggan</div>
            <div class="text-white font-['Orbitron'] font-bold text-[32px]">{{ $totalUsers }} <span class="text-[12px] text-[#8A99B5] font-['Inter']">User</span></div>
        </div>
    </div>

    <div class="flex flex-col gap-8">

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

        <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)] relative">
            <div class="p-6 border-b border-[#1A233A] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="font-['Orbitron'] text-white font-bold text-[18px] flex items-center gap-3">
                        Aktivitas Terkini (Unified Radar)
                        <span class="flex h-2.5 w-2.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#10b981] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-[#10b981]"></span>
                        </span>
                    </h3>
                    <p class="text-[#8A99B5] text-[12px] mt-1">5 transaksi gabungan terakhir (Sewa Regular & Layanan VIP).</p>
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
                            <th class="px-6 py-5">Detail Sewa / Paket</th>
                            <th class="px-6 py-5 text-center">Payment</th>
                            <th class="px-6 py-5 text-right">Manajemen Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13px] text-white">
                        @forelse($recentCombined as $item)
                        <tr class="border-b border-[#1A233A]/40 hover:bg-[#1A233A]/20 transition-colors group">

                            <td class="px-6 py-5">
                                <div class="font-['Orbitron'] {{ $item->color }} font-bold text-[14px] group-hover:opacity-80 transition-all">
                                    #{{ $item->badge }}-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </div>
                                <div class="text-[#8A99B5] text-[10px] mt-1.5 flex items-center gap-1.5">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </div>
                            </td>

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

                            <td class="px-6 py-5">
                                <div class="font-bold text-[14px] mb-1.5 text-white">{{ $item->item_name }}</div>
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-[#8A99B5] text-[11px]"><strong class="text-white">{{ \Carbon\Carbon::parse($item->booking_date)->format('d M') }}</strong></span>
                                    <span class="w-1 h-1 bg-[#1A233A] rounded-full"></span>
                                    <span class="{{ $item->color }} text-[11px] font-['Orbitron'] font-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex gap-1.5 flex-wrap w-[200px]">
                                    @foreach(json_decode($item->start_time) ?? [] as $jam)
                                        <span class="bg-[#03060D] border border-[#1A233A] px-2 py-0.5 rounded-md text-[10px] text-[#8A99B5] font-bold font-['Rajdhani']">{{ $jam }}</span>
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                @if($item->payment_proof)
                                    <button type="button" onclick="openModal('modal-bukti-{{ $item->type }}-{{ $item->id }}')" class="inline-flex items-center gap-2 px-3 py-2 {{ $item->type == 'regular' ? 'bg-[#00e5ff]/10 text-[#00e5ff] border-[#00e5ff]/30 hover:bg-[#00e5ff]' : 'bg-[#f59e0b]/10 text-[#f59e0b] border-[#f59e0b]/30 hover:bg-[#f59e0b]' }} border rounded-lg text-[10px] font-bold uppercase tracking-[1px] hover:text-black transition-all">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                        Lihat Bukti
                                    </button>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#03060D] border border-[#1A233A] text-[#8A99B5]/50 rounded-lg text-[10px] uppercase font-bold tracking-[1px]">
                                        Waiting
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-2">

                                    @if(in_array(strtolower($item->status), ['active', 'completed', 'approved']))
                                        @php
                                            $printRoute = $item->type == 'regular' ? route('booking.receipt', $item->id) : route('vip.receipt', $item->id);
                                        @endphp
                                        <button type="button" onclick="openModal('modal-nota-{{ $item->type }}-{{ $item->id }}')" title="Preview Nota" class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#10b981]/10 hover:bg-[#10b981] border border-[#10b981]/30 text-[#10b981] hover:text-black rounded-lg text-[10px] font-bold uppercase tracking-[1px] transition-all">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg>
                                            Nota
                                        </button>
                                    @endif

                                    <form action="{{ $item->type == 'regular' ? route('admin.bookings.status', $item->id) : route('admin.vip.status', $item->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf @method('PATCH')
                                        <div class="relative">
                                            @php
                                                $dotColor = 'bg-[#8A99B5]';
                                                if(strtolower($item->status) == 'pending') $dotColor = 'bg-[#f59e0b]';
                                                if(strtolower($item->status) == 'active' || strtolower($item->status) == 'approved') $dotColor = 'bg-[#10b981] shadow-[0_0_10px_#10b981]';
                                                if(strtolower($item->status) == 'cancelled' || strtolower($item->status) == 'dibatalkan') $dotColor = 'bg-[#ff3366]';
                                                if(strtolower($item->status) == 'completed') $dotColor = 'bg-[#00e5ff]';
                                            @endphp
                                            <div class="absolute left-3 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full {{ $dotColor }}"></div>
                                            <select name="status" class="pl-7 pr-8 py-2 bg-[#03060D] border border-[#1A233A] text-white text-[11px] font-bold uppercase tracking-[1px] rounded-lg outline-none focus:border-{{ $item->type == 'regular' ? '[#00e5ff]' : '[#f59e0b]' }} appearance-none cursor-pointer hover:border-[#8A99B5] transition-colors">
                                                <option value="Pending" {{ strtolower($item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Active" {{ in_array(strtolower($item->status), ['active', 'approved']) ? 'selected' : '' }}>Active</option>
                                                <option value="Completed" {{ strtolower($item->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="Cancelled" {{ strtolower($item->status) == 'cancelled' || strtolower($item->status) == 'dibatalkan' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#8A99B5]"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                        </div>
                                        <button type="submit" class="p-2 {{ $item->type == 'regular' ? 'bg-[#00e5ff]/10 border-[#00e5ff]/30 text-[#00e5ff] hover:bg-[#00e5ff]' : 'bg-[#f59e0b]/10 border-[#f59e0b]/30 text-[#f59e0b] hover:bg-[#f59e0b]' }} hover:text-black border rounded-lg transition-all" title="Update Status">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </button>
                                    </form>

                                    <form action="{{ $item->type == 'regular' ? route('admin.bookings.destroy', $item->id) : route('admin.vip.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus permanen data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] hover:bg-[#ff3366] hover:text-white rounded-lg transition-all" title="Hapus Data">
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

@foreach($recentCombined as $item)

    @if($item->payment_proof)
    <div id="modal-bukti-{{ $item->type }}-{{ $item->id }}" class="fixed inset-0 w-screen h-screen z-[99999] hidden items-center justify-center bg-[#03050A]/90 backdrop-blur-md">
        <div class="bg-[#0B1221] border border-{{ $item->type == 'regular' ? '[#00e5ff]' : '[#f59e0b]' }}/30 rounded-2xl p-6 max-w-lg w-full mx-4 shadow-[0_0_50px_rgba(0,0,0,0.5)] relative">
            <button type="button" onclick="closeModal('modal-bukti-{{ $item->type }}-{{ $item->id }}')" class="absolute top-4 right-4 p-2 text-[#8A99B5] hover:text-[#ff3366] hover:bg-[#ff3366]/10 rounded-lg transition-colors z-50">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <h3 class="{{ $item->color }} font-['Orbitron'] font-bold text-lg mb-4 flex items-center gap-2">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                BUKTI - #{{ $item->badge }}-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
            </h3>
            <div class="rounded-xl overflow-hidden border border-[#1A233A] bg-black flex justify-center items-center min-h-[300px]">
                <img src="{{ asset('storage/' . $item->payment_proof) }}" class="w-full max-h-[70vh] object-contain">
            </div>
        </div>
    </div>
    @endif

    @if(in_array(strtolower($item->status), ['active', 'completed', 'approved']))
    @php
        $printRoute = $item->type == 'regular' ? route('booking.receipt', $item->id) : route('vip.receipt', $item->id);
    @endphp
    <div id="modal-nota-{{ $item->type }}-{{ $item->id }}" class="fixed inset-0 w-screen h-screen z-[99999] hidden items-center justify-center bg-[#03050A]/90 backdrop-blur-md">
        <div class="bg-[#0B1221] border border-{{ $item->type == 'regular' ? '[#00e5ff]' : '[#f59e0b]' }}/50 rounded-2xl w-full max-w-md mx-4 shadow-[0_0_50px_rgba(0,0,0,0.5)] flex flex-col relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-{{ $item->type == 'regular' ? '[#00e5ff]' : '[#f59e0b]' }} to-transparent"></div>

            <div class="flex items-center justify-between p-5 border-b border-[#1A233A] bg-[#03060D]">
                <h3 class="{{ $item->color }} font-['Orbitron'] font-bold text-[15px] tracking-[2px] uppercase w-full text-center">
                    PREVIEW NOTA #{{ $item->badge }}-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                </h3>
                <button type="button" onclick="closeModal('modal-nota-{{ $item->type }}-{{ $item->id }}')" class="absolute right-4 text-[#8A99B5] hover:text-[#ff3366] transition-colors p-2 rounded-lg bg-[#1A233A]/50">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="p-6">
                <div class="border border-[#10b981]/30 bg-[#0B1221] rounded-xl p-6 relative overflow-hidden shadow-[inset_0_0_20px_rgba(16,185,129,0.05)]">
                    <div class="flex justify-between items-center mb-6 border-b border-[#1A233A] pb-4">
                        <div class="text-[#8A99B5] text-xs uppercase tracking-widest font-bold">Layanan</div>
                        <div class="text-white font-bold text-sm text-right">{{ $item->item_name }}</div>
                    </div>
                    <div class="bg-[#1A233A]/30 rounded-lg p-5 flex justify-between items-center border border-[#1A233A]">
                        <div class="text-white font-bold tracking-widest uppercase text-xs">TOTAL<br>KESELURUHAN</div>
                        <div class="{{ $item->color }} font-['Orbitron'] font-bold text-3xl">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="p-5 border-t border-[#1A233A] bg-[#03060D] flex justify-center gap-4">
                <button type="button" onclick="printReceiptSilent('{{ $printRoute }}?print=true'); closeModal('modal-nota-{{ $item->type }}-{{ $item->id }}')" class="px-6 py-3 bg-gradient-to-r {{ $item->type == 'regular' ? 'from-[#00e5ff] to-[#0066ff]' : 'from-[#f59e0b] to-[#ea580c]' }} hover:scale-105 text-white rounded-lg text-xs font-bold uppercase tracking-[1px] transition-all flex items-center gap-2">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    CETAK NOTA ASLI
                </button>
            </div>
        </div>
    </div>
    @endif

@endforeach


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- KONFIGURASI CHART.JS ---
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

    // --- KONFIGURASI MODAL & SILENT PRINT ---
    function openModal(id) {
        const modal = document.getElementById(id);
        if(modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if(modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
            event.target.classList.add('hidden');
            event.target.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }

    function printReceiptSilent(url) {
        let printFrame = document.createElement('iframe');
        printFrame.style.display = 'none';
        printFrame.src = url;
        document.body.appendChild(printFrame);
        printFrame.onload = function() {
            printFrame.contentWindow.focus();
            printFrame.contentWindow.print();
            setTimeout(() => {
                document.body.removeChild(printFrame);
            }, 2000);
        };
    }
</script>
@endsection
