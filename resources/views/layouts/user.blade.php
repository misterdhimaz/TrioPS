<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Member Area') - Trio Infinity PS</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Inter:wght@400;500;600&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#030712] text-white font-['Inter',_sans-serif] antialiased overflow-hidden">

    <div class="flex h-screen w-full">
        <!-- SIDEBAR USER -->
        <aside class="w-[280px] bg-[#05080f] border-r border-[#1A233A] flex flex-col hidden md:flex z-50">
            <div class="h-[80px] flex items-center px-6 border-b border-[#1A233A]">

            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 group transition-transform duration-300 hover:scale-[1.02]">
    <!-- SVG Hexagon Gamepad Logo Custom with Gradient -->
    <div class="flex items-center justify-center drop-shadow-[0_0_15px_rgba(0,229,255,0.6)] shrink-0 group-hover:drop-shadow-[0_0_25px_rgba(0,229,255,0.8)] transition-all">
        <svg width="40" height="40" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="hexGradientUser" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#00e5ff" />
                    <stop offset="100%" stop-color="#0066ff" />
                </linearGradient>
            </defs>
            <!-- Hexagon Thick Border -->
            <path d="M30 4L8 16.5V43.5L30 56L52 43.5V16.5L30 4Z" stroke="url(#hexGradientUser)" stroke-width="5" stroke-linejoin="round"/>
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
        <div class="font-['Rajdhani',_sans-serif] text-[#8A99B5] text-[9px] tracking-[2.5px] uppercase mt-[4px] font-bold group-hover:text-[#00e5ff] transition-colors">Next-Gen Gaming Protocol</div>
    </div>
</a>

            </div>

            <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-[10px] {{ request()->routeIs('dashboard') ? 'bg-[#00e5ff]/10 text-[#00e5ff] border border-[#00e5ff]/20' : 'text-[#8A99B5] hover:bg-[#1A233A]' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    <span class="font-semibold text-[13px]">My Dashboard</span>
                </a>
                <a href="/#catalog" class="flex items-center gap-3 px-4 py-3 rounded-[10px] text-[#8A99B5] hover:bg-[#1A233A]">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span class="font-semibold text-[13px]">Booking Lagi</span>
                </a>
            </nav>

            <div class="p-4 border-t border-[#1A233A]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 rounded-[10px] bg-[#0B1221] text-[#8A99B5] hover:text-[#ff3366] transition-all flex items-center justify-center gap-3">
                        <span class="font-bold text-[12px] uppercase">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTENT AREA -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            <header class="h-[80px] shrink-0 px-8 flex items-center justify-between border-b border-[#1A233A] bg-[#030712]/90 backdrop-blur-xl z-20">
                <h1 class="font-['Orbitron'] text-[18px] font-bold">Member Dashboard</h1>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <div class="text-[13px] font-bold">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-[#00e5ff] uppercase tracking-[1px]">Player Setia</div>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-[#1A233A] border border-[#00e5ff]/30 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=00e5ff&color=000" class="w-full h-full object-cover">
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 relative z-10">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
