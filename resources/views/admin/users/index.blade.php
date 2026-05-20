@extends('layouts.admin')

@section('title', 'Database Pelanggan - Admin')

@section('content')
<div class="fixed top-0 right-0 w-[800px] h-[400px] bg-[#8b5cf6]/5 blur-[120px] pointer-events-none -z-10"></div>

<div class="max-w-[1400px] mx-auto pb-12">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#8b5cf6]/10 border border-[#8b5cf6]/30 mb-3">
                <span class="w-2 h-2 rounded-full bg-[#8b5cf6] animate-pulse"></span>
                <span class="text-[#8b5cf6] text-[10px] font-bold tracking-[2px] uppercase">User Intel</span>
            </div>
            <h1 class="text-3xl md:text-[36px] font-black text-white font-['Orbitron'] tracking-wide">
                CUSTOMER <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#8b5cf6] to-[#d946ef]">DATABASE</span>
            </h1>
            <p class="text-[#8A99B5] text-[13px] mt-1 font-['Inter']">Manajemen data pelanggan dan histori loyalitas mereka.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-[#10b981]/10 border border-[#10b981]/30 text-[#10b981] p-4 rounded-xl mb-6 text-[13px] font-bold flex items-center gap-3">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] p-4 rounded-xl mb-6 text-[13px] font-bold flex items-center gap-3">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-[#0B1221]/90 backdrop-blur-xl border border-[#1A233A] rounded-[24px] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)]">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-[#03060D] border-b border-[#1A233A] text-[#8A99B5] text-[10px] font-bold font-['Rajdhani'] uppercase tracking-[2px]">
                    <tr>
                        <th class="px-6 py-5">Identitas Member</th>
                        <th class="px-6 py-5">Kontak</th>
                        <th class="px-6 py-5">Total Loyalitas</th>
                        <th class="px-6 py-5">Tanggal Join</th>
                        <th class="px-6 py-5 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="text-[13px] text-white">
                    @forelse($users as $user)
                    <tr class="border-b border-[#1A233A]/40 hover:bg-[#1A233A]/20 transition-colors group">

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-[#1A233A] border border-[#8b5cf6]/30 flex items-center justify-center text-[#8b5cf6] font-bold text-[16px] uppercase shadow-[inset_0_0_15px_rgba(139,92,246,0.1)]">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <div>
                                    <div class="font-['Orbitron'] font-bold text-[14px] flex items-center gap-2">
                                        {{ $user->name }}
                                        @if($user->is_admin)
                                            <span class="px-2 py-0.5 bg-[#ff3366]/10 text-[#ff3366] text-[9px] uppercase tracking-[1px] rounded-md font-bold border border-[#ff3366]/30">Level: Admin</span>
                                        @endif
                                    </div>
                                    <div class="text-[#8A99B5] text-[11px] mt-0.5">UID: {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2 text-[#8A99B5]">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                {{ $user->email }}
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="px-3 py-1 bg-[#10b981]/10 border border-[#10b981]/30 text-[#10b981] rounded-lg font-bold text-[11px]">
                                    {{ $user->bookings_count }} Sesi Selesai
                                </div>
                                @if($user->bookings_count > 10)
                                    <span class="text-[#f59e0b]"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-5 text-[#8A99B5] font-['Rajdhani'] font-bold">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Sistem: Anda yakin ingin menghapus user ini dari database? Histori transaksi akan ikut hilang.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2.5 bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] hover:bg-[#ff3366] hover:text-white rounded-xl transition-all" title="Hapus User">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-[#8A99B5] font-bold uppercase tracking-[2px]">Belum ada pelanggan terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
