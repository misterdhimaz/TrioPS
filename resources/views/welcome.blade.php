<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trio Infinity PS - Next-Gen Gaming Protocol</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Inter:wght@400;500;600&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .neon-text { text-shadow: 0 0 15px rgba(0, 229, 255, 0.5); }
        .cyber-border { position: relative; }
        .cyber-border::before { content: ''; position: absolute; top: -1px; left: -1px; width: 20px; height: 20px; border-top: 2px solid #00e5ff; border-left: 2px solid #00e5ff; border-top-left-radius: 8px; pointer-events: none; }
        .cyber-border::after { content: ''; position: absolute; bottom: -1px; right: -1px; width: 20px; height: 20px; border-bottom: 2px solid #00e5ff; border-right: 2px solid #00e5ff; border-bottom-right-radius: 8px; pointer-events: none; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #030712; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #00e5ff; }
    </style>
</head>
<body class="bg-[#030712] text-white font-['Inter',_sans-serif] antialiased selection:bg-[#00e5ff] selection:text-black">

    <!-- Memanggil Komponen dari dalam folder 'components/landing' -->
    <x-landing.navbar />
    <x-landing.hero />

    <x-landing.pricing />
    <x-landing.how-it-works />
    <x-landing.cta />
    <x-landing.footer />

    <!-- JAVASCRIPT UNTUK MODAL -->
<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }
</script>
</body>
</html>
