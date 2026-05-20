@props(['product'])

<div id="modal-{{ $product->id }}"
     class="hidden fixed inset-0 z-[9999] flex items-center justify-center p-4 md:p-6 bg-[#03050a]/80 backdrop-blur-xl transition-all duration-300">

    <div class="w-full max-w-[1100px] h-[85vh] translate-y-10 bg-[#0B1221] border border-[#1A233A] rounded-[24px] overflow-hidden flex flex-col md:flex-row shadow-[0_0_80px_rgba(0,0,0,0.8)] relative"
         onclick="event.stopPropagation()">

        <button onclick="closeModal('modal-{{ $product->id }}')"
                class="absolute top-4 right-4 md:top-6 md:right-6 z-50 w-10 h-10 bg-[#1A233A]/80 hover:bg-[#ff3366] text-[#8A99B5] hover:text-white rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-md border border-white/5 shadow-lg">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>

        <div class="hidden md:flex md:w-[45%] h-full bg-[#03060D] border-r border-[#1A233A] p-8 items-center justify-center relative overflow-hidden shrink-0">
            <div class="absolute w-[120%] h-[60%] bg-[#00e5ff]/15 blur-[120px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 w-full group">
                <div class="relative aspect-[4/3] rounded-[20px] border border-white/10 overflow-hidden shadow-[0_30px_60px_rgba(0,0,0,0.5)]">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#03060D] via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="absolute -top-4 -left-4 w-12 h-12 border-t-2 border-l-2 border-[#00e5ff]/40 rounded-tl-lg"></div>
                <div class="absolute -bottom-4 -right-4 w-12 h-12 border-b-2 border-r-2 border-[#00e5ff]/40 rounded-br-lg"></div>
            </div>
        </div>

        <div class="w-full md:w-[55%] h-full overflow-y-auto p-6 md:p-10 pb-12 scrollbar-thin scrollbar-thumb-[#1A233A] scrollbar-track-transparent">

            <div class="mb-8 pr-12"> <div class="inline-flex items-center gap-2 bg-[#00e5ff]/10 border border-[#00e5ff]/30 text-[#00e5ff] px-3 py-1 rounded-full text-[10px] font-bold tracking-[2px] uppercase mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#00e5ff] animate-pulse"></span>
                    {{ $product->category }}
                </div>
                <h2 class="font-['Orbitron',_sans-serif] text-[28px] md:text-[36px] font-bold text-white leading-tight mb-1">{{ $product->name }}</h2>
                <p class="font-['Inter',_sans-serif] text-[#8A99B5] text-[13px] mb-4">{{ $product->version }}</p>
                <p class="font-['Inter',_sans-serif] text-[#cbd5e1] text-[13px] leading-[1.8] opacity-80">
                    Nikmati performa gaming maksimal dengan konsol ini. Sudah terpasang koleksi game eksklusif terbaik untuk pengalaman imersif yang tak terlupakan.
                </p>
            </div>

            <div class="mb-10 p-6 bg-[#03060D]/50 border border-[#1A233A] rounded-[20px] shadow-sm">
                <h4 class="text-[#8A99B5] text-[11px] font-bold uppercase tracking-widest mb-6">Technical Specs</h4>

                <div class="grid grid-cols-2 gap-y-6 gap-x-4">
                    <div class="flex items-start gap-4">
                        <div class="text-[#00e5ff] mt-1">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg>
                        </div>
                        <div>
                            <span class="text-[#8A99B5] text-[10px] uppercase tracking-wider block mb-1">CPU</span>
                            <span class="text-white text-[13px] font-medium">{{ $product->cpu }}</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-[#00e5ff] mt-1">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
                        </div>
                        <div>
                            <span class="text-[#8A99B5] text-[10px] uppercase tracking-wider block mb-1">Resolution</span>
                            <span class="text-white text-[13px] font-medium">{{ $product->resolution }}</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-[#00e5ff] mt-1">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12H2m3.45-6.89L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                        </div>
                        <div>
                            <span class="text-[#8A99B5] text-[10px] uppercase tracking-wider block mb-1">Storage</span>
                            <span class="text-white text-[13px] font-medium">{{ $product->storage }}</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-[#00e5ff] mt-1">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0M1.42 9a16 16 0 0 1 21.16 0"/><circle cx="12" cy="20" r="1"/></svg>
                        </div>
                        <div>
                            <span class="text-[#8A99B5] text-[10px] uppercase tracking-wider block mb-1">Connectivity</span>
                            <span class="text-white text-[13px] font-medium">{{ $product->connectivity }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-10">
                <h4 class="text-white font-['Orbitron'] text-[13px] font-bold mb-4 flex items-center gap-3">
                    <span class="w-6 h-[2px] bg-[#00e5ff]"></span>
                    FULL GAME LIBRARY
                </h4>
                <div class="grid grid-cols-3 gap-3">
                    <div class="aspect-[3/4] rounded-xl overflow-hidden border border-white/5 hover:border-[#00e5ff]/50 transition-all duration-300">
                        <img src="{{ asset('images/game1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=400&auto=format&fit=crop'" class="w-full h-full object-cover">
                    </div>
                    <div class="aspect-[3/4] rounded-xl overflow-hidden border border-white/5 hover:border-[#00e5ff]/50 transition-all duration-300">
                        <img src="{{ asset('images/game2.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=400&auto=format&fit=crop'" class="w-full h-full object-cover">
                    </div>
                    <div class="aspect-[3/4] rounded-xl overflow-hidden border border-white/5 hover:border-[#00e5ff]/50 transition-all duration-300">
                        <img src="{{ asset('images/game3.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=400&auto=format&fit=crop'" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <form action="{{ route('bookings.store') }}" method="POST" id="form-booking-{{ $product->id }}" class="bg-[#03060D] border border-[#1A233A] rounded-[20px] p-6 shadow-inner mb-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" id="input-price-{{ $product->id }}" value="{{ $product->price_per_hour }}">
                <input type="hidden" name="booking_date" id="input-date-{{ $product->id }}" value="{{ date('Y-m-d') }}">

                <input type="hidden" name="selected_times" id="input-times-{{ $product->id }}" value="[]">

                <h4 class="text-[#00e5ff] font-['Orbitron'] text-[14px] font-bold mb-6 tracking-[1px] flex items-center gap-3 uppercase">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Booking Details r
                </h4>

                <div class="mb-6">
                    <label class="block text-[#8A99B5] text-[10px] font-bold uppercase tracking-widest mb-3">Pilih Tanggal</label>
                    <div class="grid grid-cols-3 gap-2">
                        <button type="button" onclick="setDate('{{ $product->id }}', '{{ date('Y-m-d') }}', this)" class="date-btn-{{ $product->id }} bg-[#00e5ff] text-black p-2.5 rounded-xl text-[11px] font-bold shadow-[0_0_15px_rgba(0,229,255,0.3)]">
                            <span class="block text-[9px] opacity-70 mb-0.5">Hari Ini</span>
                            {{ date('d M') }}
                        </button>
                        <button type="button" onclick="setDate('{{ $product->id }}', '{{ date('Y-m-d', strtotime('+1 day')) }}', this)" class="date-btn-{{ $product->id }} bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#00e5ff]/50 p-2.5 rounded-xl text-[11px] font-bold transition-all">
                            <span class="block text-[9px] opacity-70 mb-0.5">Besok</span>
                            {{ date('d M', strtotime('+1 day')) }}
                        </button>
                        <button type="button" onclick="setDate('{{ $product->id }}', '{{ date('Y-m-d', strtotime('+2 days')) }}', this)" class="date-btn-{{ $product->id }} bg-[#0B1221] border border-[#1A233A] text-[#8A99B5] hover:border-[#00e5ff]/50 p-2.5 rounded-xl text-[11px] font-bold transition-all">
                            <span class="block text-[9px] opacity-70 mb-0.5">Lusa</span>
                            {{ date('d M', strtotime('+2 days')) }}
                        </button>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-[#8A99B5] text-[10px] font-bold uppercase tracking-widest mb-1">Pilih Jam (Bisa Lebih Dari 1)</label>
                    <p class="text-[10px] text-[#cbd5e1] mb-3 opacity-70">Tekan kotak untuk memilih jam bermain. Jam tercoret sudah disewa.</p>

                    <div id="time-grid-{{ $product->id }}" class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        </div>
                </div>

                <div class="mb-8">
                    <label class="block text-[#8A99B5] text-[10px] font-bold uppercase tracking-widest mb-3">Add-ons (Opsional)</label>
                    <div class="space-y-2">
                        <label class="flex items-center justify-between p-3 rounded-xl bg-[#0B1221] border border-[#1A233A] cursor-pointer hover:border-[#00e5ff]/30 group transition-all">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="extra_controller" value="1" id="addon-controller-{{ $product->id }}" onchange="calculateTotal('{{ $product->id }}')" class="w-4 h-4 rounded border-[#1A233A] bg-[#03060D] text-[#00e5ff] focus:ring-[#00e5ff]">
                                <span class="text-white text-[12px] font-medium group-hover:text-[#00e5ff] transition-colors">Extra Controller</span>
                            </div>
                            <span class="text-[#00e5ff] text-[11px] font-bold">+20K</span>
                        </label>
                        <label class="flex items-center justify-between p-3 rounded-xl bg-[#0B1221] border border-[#1A233A] cursor-pointer hover:border-[#00e5ff]/30 group transition-all">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="gaming_headset" value="1" id="addon-headset-{{ $product->id }}" onchange="calculateTotal('{{ $product->id }}')" class="w-4 h-4 rounded border-[#1A233A] bg-[#03060D] text-[#00e5ff] focus:ring-[#00e5ff]">
                                <span class="text-white text-[12px] font-medium group-hover:text-[#00e5ff] transition-colors">Gaming Headset</span>
                            </div>
                            <span class="text-[#00e5ff] text-[11px] font-bold">+25K</span>
                        </label>
                    </div>
                </div>

                <div class="border-t border-white/5 pt-6 mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[#8A99B5] text-[12px]">Durasi Terpilih: <span id="display-duration-{{ $product->id }}" class="text-white font-bold">0 jam</span></span>
                        <span class="text-[#8A99B5] text-[12px]">{{ number_format($product->price_per_hour / 1000, 0) }}k / jam</span>
                    </div>
                    <div class="flex justify-between items-end mt-4">
                        <div>
                            <span class="text-[#8A99B5] text-[10px] uppercase tracking-widest font-bold block mb-1">Total Pembayaran</span>
                        </div>
                        <div class="text-right">
                            <span id="display-total-{{ $product->id }}" class="font-['Orbitron',_sans-serif] text-[#00e5ff] text-[32px] font-bold leading-none drop-shadow-[0_0_15px_rgba(0,229,255,0.4)]">
                                0K
                            </span>
                        </div>
                    </div>
                </div>

                <button type="button" onclick="submitBooking('{{ $product->id }}')" class="w-full group relative overflow-hidden bg-gradient-to-r from-[#00e5ff] to-[#0066ff] text-white py-4 rounded-xl text-[13px] font-bold tracking-[2px] uppercase shadow-[0_15px_30px_rgba(0,229,255,0.25)] hover:shadow-[0_20px_40px_rgba(0,229,255,0.45)] hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        Konfirmasi Booking
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>

