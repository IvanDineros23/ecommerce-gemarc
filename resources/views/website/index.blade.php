@extends('layouts.app')

@section('title', 'Home | Gemarc Enterprises Inc.')

@section('content')
@push('styles')
<style>
/* Featured Products: make the SCROLLER own the snap */
#fp-track{
    scroll-snap-type: x mandatory;
    scroll-padding-left: 1.5rem;        /* matches your mx-10 spacing */
    -webkit-overflow-scrolling: touch;
}
#fp-track .product-card{
    scroll-snap-align: start;
    scroll-snap-stop: always;
}

/* --- Subtle stagger para mas fluid pag activate ng slide --- */
.hero-slide .highlights-text,
.hero-slide .highlights-images { will-change: transform, opacity; }

.hero-track > .hero-slide.active .highlights-text{
    animation: heroFadeUp .65s cubic-bezier(.22,.61,.36,1) both .05s;
}
.hero-track > .hero-slide.active .highlights-images{
    animation: heroSlideIn .7s cubic-bezier(.22,.61,.36,1) both .12s;
}

@keyframes heroFadeUp { 
    from{opacity:0; transform:translateY(12px)} 
    to{opacity:1; transform:translateY(0)} 
}
@keyframes heroSlideIn { 
    from{opacity:0; transform:translateX(28px) scale(.985)} 
    to{opacity:1; transform:translateX(0) scale(1)} 
}

/* optional: very light Ken-Burns on machine images for life */
.hero-slide.active .machine-image{
    animation: kbZoom 5s ease-out both;
}
@keyframes kbZoom{
    from{transform:scale(1)}
    to{transform:scale(1.035)}
}

/* Pause animations if user prefers reduced motion */
@media (prefers-reduced-motion: reduce){
    .highlights-progress .bar::after,
    .hero-track > .hero-slide.active .highlights-text,
    .hero-track > .hero-slide.active .highlights-images,
    .hero-slide.active .machine-image{ animation:none !important; }
}

/* Hide native browser search clear buttons and restyle our custom clear button */
.products-search .search-input{ -webkit-appearance:none; appearance:none; }
.products-search .search-input::-webkit-search-decoration,
.products-search .search-input::-webkit-search-cancel-button,
.products-search .search-input::-ms-clear { display: none !important; -webkit-appearance: none; }

/* Blue circular clear button positioned next to the magnifier */
#product-search-clear{
    display:none; /* controlled by JS */
    width:44px;height:44px;border-radius:50%;border:none;background:#1e40af;color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 8px 20px rgba(30,64,175,.18);z-index:70;margin-left:-12px;font-size:20px;line-height:1;
}
#product-search-clear:hover{ filter:brightness(1.05); }

/* ensure the search button stays above suggestions */
.products-search .search-btn{ z-index:60 }

/* ================= PARTNERS SLIDER (Simplified) ================= */
.partner-logo {
    height: 60px;
    width: 180px;
    flex: 0 0 180px;
    object-fit: contain;
    transition: all 0.3s ease;
    filter: grayscale(0.2);
    scroll-snap-align: start;
}
.partner-logo:hover {
    filter: grayscale(0);
    transform: scale(1.05);
}
#partners-track {
    display: flex;
    gap: 2rem;
    scroll-behavior: smooth;
    -ms-overflow-style: none;
    scrollbar-width: none;
}
#partners-track::-webkit-scrollbar {
    display: none;
}
#partners-track-container {
    overflow-x: hidden;
    margin: 0 3rem;
}
@media (max-width: 768px) {
    .partner-logo { 
        height: 50px;
        width: 140px;
        flex: 0 0 140px;
    }
    #partners-track {
        gap: 1rem;
    }
    #partners-track-container {
        margin: 0 2rem;
    }
}


