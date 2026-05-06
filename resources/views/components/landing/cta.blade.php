<section class="py-[100px] relative overflow-hidden bg-[#070e20] border-y border-white/5 z-20">

        <!-- Background Ambient Glow (Agar tombol terlihat bersinar ke belakang) -->
        <div class="absolute inset-0 flex justify-center items-center pointer-events-none z-0">
            <div class="w-[600px] h-[200px] bg-[#00e5ff]/5 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-[800px] mx-auto px-6 relative z-10 text-center">

            <!-- Main Typography -->
            <h2 class="font-['Orbitron',_sans-serif] text-[36px] md:text-[46px] font-bold text-white mb-[20px] leading-[1.2] tracking-[1px]">
                Mulai <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">Perjalanan Gaming-mu</span><br>Hari Ini
            </h2>

            <!-- Subtitle -->
            <p class="font-['Inter',_sans-serif] text-[#8A99B5] text-[14px] md:text-[15px] max-w-[600px] mx-auto leading-[1.8] mb-[45px]">
                Booking konsol PlayStation favoritmu sekarang dan rasakan pengalaman gaming next-gen tanpa harus membayar harga penuh.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-center items-center gap-[20px]">

<a href="{{ route('register') }}"
   class="flex items-center gap-[10px] bg-gradient-to-r from-[#00e5ff] to-[#2563eb] text-white px-[35px] py-[15px] rounded-[8px] text-[14px] font-bold tracking-[1px] shadow-[0_10px_30px_rgba(0,229,255,0.3)] hover:shadow-[0_15px_40px_rgba(0,229,255,0.6)] hover:-translate-y-1 transition-all duration-300">

    <img src="{{ asset('images/icontombol.png') }}"
         alt="Gamepad"
         class="w-5 h-5 object-contain">

    Booking Sekarang
</a>

                <!-- Secondary Button -->
                <a href="#contact" class="flex items-center justify-center bg-[#111827]/40 backdrop-blur-sm border border-white/20 text-[#cbd5e1] hover:text-[#00e5ff] px-[35px] py-[15px] rounded-[8px] text-[14px] font-semibold tracking-[1px] hover:border-[#00e5ff] hover:bg-[#00e5ff]/10 hover:-translate-y-1 transition-all duration-300">
                    Hubungi Kami
                </a>

            </div>
        </div>
    </section>
