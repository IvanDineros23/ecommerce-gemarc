@extends('layouts.app')

@section('title', 'Home | Gemarc Enterprises Inc.')

@section('content')
<style>
/* Green-Orange Theme Hero Styling */
.gradient-bg {
    background: linear-gradient(135deg, #15803d 0%, #16a34a 30%, #f59e0b 70%, #ea580c 100%);
    position: relative;
    overflow: hidden;
}

.gradient-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="3" fill="rgba(255,255,255,0.05)"/><circle cx="40" cy="80" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes slideIn {
    0% { transform: translateX(-100px); opacity: 0; }
    100% { transform: translateX(0); opacity: 1; }
}

@keyframes slideInFromRight {
    0% { transform: translateX(100px); opacity: 0; }
    100% { transform: translateX(0); opacity: 1; }
}

.hero-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: slideInFromRight 1s ease-out;
    transform: none !important; /* Keep cards straight */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hero-card:hover {
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px) !important;
}

.hero-content {
    animation: slideIn 1s ease-out;
}

.text-stroke-sm {
    text-shadow: 
        -1px -1px 0 #000,
        1px -1px 0 #000,
        -1px 1px 0 #000,
        1px 1px 0 #000;
}

.product-card {
    transition: all 0.3s ease;
    background: white;
    border: 1px solid #e5e7eb;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    border-color: #16a34a;
}

