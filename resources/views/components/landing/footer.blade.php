<footer id="contact" class="bg-[#03050a] pt-[80px] pb-[30px] px-6 relative z-20">
        <div class="max-w-[1300px] mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[50px] mb-[60px]">

            <!-- Kolom 1: Brand & About -->
            <div class="flex flex-col">
                <div class="flex items-center gap-3 mb-[20px]">
                <div class="flex flex-col gap-6">
    <!-- Brand Identity -->
    <a href="/" class="flex items-center gap-4 group transition-transform duration-300 hover:scale-[1.02] w-fit">
        <!-- SVG Hexagon Gamepad Logo Custom with Gradient -->
        <div class="flex items-center justify-center shrink-0 transition-all">
    <img src="{{ asset('images/logo.png') }}"
         alt="Logo"
         class="w-20 h-20 object-contain drop-shadow-[0_0_15px_rgba(0,229,255,0.6)] group-hover:drop-shadow-[0_0_25px_rgba(0,229,255,0.8)] transition-all">
</div>

        <!-- Logo Text -->
        <div class="flex flex-col justify-center mt-0.5">
            <div class="font-['Orbitron',_sans-serif] font-bold text-[22px] tracking-[1px] leading-none flex gap-1.5">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">TRIO.INFINITY</span>
                <span class="text-white">PS</span>
            </div>
            <div class="font-['Rajdhani',_sans-serif] text-[#8A99B5] text-[9px] tracking-[2.5px] uppercase mt-[4px] font-bold group-hover:text-[#00e5ff] transition-colors">Next-Gen Gaming Protocol</div>
        </div>
    </a>

    <!-- Brand Description -->
    <p class="text-[#8A99B5] text-[13px] leading-relaxed max-w-[300px]">
        Pusat rental PlayStation dengan teknologi protokol masa depan. Memberikan pengalaman gaming terbaik dengan unit terbatas dan sistem manajemen modern.
    </p>
</div>

                </div>
                <p class="font-['Inter',_sans-serif] text-[#6b7a90] text-[13px] leading-[1.8] mb-[25px]">
                    Layanan sewa PlayStation premium untuk gamer yang menginginkan yang terbaik. Main lebih banyak, bayar lebih hemat.
                </p>
                <!-- Social Icons -->
                <div class="flex items-center gap-[12px]">
                    <a href="#" class="w-[38px] h-[38px] rounded-[10px] bg-[#0B1221] border border-[#1A233A] flex items-center justify-center text-[#6b7a90] hover:text-[#00e5ff] hover:border-[#00e5ff] hover:-translate-y-1 hover:shadow-[0_5px_15px_rgba(0,229,255,0.2)] transition-all duration-300">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="#" class="w-[38px] h-[38px] rounded-[10px] bg-[#0B1221] border border-[#1A233A] flex items-center justify-center text-[#6b7a90] hover:text-[#00e5ff] hover:border-[#00e5ff] hover:-translate-y-1 hover:shadow-[0_5px_15px_rgba(0,229,255,0.2)] transition-all duration-300">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>
                    <a href="#" class="w-[38px] h-[38px] rounded-[10px] bg-[#0B1221] border border-[#1A233A] flex items-center justify-center text-[#6b7a90] hover:text-[#00e5ff] hover:border-[#00e5ff] hover:-translate-y-1 hover:shadow-[0_5px_15px_rgba(0,229,255,0.2)] transition-all duration-300">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Kolom 2: Quick Links -->
            <div>
                <h4 class="font-['Orbitron',_sans-serif] text-white text-[15px] font-bold tracking-[1px] uppercase mb-[25px]">Link Cepat</h4>
                <ul class="flex flex-col gap-[16px] font-['Inter',_sans-serif] text-[14px] text-[#6b7a90]">
                    <li><a href="/" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">Beranda</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">Katalog Konsol</a></li>
                    <li><a href="#pricing" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">Paket Harga</a></li>
                    <li><a href="#how-it-works" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">Cara Kerja</a></li>
                    <li><a href="#" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Consoles -->
            <div>
                <h4 class="font-['Orbitron',_sans-serif] text-white text-[15px] font-bold tracking-[1px] uppercase mb-[25px]">Konsol</h4>
                <ul class="flex flex-col gap-[16px] font-['Inter',_sans-serif] text-[14px] text-[#6b7a90]">
                    <li><a href="#" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">PS5 Disc Edition</a></li>
                    <li><a href="#" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">PS5 Digital Edition</a></li>
                    <li><a href="#" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">PS4 Pro</a></li>
                    <li><a href="#" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">PS4 Slim</a></li>
                    <li><a href="#" class="hover:text-[#00e5ff] hover:pl-2 transition-all duration-300">Koleksi Game</a></li>
                </ul>
            </div>

            <!-- Kolom 4: Contact -->
            <div>
                <h4 class="font-['Orbitron',_sans-serif] text-white text-[15px] font-bold tracking-[1px] uppercase mb-[25px]">Kontak</h4>
                <ul class="flex flex-col gap-[20px] font-['Inter',_sans-serif] text-[14px] text-[#6b7a90]">
                    <li class="flex items-center gap-[15px] group cursor-pointer">
                        <div class="w-[38px] h-[38px] rounded-[10px] bg-[#0B1221] border border-[#1A233A] flex items-center justify-center text-[#00e5ff] shrink-0 group-hover:bg-[#00e5ff]/10 group-hover:border-[#00e5ff]/50 transition-all duration-300">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <span class="group-hover:text-white transition-colors">0858-3284-1485</span>
                    </li>
                    <li class="flex items-center gap-[15px] group cursor-pointer">
                        <div class="w-[38px] h-[38px] rounded-[10px] bg-[#0B1221] border border-[#1A233A] flex items-center justify-center text-[#00e5ff] shrink-0 group-hover:bg-[#00e5ff]/10 group-hover:border-[#00e5ff]/50 transition-all duration-300">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <span class="group-hover:text-white transition-colors">trio.infinity@gmail.com</span>
                    </li>
                    <li class="flex items-start gap-[15px] group cursor-pointer">
                        <div class="w-[38px] h-[38px] rounded-[10px] bg-[#0B1221] border border-[#1A233A] flex items-center justify-center text-[#00e5ff] shrink-0 group-hover:bg-[#00e5ff]/10 group-hover:border-[#00e5ff]/50 transition-all duration-300">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <span class="pt-[8px] leading-relaxed group-hover:text-white transition-colors">Jessa Kost, Jl. Lampung 2, Indralaya Utara</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Garis Pemisah Copyright & Legal Links -->
        <div class="max-w-[1300px] mx-auto border-t border-[#1e293b] pt-[30px] flex flex-col md:flex-row justify-between items-center gap-[20px] font-['Inter',_sans-serif] text-[13px] text-[#6b7a90]">
            <p>&copy; 2026 Trio.Infinity PS. All rights reserved.</p>
            <div class="flex flex-wrap gap-[25px]">
                <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white transition-colors">Syarat & Layanan</a>
                <a href="#" class="hover:text-white transition-colors">Kebijakan Refund</a>
            </div>
        </div>
    </footer>
