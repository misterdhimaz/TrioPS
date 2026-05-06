<nav class="fixed w-full z-50 bg-[#05080f]/95 backdrop-blur-md border-b border-white/5">
        <div class="max-w-[1300px] mx-auto px-6 h-[80px] flex items-center justify-between">

            <!-- Logo Section (Kiri) - Ukuran Diperkecil -->
            <div class="flex items-center gap-4">

                <div class="flex items-center justify-center drop-shadow-[0_0_15px_rgba(0,229,255,0.6)]">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 h-20 object-contain">
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

                    <a href="{{ route('about') }}" class="font-['Inter',_sans-serif] text-[15px] font-medium text-[#cbd5e1] hover:text-[#00e5ff] transition-colors">About</a>
                    <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}" class="font-['Inter',_sans-serif] text-[15px] font-medium text-[#cbd5e1] hover:text-[#00e5ff] transition-colors">
        Contact
    </a>
                </div>

                <!-- Tombol Dashboard -->
                <a href="{{ auth()->check() ? url('/dashboard') : route('login') }}"
   class="flex items-center gap-2 bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-white px-6 py-2.5 rounded-[6px] text-[15px] font-semibold tracking-[0.5px] shadow-[0_0_15px_rgba(0,229,255,0.4)] hover:shadow-[0_0_25px_rgba(0,229,255,0.7)] hover:scale-105 transition-all duration-300">

    <img src="{{ asset('images/icontombol.png') }}"
         alt="Dashboard"
         class="w-5 h-5 object-contain">

    Dashboard
</a>
            </div>

        </div>
    </nav>
