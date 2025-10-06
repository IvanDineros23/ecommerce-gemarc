@extends('layouts.app')

@section('content')

<div class="min-h-screen flex flex-col pt-0">
    <main class="flex-grow px-4 md:px-6">
        <div class="space-y-12 md:space-y-16">
            {{-- ===================== TOP SEARCH BAR ===================== --}}
            <div class="w-full flex justify-center pt-6">
                <div class="w-full max-w-2xl px-4">
                    <div class="relative">
                        <input
                            id="landing-search"
                            type="text"
                            autocomplete="off"
                            placeholder="Search products..."
                            class="w-full pl-6 pr-12 py-3 rounded-full text-base bg-white/95 ring-1 ring-gray-200 shadow-[0_4px_16px_rgba(0,0,0,.08)] focus:outline-none focus:ring-2 focus:ring-green-500"
                        />
                        <button
                            type="button"
                            aria-label="Search"
                            class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-green-600 hover:bg-green-700 text-white flex items-center justify-center shadow"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
                            </svg>
                        </button>
                        <div id="search-suggestions"
                            class="absolute left-0 right-0 mt-2 bg-white border border-gray-200 rounded-2xl shadow-2xl z-50 hidden"></div>
                    </div>
                </div>
            </div>
            {{-- =================== END TOP SEARCH BAR =================== --}}

            {{-- ===================== HERO / HIGHLIGHTS ===================== --}}
            <section class="relative w-full overflow-hidden flex items-center justify-center mt-6 min-h-[80vh] md:min-h-[88vh] py-10 md:py-14 bg-white">
                <div class="relative w-full max-w-[90rem] mx-auto px-6 md:px-10 grid md:grid-cols-2 gap-12 md:gap-16 items-center">
                    {{-- Left copy --}}
                    <div class="text-black">
                        <h1 class="text-5xl md:text-7xl font-extrabold leading-[0.95] mb-6">
                            TRIAXIAL<br/>SYSTEMS
                        </h1>
                        <p class="text-lg md:text-2xl/9 font-light text-black mb-10 max-w-3xl">
                            Advanced triaxial testing systems for geotechnical engineering and soil mechanics. Our equipment provides
                            precise measurement of soil strength parameters for foundation design, slope stability, and soil behavior
                            analysis.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#" class="px-8 py-4 rounded-lg bg-orange-500 hover:bg-orange-600 text-white text-lg font-semibold shadow">
                                Get Quote
                            </a>
                            <a href="#" class="px-8 py-4 rounded-lg border border-gray-400 bg-white hover:bg-gray-100 text-black text-lg font-semibold">
                                Learn More
                            </a>
                        </div>
                    </div>
                    {{-- Right placeholders (replace with <img> later) --}}
                    <div class="flex justify-center items-center gap-8">
                        <div class="min-w-[300px] min-h-[360px] p-7 rounded-2xl bg-gray-100 ring-1 ring-gray-200 shadow-[0_10px_40px_rgba(0,0,0,.10)]">
                            <div class="rounded-xl bg-white p-6 border-2 border-dashed border-gray-300 flex items-center justify-center h-[320px]">
                                <div class="text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7h18M3 7l3.6-3.6A2 2 0 018.9 3h6.2a2 2 0 011.3.5L21 7M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div class="font-semibold">Image Placeholder</div>
                                    <div class="text-sm">Add product image later</div>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-[300px] min-h-[360px] p-7 rounded-2xl bg-gray-100 ring-1 ring-gray-200 shadow-[0_10px_40px_rgba(0,0,0,.10)]">
                            <div class="rounded-xl bg-white p-6 border-2 border-dashed border-gray-300 flex items-center justify-center h-[320px]">
                                <div class="text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7h18M3 7l3.6-3.6A2 2 0 018.9 3h6.2a2 2 0 011.3.5L21 7M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div class="font-semibold">Image Placeholder</div>
                                    <div class="text-sm">Add product image later</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-6 left-0 right-0 z-20 flex justify-center gap-3">
                    <button class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-gray-400"></button>
                    <button class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-gray-400"></button>
                    <button class="w-2.5 h-2.5 rounded-full bg-gray-400"></button>
                    <button class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-gray-400"></button>
                </div>
            </section>
            {{-- =================== END HERO / HIGHLIGHTS =================== --}}

            {{-- ===================== FEATURED PRODUCTS CAROUSEL (ALPINE-FREE) ===================== --}}
            @php
                $carouselProducts = \App\Models\Product::where('is_active', 1)
                    ->orderByDesc('created_at')
                    ->take(8)
                    ->get()
                    ->map(function($p){
                        return [
                            'id' => $p->id,
                            'name' => $p->name,
                            'description' => $p->description ?? '',
                            'image_url' => method_exists($p,'firstImagePath') && $p->firstImagePath()
                                ? asset('storage/'.$p->firstImagePath())
                                : asset('images/gemarclogo.png'),
                        ];
                    })->values();
            @endphp

            @if($carouselProducts->count())
            <section id="featured" class="w-full">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-2xl font-bold mb-6 text-center text-black">Featured Products</h2>
                    {{-- Scroll-snap track --}}
                    <div id="fp-track"
                             class="relative overflow-x-auto no-scrollbar">
                        <div class="flex gap-6 snap-x snap-mandatory scroll-pl-6"
                                 style="scroll-behavior:smooth;">
                            @foreach($carouselProducts as $i => $p)
                                <article id="fp-{{ $i }}"
                                                 class="min-w-[85%] sm:min-w-[60%] md:min-w-[45%] lg:min-w-[32%]
                                                                snap-start bg-white border border-gray-200 rounded-2xl
                                                                shadow-sm p-6 flex flex-col items-center text-center">
                                    <img src="{{ $p['image_url'] }}"
                                             alt="{{ $p['name'] }}"
                                             class="w-40 h-40 object-contain rounded-xl bg-gray-100 mb-4 border" />
                                    <h3 class="font-semibold text-lg mb-1 text-gray-900">{{ $p['name'] }}</h3>
                                    @php $desc = trim($p['description']); @endphp
                                    <p class="text-sm text-gray-600 mb-3">
                                        {{ $desc ? Str::limit($desc, 90) : ' ' }}
                                    </p>
                                    <a href="/browse?q={{ urlencode($p['name']) }}"
                                         class="mt-auto px-5 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold transition">
                                        Shop Now
                                    </a>
                                </article>
                            @endforeach
                        </div>
                        {{-- Nav buttons --}}
                        <button type="button" id="fp-prev"
                                        class="hidden md:flex absolute -left-3 top-1/2 -translate-y-1/2
                                                     w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300
                                                     items-center justify-center shadow">
                            &#8592;
                        </button>
                        <button type="button" id="fp-next"
                                        class="hidden md:flex absolute -right-3 top-1/2 -translate-y-1/2
                                                     w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300
                                                     items-center justify-center shadow">
                            &#8594;
                        </button>
                    </div>
                    {{-- Dots --}}
                    <div class="flex justify-center items-center gap-2 mt-4">
                        @foreach($carouselProducts as $i => $p)
                            <button type="button"
                                            data-target="fp-{{ $i }}"
                                            class="fp-dot w-2.5 h-2.5 rounded-full bg-gray-300"
                                            aria-label="Go to slide {{ $i+1 }}"></button>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif
            {{-- =================== END FEATURED PRODUCTS CAROUSEL =================== --}}

            {{-- ===================== FEATURE GRID ===================== --}}

        {{-- ===================== FEATURE GRID ===================== --}}
        <section class="w-full flex justify-center mt-12 md:mt-16">
            <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                <a href="/browse" class="group bg-white rounded-2xl shadow-lg border border-gray-200 p-8 flex flex-col items-center text-center hover:shadow-2xl hover:-translate-y-1 transition">
                    <div class="bg-blue-100 text-blue-600 rounded-full p-4 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 7l3.6-3.6A2 2 0 018.9 3h6.2a2 2 0 011.3.5L21 7M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Browse Products</h3>
                    <p class="text-gray-600 text-sm">Explore our wide selection of industrial and commercial products.</p>
                </a>

                <a href="/get-quote" class="group bg-white rounded-2xl shadow-lg border border-gray-200 p-8 flex flex-col items-center text-center hover:shadow-2xl hover:-translate-y-1 transition">
                    <div class="bg-green-100 text-green-600 rounded-full p-4 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4m0-5a4 4 0 10-8 0 4 4 0 008 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Get a Quote</h3>
                    <p class="text-gray-600 text-sm">Request a personalized quote for your project or bulk order.</p>
                </a>

                <a href="/services" class="group bg-white rounded-2xl shadow-lg border border-gray-200 p-8 flex flex-col items-center text-center hover:shadow-2xl hover:-translate-y-1 transition">
                    <div class="bg-yellow-100 text-yellow-600 rounded-full p-4 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Our Services</h3>
                    <p class="text-gray-600 text-sm">See what services we offer for your business and technical needs.</p>
                </a>
            </div>
        </section>
        {{-- =================== END FEATURE GRID =================== --}}

    </main>
