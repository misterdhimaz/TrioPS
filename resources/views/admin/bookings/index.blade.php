@extends('layouts.admin')

@section('title', 'Command Center - Admin')

@section('content')
<div class="fixed top-0 right-0 w-[800px] h-[400px] bg-[#00e5ff]/5 blur-[120px] pointer-events-none -z-10"></div>

<div class="max-w-[1400px] mx-auto pb-12">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#00e5ff]/10 border border-[#00e5ff]/30 mb-3">
                <span class="w-2 h-2 rounded-full bg-[#00e5ff] animate-pulse"></span>
                <span class="text-[#00e5ff] text-[10px] font-bold tracking-[2px] uppercase">Live System</span>
            </div>
            <h1 class="text-3xl md:text-[36px] font-black text-white font-['Orbitron'] tracking-wide">
                TRANSACTION <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">RADAR</span>
            </h1>
            <p class="text-[#8A99B5] text-[13px] mt-1 font-['Inter']">Pantau semua antrean, verifikasi pembayaran, dan atur status unit.</p>
        </div>
    </div>

    @php
        $vipSubscriptions = \App\Models\PlanSubscription::with(['user', 'pricingPlan'])->latest()->get();

        // 1. Total Orders Gabungan
        $totalOrders = $allBookings->count() + $vipSubscriptions->count();

        // 2. Need Verify (Pending) Gabungan
        $pendingReg = $allBookings->filter(function($q) { return strtolower($q->status) == 'pending'; })->count();
        $pendingVip = $vipSubscriptions->filter(function($q) { return strtolower($q->status) == 'pending'; })->count();
        $totalPending = $pendingReg + $pendingVip;

        // 3. Active Now Gabungan
        $activeReg = $allBookings->filter(function($q) { return strtolower($q->status) == 'active'; })->count();
        $activeVip = $vipSubscriptions->filter(function($q) { return strtolower($q->status) == 'active'; })->count();
        $totalActive = $activeReg + $activeVip;

        // 4. Total Revenue Gabungan
        $revReg = $allBookings->filter(function($q) { return in_array(strtolower($q->status), ['completed', 'active']); })->sum('total_price');
        $revVip = $vipSubscriptions->filter(function($q) { return in_array(strtolower($q->status), ['completed', 'active']); })->sum('price_snapshot');
        $totalRevenue = $revReg + $revVip;
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 rounded-2xl flex items-center justify-between group hover:border-[#00e5ff]/30 transition-colors">
            <div>
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-1">Total Orders</div>
                <div class="text-white font-['Orbitron'] font-bold text-[24px]">{{ $totalOrders }}</div>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] flex items-center justify-center group-hover:bg-[#00e5ff]/10 group-hover:text-[#00e5ff] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </div>
        </div>

        <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 rounded-2xl flex items-center justify-between group hover:border-[#f59e0b]/30 transition-colors">
            <div>
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-1">Need Verify</div>
                <div class="text-[#f59e0b] font-['Orbitron'] font-bold text-[24px]">{{ $totalPending }}</div>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] flex items-center justify-center group-hover:bg-[#f59e0b]/10 group-hover:text-[#f59e0b] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
        </div>

        <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 rounded-2xl flex items-center justify-between group hover:border-[#10b981]/30 transition-colors">
            <div>
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-1">Active Now</div>
                <div class="text-[#10b981] font-['Orbitron'] font-bold text-[24px]">{{ $totalActive }}</div>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] flex items-center justify-center group-hover:bg-[#10b981]/10 group-hover:text-[#10b981] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
            </div>
        </div>

        <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 rounded-2xl flex items-center justify-between group hover:border-[#00e5ff]/30 transition-colors">
            <div>
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-1">Total Revenue</div>
                <div class="text-white font-['Orbitron'] font-bold text-[20px] truncate max-w-[100px]">
                    {{ number_format($totalRevenue / 1000, 0) }}K
                </div>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] flex items-center justify-center group-hover:bg-[#00e5ff]/10 group-hover:text-[#00e5ff] transition-colors">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-[#10b981]/10 border border-[#10b981]/30 text-[#10b981] p-4 rounded-xl mb-6 text-[13px] font-bold flex items-center gap-3">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="flex flex-wrap items-center gap-2 mb-6">
        <a href="{{ route('admin.bookings.index') }}" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all {{ $currentFilter == 'All' ? 'bg-[#00e5ff] text-black shadow-[0_0_15px_rgba(0,229,255,0.3)]' : 'bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#00e5ff]/50 hover:text-white' }}">Semua Data</a>
        <a href="{{ route('admin.bookings.index', ['status' => 'Pending']) }}" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all flex items-center gap-2 {{ $currentFilter == 'Pending' ? 'bg-[#f59e0b] text-black shadow-[0_0_15px_rgba(245,158,11,0.3)]' : 'bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#f59e0b]/50 hover:text-white' }}">@if($currentFilter == 'Pending') <span class="w-1.5 h-1.5 rounded-full bg-black"></span> @endif Booking Masuk</a>
        <a href="{{ route('admin.bookings.index', ['status' => 'Active']) }}" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all flex items-center gap-2 {{ $currentFilter == 'Active' ? 'bg-[#10b981] text-black shadow-[0_0_15px_rgba(16,185,129,0.3)]' : 'bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#10b981]/50 hover:text-white' }}">@if($currentFilter == 'Active') <span class="w-1.5 h-1.5 rounded-full bg-black"></span> @endif Active</a>
        <a href="{{ route('admin.bookings.index', ['status' => 'Completed']) }}" class="px-5 py-2.5 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all flex items-center gap-2 {{ $currentFilter == 'Completed' ? 'bg-[#00e5ff] text-black shadow-[0_0_15px_rgba(0,229,255,0.3)]' : 'bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#00e5ff]/50 hover:text-white' }}">@if($currentFilter == 'Completed') <span class="w-1.5 h-1.5 rounded-full bg-black"></span> @endif Selesai</a>
    </div>

    <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)] relative mb-12">
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
                        <td class="px-6 py-5">
                            <div class="font-['Orbitron'] text-[#00e5ff] font-bold text-[14px]">#TRX-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-[#8A99B5] text-[10px] mt-1.5 flex items-center gap-1.5"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> {{ $item->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#1A233A] flex items-center justify-center text-[#8A99B5] font-bold text-[11px] uppercase">{{ substr($item->user->name ?? '?', 0, 2) }}</div>
                                <div>
                                    <div class="font-bold text-[13px]">{{ $item->user->name ?? 'Unknown User' }}</div>
                                    <div class="text-[#8A99B5] text-[11px]">{{ $item->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="font-bold text-[14px] mb-1.5 text-white">{{ $item->playstation->name ?? 'Unit Dihapus' }}</div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-[#8A99B5] text-[11px]"><strong class="text-white">{{ \Carbon\Carbon::parse($item->booking_date)->format('d M') }}</strong></span>
                                <span class="w-1 h-1 bg-[#1A233A] rounded-full"></span>
                                <span class="text-[#00e5ff] text-[11px] font-['Orbitron'] font-bold">Rp {{ number_format($item->total_price, 0, ',', '.') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($item->payment_proof)
                                <button type="button" onclick="openModal('modal-bukti-{{ $item->id }}')" class="inline-flex items-center gap-2 px-3 py-2 bg-[#00e5ff]/10 text-[#00e5ff] border border-[#00e5ff]/30 rounded-lg text-[10px] font-bold uppercase tracking-[1px] hover:bg-[#00e5ff] hover:text-black transition-all"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> Bukti Transfer</button>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#03060D] border border-[#1A233A] text-[#8A99B5]/50 rounded-lg text-[10px] uppercase font-bold tracking-[1px]">Waiting</span>
                            @endif
                         </td>
                         <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                @if(in_array(strtolower($item->status), ['active', 'completed']))
                                    <button type="button" onclick="openModal('modal-nota-{{ $item->id }}')" class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#10b981]/10 hover:bg-[#10b981] border border-[#10b981]/30 text-[#10b981] hover:text-black rounded-lg text-[10px] font-bold uppercase tracking-[1px] transition-all"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Cetak Nota</button>
                                @endif
                                <form action="{{ route('admin.bookings.status', $item->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <select name="status" class="pl-3 pr-8 py-2 bg-[#03060D] border border-[#1A233A] text-white text-[11px] font-bold uppercase tracking-[1px] rounded-lg outline-none focus:border-[#00e5ff] appearance-none cursor-pointer">
                                        <option value="Pending" {{ strtolower($item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Active" {{ strtolower($item->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="Completed" {{ strtolower($item->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Cancelled" {{ strtolower($item->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="p-2 bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#00e5ff] hover:bg-[#00e5ff] hover:text-black rounded-lg transition-all"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg></button>
                                </form>
                                <form action="{{ route('admin.bookings.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] hover:bg-[#ff3366] hover:text-white rounded-lg"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-20 text-center"><h3 class="text-white font-['Orbitron'] font-bold text-[16px] tracking-[1px] mb-1">TIDAK ADA DATA</h3></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex items-center gap-3 mb-6 mt-16">
        <div class="w-1.5 h-6 bg-[#f59e0b] rounded-full shadow-[0_0_10px_#f59e0b]"></div>
        <h2 class="font-['Orbitron'] text-[20px] font-bold text-white tracking-[1px]">VIP PLAN RADAR</h2>
    </div>

    <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)] relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-[#03060D] border-b border-[#1A233A] text-[#8A99B5] text-[10px] font-bold font-['Rajdhani'] uppercase tracking-[2px]">
                    <tr>
                        <th class="px-6 py-5">Order ID</th>
                        <th class="px-6 py-5">Pelanggan</th>
                        <th class="px-6 py-5">Detail Paket</th>
                        <th class="px-6 py-5 text-center">Payment</th>
                        <th class="px-6 py-5 text-right">Manajemen Status</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] text-white">
                    @forelse($vipSubscriptions as $vip)
                    <tr class="border-b border-[#1A233A]/40 hover:bg-[#1A233A]/20 transition-colors group">
                        <td class="px-6 py-5">
                            <div class="font-['Orbitron'] text-[#f59e0b] font-bold text-[14px]">#VIP-{{ str_pad($vip->id, 4, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-[#8A99B5] text-[10px] mt-1.5 flex items-center gap-1.5"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> {{ \Carbon\Carbon::parse($vip->created_at)->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#1A233A] flex items-center justify-center text-[#8A99B5] font-bold text-[11px] uppercase">{{ substr($vip->user->name ?? '?', 0, 2) }}</div>
                                <div>
                                    <div class="font-bold text-[13px]">{{ $vip->user->name ?? 'Unknown User' }}</div>
                                    <div class="text-[#8A99B5] text-[11px]">{{ $vip->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="font-bold text-[14px] mb-1.5 text-white">{{ $vip->pricingPlan->title ?? 'Paket Premium' }}</div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-[#f59e0b] text-[11px] font-['Orbitron'] font-bold">Rp {{ number_format($vip->price_snapshot, 0, ',', '.') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($vip->payment_proof)
                                <button type="button" onclick="openModal('modal-vip-bukti-{{ $vip->id }}')" class="inline-flex items-center gap-2 px-3 py-2 bg-[#f59e0b]/10 text-[#f59e0b] border border-[#f59e0b]/30 rounded-lg text-[10px] font-bold uppercase tracking-[1px] hover:bg-[#f59e0b] hover:text-black transition-all"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> Bukti VIP</button>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#03060D] border border-[#1A233A] text-[#8A99B5]/50 rounded-lg text-[10px] uppercase font-bold tracking-[1px]">Waiting</span>
                            @endif
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                @if(in_array(strtolower($vip->status), ['active', 'completed']))
                                    <button type="button" onclick="openModal('modal-vip-nota-{{ $vip->id }}')" class="inline-flex items-center gap-1.5 px-3 py-2 bg-[#10b981]/10 hover:bg-[#10b981] border border-[#10b981]/30 text-[#10b981] hover:text-black rounded-lg text-[10px] font-bold uppercase tracking-[1px] transition-all"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Cetak Nota</button>
                                @endif
                                <form action="{{ route('admin.vip.status', $vip->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <select name="status" class="pl-3 pr-8 py-2 bg-[#03060D] border border-[#1A233A] text-white text-[11px] font-bold uppercase tracking-[1px] rounded-lg outline-none focus:border-[#f59e0b] appearance-none cursor-pointer">
                                        <option value="Pending" {{ strtolower($vip->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Active" {{ strtolower($vip->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="Completed" {{ strtolower($vip->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Cancelled" {{ strtolower($vip->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="p-2 bg-[#f59e0b]/10 border border-[#f59e0b]/30 text-[#f59e0b] hover:bg-[#f59e0b] hover:text-black rounded-lg transition-all"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg></button>
                                </form>
                                <form action="{{ route('admin.vip.destroy', $vip->id) }}" method="POST" onsubmit="return confirm('Hapus permanen langganan VIP ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] hover:bg-[#ff3366] hover:text-white rounded-lg transition-all"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-20 text-center"><h3 class="text-white font-['Orbitron'] font-bold text-[16px] tracking-[1px] mb-1">TIDAK ADA DATA VIP</h3></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($bookings as $item)
    @if($item->payment_proof)
    <div id="modal-bukti-{{ $item->id }}" class="fixed inset-0 w-screen h-screen z-[99999] hidden items-center justify-center bg-[#03050A]/90 backdrop-blur-md">
        <div class="bg-[#0B1221] border border-[#00e5ff]/30 rounded-2xl p-6 max-w-lg w-full mx-4 shadow-[0_0_50px_rgba(0,229,255,0.2)] relative">
            <button type="button" onclick="closeModal('modal-bukti-{{ $item->id }}')" class="absolute top-4 right-4 p-2 text-[#8A99B5] hover:text-[#ff3366] hover:bg-[#ff3366]/10 rounded-lg z-50"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            <h3 class="text-[#00e5ff] font-['Orbitron'] font-bold text-lg mb-4 flex items-center gap-2">BUKTI - #TRX-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</h3>
            <div class="rounded-xl overflow-hidden border border-[#1A233A] bg-black flex justify-center items-center min-h-[300px]">
                <img src="{{ asset('storage/' . $item->payment_proof) }}" class="w-full max-h-[70vh] object-contain">
            </div>
        </div>
    </div>
    @endif

    @if(in_array(strtolower($item->status), ['active', 'completed']))
    <div id="modal-nota-{{ $item->id }}" class="fixed inset-0 w-screen h-screen z-[99999] hidden items-center justify-center bg-[#03050A]/90 backdrop-blur-md">
        <div class="bg-[#0B1221] border border-[#00e5ff]/50 rounded-2xl w-full max-w-md mx-4 shadow-[0_0_50px_rgba(0,229,255,0.2)] flex flex-col relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-[#00e5ff] to-transparent"></div>
            <div class="flex items-center justify-between p-5 border-b border-[#1A233A] bg-[#03060D]">
                <h3 class="text-[#00e5ff] font-['Orbitron'] font-bold text-[15px] tracking-[2px] uppercase w-full text-center">PREVIEW NOTA #TRX-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</h3>
                <button type="button" onclick="closeModal('modal-nota-{{ $item->id }}')" class="absolute right-4 text-[#8A99B5] hover:text-[#ff3366] transition-colors p-2 rounded-lg bg-[#1A233A]/50"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>

            <div class="p-6">
                <div class="border border-[#10b981]/30 bg-[#0B1221] rounded-xl p-6 relative overflow-hidden shadow-[inset_0_0_20px_rgba(16,185,129,0.05)]">
                    <div class="flex justify-between items-center mb-6 border-b border-[#1A233A] pb-4">
                        <div class="text-[#8A99B5] text-xs uppercase tracking-widest font-bold">Layanan</div>
                        <div class="text-white font-bold text-sm text-right">Sewa {{ $item->playstation->name ?? 'PS' }}</div>
                    </div>
                    <div class="bg-[#1A233A]/30 rounded-lg p-5 flex justify-between items-center border border-[#1A233A]">
                        <div class="text-white font-bold tracking-widest uppercase text-xs">TOTAL<br>KESELURUHAN</div>
                        <div class="text-[#00e5ff] font-['Orbitron'] font-bold text-3xl">Rp {{ number_format($item->total_price, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            <div class="p-5 border-t border-[#1A233A] bg-[#03060D] flex justify-center gap-4">
                <button type="button" onclick="printReceiptSilent('{{ route('booking.receipt', $item->id) }}?print=true'); closeModal('modal-nota-{{ $item->id }}')" class="px-6 py-3 bg-gradient-to-r from-[#00e5ff] to-[#0066ff] hover:scale-105 text-white rounded-lg text-xs font-bold uppercase tracking-[1px] transition-all flex items-center gap-2">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    CETAK NOTA ASLI
                </button>
            </div>
        </div>
    </div>
    @endif
@endforeach

@foreach($vipSubscriptions as $vip)
    @if($vip->payment_proof)
    <div id="modal-vip-bukti-{{ $vip->id }}" class="fixed inset-0 w-screen h-screen z-[99999] hidden items-center justify-center bg-[#03050A]/90 backdrop-blur-md">
        <div class="bg-[#0B1221] border border-[#f59e0b]/30 rounded-2xl p-6 max-w-lg w-full mx-4 shadow-[0_0_50px_rgba(245,158,11,0.2)] relative">
            <button type="button" onclick="closeModal('modal-vip-bukti-{{ $vip->id }}')" class="absolute top-4 right-4 p-2 text-[#8A99B5] hover:text-[#ff3366] hover:bg-[#ff3366]/10 rounded-lg z-50"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            <h3 class="text-[#f59e0b] font-['Orbitron'] font-bold text-lg mb-4 flex items-center gap-2">BUKTI VIP - #VIP-{{ str_pad($vip->id, 4, '0', STR_PAD_LEFT) }}</h3>
            <div class="rounded-xl overflow-hidden border border-[#1A233A] bg-black flex justify-center items-center min-h-[300px]">
                <img src="{{ asset('storage/' . $vip->payment_proof) }}" class="w-full max-h-[70vh] object-contain">
            </div>
        </div>
    </div>
    @endif

    @if(in_array(strtolower($vip->status), ['active', 'completed']))
    <div id="modal-vip-nota-{{ $vip->id }}" class="fixed inset-0 w-screen h-screen z-[99999] hidden items-center justify-center bg-[#03050A]/90 backdrop-blur-md">
        <div class="bg-[#0B1221] border border-[#f59e0b]/50 rounded-2xl w-full max-w-md mx-4 shadow-[0_0_50px_rgba(245,158,11,0.15)] flex flex-col relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-[#f59e0b] to-transparent"></div>
            <div class="flex items-center justify-between p-5 border-b border-[#1A233A] bg-[#03060D]">
                <h3 class="text-[#f59e0b] font-['Orbitron'] font-bold text-[15px] tracking-[2px] uppercase w-full text-center">PREVIEW NOTA #VIP-{{ str_pad($vip->id, 4, '0', STR_PAD_LEFT) }}</h3>
                <button type="button" onclick="closeModal('modal-vip-nota-{{ $vip->id }}')" class="absolute right-4 text-[#8A99B5] hover:text-[#ff3366] transition-colors p-2 rounded-lg bg-[#1A233A]/50"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>

            <div class="p-6">
                <div class="border border-[#10b981]/30 bg-[#0B1221] rounded-xl p-6 relative overflow-hidden shadow-[inset_0_0_20px_rgba(16,185,129,0.05)]">
                    <div class="flex justify-between items-center mb-6 border-b border-[#1A233A] pb-4">
                        <div class="text-[#8A99B5] text-xs uppercase tracking-widest font-bold">Layanan VIP</div>
                        <div class="text-white font-bold text-sm text-right">{{ $vip->pricingPlan->title ?? 'Paket Premium' }}</div>
                    </div>
                    <div class="bg-[#1A233A]/30 rounded-lg p-5 flex justify-between items-center border border-[#1A233A]">
                        <div class="text-white font-bold tracking-widest uppercase text-xs">TOTAL<br>KESELURUHAN</div>
                        <div class="text-[#f59e0b] font-['Orbitron'] font-bold text-3xl">Rp {{ number_format($vip->price_snapshot, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            <div class="p-5 border-t border-[#1A233A] bg-[#03060D] flex justify-center gap-4">
                <button type="button" onclick="printReceiptSilent('{{ route('vip.receipt', $vip->id) }}?print=true'); closeModal('modal-vip-nota-{{ $vip->id }}')" class="px-6 py-3 bg-gradient-to-r from-[#f59e0b] to-[#ea580c] hover:scale-105 text-white rounded-lg text-xs font-bold uppercase tracking-[1px] transition-all flex items-center gap-2">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    CETAK NOTA VIP
                </button>
            </div>
        </div>
    </div>
    @endif
@endforeach

<script>
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
