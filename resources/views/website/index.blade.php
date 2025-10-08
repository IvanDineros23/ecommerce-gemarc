@extends('layouts.app')

@section('title', 'Home | Gemarc Enterprises Inc.')

@section('content')
@push('styles')
<style>
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


/* Enhanced Highlights / Hero Section Styles (scoped) */
.material-testing-highlights {position:relative;padding:4rem 0 6rem;min-height:90vh;color:#fff;overflow:hidden;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial,'Noto Sans',sans-serif;background:radial-gradient(circle at 20% 30%,rgba(255,255,255,.08),transparent 60%),radial-gradient(circle at 80% 70%,rgba(255,255,255,.06),transparent 55%),linear-gradient(135deg,#1e293b,#0f172a);} /* fallback gradient */
.material-testing-highlights .highlights-background {position:absolute;inset:0;background:linear-gradient(rgba(15,23,42,.78),rgba(15,23,42,.78)),url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat;z-index:0;opacity:.95;}
.material-testing-highlights .container {position:relative;z-index:2;max-width:1280px;margin:0 auto;padding:0 2rem;}
.products-search {max-width:760px;margin:0 auto 2.5rem;display:flex;gap:.5rem;background:rgba(255,255,255,.92);border-radius:50px;padding:.75rem 1.25rem;box-shadow:0 10px 40px -10px rgba(0,0,0,.35);backdrop-filter:blur(6px);}
.products-search .search-input{flex:1;border:none;font-size:1rem;padding:.75rem 1rem;background:transparent;outline:none;color:#111;}
.products-search .search-btn{width:56px;height:56px;border:none;border-radius:50%;background:#15803d;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.15rem;cursor:pointer;transition:.35s;background-image:linear-gradient(135deg,#16a34a,#15803d);} 
.products-search .search-btn:hover{filter:brightness(1.1);transform:translateY(-2px);} 
.highlights-container{position:relative;overflow:hidden;}
/* Fade style slider (simpler & reliable) */
.highlights-carousel{position:relative;width:100%;min-height:460px;}
.highlights-track{position:relative;width:100%;height:100%;}
.highlights-slide{position:absolute;inset:0;opacity:0;pointer-events:none;display:flex;transform:translateX(60px) scale(.98);transition:opacity .9s ease,transform 1s cubic-bezier(.77,0,.18,1),filter 1s;filter:blur(2px);} 
.highlights-slide.preparing{opacity:0;transform:translateX(60px) scale(.98);}
.highlights-slide.leaving{opacity:0;transform:translateX(-60px) scale(.98);filter:blur(4px);} 
.highlights-slide.active{opacity:1;pointer-events:auto;transform:translateX(0) scale(1);filter:blur(0);} 
.no-js .highlights-slide{display:none;}
.no-js .highlights-slide:first-child{display:flex;opacity:1;}
.highlights-slide .highlights-content{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:3rem;align-items:center;min-height:430px;width:100%;}
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
@media (max-width:1024px){.highlights-slide .highlights-content{gap:2.5rem;} .machine-item{max-width:44%;}}
@media (max-width:820px){.highlights-slide .highlights-content{grid-template-columns:1fr;}.machine-item{max-width:44%;}}
@media (max-width:640px){.highlights-actions{flex-direction:column;}.machine-item{max-width:46%;min-width:160px;width:48%;aspect-ratio:1/1.1;padding:.85rem;border-radius:1.25rem;} .highlights-btn{flex:1;}}
</style>
@endpush
@push('scripts')
<script>
// Advanced Fade+Slide Slider (autoplay 8s)
let currentHighlight = 0; let highlightTimer; let highlightSlides; let highlightDots; let isAnimating=false;
function setActiveSlide(idx){
    if(isAnimating || idx===currentHighlight) return;
    const prev = currentHighlight;
    currentHighlight = idx;
    isAnimating=true;
    const prevSlide = highlightSlides[prev];
    const nextSlide = highlightSlides[idx];
    prevSlide?.classList.remove('active');
    prevSlide?.classList.add('leaving');
    nextSlide?.classList.add('preparing');
    requestAnimationFrame(()=>{
        nextSlide?.classList.remove('preparing');
        nextSlide?.classList.add('active');
        highlightDots.forEach((d,i)=> d.classList.toggle('active', i===currentHighlight));
    });
    setTimeout(()=>{ prevSlide?.classList.remove('leaving'); isAnimating=false; },900); // match opacity duration
}
function showHighlight(i){
    if(!highlightSlides.length) return;
    const target = ((i % highlightSlides.length)+highlightSlides.length)%highlightSlides.length;
    if(target!==currentHighlight){ setActiveSlide(target); restartHighlightAutoplay(); }
}
function nextHighlight(){ showHighlight(currentHighlight+1); }
function startHighlightAutoplay(){ stopHighlightAutoplay(); highlightTimer=setInterval(nextHighlight,8000); }
function stopHighlightAutoplay(){ if(highlightTimer) clearInterval(highlightTimer); }
function restartHighlightAutoplay(){ startHighlightAutoplay(); }
document.addEventListener('DOMContentLoaded',()=>{
    document.querySelector('.material-testing-highlights')?.classList.remove('no-js');
    highlightSlides=[...document.querySelectorAll('.highlights-slide')];
    highlightDots=[...document.querySelectorAll('.highlights-navigation .nav-dot')];
    if(highlightSlides.length){ highlightSlides[0].classList.add('active'); highlightDots[0]?.classList.add('active'); }
    startHighlightAutoplay();
    const container=document.querySelector('.material-testing-highlights');
    if(container){
        container.addEventListener('pointerenter',stopHighlightAutoplay);
        container.addEventListener('pointerleave',startHighlightAutoplay);
    }
    document.querySelectorAll('.highlights-slide img').forEach(img=>{
        img.addEventListener('error',()=>{ if(!img.dataset.fallback){ img.dataset.fallback='1'; img.src='{{ asset('images/gemarclogo.png') }}'; }});
    });
});
</script>
@endpush

<div class="min-h-screen flex flex-col pt-0">
    <main class="flex-grow">
        <!-- Legacy Material Testing Highlights Section Injected -->
        <section class="material-testing-highlights" data-aos="fade-up">
            <div class="highlights-background"></div>
            <div class="container">
                <div class="products-search">
                    <input type="search" class="search-input" placeholder="Search products..." />
                    <button class="search-btn" type="button"><i class="fas fa-search"></i></button>
                </div>
                <div class="highlights-container">
                    <div class="highlights-carousel">
                        <div class="highlights-track">
                        <div class="highlights-slide" data-slide="0">
                            <div class="highlights-content">
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
                        <div class="highlights-slide" data-slide="1">
                            <div class="highlights-content">
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
                        <div class="highlights-slide" data-slide="2">
                            <div class="highlights-content">
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
                        <div class="highlights-slide" data-slide="3">
                            <div class="highlights-content">
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
                        <div class="highlights-slide" data-slide="4">
                            <div class="highlights-content">
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
                        <button class="nav-dot" onclick="showHighlight(0)"></button>
                        <button class="nav-dot" onclick="showHighlight(1)"></button>
                        <button class="nav-dot" onclick="showHighlight(2)"></button>
                        <button class="nav-dot" onclick="showHighlight(3)"></button>
                        <button class="nav-dot" onclick="showHighlight(4)"></button>
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
                            <article id="fp-{{ $i }}" class="product-card min-w-[75%] sm:min-w-[45%] md:min-w-[35%] lg:min-w-[28%] snap-start rounded-2xl shadow-lg p-6 flex flex-col items-center text-center">
                                <div class="w-40 h-40 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center mb-4 overflow-hidden">
                                    <img src="{{ $p['image_url'] }}" alt="{{ $p['name'] }}" class="w-full h-full object-contain" />
                                </div>
                                <h3 class="font-bold text-lg mb-2 text-gray-800 line-clamp-1">{{ $p['name'] }}</h3>
                                @php $desc = trim($p['description']); @endphp
                                <p class="text-sm text-gray-600 mb-3 leading-relaxed line-clamp-2">
                                    {{ $desc ? Str::limit($desc, 80) : 'Premium construction equipment' }}
                                </p>
                                @if($p['price'] > 0)
                                    <div class="text-lg font-bold text-green-600 mb-3">₱{{ number_format($p['price'], 2) }}</div>
                                @endif
                                <a href="{{ route('shop.index') }}" class="mt-auto w-full px-5 py-3 rounded-lg bg-green-600 hover:bg-green-700 text-white font-medium transition duration-300 shadow hover:shadow-lg">
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
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('fp-track');
            if(!track) return;
            
            const slides = track.querySelectorAll('.product-card');
            const prevBtn = document.getElementById('fp-prev');
            const nextBtn = document.getElementById('fp-next');
            let currentIndex = 0;
            const slideWidth = 286; // width + gap

            // Scroll to slide
            function scrollToSlide(idx) {
                if(idx < 0) idx = 0;
                if(idx >= slides.length) idx = slides.length - 1;
                
                currentIndex = idx;
                
                // Calculate position
                const scrollPos = idx * slideWidth;
                track.scrollTo({
                    left: scrollPos,
                    behavior: 'smooth'
                });
            }

            if(prevBtn) {
                prevBtn.addEventListener('click', () => scrollToSlide(currentIndex - 1));
            }
            
            if(nextBtn) {
                nextBtn.addEventListener('click', () => scrollToSlide(currentIndex + 1));
            }
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
            const logosPerView = window.innerWidth < 768 ? 2 : 4;
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
                    <a href="{{ route('shop.index') }}" class="feature-card group rounded-3xl shadow-lg p-10 flex flex-col items-center text-center">
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