</div>

@push('scripts')
<script>
const searchInput = document.getElementById('landing-search');
const suggestionsBox = document.getElementById('search-suggestions');
let debounceTimeout = null;

searchInput?.addEventListener('input', function () {
    const q = this.value.trim();
    clearTimeout(debounceTimeout);
    if (q.length === 0) {
        suggestionsBox.innerHTML = '';
        suggestionsBox.classList.add('hidden');
        return;
    }
    debounceTimeout = setTimeout(() => {
        fetch(`/landing-search?q=${encodeURIComponent(q)}`)
            .then(res => res.json())
            .then(data => {
                if (!Array.isArray(data) || data.length === 0) {
                    suggestionsBox.innerHTML = '<div class="px-4 py-2 text-gray-500">No products found.</div>';
                    suggestionsBox.classList.remove('hidden');
                    return;
                }
                suggestionsBox.innerHTML = data.map(product => `
                    <div class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 cursor-pointer border-b last:border-b-0"
                         onclick="window.location='/browse?q='+encodeURIComponent(product.name)">
                        <img src="${product.image_url ? product.image_url : '/images/gemarclogo.png'}"
                             alt="${product.name}" class="w-12 h-12 object-contain rounded bg-gray-100 border" />
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold truncate">${product.name}</div>
                            <div class="text-sm text-gray-500 truncate">
                                ${product.sku ? product.sku : ''} ${product.price ? '₱' + parseFloat(product.price).toLocaleString() : ''}
                            </div>
                        </div>
                    </div>
                `).join('');
                suggestionsBox.classList.remove('hidden');
            });
    }, 200);
});

