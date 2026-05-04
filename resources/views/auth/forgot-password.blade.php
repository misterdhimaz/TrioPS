<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - Trio Infinity PS</title>
    <!-- Import Font Keren -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Load Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="m-0 p-4 w-full min-h-screen bg-[#050914] font-['Inter',_sans-serif] flex flex-col justify-center items-center text-white selection:bg-[#00A3FF] selection:text-black">

    <!-- Logo & Title -->
    <div class="text-center mb-[25px]">
        <h1 class="font-['Rajdhani',_sans-serif] text-[32px] font-bold tracking-[3px] leading-[1.2] m-0 [text-shadow:0_0_15px_rgba(0,163,255,0.4)]">TRIO.INFINITY<br>PS</h1>
        <div class="font-['Rajdhani',_sans-serif] text-[11px] text-[#00A3FF] tracking-[2px] mt-[5px]">INFINITE WORLDS. ONE RENTAL.</div>
    </div>

    <!-- Recovery Form Card -->
    <div class="bg-[#0B1221] w-full max-w-[420px] p-[35px_30px] rounded-[12px] border border-white/5 shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative box-border
                before:content-[''] before:absolute before:-top-[1px] before:-left-[1px] before:w-[25px] before:h-[25px] before:border-t-2 before:border-l-2 before:border-[#00A3FF] before:rounded-tl-[12px] before:shadow-[-2px_-2px_10px_rgba(0,163,255,0.5)]
                after:content-[''] after:absolute after:-bottom-[1px] after:-right-[1px] after:w-[25px] after:h-[25px] after:border-b-2 after:border-r-2 after:border-[#00A3FF] after:rounded-br-[12px] after:shadow-[2px_2px_10px_rgba(0,163,255,0.5)]">

        <div class="flex items-center mb-[20px]">
            <div class="w-[12px] h-[12px] border-2 border-[#00A3FF] rounded-full mr-[12px] shadow-[0_0_10px_rgba(0,163,255,0.6)]"></div>
            <h2 class="font-['Rajdhani',_sans-serif] text-[16px] tracking-[1px] m-0">SYSTEM RECOVERY</h2>
        </div>

        <div class="text-[11px] text-[#8A99B5] mb-[25px] leading-[1.6]">
            Lupa password? Tidak masalah. Masukkan email Anda dan sistem akan mengirimkan tautan untuk mengatur ulang password Anda.
        </div>

        <!-- Session Status (Sukses kirim email) -->
        @if (session('status'))
            <div class="bg-[#00A3FF]/10 border border-[#00A3FF] p-[10px] rounded-[6px] mb-[20px] text-[12px] text-[#00A3FF]">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validasi Error Laravel -->
        @if ($errors->any())
            <div class="bg-[#FF1744]/10 border border-[#FF1744] p-[10px] rounded-[6px] mb-[20px] text-[12px] text-[#FF1744]">
                <ul class="m-0 pl-[20px] list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-[25px]">
                <label for="email" class="block text-[11px] text-[#8A99B5] mb-[6px] tracking-[0.5px] uppercase">Email</label>
                <input id="email" type="email" name="email" class="w-full p-[12px_15px] bg-[#03060D] border border-[#1A233A] rounded-[6px] text-white font-['Inter',_sans-serif] text-[13px] box-border transition-all duration-300 focus:outline-none focus:border-[#00A3FF] focus:ring-0 focus:shadow-[0_0_12px_rgba(0,163,255,0.2)]" value="{{ old('email') }}" required autofocus placeholder="Enter Email">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full p-[14px] bg-[#00A3FF] text-black border-none rounded-[6px] font-['Rajdhani',_sans-serif] text-[16px] font-bold tracking-[1px] cursor-pointer transition-all duration-300 uppercase shadow-[0_0_15px_rgba(0,163,255,0.3)] hover:bg-white hover:shadow-[0_0_25px_rgba(0,163,255,0.6)]">
                SEND RESET LINK >
            </button>

            <!-- Link to Login -->
            <div class="text-center mt-[25px]">
                <a href="{{ route('login') }}" class="text-[#8A99B5] text-[11px] no-underline tracking-[1px] transition-colors duration-300 hover:text-white uppercase">BACK TO LOGIN</a>
            </div>
        </form>
    </div>

</body>
</html>
