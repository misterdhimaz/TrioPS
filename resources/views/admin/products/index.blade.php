@extends('layouts.admin')

@section('title', 'Manajemen Katalog')
@section('header_title', 'Katalog Konsol')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="font-['Orbitron',_sans-serif] text-[24px] font-bold text-white">Daftar Konsol</h2>
        <p class="text-[#8A99B5] text-[13px]">Kelola unit konsol yang tampil di halaman Landing Page.</p>
    </div>
    <a href="{{ route('products.create') }}" class="bg-[#00e5ff] text-black px-5 py-2.5 rounded-[8px] text-[12px] font-bold tracking-[1px] uppercase shadow-[0_0_15px_rgba(0,229,255,0.3)] hover:bg-white transition-all">
        + Tambah Konsol
    </a>
</div>

@if(session('success'))
<div class="bg-[#10b981]/10 border border-[#10b981]/30 text-[#10b981] px-4 py-3 rounded-[10px] mb-6 text-[13px] font-medium">
    {{ session('success') }}
</div>
@endif

<div class="bg-[#0B1221] border border-[#1A233A] rounded-[20px] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-[#8A99B5] text-[11px] font-['Rajdhani'] uppercase tracking-[2px] bg-[#03060D] border-b border-[#1A233A]">
                    <th class="px-6 py-4 font-bold">Gambar</th>
                    <th class="px-6 py-4 font-bold">Nama Konsol</th>
                    <th class="px-6 py-4 font-bold">Harga / Jam</th>
                    <th class="px-6 py-4 font-bold">Status</th>
                    <th class="px-6 py-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-[13px]">
                @forelse($products as $item)
                <tr class="border-b border-[#1A233A]/50 hover:bg-[#1A233A]/20 transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-16 h-12 object-cover rounded-[6px] border border-[#1A233A]">
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-white font-bold font-['Orbitron']">{{ $item->name }}</div>
                        <div class="text-[#8A99B5] text-[11px]">{{ $item->version }}</div>
                    </td>
                    <td class="px-6 py-4 text-[#00e5ff] font-bold font-['Orbitron']">Rp {{ number_format($item->price_per_hour, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-[#10b981]/10 text-[#10b981] px-3 py-1 rounded-full text-[10px] font-bold uppercase border border-[#10b981]/30">{{ $item->status }}</span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('products.edit', $item->id) }}" class="text-[#f59e0b] hover:text-white px-2 py-1 text-[12px] font-medium">Edit</a>
                        <form action="{{ route('products.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus konsol ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[#ff3366] hover:text-white px-2 py-1 text-[12px] font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-[#8A99B5]">Belum ada data konsol. Silakan tambah baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
