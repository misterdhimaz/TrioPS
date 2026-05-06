<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Trio's Story - Trio Infinity PS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;500;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#03060D] text-white selection:bg-[#00e5ff] selection:text-black overflow-x-hidden">

    <!-- Memanggil Navbar Publik Anda -->
    @include('components.landing.navbar')

    <!-- Ambient Glow Background -->
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[400px] bg-[#00e5ff]/5 blur-[150px] pointer-events-none -z-10"></div>

    <main class="relative z-10 pt-20">
        <div class="max-w-[1200px] mx-auto px-6 py-16">

            <!-- SECTION 1: THE FOUNDERS -->
            <div class="text-center mb-24">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#00e5ff]/10 border border-[#00e5ff]/30 mb-6">
                    <span class="w-2 h-2 rounded-full bg-[#00e5ff] animate-pulse"></span>
                    <span class="text-[#00e5ff] text-[10px] font-bold tracking-[3px] uppercase font-['Rajdhani']">Origin Protocol: Activated</span>
                </div>
                <h1 class="text-4xl md:text-[56px] font-black text-white font-['Orbitron'] tracking-wide leading-tight mb-6 uppercase">
                    THE STORY OF <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">THE TRIO</span>
                </h1>
                <p class="text-[#8A99B5] text-sm md:text-base max-w-3xl mx-auto font-['Inter'] leading-loose italic">
                    "Trio Infinity PS tidak lahir dari meja rapat yang kaku, melainkan dari rasa lelah menunggu di parkiran rental yang selalu penuh."
                </p>
            </div>

            <!-- SECTION 2: THE FRUSTRATION (Asal Mula Cerita) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-32">
                <div class="order-2 lg:order-1 space-y-6">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-1.5 h-8 bg-[#ff3366] rounded-full shadow-[0_0_10px_#ff3366]"></div>
                        <h2 class="text-white font-['Orbitron'] font-bold text-2xl uppercase tracking-wider">System Failure</h2>
                    </div>
                    <div class="prose prose-invert text-[#8A99B5] font-['Inter'] leading-relaxed space-y-4">
                        <p>
                            Berawal dari saya dan dua teman saya yang memiliki satu hobi yang sama: Gaming. Namun, hobi ini seringkali terhambat oleh realita yang menyebalkan. Setiap kali kami ingin bermain, kami selalu mendapati jawaban yang sama di setiap tempat rental: <span class="text-white font-bold">"Slot Full."</span>
                        </p>
                        <p>
                            Masalahnya bukan karena tempatnya penuh, tapi karena ketiadaan sistem yang transparan. Kami harus datang jauh-jauh hanya untuk kecewa karena tidak ada fitur booking. Di situlah titik balik kami. Kami menyadari bahwa industri rental PS membutuhkan sebuah <span class="text-[#00e5ff] font-bold text-sm uppercase font-['Orbitron'] tracking-tighter">Protokol Baru</span>.
                        </p>
                        <p>
                            Kami bertiga memutuskan untuk tidak lagi menjadi konsumen yang menunggu, melainkan membangun solusi. Sebuah tempat di mana setiap gamer bisa memantau slot secara real-time dan mengamankan waktu bermain mereka bahkan sebelum berangkat dari rumah.
                        </p>
                    </div>
                </div>

                <!-- Illustration: The Broken Connection -->
                <div class="order-1 lg:order-2 relative flex justify-center items-center h-[350px]">
                    <div class="absolute inset-0 border border-dashed border-[#ff3366]/20 rounded-full animate-[spin_40s_linear_infinite] scale-[0.9]"></div>
                    <div class="w-32 h-32 bg-[#0B1221] border-2 border-[#ff3366] rounded-[32px] flex items-center justify-center relative z-10 shadow-[0_0_50px_rgba(255,51,102,0.2)]">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ff3366" stroke-width="1.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </div>
                    <div class="absolute -top-4 right-1/4 bg-[#ff3366]/10 border border-[#ff3366]/30 px-4 py-2 rounded-xl text-[#ff3366] text-[10px] font-black uppercase tracking-widest font-['Rajdhani']">NO SLOTS AVAILABLE</div>
                </div>
            </div>

            <!-- SECTION 3: THE SOLUTION (Trio Infinity PS) -->
            <div class="bg-[#0B1221]/40 border border-[#1A233A] rounded-[40px] p-10 md:p-20 relative overflow-hidden mb-32">
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-[#00e5ff]/5 blur-[100px] rounded-full"></div>

                <div class="max-w-3xl mx-auto text-center relative z-10">
                    <h2 class="text-white font-['Orbitron'] font-black text-3xl mb-8 uppercase italic">THE INFINITY PROTOCOL</h2>
                    <p class="text-[#8A99B5] text-lg font-['Inter'] leading-loose mb-12">
                        Kini, <span class="text-white font-bold">Trio Infinity PS</span> hadir di Palembang sebagai jawaban atas keresahan tersebut. Kami mengintegrasikan teknologi dashboard ke dalam dunia rental PS, memastikan tidak ada lagi waktu yang terbuang sia-sia hanya untuk sebuah slot yang "katanya" penuh.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="p-6 bg-[#03060D] border border-[#1A233A] rounded-2xl">
                            <div class="text-[#00e5ff] font-['Orbitron'] font-black text-2xl mb-1">REAL-TIME</div>
                            <div class="text-[#8A99B5] text-[10px] uppercase tracking-widest font-bold">Telemetry System</div>
                        </div>
                        <div class="p-6 bg-[#03060D] border border-[#1A233A] rounded-2xl">
                            <div class="text-[#00e5ff] font-['Orbitron'] font-black text-2xl mb-1">PRIORITY</div>
                            <div class="text-[#8A99B5] text-[10px] uppercase tracking-widest font-bold">Booking Access</div>
                        </div>
                        <div class="p-6 bg-[#03060D] border border-[#1A233A] rounded-2xl">
                            <div class="text-[#00e5ff] font-['Orbitron'] font-black text-2xl mb-1">PREMIUM</div>
                            <div class="text-[#8A99B5] text-[10px] uppercase tracking-widest font-bold">Unit Maintenance</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Memanggil CTA Publik Anda -->
            @include('components.landing.cta')

        </div>
    </main>

    <!-- Memanggil Footer Publik Anda -->
    @include('components.landing.footer')

</body>
</html>
