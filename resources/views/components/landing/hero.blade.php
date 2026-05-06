<section class="relative w-full h-screen min-h-[850px] flex items-center pt-[80px] overflow-hidden bg-[#05080f]">

        <!-- Background Image Lokal -->
        <div class="absolute inset-0 z-0">
            <!-- Ganti 'images/bg-hero.jpg' dengan letak dan nama gambar lokalmu -->
            <img src="{{ asset('images/bg-hero.png') }}" alt="Gaming Background" class="w-full h-full object-cover object-center opacity-60 mix-blend-screen" />

            <!-- Overlay Gradient (Agar teks tetap terbaca dan ujung bawah menyatu dengan background hitam) -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#030712] via-[#030712]/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#05080f] via-[#05080f]/50 to-transparent"></div>
        </div>

        <!-- Content Container -->
        <div class="relative z-10 max-w-[1300px] mx-auto px-6 w-full -mt-32">

            <div class="max-w-[600px]">
                <!-- Main Typography -->
                <h1 class="font-['Orbitron',_sans-serif] text-[50px] md:text-[60px] font-bold leading-[1.05] tracking-[2px] mb-[25px] uppercase">
                    <span class="text-white block drop-shadow-lg">RENT THE</span>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff] block drop-shadow-[0_0_20px_rgba(0,229,255,0.5)] py-1">ULTIMATE</span>
                    <span class="text-[#cbd5e1] block drop-shadow-lg">CONSOLE</span>
                </h1>

                <!-- Subtitle Description -->
                <p class="font-['Inter',_sans-serif] text-[#8A99B5] text-[15px] leading-[1.8] max-w-[480px] mb-[40px]">
                    Experience next-gen gaming with our premium PlayStation 5 & PS4 rental service. Pick up, play, and return — no commitment required.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-[20px] mb-[60px]">
<a href="{{ route('catalog.index') }}"
   class="flex items-center gap-2 bg-[#00e5ff] text-black px-[30px] py-[14px] rounded-[8px] text-[13px] font-bold tracking-[0.5px] uppercase shadow-[0_0_20px_rgba(0,229,255,0.4)] hover:bg-white hover:shadow-[0_0_30px_rgba(0,229,255,0.6)] hover:-translate-y-1 transition-all duration-300">

    <img src="{{ asset('images/icontombol.png') }}"
         alt="icon"
         class="w-7 h-7 object-contain">

    Sewa Konsol Sekarang
</a>

    <a href="#how-it-works" class="flex items-center gap-2 bg-[#111827]/60 backdrop-blur-sm border border-white/10 text-white px-[30px] py-[14px] rounded-[8px] text-[13px] font-semibold tracking-[0.5px] uppercase hover:border-[#00e5ff] hover:text-[#00e5ff] hover:-translate-y-1 transition-all duration-300">
        Cara Sewa
    </a>
</div>

                <!-- Stats Icons Row -->
                <div class="flex flex-wrap items-center gap-[40px]">

                    <!-- Stat 1: Rating -->
                    <div class="flex items-center gap-[15px]">
                        <div class="w-[40px] h-[40px] rounded-[8px] bg-[#0c1322]/80 border border-white/5 flex items-center justify-center text-[#00e5ff] shadow-[inset_0_0_10px_rgba(0,229,255,0.1)]">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-['Orbitron',_sans-serif] text-white font-bold text-[18px] leading-none mb-1">4.9</span>
                            <span class="font-['Rajdhani',_sans-serif] text-[#64748b] text-[10px] tracking-[2px] uppercase font-bold">Rating</span>
                        </div>
                    </div>

                    <!-- Stat 2: Genuine -->
                    <div class="flex items-center gap-[15px]">
                        <div class="w-[40px] h-[40px] rounded-[8px] bg-[#0c1322]/80 border border-white/5 flex items-center justify-center text-[#00e5ff] shadow-[inset_0_0_10px_rgba(0,229,255,0.1)]">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-['Orbitron',_sans-serif] text-white font-bold text-[18px] leading-none mb-1">100%</span>
                            <span class="font-['Rajdhani',_sans-serif] text-[#64748b] text-[10px] tracking-[2px] uppercase font-bold">Genuine</span>
                        </div>
                    </div>

                    <!-- Stat 3: Support -->
                    <div class="flex items-center gap-[15px]">
                        <div class="w-[40px] h-[40px] rounded-[8px] bg-[#0c1322]/80 border border-white/5 flex items-center justify-center text-[#00e5ff] shadow-[inset_0_0_10px_rgba(0,229,255,0.1)]">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-['Orbitron',_sans-serif] text-white font-bold text-[18px] leading-none mb-1">24/7</span>
                            <span class="font-['Rajdhani',_sans-serif] text-[#64748b] text-[10px] tracking-[2px] uppercase font-bold">Support</span>
                        </div>
                    </div>

                    <!-- Stat 4: Games -->
                    <div class="flex items-center gap-[15px]">
                        <div class="w-[40px] h-[40px] rounded-[8px] bg-[#0c1322]/80 border border-white/5 flex items-center justify-center text-[#00e5ff] shadow-[inset_0_0_10px_rgba(0,229,255,0.1)]">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-['Orbitron',_sans-serif] text-white font-bold text-[18px] leading-none mb-1">50+</span>
                            <span class="font-['Rajdhani',_sans-serif] text-[#64748b] text-[10px] tracking-[2px] uppercase font-bold">Games</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator (Di Tengah Bawah) -->
        <div class="absolute bottom-[40px] left-1/2 -translate-x-1/2 flex flex-col items-center gap-[10px] z-10">
            <span class="font-['Rajdhani',_sans-serif] text-[#6b7a90] text-[10px] tracking-[3px] uppercase font-bold">Scroll</span>
            <!-- Mouse Icon -->
            <div class="w-[20px] h-[34px] border-2 border-[#1e293b] rounded-[15px] flex justify-center p-[3px]">
                <div class="w-[4px] h-[8px] bg-[#00e5ff] rounded-[4px] animate-[bounce_2s_infinite]"></div>
            </div>
        </div>

    </section>