.material-testing-highlights {position:relative;padding:4rem 0 6rem;min-height:90vh;color:#fff;overflow:hidden;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,'Noto Sans',sans-serif;background:#000; z-index:0;} /* solid black bg */
.material-testing-highlights .highlights-background {position:absolute;inset:0;background:linear-gradient(rgba(0,0,0,.78),rgba(0,0,0,.78)),url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center center/cover no-repeat #000;z-index:0;opacity:.95;}
.material-testing-highlights .container {position:relative;z-index:2;max-width:1280px;margin:0 auto;padding:0 2rem;}
.products-search { padding:8px; border-radius:60px; display:flex; align-items:center; gap:.5rem; position:relative; z-index:60; max-width:760px;margin:0 auto 2.5rem; background:rgba(255,255,255,.95); box-shadow:0 8px 30px rgba(2,6,23,.18); }
.products-search .search-input-wrapper{
    position:relative; flex:1; display:flex; align-items:center; height:56px;
}
.products-search .search-input{
    width:100%; height:100%;
    padding:0 16px; border:none; outline:none;
    background:transparent; color:#0f172a; font-weight:500; font-size:1rem;
    border-radius:9999px;
}

/* place the clear button INSIDE the wrapper, absolutely positioned */
#product-search-clear{
    position:absolute; right:64px; /* space for green button */
    top:50%; transform:translateY(-50%);
    display:none; width:36px; height:36px;
    border:none; border-radius:50%;
    background:#1e40af; color:#fff; cursor:pointer;
    box-shadow:0 8px 20px rgba(30,64,175,.18); z-index:70;
}

/* search (magnifier) button fixed size, no layout shift */
.products-search .search-btn{
    width:56px; height:56px; flex:0 0 56px;
    border:none; border-radius:50%;
    background:#15803d; color:#fff; font-size:1.15rem; cursor:pointer;
    display:flex; align-items:center; justify-content:center;
}

.products-search .search-btn:hover{filter:brightness(1.05);transform:translateY(-2px);} 
.highlights-container{position:relative;overflow:hidden;}
/* Fade style slider (isolated hero variant) */
.hero-carousel{position:relative;width:100%;min-height:440px;}
.hero-track{position:relative;width:100%;height:100%;min-height:440px;}
/* Ensure only one slide is visible at a time, with smooth fade/slide animation */
.hero-track > .hero-slide {
    position: absolute; inset: 0;
    display: none !important;
    opacity: 0;
    transform: translateX(60px) scale(.98);
    transition: opacity 0.5s cubic-bezier(.77,0,.18,1), transform 0.7s cubic-bezier(.77,0,.18,1), filter 0.7s;
    filter: blur(2px);
    z-index: 1;
}
.hero-slide.preparing {
    display: flex !important;
    opacity: 0;
    transform: translateX(60px) scale(.98);
    filter: blur(2px);
    z-index: 2;
}
.hero-slide.leaving {
    display: flex !important;
    opacity: 0;
    transform: translateX(-60px) scale(.98);
    filter: blur(4px);
    z-index: 1;
}
.hero-track > .hero-slide.active {
    display: flex !important;
    opacity: 1;
    transform: translateX(0) scale(1);
    filter: blur(0);
    pointer-events: auto;
    z-index: 3;
}
.no-js .hero-slide { display: none; }
.no-js .hero-slide:first-child { display: flex; opacity: 1; }
.hero-slide .hero-highlights-content{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:3rem;align-items:center;min-height:430px;width:100%;}
.highlights-text .highlights-title{font-size:clamp(2.5rem,6vw,4.5rem);line-height:1.05;font-weight:800;letter-spacing:.5px;margin:0 0 1.25rem;}
.highlights-text .highlights-description{font-size:1.1rem;line-height:1.6;max-width:40ch;color:#f1f5f9;margin:0 0 2rem;font-weight:400;}
.highlights-actions{display:flex;gap:1rem;flex-wrap:wrap;}
.highlights-btn{padding:1rem 2.2rem;border-radius:1rem;text-decoration:none;font-weight:600;font-size:1rem;display:inline-flex;align-items:center;justify-content:center;letter-spacing:.5px;transition:.35s;position:relative;overflow:hidden;}
.highlights-btn.primary{background:linear-gradient(135deg,#f59e0b,#ea580c);color:#fff;box-shadow:0 12px 32px -6px rgba(234,88,12,.45);} 
.highlights-btn.primary:hover{transform:translateY(-3px);box-shadow:0 18px 40px -8px rgba(234,88,12,.55);} 
.highlights-btn.secondary{background:rgba(255,255,255,.1);color:#fff;border:2px solid rgba(255,255,255,.4);backdrop-filter:blur(6px);} 
.highlights-btn.secondary:hover{background:#fff;color:#0f172a;}
.highlights-images{display:flex;align-items:center;justify-content:center;}
.compression-machines-showcase{display:flex;gap:2rem;flex-wrap:wrap;justify-content:center;}
.machine-item{width:250px;max-width:44%;min-width:200px;aspect-ratio:1/1.05;background:linear-gradient(145deg,rgba(255,255,255,.92),rgba(243,244,246,.95));border:1px solid rgba(255,255,255,.4);box-shadow:0 20px 40px -18px rgba(0,0,0,.4);border-radius:1.6rem;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;padding:1rem;transition:.55s;}
.machine-item:before{content:"";position:absolute;inset:0;background:radial-gradient(circle at 30% 20%,rgba(255,255,255,.65),transparent 60%);opacity:0;transition:.5s;}
.machine-item:hover{transform:translateY(-6px) scale(1.02);box-shadow:0 28px 56px -18px rgba(0,0,0,.55);} 
.machine-item:hover:before{opacity:1;}
.machine-image{width:90%;height:90%;object-fit:contain;filter:drop-shadow(0 10px 18px rgba(0,0,0,.35));transition:.7s;image-rendering:auto;}
.machine-item:hover .machine-image{transform:scale(1.06);} 
/* Dots */
.highlights-navigation{display:flex;justify-content:center;align-items:center;gap:14px;margin:3rem 0 0;}
.highlights-navigation .nav-dot{width:14px;height:14px;background:rgba(255,255,255,.3);border:none;border-radius:50%;cursor:pointer;transition:.4s;position:relative;}
.highlights-navigation .nav-dot.active{background:#fff;box-shadow:0 0 0 4px rgba(255,255,255,.25);} 
.highlights-navigation .nav-dot:hover{background:rgba(255,255,255,.55);} 
@media (max-width:1024px){.hero-slide .hero-highlights-content{gap:2.5rem;} .machine-item{max-width:44%;}}
@media (max-width:820px){.hero-slide .hero-highlights-content{grid-template-columns:1fr;}.machine-item{max-width:44%;}}
@media (max-width:640px){.highlights-actions{flex-direction:column;}.machine-item{max-width:46%;min-width:160px;width:48%;aspect-ratio:1/1.1;padding:.85rem;border-radius:1.25rem;} .highlights-btn{flex:1;}}
/* --- Namespaced hero layout to avoid collision with global .highlights-content in external CSS --- */
.material-testing-highlights .hero-highlights-content{display:flex;flex-direction:column;gap:3rem;align-items:stretch;}
@media (min-width:900px){
    .material-testing-highlights .hero-highlights-content{flex-direction:row;}
    .material-testing-highlights .hero-highlights-content > .highlights-text,
    .material-testing-highlights .hero-highlights-content > .highlights-images{flex:1 1 0;}
}
/* Force machines to stay horizontal */
.material-testing-highlights .compression-machines-showcase{flex-wrap:nowrap;}

/* Smaller font for Calibration & Maintenance and Superpave slides */
.hero-slide[data-slide="2"] .highlights-title,
.hero-slide[data-slide="3"] .highlights-title { font-size: clamp(2.1rem, 5vw, 3.2rem); }
.hero-slide[data-slide="2"] .highlights-description,
.hero-slide[data-slide="3"] .highlights-description { font-size: 1rem; }
</style>
@endpush
@push('scripts')
<script>
// Home hero slider (with smooth 5s autoplay + progress sync)
window.homeHero = (function(){
    const AUTOPLAY_MS = 5000; // <-- 5 seconds
    let current = 0, timer, slides = [], dots = [], animating = false, initialized = false;
    let progressEl, running = false;

    function setActive(idx) {
        if (animating || idx === current) return;
        const prev = current;
        current = idx;
        animating = true;

        const prevSlide = slides[prev];
        const nextSlide = slides[idx];

        // Prepare next slide for animation
        nextSlide?.classList.add('preparing');
        nextSlide?.classList.remove('leaving','active');
        prevSlide?.classList.remove('preparing');
        prevSlide?.classList.add('leaving');

        // Let CSS apply .preparing before switching to .active
        setTimeout(() => {
            prevSlide?.classList.remove('active');
            nextSlide?.classList.remove('preparing');
            nextSlide?.classList.add('active');
            dots.forEach((d, i) => d.classList.toggle('active', i === current));
        }, 30);

        // Finish cycle
        setTimeout(() => {
            prevSlide?.classList.remove('leaving');
            animating = false;
        }, 700); // slight bump to match the stagger durations
    }

    function show(i) {
        if (!slides.length) return;
        let target = i;
        if (i < 0) target = slides.length - 1;
        else if (i >= slides.length) target = 0;

        if (target !== current) {
            setActive(target);
            restart(); // restart autoplay + progress
        }
    }
    const next = () => show(current + 1);
    const prev = () => show(current - 1);

    function start() {
        stop();
        running = true;
        timer = setInterval(next, AUTOPLAY_MS);
        startProgress();
    }
    function stop() {
        running = false;
        if (timer) clearInterval(timer);
        pauseProgress();
    }
    function restart() {
        start();
    }

    // ---- Progress bar control ----
    function setupProgress(){
        progressEl = document.querySelector('.highlights-progress .bar');
        if (progressEl){
            // set duration via CSS var so it stays in sync
            progressEl.style.setProperty('--ap-dur', AUTOPLAY_MS+'ms');
        }
    }
    function startProgress(){
        if (!progressEl) return;
        // reset animation
        progressEl.classList.remove('playing');
        // force reflow to restart animation reliably
        void progressEl.offsetWidth;
        progressEl.classList.add('playing');
        // apply animation to ::after via inline style trick
        progressEl.style.setProperty('animation','none');
        void progressEl.offsetWidth;
        progressEl.style.removeProperty('animation'); // allow ::after animation to run
        // also toggle aria for a11y (optional)
        progressEl.setAttribute('aria-valuemin','0');
        progressEl.setAttribute('aria-valuemax','100');
    }
    function pauseProgress(){
        if (!progressEl) return;
        // pause by setting animation-play-state on bar pseudo-container
        progressEl.style.setProperty('animation-play-state','paused');
        // Pause pseudo by adding a class on root and using computed style
        progressEl.parentElement?.style.setProperty('animation-play-state','paused');
        // Use document-level toggle via CSS? We’ll do a simple hack:
        progressEl.classList.add('paused');
    }
    function resumeProgress(){
        if (!progressEl) return;
        progressEl.style.removeProperty('animation-play-state');
        progressEl.parentElement?.style.removeProperty('animation-play-state');
        progressEl.classList.remove('paused');
    }

    function init() {
        if (initialized) return;
        const hero = document.querySelector('.material-testing-highlights');
        if (!hero) return;
        hero.classList.remove('no-js');

        slides = [...hero.querySelectorAll('.hero-slide')];
        dots   = [...document.querySelectorAll('.highlights-navigation .nav-dot')];
        setupProgress();

        if (slides.length) {
            slides.forEach((s, i) => {
                if (i === 0) { s.classList.add('active'); }
                else { s.classList.remove('active','leaving','preparing'); }
            });
            dots[0]?.classList.add('active');
        }

        // dot handlers
        dots.forEach((d, i) => d.addEventListener('click', () => show(i)));

        // autoplay + hover pause + tab visibility pause
        start();
        hero.addEventListener('pointerenter', () => { stop(); });
        hero.addEventListener('pointerleave', () => { start(); });

        document.addEventListener('visibilitychange', () => {
            if (document.hidden) { stop(); }
            else { start(); }
        });

        // image fallback
        hero.querySelectorAll('.hero-slide img').forEach(img => {
            img.addEventListener('error', () => {
                if (!img.dataset.fallback) { img.dataset.fallback = '1'; img.src = '{{ asset('images/gemarclogo.png') }}'; }
            });
        });

        initialized = true;
    }

    document.addEventListener('DOMContentLoaded', init);
    return { show, next, prev, start, stop };
})();
</script>
@endpush

<div class="min-h-screen flex flex-col pt-0">
    <main class="flex-grow">
        <!-- Legacy Material Testing Highlights Section Injected -->
    <section class="material-testing-highlights no-js" data-aos="fade-up">
            <div class="highlights-background"></div>
            <div class="container">
                @include('components.searchbar')
                <div class="highlights-container">
                    <div class="hero-carousel">
                        <div class="hero-track">
                        <div class="hero-slide active" data-slide="0">
                            <div class="hero-highlights-content">
                                <div class="highlights-text">
                                    <h1 class="highlights-title"><span class="text-white">TRIAXIAL</span><br>SYSTEMS</h1>
                                    <p class="highlights-description">Advanced triaxial testing systems for geotechnical engineering and soil mechanics. Our equipment provides precise measurement of soil strength parameters for foundation design, slope stability, and soil behavior analysis.</p>
                                    <div class="highlights-actions">
                                        <a href="{{ url('/contact') }}" class="highlights-btn primary">Get Quote</a>
                                        <a href="{{ url('/soil') }}" class="highlights-btn secondary">Learn More</a>
                                    </div>
                                </div>
                                <div class="highlights-images">
                                    <div class="compression-machines-showcase">
                                        <div class="machine-item"><img src="{{ asset('images/highlights/b7rrt16v5qz6i4z3yy29w860zfnp2oqr.jpg') }}" alt="Triaxial Testing System" class="machine-image"></div>
                                        <div class="machine-item"><img src="{{ asset('images/highlights/wykehamfarrance-AUTOTRIAX2-Automatic-triaxial-test-system-1-512x512.jpg') }}" alt="Automatic Triaxial Test System" class="machine-image"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hero-slide" data-slide="1">
                            <div class="hero-highlights-content">
                                <div class="highlights-text">
                                    <h1 class="highlights-title"><span class="text-white">COMPRESSION</span><br>TESTING</h1>
                                    <p class="highlights-description">Professional compression testing equipment for construction materials including concrete, cement, mortar, and other building materials. Our machines deliver precise load measurement and accurate strength analysis for quality control and compliance testing.</p>
                                    <div class="highlights-actions">
                                        <a href="{{ url('/contact') }}" class="highlights-btn primary">Get Quote</a>
                                        <a href="{{ url('/concrete-mortar') }}" class="highlights-btn secondary">Learn More</a>
                                    </div>
                                </div>
                                <div class="highlights-images">
                                    <div class="compression-machines-showcase">
                                        <div class="machine-item"><img src="{{ asset('images/highlights/HCM-6100.7F.png') }}" alt="Compression Testing Machine" class="machine-image"></div>
                                        <div class="machine-item"><img src="{{ asset('images/highlights/22.1102.01-SV-i20.jpg') }}" alt="Professional Compression Testing System" class="machine-image"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hero-slide" data-slide="2">
                            <div class="hero-highlights-content">
                                <div class="highlights-text">
                                    <h1 class="highlights-title"><span class="text-white">CALIBRATION &</span><br>MAINTENANCE</h1>
                                    <p class="highlights-description">Complete calibration and maintenance services for all testing equipment. Our certified technicians ensure your instruments maintain accuracy and compliance with international standards.</p>
                                    <div class="highlights-actions">
                                        <a href="{{ url('/services') }}" class="highlights-btn primary">Get Quote</a>
                                        <a href="{{ url('/services') }}" class="highlights-btn secondary">Learn More</a>
                                    </div>
                                </div>
                                <div class="highlights-images">
                                    <div class="compression-machines-showcase">
                                        <div class="machine-item"><img src="{{ asset('images/highlights/calibration/471297900_514765054922698_1512859822718235856_n.jpg') }}" alt="Calibration Services" class="machine-image"></div>
                                        <div class="machine-item"><img src="{{ asset('images/highlights/calibration/viber_image_2025-09-04_08-39-35-055.jpg') }}" alt="Equipment Maintenance" class="machine-image"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hero-slide" data-slide="3">
                            <div class="hero-highlights-content">
                                <div class="highlights-text">
                                    <h1 class="highlights-title"><span class="text-white">SUPERPAVE</span><br>GYRATORY COMPACTORS</h1>
                                    <p class="highlights-description">Advanced Superpave Gyratory Compactors for asphalt mix design and quality control. Our equipment ensures precise compaction, angle measurement, and comprehensive data analysis for optimal pavement performance.</p>
                                    <div class="highlights-actions">
                                        <a href="{{ url('/asphalt-bitumen') }}" class="highlights-btn primary">Get Quote</a>
                                        <a href="{{ url('/asphalt-bitumen') }}" class="highlights-btn secondary">Learn More</a>
                                    </div>
                                </div>
                                <div class="highlights-images">
                                    <div class="compression-machines-showcase">
                                        <div class="machine-item"><img src="{{ asset('images/highlights/SuperpaveR-Gyratory-Compactor.png') }}" alt="Superpave Gyratory Compactor" class="machine-image"></div>
                                        <div class="machine-item"><img src="{{ asset('images/highlights/G1-scaled.jpg') }}" alt="Advanced Gyratory Compactor System" class="machine-image"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hero-slide" data-slide="4">
                            <div class="hero-highlights-content">
                                <div class="highlights-text">
                                    <h1 class="highlights-title"><span class="text-white">DRILLING</span><br>EQUIPMENT</h1>
                                    <p class="highlights-description">Professional drilling equipment for soil investigation, core sampling, and geotechnical exploration. Our robust and reliable drilling systems offer optimal performance for both field and laboratory applications.</p>
                                    <div class="highlights-actions">
                                        <a href="{{ url('/drilling-machine') }}" class="highlights-btn primary">Get Quote</a>
                                        <a href="{{ url('/drilling-machine') }}" class="highlights-btn secondary">Learn More</a>
                                    </div>
                                </div>
                                <div class="highlights-images">
                                    <div class="compression-machines-showcase">
                                        <div class="machine-item"><img src="{{ asset('images/highlights/multidrill-sl__1.jpg') }}" alt="MultiDrill SL" class="machine-image"></div>
                                        <div class="machine-item"><img src="{{ asset('images/highlights/multidrill-xl-140DR_.jpg') }}" alt="MultiDrill XL 140DR" class="machine-image"></div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end highlights-track -->
                        </div>
                    </div>
                    <div class="highlights-navigation">
                                                                        <button class="nav-dot" data-index="0" type="button"></button>
                                                                        <button class="nav-dot" data-index="1" type="button"></button>
                                                                        <button class="nav-dot" data-index="2" type="button"></button>
                                                                        <button class="nav-dot" data-index="3" type="button"></button>
                                                                        <button class="nav-dot" data-index="4" type="button"></button>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Legacy Highlights Section -->
        
        {{-- ===================== FEATURED PRODUCTS CAROUSEL ===================== --}}
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
                        'price' => $p->price ?? 0,
                        'image_url' => method_exists($p,'firstImagePath') && $p->firstImagePath()
                            ? asset('storage/'.$p->firstImagePath())
                            : asset('images/gemarclogo.png'),
                    ];
                })->values();
        @endphp

        @if($carouselProducts->count())
        <section id="product-showcase" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-5xl font-bold text-gray-800 mb-6">Featured Products</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Discover our most popular construction materials and premium equipment
                    </p>
                </div>
                <div class="relative max-w-6xl mx-auto">
                    <button type="button" id="fp-prev" class="absolute left-0 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-white text-gray-700 rounded-full shadow z-10">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" id="fp-next" class="absolute right-0 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-white text-gray-700 rounded-full shadow z-10">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    
                    <div id="fp-track-container" class="overflow-hidden mx-10">
                        <div id="fp-track" class="relative overflow-x-auto no-scrollbar">
                            <div class="flex gap-6 snap-x snap-mandatory scroll-pl-6" style="scroll-behavior:smooth;">
                                @foreach($carouselProducts as $i => $p)
                            <article id="fp-{{ $i }}" class="product-card min-w-[95%] sm:min-w-[60%] md:min-w-[45%] lg:min-w-[32%] snap-start rounded-3xl shadow-2xl p-10 flex flex-col items-center text-center h-[480px]">
                                <div class="w-56 h-56 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center mb-6 overflow-hidden">
                                    <img src="{{ $p['image_url'] }}" alt="{{ $p['name'] }}" class="w-full h-full object-contain" style="max-width:210px;max-height:210px;" />
                                </div>
                                <h3 class="font-bold text-2xl mb-3 text-gray-800 line-clamp-1">{{ $p['name'] }}</h3>
                                @php $desc = trim($p['description']); @endphp
                                <p class="text-base text-gray-600 mb-4 leading-relaxed line-clamp-2">
                                    {{ $desc ? Str::limit($desc, 80) : 'Premium construction equipment' }}
                                </p>
                                @if($p['price'] > 0)
                                    <div class="text-xl font-bold text-green-600 mb-4">₱{{ number_format($p['price'], 2) }}</div>
                                @endif
                                <a href="{{ route('auth.welcome') }}" class="mt-auto w-full px-7 py-4 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold transition duration-300 shadow hover:shadow-xl text-lg">
                                    <i class="fas fa-shopping-cart mr-2"></i>Shop Now
                                </a>
                            </article>
                        @endforeach
                            </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
                @push('scripts')
                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const track   = document.getElementById('fp-track');
                    if (!track) return;

                    const slides  = track.querySelectorAll('.product-card');
                    const prevBtn = document.getElementById('fp-prev');
                    const nextBtn = document.getElementById('fp-next');

                    let currentIndex = 0;
                    let programmatic = false;  // ignore scroll events we triggered
                    let releaseTimer = null;

                    function updateButtons() {
                        const atStart = currentIndex <= 0;
                        const atEnd   = currentIndex >= slides.length - 1;
                        [prevBtn, nextBtn].forEach(btn => btn && (btn.disabled = false));
                        if (prevBtn) prevBtn.disabled = atStart;
                        if (nextBtn) nextBtn.disabled = atEnd;
                        if (prevBtn) prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
                        if (nextBtn) nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
                    }

                    function goTo(idx) {
                        if (!slides.length) return;
                        if (idx < 0) idx = 0;
                        if (idx > slides.length - 1) idx = slides.length - 1;
                        currentIndex = idx;
                        updateButtons();

                        programmatic = true;
                        clearTimeout(releaseTimer);
                        slides[idx].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
                        // release the programmatic lock shortly after the smooth scroll finishes
                        releaseTimer = setTimeout(() => { programmatic = false; }, 450);
                    }

                    // Buttons
                    prevBtn && prevBtn.addEventListener('click', () => goTo(currentIndex - 1));
                    nextBtn && nextBtn.addEventListener('click', () => goTo(currentIndex + 1));

                    // Keep currentIndex in sync using visibility (most stable on varying widths)
                    const io = new IntersectionObserver((entries) => {
                        if (programmatic) return; // ignore while we’re animating to a target
                        let bestIdx = currentIndex, bestRatio = 0;
                        for (const e of entries) {
                            if (e.isIntersecting && e.intersectionRatio > bestRatio) {
                                bestRatio = e.intersectionRatio;
                                bestIdx = [...slides].indexOf(e.target);
                            }
                        }
                        if (bestRatio > 0) {
                            currentIndex = bestIdx;
                            updateButtons();
                        }
                    }, {
                        root: track,
                        threshold: [0.51, 0.75, 0.98] // prefer the card that’s >50% visible
                    });

                    slides.forEach(el => io.observe(el));
                    updateButtons();

                    // Fallback: when user stops dragging, nudge to nearest snap to avoid half-cards
                    let snapTimer;
                    track.addEventListener('scroll', () => {
                        if (programmatic) return;
                        clearTimeout(snapTimer);
                        snapTimer = setTimeout(() => {
                            // find nearest card by left offset relative to track
                            let best = 0, bestDist = Infinity;
                            const trackLeft = track.getBoundingClientRect().left;
                            slides.forEach((el, i) => {
                                const dist = Math.abs(el.getBoundingClientRect().left - trackLeft);
                                if (dist < bestDist) { bestDist = dist; best = i; }
                            });
                            goTo(best);
                        }, 120);
                    }, { passive: true });

                    // Re-snap on resize to keep the active card aligned
                    window.addEventListener('resize', () => goTo(currentIndex));
                });
                </script>
                @endpush
        @endif

        {{-- ===================== OUR GLOBAL PARTNERS (SIMPLIFIED SLIDER) ===================== --}}
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Global Partners</h2>
                    <p class="text-xl text-gray-600">Trusted by leading companies worldwide</p>
                </div>
                
                <div class="relative max-w-6xl mx-auto">
                    <button type="button" id="partners-prev" class="absolute left-0 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-white text-gray-700 rounded-full shadow z-10">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" id="partners-next" class="absolute right-0 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-white text-gray-700 rounded-full shadow z-10">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    
                    <div id="partners-track-container" class="overflow-hidden mx-10">
                        <div id="partners-track" class="flex gap-8 snap-x snap-mandatory scroll-pl-8" style="scroll-behavior: smooth;">
                            <img src="{{ asset('images/highlights/partnership/gilson_logo.png') }}" alt="Gilson" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/ehwa.png') }}" alt="Ehwa" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/labtech_logo.jpg') }}" alt="Labtech" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}" alt="Dual MFG" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}" alt="NL Scientific" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/QLab-Corporation.jpg') }}" alt="QLab" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/Tae-Sung-Co_logo.png') }}" alt="Tae Sung" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/toho-logo-200.jpg') }}" alt="Toho" class="partner-logo snap-start">
                            <img src="{{ asset('images/highlights/partnership/WandJ.jpg') }}" alt="W&J" class="partner-logo snap-start">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===================== DOWNLOAD COMPANY BROCHURE ===================== --}}
        @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const partnersTrack = document.getElementById('partners-track');
            if(!partnersTrack) return;
            
            const logos = partnersTrack.querySelectorAll('.partner-logo');
            const prevBtn = document.getElementById('partners-prev');
            const nextBtn = document.getElementById('partners-next');
            
            // Number of logos to show at once (adjust based on screen size)
            let logosPerView = window.innerWidth < 768 ? 2 : 4;
            let currentPosition = 0;
            
            function updateNavigation() {
                // Enable/disable buttons based on scroll position
                prevBtn.disabled = currentPosition <= 0;
                nextBtn.disabled = currentPosition >= logos.length - logosPerView;
                
                // Update visual state
                prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
                nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
            }
            
            function scrollPartners(direction) {
                const newPosition = currentPosition + direction;
                
                if (newPosition >= 0 && newPosition <= logos.length - logosPerView) {
                    currentPosition = newPosition;
                    const logo = logos[currentPosition];
                    if (logo) {
                        logo.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'nearest', 
                            inline: 'start' 
                        });
                    }
                    updateNavigation();
                }
            }

            // Add click handlers
            if(prevBtn) {
                prevBtn.addEventListener('click', () => scrollPartners(-1));
            }
            
            if(nextBtn) {
                nextBtn.addEventListener('click', () => scrollPartners(1));
            }
            
            // Initialize navigation state
            updateNavigation();
            
            // Update navigation on window resize
            window.addEventListener('resize', () => {
                logosPerView = window.innerWidth < 768 ? 2 : 4;
                updateNavigation();
            });
        });
        </script>
        @endpush

        <section class="download-section py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8">Download Our Digital Brochure</h2>
                    <a href="{{ asset('GEI 2025 brochure (1).pdf') }}" download="Gemarc-Enterprises-Brochure-2025.pdf" 
                        class="inline-flex items-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-xl transition-all duration-300 hover:shadow-lg">
                        <i class="fas fa-download mr-2"></i>Download
                    </a>
                </div>
            </div>
        </section>

        {{-- ===================== ENHANCED FEATURE GRID ===================== --}}
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-5xl font-bold text-gray-800 mb-6">Why Choose Gemarc?</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Your trusted partner for exceptional service and premium construction solutions</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <a href="{{ route('browse') }}" class="feature-card group rounded-3xl shadow-lg p-10 flex flex-col items-center text-center">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl p-6 mb-6 group-hover:scale-110 transition-transform duration-300"><i class="fas fa-shopping-cart text-3xl"></i></div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Browse Products</h3>
                        <p class="text-gray-600 leading-relaxed">Explore our comprehensive selection of premium industrial and commercial construction products.</p>
                    </a>
                    <a href="/contact" class="feature-card group rounded-3xl shadow-lg p-10 flex flex-col items-center text-center">
                        <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-2xl p-6 mb-6 group-hover:scale-110 transition-transform duration-300"><i class="fas fa-calculator text-3xl"></i></div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Get a Quote</h3>
                        <p class="text-gray-600 leading-relaxed">Request personalized quotes for your projects or bulk orders with competitive pricing.</p>
                    </a>
                    <a href="/services" class="feature-card group rounded-3xl shadow-lg p-10 flex flex-col items-center text-center">
                        <div class="bg-gradient-to-br from-green-600 to-orange-500 text-white rounded-2xl p-6 mb-6 group-hover:scale-110 transition-transform duration-300"><i class="fas fa-tools text-3xl"></i></div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Our Services</h3>
                        <p class="text-gray-600 leading-relaxed">Comprehensive solutions for all your business and technical construction requirements.</p>
                    </a>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection