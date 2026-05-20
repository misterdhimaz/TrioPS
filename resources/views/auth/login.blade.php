<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Trio Infinity PS</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <h2 class="font-['Rajdhani',_sans-serif] text-[16px] tracking-[1px] m-0">SYSTEM LOGIN</h2>
        </div>

        @if ($errors->any())
            <div class="bg-[#FF1744]/10 border border-[#FF1744] p-[10px] rounded-[6px] mb-[20px] text-[12px] text-[#FF1744]">
                <ul class="m-0 pl-[20px] list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-[18px]">
                <label for="email" class="block text-[11px] text-[#8A99B5] mb-[6px] tracking-[0.5px] uppercase">Username/Email</label>
                <input id="email" type="email" name="email" class="w-full p-[12px_15px] bg-[#03060D] border border-[#1A233A] rounded-[6px] text-white font-['Inter',_sans-serif] text-[13px] box-border transition-all duration-300 focus:outline-none focus:border-[#00A3FF] focus:ring-0 focus:shadow-[0_0_12px_rgba(0,163,255,0.2)]" value="{{ old('email') }}" required autofocus placeholder="Enter Username/Email">
            </div>

            <div class="mb-[18px]">
                <label for="password" class="block text-[11px] text-[#8A99B5] mb-[6px] tracking-[0.5px] uppercase">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" class="w-full p-[12px_40px_12px_15px] bg-[#03060D] border border-[#1A233A] rounded-[6px] text-white font-['Inter',_sans-serif] text-[13px] box-border transition-all duration-300 focus:outline-none focus:border-[#00A3FF] focus:ring-0 focus:shadow-[0_0_12px_rgba(0,163,255,0.2)]" required placeholder="Enter Password">

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

            <label class="flex items-center my-[20px] cursor-pointer group">
                <input type="checkbox" name="remember" id="remember_me"
                       class="appearance-none w-[16px] h-[16px] bg-[#03060D] border border-[#1A233A] rounded-[3px] mr-[10px] cursor-pointer relative inline-block focus:ring-0 focus:ring-offset-0 checked:bg-[#00A3FF] checked:border-[#00A3FF] checked:after:content-['✔'] checked:after:absolute checked:after:text-black checked:after:text-[12px] checked:after:-top-[1px] checked:after:left-[2px] checked:after:font-bold">
                <span class="text-[11px] text-[#8A99B5] transition-colors group-hover:text-white uppercase">Remember me</span>
            </label>

            <button type="submit"
                    class="w-full p-[14px] bg-[#00A3FF] text-black border-none rounded-[6px] font-['Rajdhani',_sans-serif] text-[16px] font-bold tracking-[1px] cursor-pointer transition-all duration-300 uppercase shadow-[0_0_15px_rgba(0,163,255,0.3)] hover:bg-white hover:shadow-[0_0_25px_rgba(0,163,255,0.6)]">
                LOG IN >
            </button>

            <div class="text-center mt-[25px] flex flex-col gap-[10px]">
                <a href="{{ route('register') }}" class="text-[#8A99B5] text-[11px] no-underline tracking-[1px] transition-colors duration-300 hover:text-white uppercase">DON'T HAVE AN ACCOUNT? REGISTER</a>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[#8A99B5] text-[11px] no-underline tracking-[1px] transition-colors duration-300 hover:text-white uppercase">FORGOT PASSWORD?</a>
                @endif
            </div>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function () {
            // Ubah tipe input antara password dan text
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

            // Ubah icon mata
            eyeIcon.classList.toggle('hidden');
            eyeOffIcon.classList.toggle('hidden');
        });
    </script>
</body>
</html>
