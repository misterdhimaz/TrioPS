<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Trio Infinity PS</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Cyberpunk Scrollbar untuk Modal */
        .cyber-scroll::-webkit-scrollbar { width: 6px; }
        .cyber-scroll::-webkit-scrollbar-track { background: #03060D; border-radius: 4px; }
        .cyber-scroll::-webkit-scrollbar-thumb { background: #1A233A; border-radius: 4px; }
        .cyber-scroll::-webkit-scrollbar-thumb:hover { background: #00A3FF; }
    </style>
</head>
<body class="m-0 p-4 w-full min-h-screen bg-[#050914] font-['Inter',_sans-serif] flex flex-col justify-center items-center text-white selection:bg-[#00A3FF] selection:text-black">

    <div class="text-center mb-[25px]">
        <h1 class="font-['Rajdhani',_sans-serif] text-[32px] font-bold tracking-[3px] leading-[1.2] m-0 [text-shadow:0_0_15px_rgba(0,163,255,0.4)]">TRIO.INFINITY<br>PS</h1>
        <div class="font-['Rajdhani',_sans-serif] text-[11px] text-[#00A3FF] tracking-[2px] mt-[5px]">INFINITE WORLDS. ONE RENTAL.</div>
    </div>

    <div class="bg-[#0B1221] w-full max-w-[420px] p-[35px_30px] rounded-[12px] border border-white/5 shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative box-border
                before:content-[''] before:absolute before:-top-[1px] before:-left-[1px] before:w-[25px] before:h-[25px] before:border-t-2 before:border-l-2 before:border-[#00A3FF] before:rounded-tl-[12px] before:shadow-[-2px_-2px_10px_rgba(0,163,255,0.5)]
                after:content-[''] after:absolute after:-bottom-[1px] after:-right-[1px] after:w-[25px] after:h-[25px] after:border-b-2 after:border-r-2 after:border-[#00A3FF] after:rounded-br-[12px] after:shadow-[2px_2px_10px_rgba(0,163,255,0.5)]">

        <div class="flex items-center mb-[25px]">
            <div class="w-[12px] h-[12px] border-2 border-[#00A3FF] rounded-full mr-[12px] shadow-[0_0_10px_rgba(0,163,255,0.6)]"></div>
            <h2 class="font-['Rajdhani',_sans-serif] text-[16px] tracking-[1px] m-0">SYSTEM REGISTRATION</h2>
        </div>

        @if ($errors->any())
            <div class="bg-[#FF1744]/10 border border-[#FF1744] p-[10px] rounded-[6px] mb-[20px] text-[12px] text-[#FF1744]">
                <ul class="m-0 pl-[20px] list-disc">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-[18px]">
                <label for="name" class="block text-[11px] text-[#8A99B5] mb-[6px] tracking-[0.5px]">Nama Lengkap</label>
                <input id="name" type="text" name="name" class="w-full p-[12px_15px] bg-[#03060D] border border-[#1A233A] rounded-[6px] text-white font-['Inter',_sans-serif] text-[13px] box-border transition-all duration-300 focus:outline-none focus:border-[#00A3FF] focus:ring-0 focus:shadow-[0_0_12px_rgba(0,163,255,0.2)]" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
            </div>

            <div class="mb-[18px]">
                <label for="email" class="block text-[11px] text-[#8A99B5] mb-[6px] tracking-[0.5px]">Email</label>
                <input id="email" type="email" name="email" class="w-full p-[12px_15px] bg-[#03060D] border border-[#1A233A] rounded-[6px] text-white font-['Inter',_sans-serif] text-[13px] box-border transition-all duration-300 focus:outline-none focus:border-[#00A3FF] focus:ring-0 focus:shadow-[0_0_12px_rgba(0,163,255,0.2)]" value="{{ old('email') }}" required placeholder="Masukkan email">
            </div>

            <div class="mb-[18px]">
                <label for="password" class="block text-[11px] text-[#8A99B5] mb-[6px] tracking-[0.5px]">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" class="w-full p-[12px_40px_12px_15px] bg-[#03060D] border border-[#1A233A] rounded-[6px] text-white font-['Inter',_sans-serif] text-[13px] box-border transition-all duration-300 focus:outline-none focus:border-[#00A3FF] focus:ring-0 focus:shadow-[0_0_12px_rgba(0,163,255,0.2)]" required placeholder="Masukkan password">

                    <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#8A99B5] hover:text-[#00A3FF] transition-colors focus:outline-none">
                        <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg id="eyeOffIcon" class="hidden" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mb-[18px]">
                <label for="password_confirmation" class="block text-[11px] text-[#8A99B5] mb-[6px] tracking-[0.5px]">Konfirmasi Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="w-full p-[12px_40px_12px_15px] bg-[#03060D] border border-[#1A233A] rounded-[6px] text-white font-['Inter',_sans-serif] text-[13px] box-border transition-all duration-300 focus:outline-none focus:border-[#00A3FF] focus:ring-0 focus:shadow-[0_0_12px_rgba(0,163,255,0.2)]" required placeholder="Ulangi password">

                    <button type="button" id="togglePasswordConfirm" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#8A99B5] hover:text-[#00A3FF] transition-colors focus:outline-none">
                        <svg id="eyeIconConfirm" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg id="eyeOffIconConfirm" class="hidden" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center my-[20px] group">
                <input type="checkbox" name="terms" id="terms_checkbox" required
                       class="appearance-none w-[16px] h-[16px] bg-[#03060D] border border-[#1A233A] rounded-[3px] mr-[10px] cursor-pointer relative inline-block focus:ring-0 focus:ring-offset-0 checked:bg-[#00A3FF] checked:border-[#00A3FF] checked:after:content-['✔'] checked:after:absolute checked:after:text-black checked:after:text-[12px] checked:after:-top-[1px] checked:after:left-[2px] checked:after:font-bold">
                <label for="terms_checkbox" class="text-[11px] text-[#8A99B5] cursor-pointer transition-colors group-hover:text-white">I agree to the</label>
                <button type="button" onclick="openModal()" class="text-[11px] text-[#00A3FF] font-semibold ml-1 cursor-pointer transition-all hover:text-white hover:underline decoration-[#00A3FF] underline-offset-2 bg-transparent border-none p-0 outline-none">
                    Terms & Conditions
                </button>
            </div>

            <button type="submit"
                    class="w-full p-[14px] bg-[#00A3FF] text-black border-none rounded-[6px] font-['Rajdhani',_sans-serif] text-[16px] font-bold tracking-[1px] cursor-pointer transition-all duration-300 uppercase shadow-[0_0_15px_rgba(0,163,255,0.3)] hover:bg-white hover:shadow-[0_0_25px_rgba(0,163,255,0.6)]">
                REGISTER >
            </button>

            <div class="text-center mt-[25px]">
                <a href="{{ route('login') }}" class="text-[#8A99B5] text-[11px] no-underline tracking-[1px] transition-colors duration-300 hover:text-white">ALREADY REGISTERED? LOG IN</a>
            </div>
        </form>
    </div>

    <div id="termsModal" class="fixed inset-0 z-50 hidden flex justify-center items-center bg-black/80 backdrop-blur-sm p-4 opacity-0 transition-opacity duration-300">
        <div class="bg-[#0B1221] w-full max-w-[500px] rounded-[12px] border border-[#1A233A] shadow-[0_20px_50px_rgba(0,0,0,0.8)] relative box-border transform scale-95 transition-transform duration-300 overflow-hidden
                    before:content-[''] before:absolute before:-top-[1px] before:-left-[1px] before:w-[25px] before:h-[25px] before:border-t-2 before:border-l-2 before:border-[#00A3FF] before:rounded-tl-[12px] before:z-10
                    after:content-[''] after:absolute after:-bottom-[1px] after:-right-[1px] after:w-[25px] after:h-[25px] after:border-b-2 after:border-r-2 after:border-[#00A3FF] after:rounded-br-[12px] after:z-10">

            <div class="flex items-center justify-between p-[25px] border-b border-white/5 bg-[#03060D]">
                <div class="flex items-center">
                    <div class="w-[10px] h-[10px] border-2 border-[#00A3FF] rounded-full mr-[12px] shadow-[0_0_8px_rgba(0,163,255,0.6)]"></div>
                    <h2 class="font-['Rajdhani',_sans-serif] text-[16px] tracking-[1px] m-0 text-white font-bold">TERMS & CONDITIONS</h2>
                </div>
                <button onclick="closeModal()" class="text-[#8A99B5] hover:text-[#FF1744] transition-colors bg-transparent border-none text-[20px] cursor-pointer">&times;</button>
            </div>

            <div class="p-[25px] max-h-[50vh] overflow-y-auto cyber-scroll text-[12px] text-[#8A99B5] leading-[1.6]">
                <p class="mb-4"><strong class="text-white">1. Ketentuan Umum</strong><br>
                Dengan mendaftar dan menggunakan layanan Trio Infinity PS, Anda setuju untuk mematuhi semua syarat dan ketentuan yang berlaku. Akun Anda bersifat pribadi dan tidak boleh dipindahtangankan ke pihak lain.</p>

                <p class="mb-4"><strong class="text-white">2. Sistem Reservasi & Pembayaran</strong><br>
                Semua penyewaan konsol PS4/PS5 wajib dilakukan melalui sistem booking online. Waktu penyewaan akan berjalan sesuai dengan slot yang dipilih. Keterlambatan tanpa konfirmasi tidak akan mendapatkan kompensasi waktu.</p>

                <p class="mb-4"><strong class="text-white">3. Kewajiban Pengguna</strong><br>
                Pengguna diwajibkan untuk menjaga keutuhan hardware (Konsol, Controller/Stik, TV, dan Aksesoris lainnya). Kerusakan yang disebabkan oleh kelalaian pengguna (terjatuh, terkena tumpahan air, emosi saat bermain) sepenuhnya menjadi tanggung jawab penyewa dan akan dikenakan denda penggantian sesuai harga komponen.</p>

                <p class="mb-0"><strong class="text-white">4. Hak Pengelola</strong><br>
                Admin Trio Infinity PS berhak membatalkan sesi secara sepihak dan meng-hibernate sistem jika ditemukan indikasi pelanggaran aturan, manipulasi sistem, atau perilaku yang mengganggu kenyamanan pengunjung lain.</p>
            </div>

            <div class="p-[20px] border-t border-white/5 bg-[#03060D] flex gap-[15px] justify-end">
                <button onclick="closeModal()" class="px-[20px] py-[10px] bg-transparent text-[#8A99B5] border border-[#1A233A] rounded-[6px] text-[11px] font-bold tracking-[1px] cursor-pointer hover:bg-[#1A233A] hover:text-white transition-all uppercase">
                    Batal
                </button>
                <button onclick="agreeTerms()" class="px-[20px] py-[10px] bg-[#00A3FF] text-black border-none rounded-[6px] text-[11px] font-bold tracking-[1px] cursor-pointer hover:bg-white transition-all uppercase shadow-[0_0_10px_rgba(0,163,255,0.3)]">
                    Saya Setuju
                </button>
            </div>
        </div>
    </div>

    <script>
        // Modal Logic
        const modal = document.getElementById('termsModal');
        const modalBox = modal.querySelector('div');

        function openModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalBox.classList.remove('scale-95');
                modalBox.classList.add('scale-100');
            }, 10);
        }

        function closeModal() {
            modal.classList.add('opacity-0');
            modalBox.classList.remove('scale-100');
            modalBox.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function agreeTerms() {
            document.getElementById('terms_checkbox').checked = true;
            closeModal();
        }

        // Show/Hide Password Logic (Primary Password)
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            eyeIcon.classList.toggle('hidden');
            eyeOffIcon.classList.toggle('hidden');
        });

        // Show/Hide Password Logic (Confirmation Password)
        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirmInput = document.getElementById('password_confirmation');
        const eyeIconConfirm = document.getElementById('eyeIconConfirm');
        const eyeOffIconConfirm = document.getElementById('eyeOffIconConfirm');

        togglePasswordConfirm.addEventListener('click', function () {
            const isPassword = passwordConfirmInput.getAttribute('type') === 'password';
            passwordConfirmInput.setAttribute('type', isPassword ? 'text' : 'password');
            eyeIconConfirm.classList.toggle('hidden');
            eyeOffIconConfirm.classList.toggle('hidden');
        });
    </script>
</body>
</html>
