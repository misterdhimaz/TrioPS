@extends('layouts.admin')
@section('title', 'Tambah Pricing Plan - Trio Infinity PS')

@section('content')
<div class="max-w-[800px] mx-auto">
    <!-- HEADER -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#00e5ff]/10 border border-[#00e5ff]/30 mb-2">
                <span class="w-2 h-2 rounded-full bg-[#00e5ff] animate-pulse"></span>
                <span class="text-[#00e5ff] text-[10px] font-bold tracking-[2px] uppercase font-['Rajdhani']">System Config</span>
            </div>
            <h2 class="text-3xl font-black text-white font-['Orbitron'] tracking-wide">ADD NEW <span class="text-[#00e5ff]">PLAN</span></h2>
        </div>
        <a href="{{ route('pricing.index') }}" class="px-5 py-2.5 bg-[#1A233A] text-[#8A99B5] rounded-xl hover:bg-[#ff3366] hover:text-white transition-all text-[11px] font-bold uppercase tracking-[1px] flex items-center gap-2">
            Kembali
        </a>
    </div>

    <!-- FORM SECTION -->
    <div class="bg-[#0B1221] border border-[#1A233A] rounded-[24px] p-6 md:p-10 relative overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.5)]">
        <form action="{{ route('pricing.store') }}" method="POST" class="relative z-10 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">Nama Paket *</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Paket Harian" required class="w-full bg-[#03060D] border border-[#1A233A] text-white focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] rounded-xl px-4 py-3 outline-none">
                </div>

                <!-- Subtitle -->
                <div>
                    <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">Subtitle *</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle') }}" placeholder="Contoh: Per Hari" required class="w-full bg-[#03060D] border border-[#1A233A] text-white focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] rounded-xl px-4 py-3 outline-none">
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">Harga (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price') }}" placeholder="100000" required min="0" class="w-full bg-[#03060D] border border-[#1A233A] text-white focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] rounded-xl px-4 py-3 outline-none">
                </div>

                <!-- Duration Text -->
                <div>
                    <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">Teks Durasi (Bawah Harga) *</label>
                    <input type="text" name="duration_text" value="{{ old('duration_text') }}" placeholder="Contoh: per hari" required class="w-full bg-[#03060D] border border-[#1A233A] text-white focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] rounded-xl px-4 py-3 outline-none">
                </div>

                <!-- Badge -->
                <div>
                    <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">Badge (Opsional)</label>
                    <input type="text" name="badge" value="{{ old('badge') }}" placeholder="Contoh: Paling Populer" class="w-full bg-[#03060D] border border-[#1A233A] text-white focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] rounded-xl px-4 py-3 outline-none">
                </div>

                <!-- Color Theme -->
                <div>
                    <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">Tema Warna *</label>
                    <select name="color_theme" required class="w-full bg-[#03060D] border border-[#1A233A] text-white focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] rounded-xl px-4 py-3 outline-none appearance-none">
                        <option value="purple" {{ old('color_theme') == 'purple' ? 'selected' : '' }}>Purple (Harian)</option>
                        <option value="cyan" {{ old('color_theme') == 'cyan' ? 'selected' : '' }}>Cyan (Populer/Tengah)</option>
                        <option value="amber" {{ old('color_theme') == 'amber' ? 'selected' : '' }}>Amber (Elite/Premium)</option>
                    </select>
                </div>
            </div>

            <!-- Features -->
            <div>
                <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">Fitur & Benefit (Pisahkan dgn Enter) *</label>
                <textarea name="features" rows="5" placeholder="1 Konsol PS5&#10;2 Stik DualSense&#10;Game Bebas Pilih" required class="w-full bg-[#03060D] border border-[#1A233A] text-white focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] rounded-xl px-4 py-3 outline-none resize-none">{{ old('features') }}</textarea>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[2px] font-['Rajdhani'] mb-2">Deskripsi Singkat</label>
                <textarea name="description" rows="2" placeholder="Cocok untuk sesi gaming singkat..." class="w-full bg-[#03060D] border border-[#1A233A] text-white focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] rounded-xl px-4 py-3 outline-none resize-none">{{ old('description') }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 border-t border-[#1A233A]">
                <button type="submit" class="w-full bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-black px-8 py-4 rounded-xl font-black uppercase tracking-[2px] text-[12px] hover:shadow-[0_0_25px_rgba(0,229,255,0.4)] transition-all">
                    Deploy Plan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
