<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Trio Infinity PS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;500;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#03060D] text-white selection:bg-[#00e5ff] selection:text-black overflow-x-hidden">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-[100] bg-[#03050a]/80 backdrop-blur-md border-b border-[#1A233A]">
        <div class="max-w-[1200px] mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#00e5ff]/10 border border-[#00e5ff]/30 rounded-xl flex items-center justify-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00e5ff" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M12 12h.01"/><path d="M17 12h.01"/><path d="M7 12h.01"/></svg>
                </div>
                <span class="font-['Orbitron'] font-black text-[16px] tracking-wider uppercase">TRIO.INFINITY <span class="text-[#00e5ff]">PS</span></span>
            </a>

            <!-- Nav Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="/" class="text-[#8A99B5] hover:text-[#00e5ff] font-['Rajdhani'] font-bold text-[13px] uppercase tracking-[2px] transition-all">Home</a>
                <a href="/#catalog" class="text-[#8A99B5] hover:text-[#00e5ff] font-['Rajdhani'] font-bold text-[13px] uppercase tracking-[2px] transition-all">Catalog</a>
                <a href="{{ route('about') }}" class="text-[#00e5ff] font-['Rajdhani'] font-bold text-[13px] uppercase tracking-[2px]">About</a>
            </div>

            <!-- CTA -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl bg-[#00e5ff] text-black font-['Rajdhani'] font-black text-[11px] uppercase tracking-[1px] hover:shadow-[0_0_20px_rgba(0,229,255,0.4)] transition-all">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-[#8A99B5] hover:text-white font-['Rajdhani'] font-bold text-[13px] uppercase tracking-[2px] transition-all">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl border border-[#00e5ff] text-[#00e5ff] font-['Rajdhani'] font-bold text-[11px] uppercase tracking-[1px] hover:bg-[#00e5ff] hover:text-black transition-all">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#03060D] border-t border-[#1A233A] pt-20 pb-10">
        <div class="max-w-[1200px] mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1 md:col-span-2">
                <h4 class="font-['Orbitron'] font-black text-xl mb-6">TRIO.INFINITY <span class="text-[#00e5ff]">PS</span></h4>
                <p class="text-[#8A99B5] text-sm leading-relaxed max-w-sm mb-6">Protokol rental PlayStation generasi terbaru dengan performa maksimal dan kenyamanan tanpa batas. #NextGenGamingProtocol</p>
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-lg bg-[#1A233A] flex items-center justify-center hover:bg-[#00e5ff] hover:text-black transition-all cursor-pointer">IG</div>
                    <div class="w-10 h-10 rounded-lg bg-[#1A233A] flex items-center justify-center hover:bg-[#00e5ff] hover:text-black transition-all cursor-pointer">FB</div>
                </div>
            </div>
            <div>
                <h5 class="font-['Orbitron'] font-bold text-[12px] uppercase tracking-[2px] mb-6 text-white">Quick Links</h5>
                <ul class="space-y-4 text-[#8A99B5] text-[13px] font-['Rajdhani'] font-medium uppercase tracking-[1px]">
                    <li><a href="/#catalog" class="hover:text-[#00e5ff]">Unit Catalog</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[#00e5ff]">About Story</a></li>
                    <li><a href="/#terms" class="hover:text-[#00e5ff]">Terms & Rules</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-['Orbitron'] font-bold text-[12px] uppercase tracking-[2px] mb-6 text-white">Operational</h5>
                <p class="text-[#8A99B5] text-[13px] font-['Rajdhani'] font-medium">SETIAP HARI<br>10:00 - 24:00 WIB</p>
                <p class="text-[#00e5ff] text-[13px] font-['Rajdhani'] font-bold mt-4">Palembang, South Sumatra</p>
            </div>
        </div>
        <div class="text-center border-t border-[#1A233A] pt-10 text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold">
            &copy; 2026 TRIO INFINITY PS. ALL SYSTEMS OPERATIONAL.
        </div>
    </footer>

</body>
</html>