.feature-card {
    transition: all 0.3s ease;
    background: white;
    border: 1px solid #e5e7eb;
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.pavetest-title {
    background: linear-gradient(135deg, #f59e0b, #ea580c);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.search-enhanced {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.btn-primary {
    background: linear-gradient(135deg, #f59e0b, #ea580c);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(245, 158, 11, 0.4);
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid white;
    backdrop-filter: blur(10px);
}

.btn-secondary:hover {
    background: white;
    color: #15803d;
}

/* Hero slideshow */
.hero-slideshow {
    position: relative;
    height: 400px;
    overflow: hidden;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.hero-slide.active {
    opacity: 1;
}

/* Partners carousel */
.partners-scroll {
    animation: scroll 30s linear infinite;
}

@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.partner-logo {
    height: 60px;
    width: auto;
    object-fit: contain;
    filter: grayscale(100%);
    transition: all 0.3s ease;
}

.partner-logo:hover {
    filter: grayscale(0%);
    transform: scale(1.1);
}

/* Download section */
.download-section {
    background: linear-gradient(135deg, #16a34a, #15803d);
}

.download-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}
</style>

<div class="min-h-screen flex flex-col pt-0">
    <main class="flex-grow">
        {{-- ===================== GREEN-ORANGE HERO SECTION WITH SLIDESHOW ===================== --}}
        <section class="gradient-bg text-white py-20 relative min-h-[90vh] flex items-center">
            <div class="relative z-10 container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    {{-- Enhanced Search Bar --}}
                    <div class="text-center mb-16">
                        <div class="search-enhanced rounded-3xl p-8 max-w-3xl mx-auto mb-12">
                            <h2 class="text-3xl font-bold text-gray-800 mb-6">Find Your Perfect Product</h2>
                            <div class="relative">
                                <input
                                    id="landing-search"
                                    type="text"
                                    autocomplete="off"
                                    placeholder="Search for construction materials, equipment..."
                                    class="w-full pl-8 pr-16 py-5 rounded-2xl text-lg bg-white ring-2 ring-green-200 shadow-lg focus:outline-none focus:ring-4 focus:ring-green-500 text-gray-800"
                                />
                                <button
                                    type="button"
                                    aria-label="Search"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-12 h-12 rounded-xl btn-primary text-white flex items-center justify-center shadow-lg"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"/>
                                    </svg>
                                </button>
                                <div id="search-suggestions"
                                    class="absolute left-0 right-0 mt-3 bg-white border border-gray-200 rounded-2xl shadow-2xl z-50 hidden"></div>
                            </div>
                        </div>

                        {{-- Hero Content with Slideshow --}}
                        <div class="grid md:grid-cols-2 gap-16 items-center">
                            {{-- Left Content --}}
                            <div class="text-left hero-content">
                                <h1 class="text-6xl md:text-8xl font-extrabold leading-[0.9] mb-8">
                                    <span class="text-amber-400 text-stroke-sm">PAVETEST</span><br/>
                                    <span class="text-white">SOLUTIONS</span>
                                </h1>
                                <p class="text-xl md:text-2xl font-light text-green-100 mb-12 leading-relaxed">
                                    Advanced Pavetest equipment for comprehensive asphalt and bituminous materials testing. Our state-of-the-art systems deliver precise measurements and analysis for road construction and pavement research.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-6">
                                    <a href="{{ route('shop.index') }}" class="inline-flex items-center px-10 py-5 btn-primary text-white text-lg font-bold rounded-2xl shadow-2xl">
                                        <i class="fas fa-shopping-cart mr-3"></i>
                                        GET QUOTE
                                    </a>
                                    <a href="/pavetest" class="inline-flex items-center px-10 py-5 btn-secondary text-white text-lg font-bold rounded-2xl">
                                        <i class="fas fa-info-circle mr-3"></i>
                                        LEARN MORE
                                    </a>
                                </div>
                            </div>

                            {{-- Right Images Slideshow --}}
                            <div class="hero-slideshow">
                                <div class="hero-slide active">
                                    <div class="flex justify-center items-center gap-6">
                                        <div class="hero-card min-w-[280px] min-h-[340px] p-6 rounded-3xl shadow-2xl">
                                            <div class="rounded-2xl bg-white p-4 border-2 border-dashed border-gray-300 flex items-center justify-center h-[300px]">
                                                <img src="{{ asset('images/highlights/pavetest/pavetest1.jpg') }}" alt="Pavetest Equipment 1" class="w-full h-full object-contain rounded-xl">
                                            </div>
                                        </div>
                                        <div class="hero-card min-w-[280px] min-h-[340px] p-6 rounded-3xl shadow-2xl">
                                            <div class="rounded-2xl bg-white p-4 border-2 border-dashed border-gray-300 flex items-center justify-center h-[300px]">
                                                <img src="{{ asset('images/highlights/pavetest/pavetest2.jpg') }}" alt="Pavetest Equipment 2" class="w-full h-full object-contain rounded-xl">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hero-slide">
                                    <div class="flex justify-center items-center gap-6">
                                        <div class="hero-card min-w-[280px] min-h-[340px] p-6 rounded-3xl shadow-2xl">
                                            <div class="rounded-2xl bg-white p-4 border-2 border-dashed border-gray-300 flex items-center justify-center h-[300px]">
                                                <img src="{{ asset('images/highlights/concrete/concrete1.jpg') }}" alt="Concrete Testing Equipment" class="w-full h-full object-contain rounded-xl">
                                            </div>
                                        </div>
                                        <div class="hero-card min-w-[280px] min-h-[340px] p-6 rounded-3xl shadow-2xl">
                                            <div class="rounded-2xl bg-white p-4 border-2 border-dashed border-gray-300 flex items-center justify-center h-[300px]">
                                                <img src="{{ asset('images/highlights/concrete/concrete2.jpg') }}" alt="Concrete Testing Equipment 2" class="w-full h-full object-contain rounded-xl">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hero-slide">
                                    <div class="flex justify-center items-center gap-6">
                                        <div class="hero-card min-w-[280px] min-h-[340px] p-6 rounded-3xl shadow-2xl transform rotate-1">
                                            <div class="rounded-2xl bg-white p-4 border-2 border-dashed border-gray-300 flex items-center justify-center h-[300px]">
                                                <img src="{{ asset('images/highlights/aggregates/aggregates1.jpg') }}" alt="Aggregates Testing Equipment" class="w-full h-full object-contain rounded-xl">
                                            </div>
                                        </div>
                                        <div class="hero-card min-w-[280px] min-h-[340px] p-6 rounded-3xl shadow-2xl transform -rotate-1">
                                            <div class="rounded-2xl bg-white p-4 border-2 border-dashed border-gray-300 flex items-center justify-center h-[300px]">
                                                <img src="{{ asset('images/highlights/aggregates/aggregates2.jpg') }}" alt="Aggregates Testing Equipment 2" class="w-full h-full object-contain rounded-xl">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- =================== END GREEN-ORANGE HERO SECTION =================== --}}

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
                
                {{-- Enhanced Carousel --}}
                <div id="fp-track" class="relative overflow-x-auto no-scrollbar">
                    <div class="flex gap-8 snap-x snap-mandatory scroll-pl-6" style="scroll-behavior:smooth;">
                        @foreach($carouselProducts as $i => $p)
                            <article id="fp-{{ $i }}" class="product-card min-w-[85%] sm:min-w-[60%] md:min-w-[45%] lg:min-w-[32%] snap-start rounded-3xl shadow-lg p-8 flex flex-col items-center text-center">
                                <div class="w-48 h-48 rounded-2xl bg-gray-50 border-2 border-gray-100 flex items-center justify-center mb-6 overflow-hidden">
                                    <img src="{{ $p['image_url'] }}" alt="{{ $p['name'] }}" class="w-full h-full object-contain" />
                                </div>
                                <h3 class="font-bold text-xl mb-3 text-gray-900">{{ $p['name'] }}</h3>
                                @php $desc = trim($p['description']); @endphp
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    {{ $desc ? Str::limit($desc, 90) : 'Premium construction equipment' }}
                                </p>
                                @if($p['price'] > 0)
                                    <div class="text-2xl font-bold text-green-600 mb-4">₱{{ number_format($p['price'], 2) }}</div>
                                @endif
                                <a href="{{ route('shop.index') }}?search={{ urlencode($p['name']) }}" class="mt-auto px-8 py-4 rounded-xl bg-green-600 hover:bg-green-700 text-white font-bold transition duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-shopping-cart mr-2"></i>Shop Now
                                </a>
                            </article>
                        @endforeach
                    </div>
                    {{-- Enhanced Navigation --}}
                    <button type="button" id="fp-prev" class="hidden md:flex absolute -left-4 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white hover:bg-gray-50 items-center justify-center shadow-xl border border-gray-100 text-gray-600 hover:text-gray-800 transition">
                        <i class="fas fa-chevron-left text-xl"></i>
                    </button>
                    <button type="button" id="fp-next" class="hidden md:flex absolute -right-4 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white hover:bg-gray-50 items-center justify-center shadow-xl border border-gray-100 text-gray-600 hover:text-gray-800 transition">
                        <i class="fas fa-chevron-right text-xl"></i>
                    </button>
                </div>
                {{-- Enhanced Dots --}}
                <div class="flex justify-center items-center gap-3 mt-8">
                    @foreach($carouselProducts as $i => $p)
                        <button type="button" data-target="fp-{{ $i }}" class="fp-dot w-4 h-4 rounded-full bg-gray-300 hover:bg-gray-400 transition" aria-label="Go to slide {{ $i+1 }}"></button>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
        {{-- =================== END FEATURED PRODUCTS CAROUSEL =================== --}}

        {{-- ===================== OUR GLOBAL PARTNERS ===================== --}}
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Global Partners</h2>
                    <p class="text-xl text-gray-600">Trusted by leading companies worldwide</p>
                </div>
                
                <div class="relative overflow-hidden">
                    <div class="partners-scroll flex items-center gap-12 whitespace-nowrap">
                        {{-- First set of logos --}}
                        <img src="{{ asset('images/highlights/partnership/gilson_logo.png') }}" alt="Gilson" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/ehwa.png') }}" alt="Ehwa" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/labtech_logo.jpg') }}" alt="Labtech" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}" alt="Dual MFG" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}" alt="NL Scientific" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/QLab-Corporation.jpg') }}" alt="QLab Corporation" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/Tae-Sung-Co_logo.png') }}" alt="Tae Sung Co" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/toho-logo-200.jpg') }}" alt="Toho" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/WandJ.jpg') }}" alt="W&J" class="partner-logo">
                        
                        {{-- Duplicate set for seamless scroll --}}
                        <img src="{{ asset('images/highlights/partnership/gilson_logo.png') }}" alt="Gilson" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/ehwa.png') }}" alt="Ehwa" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/labtech_logo.jpg') }}" alt="Labtech" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}" alt="Dual MFG" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}" alt="NL Scientific" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/QLab-Corporation.jpg') }}" alt="QLab Corporation" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/Tae-Sung-Co_logo.png') }}" alt="Tae Sung Co" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/toho-logo-200.jpg') }}" alt="Toho" class="partner-logo">
                        <img src="{{ asset('images/highlights/partnership/WandJ.jpg') }}" alt="W&J" class="partner-logo">
                    </div>
                </div>
            </div>
        </section>
        {{-- =================== END GLOBAL PARTNERS =================== --}}

        {{-- ===================== DOWNLOAD COMPANY BROCHURE ===================== --}}
        <section class="download-section py-20 text-white">
            <div class="container mx-auto px-4">
                <div class="max-w-5xl mx-auto">
                    <div class="download-card rounded-3xl p-12">
                        {{-- Header Section --}}
                        <div class="text-center mb-12">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-500 rounded-full mb-6">
                                <i class="fas fa-file-pdf text-3xl text-white"></i>
                            </div>
                            <h2 class="text-4xl md:text-5xl font-bold mb-4">Download Our Digital Brochure</h2>
                            <p class="text-xl text-green-100 max-w-3xl mx-auto leading-relaxed">
                                Get comprehensive information about our products, services, and solutions in our latest company brochure.
                            </p>
                        </div>
                        
                        {{-- Features Grid --}}
                        <div class="grid md:grid-cols-2 gap-8 mb-12">
                            <div class="bg-white/10 rounded-2xl p-8 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-400 rounded-full mb-4">
                                    <i class="fas fa-tools text-2xl text-white"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-3">Product Catalog</h3>
                                <p class="text-green-100 leading-relaxed">Complete equipment specifications, technical details, and comprehensive product information</p>
                            </div>
                            <div class="bg-white/10 rounded-2xl p-8 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-400 rounded-full mb-4">
                                    <i class="fas fa-handshake text-2xl text-white"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-3">Partnership Info</h3>
                                <p class="text-green-100 leading-relaxed">Learn about our global partners, collaborations, and worldwide network</p>
                            </div>
                        </div>
                        
                        {{-- Download Button --}}
                        <div class="text-center">
                            <a href="{{ asset('GEI 2025 brochure (1).pdf') }}" 
                               download="Gemarc-Enterprises-Brochure-2025.pdf"
                               class="inline-flex items-center px-12 py-6 bg-orange-500 hover:bg-orange-600 text-white font-bold text-xl rounded-2xl shadow-2xl transition-all duration-300 hover:shadow-orange-500/25 hover:scale-105">
                                <i class="fas fa-download mr-4 text-xl"></i>
                                Download Brochure (PDF)
                            </a>
                            
                            <div class="flex items-center justify-center gap-6 mt-8 text-green-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-300"></i>
                                    <span>Free Download</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar text-green-300"></i>
                                    <span>Updated 2025</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-file-archive text-green-300"></i>
                                    <span>15MB PDF</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- =================== END DOWNLOAD BROCHURE =================== --}}

        {{-- ===================== ENHANCED FEATURE GRID ===================== --}}
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-5xl font-bold text-gray-800 mb-6">Why Choose Gemarc?</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Your trusted partner for exceptional service and premium construction solutions
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <a href="{{ route('shop.index') }}" class="feature-card group rounded-3xl shadow-lg p-10 flex flex-col items-center text-center">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl p-6 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-shopping-cart text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Browse Products</h3>
                        <p class="text-gray-600 leading-relaxed">Explore our comprehensive selection of premium industrial and commercial construction products.</p>
                    </a>

                    <a href="/contact" class="feature-card group rounded-3xl shadow-lg p-10 flex flex-col items-center text-center">
                        <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-2xl p-6 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-calculator text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Get a Quote</h3>
                        <p class="text-gray-600 leading-relaxed">Request personalized quotes for your projects or bulk orders with competitive pricing.</p>
                    </a>

                    <a href="/services" class="feature-card group rounded-3xl shadow-lg p-10 flex flex-col items-center text-center">
                        <div class="bg-gradient-to-br from-green-600 to-orange-500 text-white rounded-2xl p-6 mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-tools text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Our Services</h3>
                        <p class="text-gray-600 leading-relaxed">Comprehensive solutions for all your business and technical construction requirements.</p>
                    </a>
                </div>
            </div>
        </section>
        {{-- =================== END ENHANCED FEATURE GRID =================== --}}

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hero Slideshow
    const slides = document.querySelectorAll('.hero-slide');
    let currentSlide = 0;
    
    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
    
    // Auto-advance hero slideshow every 4 seconds
    setInterval(nextSlide, 4000);

    // Search functionality
    const searchInput = document.getElementById('landing-search');
    const suggestionsBox = document.getElementById('search-suggestions');
    let debounceTimeout = null;

    if (searchInput) {
        searchInput.addEventListener('input', function () {
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
                            suggestionsBox.innerHTML = '<div class="px-6 py-4 text-gray-500 text-center">No products found.</div>';
                            suggestionsBox.classList.remove('hidden');
                            return;
                        }
                        suggestionsBox.innerHTML = data.map(product => `
                            <div class="flex items-center gap-4 px-6 py-4 hover:bg-green-50 cursor-pointer border-b last:border-b-0 transition"
                                 onclick="window.location='{{ route('shop.index') }}?search='+encodeURIComponent('${product.name}')">
                                <img src="${product.image_url ? product.image_url : '/images/gemarclogo.png'}"
                                     alt="${product.name}" class="w-14 h-14 object-contain rounded-xl bg-gray-100 border" />
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-gray-800 truncate">${product.name}</div>
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

        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const q = this.value.trim();
                if (q.length > 0) window.location = `{{ route('shop.index') }}?search=${encodeURIComponent(q)}`;
            }
        });

        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.classList.add('hidden');
            }
        });
    }

    // Enhanced Featured Products Carousel
    const track = document.querySelector('#fp-track > .flex');
    if(track) {
        const cards = [...track.children];
        const dots  = [...document.querySelectorAll('.fp-dot')];
        let index = 0;

        function go(i, smoothScroll = true){
          index = Math.max(0, Math.min(i, cards.length - 1));
          
          // Only scroll if explicitly requested (not on initial page load)
          if (smoothScroll) {
              cards[index].scrollIntoView({behavior:'smooth', inline:'start', block:'nearest'});
          }
          
          // Always update the active dot
          dots.forEach((d, k) => {
              d.classList.toggle('bg-green-600', k===index);
              d.classList.toggle('bg-gray-300', k!==index);
              d.classList.toggle('scale-125', k===index);
          });
        }

        // Initial state - don't scroll on page load
        go(0, false);

        // Dots click
        dots.forEach((dot, i) => {
          dot.addEventListener('click', () => go(i, true));
        });

        // Prev/Next with enhanced functionality
        const prev = document.getElementById('fp-prev');
        const next = document.getElementById('fp-next');
        prev?.addEventListener('click', () => go(index - 1, true));
        next?.addEventListener('click', () => go(index + 1, true));

        // Manual control - no auto-advance for products
        let ticking = false;
        track.parentElement.addEventListener('scroll', () => {
          if (ticking) return;
          window.requestAnimationFrame(() => {
            let min = Infinity, at = 0;
            cards.forEach((el, i) => {
              const rect = el.getBoundingClientRect();
              const dist = Math.abs(rect.left - track.getBoundingClientRect().left);
              if (dist < min) { min = dist; at = i; }
            });
            go(at, false);
            ticking = false;
          });
          ticking = true;
        }, {passive:true});
    }

    // Smooth animations on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.transform = 'translateY(0)';
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.feature-card, .product-card').forEach(card => {
        card.style.transform = 'translateY(30px)';
        card.style.opacity = '0';
        card.style.transition = 'all 0.8s ease';
        observer.observe(card);
    });
});
</script>
@endsection