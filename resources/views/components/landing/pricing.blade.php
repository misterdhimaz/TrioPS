<section id="pricing" class="py-[100px] bg-[#03050a] px-6 border-t border-white/5 relative z-20">
    <div class="max-w-[1200px] mx-auto">


        <div class="flex flex-col items-center text-center mb-[70px]">

            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#00e5ff]/30 bg-[#00e5ff]/5 mb-[20px] shadow-[0_0_15px_rgba(0,229,255,0.1)]">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00e5ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                <span class="text-[#00e5ff] text-[10px] font-bold tracking-[2px] uppercase">Paket Harga</span>
            </div>


            <h2 class="font-['Orbitron',_sans-serif] text-[36px] md:text-[46px] font-bold text-white mb-[15px] tracking-[1px]">
                Harga Simpel & <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">Transparan</span>
            </h2>


            <p class="font-['Inter',_sans-serif] text-[#8A99B5] text-[14px] max-w-[500px] leading-[1.8]">
                Tanpa biaya tersembunyi, tanpa kejutan. Bayar sesuai kebutuhan gaming Anda.
            </p>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-[30px] items-stretch">

            @forelse($pricing_plans ?? [] as $index => $plan)
                @php
                    $features = json_decode($plan->features, true) ?? [];
                    $priceFormat = $plan->price >= 1000 ? number_format($plan->price / 1000, 0, ',', '.') . 'k' : number_format($plan->price, 0, ',', '.');
                    $themeIndex = $index % 3;

                    // Variabel warna dinamis sesuai tema
                    $colorClass = $themeIndex == 0 ? '#8b5cf6' : ($themeIndex == 1 ? '#00e5ff' : '#f59e0b');
                    $gradientClass = $themeIndex == 0 ? 'from-[#c084fc] to-[#8b5cf6]' : ($themeIndex == 1 ? 'from-[#00e5ff] to-[#0066ff]' : 'from-[#fbbf24] to-[#f59e0b]');
                @endphp


                <div class="bg-[#0B1221] border {{ $themeIndex == 1 ? 'border-[#00e5ff]/50' : 'border-white/5' }} rounded-[20px] p-[35px] hover:scale-105 transition-all duration-300 flex flex-col relative group">

                    @if($themeIndex == 1)
                        <div class="absolute -top-[12px] left-1/2 -translate-x-1/2 bg-[#00e5ff] text-white px-[15px] py-[4px] rounded-full text-[10px] font-bold tracking-[1.5px] uppercase shadow-[0_0_15px_rgba(0,229,255,0.4)]">Paling Populer</div>
                    @endif

                    <div class="flex items-center gap-[15px] mb-[30px]">
                        <div class="w-[45px] h-[45px] rounded-[12px] bg-white/5 border border-white/10 flex items-center justify-center" style="color: {{ $colorClass }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"></rect><circle cx="12" cy="12" r="2"></circle></svg>
                        </div>
                        <h3 class="text-white text-[18px] font-bold font-['Orbitron']">{{ $plan->title }}</h3>
                    </div>

                    <div class="mb-[20px]">
                        <span class="font-['Orbitron'] text-transparent bg-clip-text bg-gradient-to-r {{ $gradientClass }} text-[45px] font-bold leading-none">{{ $priceFormat }}</span>
                        <span class="text-[#8A99B5] text-[12px] ml-2">/ {{ $plan->duration_text }}</span>
                    </div>

                    <hr class="border-white/5 my-[25px]">

                    <ul class="space-y-[15px] mb-[35px] flex-1">
                        @foreach($features as $feature)
                            <li class="flex items-center gap-[12px] text-[#cbd5e1] text-[12px]">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="{{ $colorClass }}"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1.177-7.86l-2.765-2.767L7 12.431l3.823 3.823 7.918-7.918-1.06-1.061-6.858 6.858z"></path></svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>


                    @auth
                        <form action="{{ route('plan.subscriptions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pricing_plan_id" value="{{ $plan->id }}">

                            <div class="mb-4">
                                <label class="block text-[#8A99B5] text-[10px] font-bold uppercase tracking-[1px] mb-2">Tanggal Mulai</label>
                                <input type="date" name="start_date" required min="{{ date('Y-m-d') }}"
                                    class="w-full bg-[#03060D] border border-white/10 text-white rounded-xl px-4 py-2.5 outline-none text-[12px] transition-all"
                                    style="&:focus { border-color: {{ $colorClass }}; }">
                            </div>

                            <button type="submit" class="w-full block text-center py-[14px] rounded-[10px] text-[13px] font-bold tracking-[1px] transition-all duration-300
                                {{ $themeIndex == 1 ? 'bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-white shadow-[0_0_20px_rgba(0,229,255,0.3)]' : 'bg-[#1A233A] text-white hover:bg-white/10 border border-white/5' }}">
                                Pilih {{ $plan->title }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center bg-[#1A233A] hover:bg-white/10 text-white py-[14px] rounded-[10px] text-[13px] font-bold tracking-[1px] border border-white/5 transition-all">
                            Login untuk Memesan
                        </a>
                    @endauth
                </div>
            @empty
                <div class="col-span-1 lg:col-span-3 text-center py-10">
                    <p class="text-[#8A99B5] font-['Orbitron'] tracking-[2px]">SIGNAL LOST: MENUNGGU DATA PLAN DARI SERVER...</p>
                </div>
            @endforelse

        </div>


        <div class="mt-[50px] flex items-center justify-center gap-[15px] text-[#6b7a90] text-[11px] flex-wrap">
            <span class="flex items-center gap-1">💳 Menerima pembayaran tunai & online</span>
            <span class="hidden md:inline">·</span>
            <span class="flex items-center gap-1">🔒 Memerlukan deposit jaminan</span>
            <span class="hidden md:inline">·</span>
            <span class="flex items-center gap-1">📦 Gratis antar untuk paket Elite</span>
        </div>

    </div>
</section>
