@extends('layouts.admin')

@section('title', 'Tambah Konsol')
@section('header_title', 'Tambah Data Konsol')

@section('content')
<div class="mb-8">
    <h2 class="font-['Orbitron',_sans-serif] text-[24px] font-bold text-white">Input Konsol Baru</h2>
    <p class="text-[#8A99B5] text-[13px]">Masukkan spesifikasi monster gaming baru ke dalam database sistem.</p>
</div>

<!-- Menampilkan Pesan Error jika ada form yang salah/kosong -->
@if ($errors->any())
<div class="bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] px-4 py-3 rounded-[10px] mb-6 text-[13px]">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-[#0B1221] border border-[#1A233A] rounded-[20px] p-6 md:p-8 max-w-[1000px] shadow-sm">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Nama Konsol -->
        <div>
            <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Nama Konsol</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: PlayStation 5" class="w-full bg-[#030712] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] transition-colors">
        </div>

        <!-- Versi -->
        <div>
            <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Versi / Edisi</label>
            <input type="text" name="version" value="{{ old('version') }}" required placeholder="Contoh: Digital Edition" class="w-full bg-[#030712] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] transition-colors">
        </div>

        <!-- Kategori -->
        <div>
            <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Kategori</label>
            <div class="relative">
                <select name="category" required class="w-full bg-[#030712] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] appearance-none transition-colors">
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <option value="PS5" {{ old('category') == 'PS5' ? 'selected' : '' }}>PS5</option>
                    <option value="PS4" {{ old('category') == 'PS4' ? 'selected' : '' }}>PS4</option>
                    <option value="Xbox" {{ old('category') == 'Xbox' ? 'selected' : '' }}>Xbox</option>
                    <option value="Nintendo" {{ old('category') == 'Nintendo' ? 'selected' : '' }}>Nintendo Switch</option>
                </select>
                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-[#8A99B5]">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Status Stok</label>
            <div class="relative">
                <select name="status" required class="w-full bg-[#030712] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] appearance-none transition-colors">
                    <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Limited" {{ old('status') == 'Limited' ? 'selected' : '' }}>Limited</option>
                    <option value="Out of Stock" {{ old('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-[#8A99B5]">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
            </div>
        </div>

        <!-- Harga -->
        <div class="md:col-span-2 border-t border-[#1A233A] pt-6">
            <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Harga Sewa per Jam (Rp)</label>
            <input type="number" name="price_per_hour" value="{{ old('price_per_hour') }}" required placeholder="Contoh: 15000 (tanpa titik)" class="w-full md:w-1/2 bg-[#030712] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] transition-colors">
        </div>
    </div>

    <!-- Spesifikasi Teknis -->
    <div class="bg-[#03060D] border border-[#1A233A] rounded-[16px] p-6 mb-8">
        <h3 class="text-[#00e5ff] font-['Orbitron'] text-[14px] font-bold mb-5 flex items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
            Spesifikasi Teknis
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">CPU</label>
                <input type="text" name="cpu" value="{{ old('cpu') }}" required placeholder="Contoh: AMD Zen 2 — 3.5GHz" class="w-full bg-[#0B1221] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] transition-colors">
            </div>
            <div>
                <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Resolusi</label>
                <input type="text" name="resolution" value="{{ old('resolution') }}" required placeholder="Contoh: 4K / 120fps" class="w-full bg-[#0B1221] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] transition-colors">
            </div>
            <div>
                <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Penyimpanan (Storage)</label>
                <input type="text" name="storage" value="{{ old('storage') }}" required placeholder="Contoh: 825GB NVMe SSD" class="w-full bg-[#0B1221] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] transition-colors">
            </div>
            <div>
                <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Konektivitas</label>
                <input type="text" name="connectivity" value="{{ old('connectivity') }}" required placeholder="Contoh: Wi-Fi 6 / BT 5.1" class="w-full bg-[#0B1221] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] transition-colors">
            </div>
        </div>
    </div>

    <!-- Termasuk Game -->
    <div class="mb-8">
        <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Game yang Termasuk (Pisahkan dengan koma)</label>
        <input type="text" name="included_games" value="{{ old('included_games') }}" required placeholder="Contoh: FC 24, Tekken 8, Spider-Man 2" class="w-full bg-[#030712] border border-[#1A233A] text-white text-[13px] rounded-[10px] px-4 py-3 focus:outline-none focus:border-[#00e5ff] focus:ring-1 focus:ring-[#00e5ff] transition-colors">
    </div>

    <!-- Upload Gambar -->
    <div class="mb-10">
        <label class="block text-[#8A99B5] text-[11px] font-bold uppercase tracking-[1px] mb-2">Foto / Banner Konsol (Wajib)</label>
        <div class="relative w-full bg-[#030712] border border-[#1A233A] border-dashed rounded-[10px] px-4 py-8 text-center hover:border-[#00e5ff]/50 hover:bg-[#00e5ff]/5 transition-all group">
            <input type="file" name="image" required accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
            <div class="text-[#8A99B5] flex flex-col items-center">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-3 text-[#1A233A] group-hover:text-[#00e5ff] transition-colors"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                <span class="text-[14px] font-semibold text-white mb-1">Klik atau Tarik file ke sini</span>
                <span class="text-[11px]">Format: JPG, PNG, WEBP (Maks 2MB)</span>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#1A233A]">
        <a href="{{ route('products.index') }}" class="px-8 py-3 rounded-[10px] border border-[#1A233A] text-[#8A99B5] hover:text-white hover:bg-[#1A233A] transition-all font-bold text-[13px] uppercase tracking-[1px] text-center">Batal</a>
        <button type="submit" class="flex-1 bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-white py-3 rounded-[10px] text-[13px] font-bold tracking-[1px] uppercase shadow-[0_10px_20px_rgba(0,229,255,0.2)] hover:shadow-[0_15px_30px_rgba(0,229,255,0.4)] hover:-translate-y-0.5 transition-all">
            Simpan Data Konsol
        </button>
    </div>
</form>
@endsection
