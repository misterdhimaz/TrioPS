<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog - TRIO INFINITY PS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Rajdhani:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#030712] text-white font-['Inter',_sans-serif] antialiased selection:bg-[#00e5ff] selection:text-black">

    <!-- Panggil Navbar Landing Page -->
    <x-landing.navbar />





    <!-- CATALOG SECTION -->
    <section id="catalog" class="py-[120px] bg-[#03050a] px-6 relative min-h-screen">

        <!-- Ambient Background Lighting -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-[#00e5ff]/5 blur-[150px] pointer-events-none"></div>

        <div class="max-w-[1300px] mx-auto relative z-10">

            <!-- Section Header -->
            <div class="flex flex-col items-center text-center mb-[60px]">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#00e5ff]/30 bg-[#00e5ff]/5 mb-[20px] shadow-[0_0_15px_rgba(0,229,255,0.1)]">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00e5ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"></rect><circle cx="12" cy="12" r="2"></circle><path d="M6 12h.01M18 12h.01"></path></svg>
                    <span class="text-[#00e5ff] text-[10px] font-bold tracking-[2px] uppercase">Catalog Nexus</span>
                </div>
                <h2 class="font-['Orbitron',_sans-serif] text-[36px] md:text-[46px] font-bold text-white mb-[15px] tracking-[1px]">
                    Pilih <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#00e5ff] to-[#0066ff]">Monster Gaming-mu</span>
                </h2>
                <p class="font-['Inter',_sans-serif] text-[#8A99B5] text-[14px] max-w-[600px] leading-[1.8]">
                    Semua konsol sudah dilengkapi dengan game top-tier, dua controller, dan seluruh kabel yang diperlukan. Tinggal main!
                </p>
            </div>


            <!-- FILTER & SEARCH PANEL -->
<div class="mb-[50px] bg-[#0B1221]/80 backdrop-blur-md border border-[#1A233A] p-6 rounded-[24px] shadow-[0_10px_30px_rgba(0,0,0,0.3)]">
    <form action="{{ route('catalog.index') }}" method="GET" class="flex flex-col lg:flex-row gap-5 items-end">

        <!-- Search Input -->
        <div class="flex-1 w-full">
            <label class="block text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-3">Cari Unit</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-[#8A99B5] group-focus-within:text-[#00e5ff] transition-colors">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama konsol (ex: Alpha)..."
                    class="w-full bg-[#03060D] border border-[#1A233A] text-white text-[13px] pl-12 pr-4 py-3.5 rounded-xl outline-none focus:border-[#00e5ff] focus:shadow-[0_0_15px_rgba(0,229,255,0.1)] transition-all">
            </div>
        </div>

        <!-- Category Filter -->
        <div class="w-full lg:w-[250px]">
            <label class="block text-[#8A99B5] text-[10px] uppercase tracking-[2px] font-bold mb-3">Kategori</label>
            <div class="relative">
                <select name="category" onchange="this.form.submit()"
                    class="w-full bg-[#03060D] border border-[#1A233A] text-white text-[13px] px-4 py-3.5 rounded-xl outline-none focus:border-[#00e5ff] appearance-none cursor-pointer">
                    <option value="">Semua Konsol</option>
                    <option value="PS5" {{ request('category') == 'PS5' ? 'selected' : '' }}>PlayStation 5</option>
                    <option value="PS4" {{ request('category') == 'PS4' ? 'selected' : '' }}>PlayStation 4</option>
                </select>
                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-[#8A99B5]">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
            </div>
        </div>

        <!-- Reset Button -->
        @if(request('search') || request('category'))
        <div class="w-full lg:w-auto">
            <a href="{{ route('catalog.index') }}" class="flex items-center justify-center gap-2 px-6 py-3.5 bg-[#ff3366]/10 border border-[#ff3366]/30 text-[#ff3366] rounded-xl text-[11px] font-bold uppercase tracking-[1px] hover:bg-[#ff3366] hover:text-white transition-all h-[52px]">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                Reset
            </a>
        </div>
        @endif

        <!-- Submit Button (Manual) -->
        <div class="w-full lg:w-auto">
            <button type="submit" class="w-full lg:w-auto bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-black px-8 py-3.5 rounded-xl text-[11px] font-black uppercase tracking-[2px] shadow-[0_4px_15px_rgba(0,229,255,0.2)] hover:shadow-[0_0_25px_rgba(0,229,255,0.4)] transition-all h-[52px]">
                Apply Filter
            </button>
        </div>
    </form>
</div>

            <!-- Grid Cards (DINAMIS DARI DATABASE) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[25px]">
                @forelse($products as $product)
                <div class="bg-[#0B1221] border border-[#1A233A] rounded-[16px] overflow-hidden hover:border-[#00e5ff]/50 hover:shadow-[0_0_30px_rgba(0,229,255,0.15)] transition-all duration-300 group flex flex-col justify-between relative">

                    <!-- Glow Effect on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-br from-[#00e5ff]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <!-- Image Banner -->
                    <div class="relative h-[220px] w-full bg-[#1A233A] overflow-hidden shrink-0 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="text-[#8A99B5] text-[12px] font-bold uppercase tracking-[2px] opacity-50">Image Missing</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B1221] via-transparent to-transparent opacity-80"></div>
                        <div class="absolute top-4 left-4 bg-[#00e5ff] text-black px-2.5 py-1 rounded-[6px] text-[10px] font-bold tracking-[1px] shadow-[0_0_10px_rgba(0,229,255,0.5)] uppercase">{{ $product->category ?? 'CONSOLE' }}</div>
                    </div>

                    <div class="p-[25px] flex-1 flex flex-col relative z-10">
                        <!-- Card Header -->
                        <div class="flex justify-between items-start mb-[20px]">
                            <div>
                                <h3 class="font-['Orbitron',_sans-serif] text-white text-[18px] font-bold">{{ $product->name }}</h3>
                                <p class="font-['Inter',_sans-serif] text-[#8A99B5] text-[11px] mt-[4px] uppercase tracking-[1px]">{{ $product->version ?? 'Standard Edition' }}</p>
                            </div>

                            <!-- Logika Warna Status -->
                            @php
                                $statusColor = strtolower($product->status) == 'available' ? '10b981' : (strtolower($product->status) == 'limited' ? 'f59e0b' : 'ff3366');
                            @endphp
                            <div class="flex items-center gap-[6px] border border-[#{{$statusColor}}]/40 bg-[#{{$statusColor}}]/10 px-[10px] py-[4px] rounded-[6px]">
                                <span class="text-[#{{$statusColor}}] text-[9px] font-bold tracking-[1px] uppercase">{{ $product->status }}</span>
                            </div>
                        </div>

                        <!-- Specs Grid -->
                        <div class="grid grid-cols-2 gap-[10px] mb-[25px]">
                            <div class="bg-[#03060D] border border-[#1A233A] p-[10px] rounded-[8px] flex items-center gap-[10px]">
                                <div class="text-[#00e5ff]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/></svg></div>
                                <div class="text-white text-[9px] font-bold uppercase tracking-[1px] truncate">{{ $product->cpu ?? 'Zen 2 CPU' }}</div>
                            </div>
                            <div class="bg-[#03060D] border border-[#1A233A] p-[10px] rounded-[8px] flex items-center gap-[10px]">
                                <div class="text-[#00e5ff]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/></svg></div>
                                <div class="text-white text-[9px] font-bold uppercase tracking-[1px] truncate">{{ $product->resolution ?? '4K / 60FPS' }}</div>
                            </div>
                        </div>

                        <!-- Included Games Tags -->
                        <div class="mb-[25px] flex-1">
                            <div class="text-[#8A99B5] text-[9px] uppercase tracking-[1px] font-bold mb-[10px]">Top Games Installed</div>
                            <div class="flex flex-wrap gap-[6px]">
                                @if($product->included_games)
                                    @php $games = explode(',', $product->included_games); @endphp
                                    @foreach(array_slice($games, 0, 2) as $game)
                                        <span class="bg-[#03060D] border border-[#1A233A] text-[#8A99B5] text-[9px] font-bold uppercase tracking-[1px] px-[8px] py-[4px] rounded-[4px]">{{ trim($game) }}</span>
                                    @endforeach
                                    @if(count($games) > 2)
                                        <span class="bg-[#03060D] border border-[#1A233A] text-[9px] font-bold uppercase tracking-[1px] px-[8px] py-[4px] rounded-[4px] text-[#00e5ff]">+{{ count($games) - 2 }}</span>
                                    @endif
                                @else
                                    <span class="bg-[#03060D] border border-[#1A233A] text-[#8A99B5] text-[9px] font-bold uppercase tracking-[1px] px-[8px] py-[4px] rounded-[4px]">Library Kosong</span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer Actions -->
                        <div class="flex flex-col gap-3 pt-[20px] border-t border-[#1A233A] mt-auto">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-end gap-[4px]">
                                        <span class="font-['Orbitron',_sans-serif] text-[#00e5ff] text-[24px] font-bold leading-none">{{ number_format($product->price_per_hour / 1000, 0) }}K</span>
                                        <span class="text-[#8A99B5] text-[10px] mb-[2px]">/ jam</span>
                                    </div>
                                    <div class="text-[#8A99B5] text-[9px] mt-[2px] font-bold uppercase tracking-[1px]">2 Controllers Include</div>
                                </div>
                                <button onclick="openModal('modal-{{ $product->id }}', '{{ $product->id }}', '{{ date('Y-m-d') }}')" class="flex items-center gap-[6px] bg-[#00e5ff] text-black px-[18px] py-[10px] rounded-[8px] text-[11px] font-bold tracking-[1px] uppercase shadow-[0_0_15px_rgba(0,229,255,0.2)] hover:bg-white hover:shadow-[0_0_20px_rgba(0,229,255,0.5)] hover:-translate-y-0.5 transition-all duration-300">
                                    Book Now
                                </button>
                            </div>
                            <button onclick="openModal('modal-{{ $product->id }}', '{{ $product->id }}', '{{ date('Y-m-d') }}')" class="w-full flex items-center justify-center gap-2 bg-[#111827]/60 backdrop-blur-sm border border-white/10 text-[#cbd5e1] py-3 rounded-[8px] text-[10px] font-bold tracking-[1.5px] uppercase hover:border-[#00e5ff]/50 hover:text-white transition-all duration-300">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#00e5ff]"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- KOMPONEN MODAL DINAMIS -->
                <x-landing.modal-detail :product="$product" />

                @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 py-20 text-center bg-[#0B1221]/50 border border-[#1A233A] border-dashed rounded-[24px]">
                    <div class="w-16 h-16 bg-[#1A233A]/50 rounded-full flex items-center justify-center mx-auto mb-4 border border-[#1A233A]">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8A99B5" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <h3 class="text-white font-['Orbitron'] font-bold text-[18px] mb-2 tracking-[1px]">SISTEM KOSONG</h3>
                    <p class="text-[#8A99B5] text-[12px] font-bold uppercase tracking-[2px]">Admin belum menambahkan produk itu ke dalam database.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Panggil Footer Landing Page -->
    <x-landing.footer />

    <!-- SCRIPT UNTUK MODAL & LOGIKA MULTI-SELECT JAM DINAMIS -->
    <script>
        const allBookedSlots = @json($bookedSlots);

        function openModal(modalId, productId, todayDate) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            renderTimeSlots(productId, todayDate);
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function renderTimeSlots(productId, selectedDate) {
            const container = document.getElementById('time-grid-' + productId);
            if(!container) return;

            container.innerHTML = '';

            const bookedTimes = (allBookedSlots[productId] && allBookedSlots[productId][selectedDate])
                                ? allBookedSlots[productId][selectedDate]
                                : [];

            const allTimes = ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];

            allTimes.forEach(time => {
                if (bookedTimes.includes(time)) {
                    container.innerHTML += `
                        <button type="button" disabled class="bg-[#ff3366]/5 border border-[#ff3366]/20 text-[#ff3366]/40 py-2 rounded-lg text-[11px] font-bold cursor-not-allowed line-through relative">
                            ${time}
                        </button>`;
                } else {
                    container.innerHTML += `
                        <button type="button" data-time="${time}" onclick="toggleTimeSlot('${productId}', this)" class="time-btn-${productId} bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] py-2 rounded-lg text-[11px] font-bold hover:border-[#00e5ff]/50 transition-all">
                            ${time}
                        </button>`;
                }
            });

            const inputTimes = document.getElementById('input-times-' + productId);
            if(inputTimes) inputTimes.value = "[]";
            calculateTotal(productId);
        }

        function setDate(productId, dateValue, btnElement) {
            const inputDate = document.getElementById('input-date-' + productId);
            if(inputDate) inputDate.value = dateValue;

            const buttons = document.querySelectorAll('.date-btn-' + productId);
            buttons.forEach(btn => {
                btn.className = 'date-btn-' + productId + ' bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#00e5ff]/50 p-2.5 rounded-xl text-[11px] font-bold transition-all';
            });
            btnElement.className = 'date-btn-' + productId + ' bg-[#00e5ff] text-black p-2.5 rounded-xl text-[11px] font-bold shadow-[0_0_15px_rgba(0,229,255,0.3)] transition-all';

            renderTimeSlots(productId, dateValue);
        }

        function toggleTimeSlot(productId, btnElement) {
            const isSelected = btnElement.classList.contains('bg-[#00e5ff]');

            if (isSelected) {
                btnElement.classList.remove('bg-[#00e5ff]', 'text-black', 'shadow-[0_0_15px_rgba(0,229,255,0.3)]', 'selected-time-' + productId);
                btnElement.classList.add('bg-[#0B1221]', 'text-[#8A99B5]');
            } else {
                btnElement.classList.remove('bg-[#0B1221]', 'text-[#8A99B5]');
                btnElement.classList.add('bg-[#00e5ff]', 'text-black', 'shadow-[0_0_15px_rgba(0,229,255,0.3)]', 'selected-time-' + productId);
            }

            calculateTotal(productId);
        }

        function calculateTotal(productId) {
            const priceInput = document.getElementById('input-price-' + productId);
            if(!priceInput) return;

            const basePrice = parseInt(priceInput.value);
            const selectedButtons = document.querySelectorAll('.selected-time-' + productId);
            const duration = selectedButtons.length;

            const timeArray = Array.from(selectedButtons).map(btn => btn.getAttribute('data-time'));
            document.getElementById('input-times-' + productId).value = JSON.stringify(timeArray);

            let addonPrice = 0;
            const addonController = document.getElementById('addon-controller-' + productId);
            const addonHeadset = document.getElementById('addon-headset-' + productId);

            if(addonController && addonController.checked) addonPrice += 20000;
            if(addonHeadset && addonHeadset.checked) addonPrice += 25000;

            const displayDuration = document.getElementById('display-duration-' + productId);
            if(displayDuration) displayDuration.innerText = duration + " jam";

            const displayTotal = document.getElementById('display-total-' +   productId);
            if(displayTotal) {
                if (duration > 0) {
                    const total = (duration * basePrice) + addonPrice;
                    displayTotal.innerText = (total / 1000) + "K";
                } else {
                    displayTotal.innerText = "0K";
                }
            }
        }

        function submitBooking(productId) {
            const selectedTimes = document.getElementById('input-times-' + productId).value;
            const parsedTimes = JSON.parse(selectedTimes);

            if (parsedTimes.length === 0) {
                alert('SYSTEM WARNING: Pilih minimal 1 slot jam operasional!');
                return;
            }

            document.getElementById('form-booking-' + productId).submit();
        }
    </script>
</body>
</html>
