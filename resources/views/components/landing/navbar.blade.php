<nav class="fixed w-full z-50 bg-[#05080f]/95 backdrop-blur-md border-b border-white/5">
        <div class="max-w-[1300px] mx-auto px-6 h-[80px] flex items-center justify-between">

            <!-- Logo Section (Kiri) - Ukuran Diperkecil -->
            <div class="flex items-center gap-4">
                <!-- SVG Hexagon Gamepad Logo Custom with Gradient -->
                <div class="flex items-center justify-center drop-shadow-[0_0_15px_rgba(0,229,255,0.6)]">
                    <svg width="40" height="40" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="hexGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#00e5ff" />
                                <stop offset="100%" stop-color="#0066ff" />
                            </linearGradient>
                        </defs>
                        <!-- Hexagon Thick Border -->
                        <path d="M30 4L8 16.5V43.5L30 56L52 43.5V16.5L30 4Z" stroke="url(#hexGradient)" stroke-width="5" stroke-linejoin="round"/>
                        <!-- White Gamepad Outline -->
                        <path d="M16 36C14 36 13 31 13 26C13 21 17 19 22 19H38C43 19 47 21 47 26C47 31 46 36 44 36C41 36 40 31 38 30H22C20 31 19 36 16 36Z" stroke="white" stroke-width="2.5" stroke-linejoin="round"/>
                        <!-- D-pad (Left) -->
                        <path d="M20 25H26M23 22V28" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <!-- Action Buttons (Right) -->
                        <circle cx="37" cy="23" r="1.5" fill="white"/>
                        <circle cx="41" cy="26" r="1.5" fill="white"/>
                        <circle cx="37" cy="29" r="1.5" fill="white"/>
                    </svg>
                </div>
                <!-- Logo Text -->
                <div class="flex flex-col justify-center mt-0.5">
                    <div class="font-['Orbitron',_sans-serif] font-bold text-[24px] tracking-[1px] leading-none flex gap-2">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">TRIO.INFINITY</span>
                        <span class="text-white">PS</span>
                    </div>
                    <div class="font-['Rajdhani',_sans-serif] text-white text-[10px] tracking-[3px] uppercase mt-[4px] font-medium">Next-Gen Gaming Protocol</div>
                </div>
            </div>

            <!-- Navigation Links & Action Button (Kanan) -->
            <div class="flex items-center gap-[35px]">
                <!-- Links Navigasi -->
                <div class="hidden lg:flex items-center gap-[30px]">
                    <a href="/" class="font-['Inter',_sans-serif] text-[15px] font-medium text-white hover:text-[#00e5ff] transition-colors">Home</a>
                    <!-- Ubah di Navbar Anda -->
<a href="{{ route('catalog.index') }}" class="font-['Inter',_sans-serif] text-[15px] font-medium text-[#cbd5e1] hover:text-[#00e5ff] transition-colors">
    Katalog
</a>

                    <a href="#how-it-works" class="font-['Inter',_sans-serif] text-[15px] font-medium text-[#cbd5e1] hover:text-[#00e5ff] transition-colors">About</a>
                    <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}" class="font-['Inter',_sans-serif] text-[15px] font-medium text-[#cbd5e1] hover:text-[#00e5ff] transition-colors">
        Contact
    </a>
                </div>

                <!-- Tombol Dashboard -->
                <a href="{{ auth()->check() ? url('/dashboard') : route('login') }}"
                   class="flex items-center gap-2 bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-white px-6 py-2.5 rounded-[6px] text-[15px] font-semibold tracking-[0.5px] shadow-[0_0_15px_rgba(0,229,255,0.4)] hover:shadow-[0_0_25px_rgba(0,229,255,0.7)] hover:scale-105 transition-all duration-300">
                    <!-- Sparkle Icon -->
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/>
                    </svg>
                    Dashboard
                </a>
            </div>

        </div>
    </nav>