searchInput?.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        const q = this.value.trim();
        if (q.length > 0) window.location = `/browse?q=${encodeURIComponent(q)}`;
    }
});

document.addEventListener('click', function (e) {
    if (!searchInput?.contains(e.target) && !suggestionsBox?.contains(e.target)) {
        suggestionsBox?.classList.add('hidden');
    }
});
</script>

<script>
  // Smooth scroll helpers for Featured Products
  (function(){
    const track = document.querySelector('#fp-track > .flex');
    if(!track) return;

    const cards = [...track.children];
    const dots  = [...document.querySelectorAll('.fp-dot')];
    let index = 0;

    function go(i){
      index = Math.max(0, Math.min(i, cards.length - 1));
      cards[index].scrollIntoView({behavior:'smooth', inline:'start', block:'nearest'});
      dots.forEach((d, k) => d.classList.toggle('bg-green-600', k===index));
      dots.forEach((d, k) => d.classList.toggle('bg-gray-300', k!==index));
    }

    // Initial state
    go(0);

    // Dots click
    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => go(i));
    });

    // Prev/Next (desktop only)
    const prev = document.getElementById('fp-prev');
    const next = document.getElementById('fp-next');
    prev?.addEventListener('click', () => go(index - 1));
    next?.addEventListener('click', () => go(index + 1));

    // Snap observer (updates active dot when user drags)
    let ticking = false;
    track.parentElement.addEventListener('scroll', () => {
      if (ticking) return;
      window.requestAnimationFrame(() => {
        // Find the card closest to the left
        let min = Infinity, at = 0;
        cards.forEach((el, i) => {
          const rect = el.getBoundingClientRect();
          const dist = Math.abs(rect.left - track.getBoundingClientRect().left);
          if (dist < min) { min = dist; at = i; }
        });
        go(at);
        ticking = false;
      });
      ticking = true;
    }, {passive:true});
  })();
</script>
@endpush
@endsection
