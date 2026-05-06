@extends('layouts.admin')
@section('title', 'Pricing Plans Management - Trio Infinity PS')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#00e5ff]/10 border border-[#00e5ff]/30 mb-2">
            <span class="w-2 h-2 rounded-full bg-[#00e5ff] animate-pulse"></span>
            <span class="text-[#00e5ff] text-[10px] font-bold tracking-[2px] uppercase font-['Rajdhani']">System Config</span>
        </div>
        <h2 class="text-3xl font-black text-white font-['Orbitron'] tracking-wide">PRICING <span class="text-[#00e5ff]">PLANS</span></h2>
    </div>

    <!-- Tombol Tambah Data -->
    <a href="{{ route('pricing.create') }}" class="bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-black px-6 py-3 rounded-xl font-black uppercase tracking-[1px] text-[12px] hover:shadow-[0_0_20px_rgba(0,229,255,0.4)] transition-all flex items-center gap-2 group">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="group-hover:rotate-90 transition-transform"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Tambah Plan
    </a>
</div>

<!-- GLOBAL ALERTS -->
@if(session('success'))
<div class="bg-[#10b981]/10 border border-[#10b981]/30 text-[#10b981] p-4 rounded-xl mb-6 text-[13px] font-bold flex items-center gap-3 animate-[slideDown_0.3s_ease-out]">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
    {{ session('success') }}
</div>
@endif

<!-- DATA GRID -->
<div class="bg-[#0B1221] border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.5)]">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#03060D] border-b border-[#1A233A] text-[#8A99B5] text-[11px] uppercase tracking-[2px] font-['Rajdhani'] font-bold">
                    <th class="px-6 py-5 whitespace-nowrap">Nama Plan</th>
                    <th class="px-6 py-5 whitespace-nowrap">Harga</th>
                    <th class="px-6 py-5 min-w-[250px]">Durasi/Fitur</th>
                    <th class="px-6 py-5 text-right whitespace-nowrap">Aksi Sistem</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1A233A]">
                @forelse($pricing_plans as $plan)
                <tr class="hover:bg-[#1A233A]/30 transition-colors group">
                    <td class="px-6 py-5">
                        <div class="text-white font-bold font-['Orbitron'] tracking-wider">{{ $plan->title }}</div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-[#00e5ff]/10 border border-[#00e5ff]/20 text-[#00e5ff] font-bold font-['Orbitron'] text-sm">
                            Rp {{ number_format($plan->price ?? 0, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-6 py-5 text-[#8A99B5] text-[13px] font-['Inter'] leading-relaxed">
                        {{ Str::limit($plan->description ?? 'Tidak ada spesifikasi fitur yang dideklarasikan.', 80) }}
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <!-- Edit Button -->
                            <a href="{{ route('pricing.edit', $plan->id) }}" class="p-2.5 bg-[#1A233A] text-[#00e5ff] rounded-xl hover:bg-[#00e5ff] hover:text-black hover:shadow-[0_0_15px_rgba(0,229,255,0.4)] transition-all" title="Edit Protokol">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('pricing.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Peringatan: Hapus plan ini dari sistem secara permanen?');" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2.5 bg-[#1A233A] text-[#ff3366] rounded-xl hover:bg-[#ff3366] hover:text-white hover:shadow-[0_0_15px_rgba(255,51,102,0.4)] transition-all" title="Hapus Protokol">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center">
                        <div class="w-16 h-16 mx-auto bg-[#1A233A] rounded-full flex items-center justify-center text-[#8A99B5] mb-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        </div>
                        <div class="text-white font-['Orbitron'] font-bold text-lg tracking-wider mb-2">NO PRICING DATA DETECTED</div>
                        <p class="text-[13px] text-[#8A99B5] font-['Inter']">Silakan klik "Tambah Plan" untuk menginisialisasi paket rental pertama Anda.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
