@extends('layouts.user')
@section('title', 'Trio.InfinityPS')

@section('content')
<div class="fixed top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[400px] bg-[#00e5ff]/5 blur-[150px] pointer-events-none -z-10"></div>

<div class="max-w-[1200px] mx-auto pb-20">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-10 border-b border-[#1A233A] pb-8 relative">
        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#00e5ff]/10 border border-[#00e5ff]/30 mb-4">
                <div class="w-2 h-2 rounded-full bg-[#00e5ff] animate-pulse"></div>
                <span class="text-[#00e5ff] text-[10px] font-bold tracking-[2px] uppercase font-['Rajdhani']">System Online</span>
            </div>
            <h1 class="text-3xl md:text-[40px] font-black text-white font-['Orbitron'] tracking-wide leading-tight">
                MEMBER <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">Trio.Infinity PS</span>
            </h1>
            <p class="text-[#8A99B5] text-sm mt-2 font-['Inter']">Welcome back, <span class="text-white font-bold">{{ Auth::user()->name }}</span>. Here is your gaming telemetry.</p>
        </div>

        <div class="bg-[#03060D] border border-[#1A233A] px-5 py-3 rounded-2xl flex items-center gap-4 relative z-10 shadow-[0_0_20px_rgba(0,0,0,0.5)]">
            <div class="text-right">
                <div class="text-[#8A99B5] text-[10px] uppercase tracking-[1px] font-bold">Total Transaksi</div>
                <div class="text-white font-['Orbitron'] font-bold text-[16px]">{{ $activeBookings->count() }} Orders</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#00e5ff]/20 to-transparent flex items-center justify-center border border-[#00e5ff]/30 text-[#00e5ff]">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            </div>
        </div>
    </div>

    @if(session('success') || session('booking_success'))
    <div class="bg-[#10b981]/10 border border-[#10b981]/30 text-[#10b981] p-4 rounded-2xl mb-8 text-[13px] font-bold flex items-center gap-3 backdrop-blur-sm animate-[slideDown_0.3s_ease-out]">
        <div class="bg-[#10b981]/20 p-1.5 rounded-lg"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
        {{ session('success') ?? session('booking_success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] p-4 rounded-2xl mb-8 text-[13px] font-bold flex items-center gap-3 backdrop-blur-sm">
        <div class="bg-[#ff3366]/20 p-1.5 rounded-lg"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div>
        {{ session('error') }}
    </div>
    @endif

    <div class="flex items-center gap-3 mb-6">
        <div class="w-1.5 h-6 bg-[#00e5ff] rounded-full shadow-[0_0_10px_#00e5ff]"></div>
        <h2 class="font-['Orbitron'] text-[20px] font-bold text-white tracking-[1px]">ACTIVE SESSIONS</h2>
    </div>

    <div class="space-y-5">
        @forelse($activeBookings as $booking)
            <div class="bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-5 md:p-6 rounded-[24px] flex flex-col xl:flex-row items-center justify-between gap-6 hover:border-[#00e5ff]/40 hover:shadow-[0_8px_30px_rgba(0,0,0,0.5)] transition-all duration-300 group">

                <div class="flex items-center gap-5 w-full xl:w-auto xl:flex-1">
                    <div class="w-20 h-20 bg-[#03060D] border border-[#1A233A] rounded-2xl p-2 shrink-0 flex items-center justify-center relative overflow-hidden group-hover:border-[#00e5ff]/30 transition-colors">
                        <div class="absolute inset-0 bg-[#00e5ff]/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        @if($booking->playstation && $booking->playstation->image)
                            <img src="{{ asset('storage/' . $booking->playstation->image) }}" alt="Console" class="w-full h-full object-contain relative z-10 group-hover:scale-110 transition-transform duration-500">
                        @else
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1A233A" stroke-width="1.5"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M12 12h.01"/><path d="M17 12h.01"/><path d="M7 12h.01"/></svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="text-[#00e5ff] text-[10px] font-bold font-['Rajdhani'] uppercase tracking-[2px]">#TRX-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <span class="w-1 h-1 bg-[#1A233A] rounded-full"></span>
                            <span class="text-[#8A99B5] text-[10px] font-bold uppercase tracking-[1px]">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                        </div>
                        <h4 class="text-white font-bold text-[18px] md:text-[20px] font-['Orbitron'] leading-tight">{{ $booking->playstation->name ?? 'Unit Terhapus' }}</h4>
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-start xl:justify-center gap-2 w-full xl:w-auto xl:flex-1 bg-[#03060D] p-3 rounded-2xl border border-[#1A233A]">
                    <div class="w-full text-[9px] text-[#8A99B5] uppercase tracking-[1px] font-bold mb-1 pl-1">Slot Jadwal:</div>
                    <div class="flex flex-wrap gap-2 w-full">
                        @php
                            $jamArray = is_string($booking->start_time) ? json_decode($booking->start_time, true) : $booking->start_time;
                            if (!is_array($jamArray)) $jamArray = [];
                        @endphp
                        @foreach($jamArray as $jam)
                            <span class="px-3 py-1.5 bg-[#1A233A] text-white text-[11px] rounded-lg font-bold font-['Rajdhani'] tracking-[1px] shadow-sm">
                                {{ $jam }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-row xl:flex-col items-center justify-between xl:items-end xl:justify-center w-full xl:w-auto gap-4 xl:gap-2">
                    <div class="text-white font-['Orbitron'] font-black text-[20px] md:text-[24px]">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </div>

                    <div class="flex items-center gap-2">
                        @php
                            $jamMulai = $jamArray[0] ?? '00:00';
                            $tanggalSaja = \Carbon\Carbon::parse($booking->booking_date)->toDateString();
                            $waktuMain = \Carbon\Carbon::parse($tanggalSaja . ' ' . $jamMulai);
                            $sudahMulai = now('Asia/Jakarta')->greaterThanOrEqualTo($waktuMain);
                            $status = strtolower($booking->status);
                        @endphp

                        {{-- STATUS: PENDING --}}
                        @if($status == 'pending')
                            @if(!$booking->payment_proof)
                                <button onclick="toggleModal('pay-modal-{{ $booking->id }}')" class="bg-[#00e5ff] text-black px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-[1px] shadow-[0_4px_15px_rgba(0,229,255,0.2)] hover:shadow-[0_0_20px_rgba(0,229,255,0.5)] hover:-translate-y-0.5 transition-all">
                                    Upload Bukti
                                </button>
                            @else
                                <span class="px-5 py-2.5 bg-[#f59e0b]/10 text-[#f59e0b] border border-[#f59e0b]/30 rounded-xl text-[10px] font-bold uppercase tracking-[1px] flex items-center gap-2">
                                    <svg class="animate-spin -ml-1 mr-1 h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Verifikasi
                                </span>
                            @endif

                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Batalkan sesi gaming ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2.5 bg-[#1A233A] text-[#ff3366]/80 rounded-xl hover:bg-[#ff3366] hover:text-white transition-all group" title="Batalkan Pesanan">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </form>

                        {{-- STATUS: APPROVED / ACTIVE / COMPLETED --}}
                        @elseif(in_array($status, ['approved', 'active', 'completed']))

                            @if($status == 'completed')
                                <span class="px-4 py-2.5 bg-[#1A233A] text-[#8A99B5] rounded-xl text-[10px] font-bold uppercase tracking-[1px]">Completed</span>
                            @else
                                @if(!$sudahMulai)
                                    <span class="px-4 py-2.5 bg-[#00e5ff]/10 text-[#00e5ff] border border-[#00e5ff]/30 rounded-xl text-[10px] font-bold uppercase tracking-[1px] flex items-center gap-1.5">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        ACC (Siap Main)
                                    </span>
                                @else
                                    <span class="px-4 py-2.5 bg-[#10b981]/10 text-[#10b981] border border-[#10b981]/30 rounded-xl text-[10px] font-bold uppercase tracking-[1px] flex items-center gap-1.5">
                                        <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#10b981] opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-[#10b981]"></span></span>
                                        Sedang Bermain
                                    </span>
                                @endif
                            @endif

                          <button type="button" onclick="printReceiptSilent('{{ route('booking.receipt', $booking->id) }}')"
   class="px-4 py-2.5 bg-gradient-to-r from-[#00e5ff] to-[#0066ff] hover:scale-105 text-white rounded-xl text-[10px] font-bold uppercase tracking-[1px] transition-all shadow-[0_0_15px_rgba(0,229,255,0.4)] flex items-center gap-2">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
    Cetak Nota
</button>

                        {{-- STATUS: CANCELLED --}}
                        @else
                            <span class="px-5 py-2.5 bg-[#ff3366]/10 text-[#ff3366] border border-[#ff3366]/30 rounded-xl text-[10px] font-bold uppercase tracking-[1px]">Cancelled</span>
                        @endif
                    </div>
                </div>
            </div>

            @if(strtolower($booking->status) == 'pending' && !$booking->payment_proof)
            <div id="pay-modal-{{ $booking->id }}" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-[#03050a]/90 backdrop-blur-md p-4 transition-opacity">
                <div class="bg-[#0B1221] border border-[#1A233A] p-8 rounded-[32px] w-full max-w-md relative shadow-[0_0_50px_rgba(0,0,0,0.8)] overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#00e5ff]/20 blur-[60px] rounded-full pointer-events-none"></div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-white font-['Orbitron'] font-bold text-[20px] leading-none mb-1.5">Konfirmasi Pembayaran</h3>
                                <p class="text-[#8A99B5] text-[12px]">TRX-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <button type="button" onclick="toggleModal('pay-modal-{{ $booking->id }}')" class="w-8 h-8 flex items-center justify-center rounded-full bg-[#1A233A] text-[#8A99B5] hover:text-white hover:bg-[#ff3366]/80 transition-colors">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>

                        <div class="bg-[#03060D] border border-[#1A233A] rounded-2xl p-5 text-center mb-6">
                            <p class="text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-bold mb-1">Total Tagihan</p>
                            <h2 class="text-[#00e5ff] font-['Orbitron'] font-black text-[32px]">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</h2>
                            <div class="mt-4 pt-4 border-t border-[#1A233A] text-[12px] text-[#8A99B5]">
                                Transfer ke: <strong class="text-white">BCA 12345678</strong> (Trio Infinity)
                            </div>
                        </div>

                        <form action="{{ route('bookings.payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="relative group cursor-pointer mb-2">
                                <input type="file" name="payment_proof" id="file-{{ $booking->id }}" required accept="image/*" onchange="previewImage(this, 'preview-{{ $booking->id }}', 'icon-{{ $booking->id }}')" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                                <div class="bg-[#03060D] border-2 border-dashed border-[#1A233A] group-hover:border-[#00e5ff]/50 rounded-2xl p-6 text-center transition-colors relative overflow-hidden h-[160px] flex flex-col items-center justify-center">
                                    <div id="icon-{{ $booking->id }}" class="flex flex-col items-center">
                                        <div class="w-12 h-12 rounded-full bg-[#1A233A] text-[#8A99B5] group-hover:text-[#00e5ff] group-hover:bg-[#00e5ff]/10 flex items-center justify-center mb-3 transition-colors">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                        </div>
                                        <p class="text-[#8A99B5] text-[11px] font-bold">Klik atau seret struk ke sini</p>
                                        <p class="text-[#8A99B5]/60 text-[9px] mt-1">PNG, JPG (Max 2MB)</p>
                                    </div>
                                    <img id="preview-{{ $booking->id }}" class="hidden absolute inset-0 w-full h-full object-cover z-10" alt="Preview">
                                    <div class="absolute inset-0 bg-black/50 z-10 hidden" id="overlay-preview-{{ $booking->id }}"></div>
                                </div>
                            </div>

                            @error('payment_proof')
                                <p class="text-[#ff3366] text-[10px] font-bold mb-4 flex items-center gap-1"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> {{ $message }}</p>
                            @enderror
                            <div class="mb-6"></div>

                            <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-black text-[12px] font-black uppercase tracking-[2px] hover:shadow-[0_0_25px_rgba(0,229,255,0.4)] transition-all">
                                Kirim Bukti Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif

        @empty
            <div class="py-24 flex flex-col items-center justify-center bg-[#0B1221]/50 border border-[#1A233A] border-dashed rounded-[32px] text-center relative overflow-hidden w-full">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] bg-[#00e5ff]/5 blur-[80px] rounded-full pointer-events-none"></div>
                <div class="w-24 h-24 mb-6 relative z-10">
                    <div class="absolute inset-0 border-2 border-dashed border-[#1A233A] rounded-full animate-[spin_10s_linear_infinite]"></div>
                    <div class="absolute inset-2 border-2 border-dashed border-[#00e5ff]/30 rounded-full animate-[spin_15s_linear_infinite_reverse]"></div>
                    <div class="absolute inset-0 flex items-center justify-center text-[#8A99B5]">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                    </div>
                </div>
                <h3 class="text-white font-['Orbitron'] font-bold text-[20px] mb-2 tracking-[1px] relative z-10">NO SIGNAL DETECTED</h3>
                <p class="text-[#8A99B5] text-[13px] max-w-[300px] mb-8 relative z-10">Kamu belum memiliki riwayat rental. Pilih konsol tempurmu sekarang.</p>
                <a href="{{ route('catalog.index') }}" class="relative z-10 bg-[#1A233A] border border-[#1A233A] hover:border-[#00e5ff]/50 text-white px-6 py-3 rounded-xl text-[11px] font-bold uppercase tracking-[1px] transition-all hover:text-[#00e5ff]">
                    Buka Katalog Konsol
                </a>
            </div>
        @endforelse
    </div>

    <div class="flex items-center gap-3 mb-6 mt-16">
        <div class="w-1.5 h-6 bg-[#f59e0b] rounded-full shadow-[0_0_10px_#f59e0b]"></div>
        <h2 class="font-['Orbitron'] text-[20px] font-bold text-white tracking-[1px]">VIP PLAN RADAR</h2>
    </div>

    <div class="space-y-5">
        @forelse($vipSubscriptions as $vip)
            <div class="bg-gradient-to-r from-[#0B1221] to-[#1A233A]/50 border {{ $vip->status == 'Pending' ? 'border-[#f59e0b]/50' : 'border-[#1A233A]' }} p-5 md:p-6 rounded-[24px] flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">

                <div class="absolute -right-10 -top-10 w-32 h-32 bg-[#f59e0b]/10 blur-[40px] rounded-full"></div>

                <div class="flex-1 relative z-10 w-full">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-[#f59e0b] text-[10px] font-bold uppercase tracking-[2px]">VIP-{{ str_pad($vip->id, 4, '0', STR_PAD_LEFT) }}</span>
                        <span class="w-1 h-1 bg-[#8A99B5] rounded-full"></span>
                        <span class="text-[#8A99B5] text-[10px] font-bold uppercase tracking-[1px]">Mulai: {{ \Carbon\Carbon::parse($vip->start_date)->format('d M Y') }}</span>
                    </div>
                    <h4 class="text-white font-bold text-[22px] font-['Orbitron']">{{ $vip->pricingPlan->title ?? 'Paket Premium' }}</h4>
                    <p class="text-[#8A99B5] text-[12px] mt-1">{{ $vip->pricingPlan->subtitle ?? 'Unlimited Gaming' }}</p>
                </div>

                <div class="flex-shrink-0 text-left md:text-right relative z-10 w-full md:w-auto">
                    <div class="text-[#f59e0b] font-['Orbitron'] font-black text-[24px] mb-2">
                        Rp {{ number_format($vip->price_snapshot, 0, ',', '.') }}
                    </div>

                    @if(strtolower($vip->status) == 'pending')
                        @if(!$vip->payment_proof)
                            <div class="flex gap-2">
                                <button onclick="toggleModal('vip-pay-modal-{{ $vip->id }}')" class="bg-[#f59e0b] text-black px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-[1px] shadow-[0_4px_15px_rgba(245,158,11,0.2)] hover:shadow-[0_0_20px_rgba(245,158,11,0.5)] transition-all">Upload Bukti</button>
                                <form action="{{ route('plan.subscriptions.destroy', $vip->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2.5 bg-[#1A233A] text-[#ff3366]/80 rounded-xl hover:bg-[#ff3366] hover:text-white" title="Batal"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                </form>
                            </div>
                        @else
                            <span class="px-5 py-2.5 bg-[#f59e0b]/10 text-[#f59e0b] border border-[#f59e0b]/30 rounded-xl text-[10px] font-bold uppercase tracking-[1px]">Verifikasi Admin</span>
                        @endif
                    @elseif(strtolower($vip->status) == 'active')
                        <span class="px-5 py-2.5 bg-[#10b981]/10 text-[#10b981] border border-[#10b981]/30 rounded-xl text-[10px] font-bold uppercase tracking-[1px] flex items-center gap-2">Paket Aktif</span>
                    @endif
                </div>
            </div>

            @if(strtolower($vip->status) == 'pending' && !$vip->payment_proof)
            <div id="vip-pay-modal-{{ $vip->id }}" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-[#03050a]/90 backdrop-blur-md p-4 transition-opacity">
                <div class="bg-[#0B1221] border border-[#1A233A] p-8 rounded-[32px] w-full max-w-md relative shadow-[0_0_50px_rgba(0,0,0,0.8)] overflow-hidden">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-white font-['Orbitron'] font-bold text-[20px] mb-1">Pembayaran VIP</h3>
                            <p class="text-[#8A99B5] text-[12px]">TRX-VIP-{{ str_pad($vip->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <button type="button" onclick="toggleModal('vip-pay-modal-{{ $vip->id }}')" class="text-[#8A99B5] hover:text-[#ff3366]"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                    </div>

                    <form action="{{ route('plan.subscriptions.payment', $vip->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="payment_proof" required accept="image/*" class="w-full mb-4 text-sm text-[#8A99B5] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:uppercase file:bg-[#f59e0b]/10 file:text-[#f59e0b] bg-[#03060D] border border-[#1A233A] rounded-xl">
                        <button type="submit" class="w-full py-3.5 rounded-xl bg-[#f59e0b] text-black text-[12px] font-black uppercase tracking-[2px]">Kirim Bukti VIP</button>
                    </form>
                </div>
            </div>
            @endif
        @empty
            <div class="text-center p-8 border border-[#1A233A] rounded-[24px] bg-[#03060D]">
                <p class="text-[#8A99B5] text-sm">Belum ada paket VIP yang aktif.</p>
            </div>
        @endforelse
    </div>


</div>

<script>
    function toggleModal(modalID) {
        const modal = document.getElementById(modalID);
        if (modal) {
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    }

    function previewImage(input, previewId, iconId) {
        const preview = document.getElementById(previewId);
        const icon = document.getElementById(iconId);
        const overlay = document.getElementById('overlay-' + previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                icon.classList.add('hidden');
                if(overlay) overlay.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function printReceiptSilent(url) {
        // Buat elemen iframe rahasia
        let printFrame = document.createElement('iframe');
        printFrame.style.display = 'none';
        printFrame.src = url;

        // Tempelkan iframe ke dalam dashboard
        document.body.appendChild(printFrame);

        // Begitu file nota selesai di-load, langsung tembak jendela Print!
        printFrame.onload = function() {
            printFrame.contentWindow.focus();
            printFrame.contentWindow.print();

            // Bersihkan iframe setelah selesai (delay 2 detik) agar tidak berat
            setTimeout(() => {
                document.body.removeChild(printFrame);
            }, 2000);
        };
    }
</script>
@endsection
