@extends('layouts.admin')
@section('title', 'Edit Pricing Plan - Trio Infinity PS')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- HEADER -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#f59e0b]/10 border border-[#f59e0b]/30 mb-2">
                <span class="w-2 h-2 rounded-full bg-[#f59e0b] animate-pulse"></span>
                <span class="text-[#f59e0b] text-[10px] font-bold tracking-[2px] uppercase font-['Rajdhani']">System Update</span>
            </div>
            <h2 class="text-3xl font-black text-white font-['Orbitron'] tracking-wide">EDIT <span class="text-[#f59e0b]">PLAN</span></h2>
        </div>

        <a href="{{ route('pricing.index') }}" class="px-5 py-2.5 bg-[#1A233A] text-[#8A99B5] rounded-xl hover:bg-[#ff3366] hover:text-white transition-all text-[11px] font-bold uppercase tracking-[1px] flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali
        </a>
    </div>

    <!-- FORM SECTION -->
    <div class="bg-[#0B1221] border border-[#1A233A] rounded-[24px] p-6 md:p-10 relative overflow-hidden">
        <!-- Ambient Glow Internal (Warna Amber untuk mode Edit) -->
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-[#f59e0b]/5 blur-[80px] rounded-full pointer-events-none"></div>

        <form action="{{ route('pricing.update', $pricing->id) }}" method="POST" class="relative z-10 space-y-6">
            @csrf
            @method('PUT') <!-- Wajib untuk proses Update di Laravel -->

            <!-- Input: Title -->
            <div>
                <label for="title" class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">
                    Nama Plan <span class="text-[#ff3366]">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $pricing->title) }}" placeholder="Contoh: Paket Begadang VIP" required
                    class="w-full bg-[#03060D] border @error('title') border-[#ff3366] @else border-[#1A233A] @enderror text-white focus:border-[#f59e0b] focus:ring-1 focus:ring-[#f59e0b] rounded-xl px-4 py-3.5 outline-none transition-all placeholder:text-[#8A99B5]/40 font-['Inter']">
                @error('title')
                    <p class="text-[#ff3366] text-[11px] mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input: Price -->
            <div>
                <label for="price" class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">
                    Harga (Rp) <span class="text-[#ff3366]">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#8A99B5] font-bold">Rp</span>
                    <input type="number" name="price" id="price" value="{{ old('price', $pricing->price) }}" placeholder="50000" required min="0"
                        class="w-full bg-[#03060D] border @error('price') border-[#ff3366] @else border-[#1A233A] @enderror text-white focus:border-[#f59e0b] focus:ring-1 focus:ring-[#f59e0b] rounded-xl pl-12 pr-4 py-3.5 outline-none transition-all placeholder:text-[#8A99B5]/40 font-['Inter']">
                </div>
                @error('price')
                    <p class="text-[#ff3366] text-[11px] mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input: Description / Features -->
            <div>
                <label for="description" class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">
                    Deskripsi / Fitur Plan
                </label>
                <textarea name="description" id="description" rows="4" placeholder="Masukkan detail durasi atau fitur yang didapat..."
                    class="w-full bg-[#03060D] border @error('description') border-[#ff3366] @else border-[#1A233A] @enderror text-white focus:border-[#f59e0b] focus:ring-1 focus:ring-[#f59e0b] rounded-xl px-4 py-3.5 outline-none transition-all placeholder:text-[#8A99B5]/40 font-['Inter'] resize-none">{{ old('description', $pricing->description) }}</textarea>
                @error('description')
                    <p class="text-[#ff3366] text-[11px] mt-2 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-6 border-t border-[#1A233A]">
                <button type="submit" class="flex-1 md:flex-none bg-gradient-to-r from-[#f59e0b] to-[#fbbf24] text-black px-8 py-4 rounded-xl font-black uppercase tracking-[2px] text-[12px] hover:shadow-[0_0_25px_rgba(245,158,11,0.4)] transition-all">
                    Update Plan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
