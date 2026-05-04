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

                <!-- Primary Button (Logo Hitam Tajam + Gradasi Biru Cerah) -->
                <a href="{{ route('register') }}" class="flex items-center gap-[10px] bg-gradient-to-r from-[#00e5ff] to-[#2563eb] text-white px-[35px] py-[15px] rounded-[8px] text-[14px] font-bold tracking-[1px] shadow-[0_10px_30px_rgba(0,229,255,0.3)] hover:shadow-[0_15px_40px_rgba(0,229,255,0.6)] hover:-translate-y-1 transition-all duration-300">
                    <!-- Icon Gamepad: Warna hitam (#03050a) dan ukuran diperbesar (20x20) -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#03050a" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.58 7.19c-.23-1.15-.97-2.18-2.06-2.82C18.25 3.62 16.5 3 12 3s-6.25.62-7.52 1.37C3.39 5.01 2.65 6.04 2.42 7.19L1 14.5c-.19.95.12 1.94.82 2.64A3.01 3.01 0 0 0 4.02 18h.04c1.17 0 2.22-.68 2.7-1.74l1.37-3.08c.18-.4.58-.66 1.02-.68h5.7c.44.02.84.28 1.02.68l1.37 3.08c.48 1.06 1.53 1.74 2.7 1.74h.04c.83.02 1.63-.3 2.2-.86.7-.7.1.01-1.94-.82-2.64l-1.42-7.31zM8 11H6v2H5v-2H3v-1h2V8h1v2h2v1zm7-1c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2 3c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2-3c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"></path>
                    </svg>
                    Booking Sekarang
                </a>

                <!-- Secondary Button -->
                <a href="#contact" class="flex items-center justify-center bg-[#111827]/40 backdrop-blur-sm border border-white/20 text-[#cbd5e1] hover:text-[#00e5ff] px-[35px] py-[15px] rounded-[8px] text-[14px] font-semibold tracking-[1px] hover:border-[#00e5ff] hover:bg-[#00e5ff]/10 hover:-translate-y-1 transition-all duration-300">
                    Hubungi Kami
                </a>

            </div>
        </div>
    </section>
