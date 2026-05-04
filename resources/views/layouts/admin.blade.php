<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - Trio Infinity PS</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Inter:wght@400;500;600&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CUSTOM SCROLLBAR GLOBAL UNTUK SEMUA HALAMAN ADMIN -->
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #030712; border-left: 1px solid #1A233A; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #00e5ff; }
        .overflow-x-auto::-webkit-scrollbar { height: 6px; }
    </style>
</head>
<body class="bg-[#030712] text-white font-['Inter',_sans-serif] antialiased selection:bg-[#00e5ff] selection:text-black overflow-hidden">

    <!-- PEMBUNGKUS UTAMA -->
    <div class="flex h-screen w-full">

        <!-- SIDEBAR KIRI (TETAP) -->
        <aside class="w-[280px] bg-[#05080f] border-r border-[#1A233A] flex flex-col hidden md:flex z-50 shadow-[5px_0_30px_rgba(0,0,0,0.5)]">

            <!-- Brand Logo -->
           <div class="flex items-center gap-4 px-6 py-6 border-b border-[#1A233A]">
    <!-- SVG Hexagon Gamepad Logo Custom with Gradient -->
    <div class="flex items-center justify-center drop-shadow-[0_0_15px_rgba(0,229,255,0.6)] shrink-0">
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
        <div class="font-['Orbitron',_sans-serif] font-bold text-[18px] tracking-[1px] leading-none flex gap-1.5">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">TRIO.INFINITY</span>
            <span class="text-white">PS</span>
        </div>
        <div class="font-['Rajdhani',_sans-serif] text-[#8A99B5] text-[9px] tracking-[2.5px] uppercase mt-[4px] font-bold">Next-Gen Gaming Protocol</div>
    </div>
</div>

            <!-- Menu Navigasi -->
            <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto scrollbar-thin">

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-[10px] transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#00e5ff] shadow-[inset_0_0_15px_rgba(0,229,255,0.1)]' : 'text-[#8A99B5] hover:bg-[#1A233A]/50 hover:text-white' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('admin.dashboard') ? 'text-[#00e5ff]' : 'group-hover:text-[#00e5ff]' }} transition-colors"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    <span class="font-semibold text-[13px] tracking-[0.5px]">Dashboard Utama</span>
                </a>

                <!-- Katalog Konsol -->
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-[10px] transition-all group {{ request()->routeIs('products.*') ? 'bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#00e5ff] shadow-[inset_0_0_15px_rgba(0,229,255,0.1)]' : 'text-[#8A99B5] hover:bg-[#1A233A]/50 hover:text-white' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('products.*') ? 'text-[#00e5ff]' : 'group-hover:text-[#00e5ff]' }} transition-colors"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    <span class="font-semibold text-[13px] tracking-[0.5px]">Katalog Konsol</span>
                </a>

                <!-- Pricing Plans -->
                <a href="{{ route('pricing.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-[10px] transition-all group {{ request()->routeIs('pricing.*') ? 'bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#00e5ff] shadow-[inset_0_0_15px_rgba(0,229,255,0.1)]' : 'text-[#8A99B5] hover:bg-[#1A233A]/50 hover:text-white' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('pricing.*') ? 'text-[#00e5ff]' : 'group-hover:text-[#00e5ff]' }} transition-colors"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <span class="font-semibold text-[13px] tracking-[0.5px]">Pricing Plans</span>
                </a>




                <!-- Data Transaksi (Booking Management) -->
                <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-[10px] transition-all group {{ request()->routeIs('admin.bookings.*') ? 'bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#00e5ff] shadow-[inset_0_0_15px_rgba(0,229,255,0.1)]' : 'text-[#8A99B5] hover:bg-[#1A233A]/50 hover:text-white' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->routeIs('admin.bookings.*') ? 'text-[#00e5ff]' : 'group-hover:text-[#00e5ff]' }} transition-colors"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span class="font-semibold text-[13px] tracking-[0.5px]">Data Transaksi</span>
                </a>


                            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.reports.index') ? 'bg-gradient-to-r from-[#00e5ff]/20 to-transparent text-[#00e5ff] border-l-2 border-[#00e5ff]' : 'text-[#8A99B5] hover:bg-[#1A233A] hover:text-white' }}">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
    <span class="font-bold text-[12px] tracking-[1px]">Laporan Keuangan</span>
</a>

            </nav>

            <!-- Tambahkan menu ini di bawah Data Transaksi -->


            <!-- Logout Section -->
            <div class="p-4 border-t border-[#1A233A] shrink-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-3 w-full px-4 py-3 rounded-[10px] bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:text-[#ff3366] hover:border-[#ff3366]/50 transition-all group">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="font-bold text-[12px] tracking-[1px] uppercase">Logout System</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- AREA KANAN (Dibelah jadi Header Diam & Konten Bisa Scroll) -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden bg-[#030712] relative">

            <!-- Efek Cahaya Glow Background -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-[#00e5ff]/5 blur-[120px] rounded-full pointer-events-none z-0"></div>

            <!-- HEADER ATAS (TERKUNCI MATI) -->
            <header class="h-[80px] shrink-0 px-8 flex items-center justify-between border-b border-[#1A233A] bg-[#030712]/90 backdrop-blur-xl relative z-20">
                <div>
                    <h1 class="font-['Orbitron',_sans-serif] text-[20px] font-bold text-white tracking-[1px]">Dashboard Admin</h1>
                    <div class="font-['Rajdhani',_sans-serif] text-[#00e5ff] text-[12px] tracking-[2px] uppercase font-bold mt-1 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#00e5ff] animate-pulse"></span> Gacor
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <!-- Notifikasi -->
                    <button class="relative text-[#8A99B5] hover:text-[#00e5ff] transition-colors">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-[#ff3366] rounded-full border-2 border-[#030712]"></span>
                    </button>

                    <!-- Profil Admin -->
                    <div class="flex items-center gap-3 pl-5 border-l border-[#1A233A]">
                        <div class="text-right hidden sm:block">
                            <div class="text-[13px] font-bold text-white">{{ auth()->user()->name ?? 'Admin' }}</div>
                            <div class="text-[10px] text-[#00e5ff] font-['Rajdhani'] uppercase tracking-[1px]">Super Admin</div>
                        </div>
                        <div class="w-[40px] h-[40px] rounded-[10px] bg-[#1A233A] border border-[#00e5ff]/30 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'A') }}&background=00e5ff&color=000&bold=true" alt="Admin" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </header>

            <!-- ISI KONTEN (HANYA BAGIAN INI YANG BISA DI-SCROLL) -->
            <main class="flex-1 overflow-y-auto relative z-10 scrollbar-thin scrollbar-thumb-[#1A233A]">
                <div class="p-8 max-w-[1400px] mx-auto min-h-screen">
                    @yield('content')
                </div>
            </main>

        </div> <!-- Penutup Area Kanan -->

    </div> <!-- Penutup Pembungkus Utama -->
</body>
</html>
