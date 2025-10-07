@extends('layouts.app')

@section('title', 'Home | Gemarc Enterprises Inc.')

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
                            PAVETEST<br/>SOLUTIONS
                        </h1>
                        <p class="text-lg md:text-2xl/9 font-light text-black mb-10 max-w-3xl">
                            Advanced Pavetest equipment for comprehensive asphalt and bituminous materials testing. Our state-of-the-art systems deliver precise measurements and analysis for road construction and pavement research.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('shop.index') }}" class="px-8 py-4 rounded-lg bg-orange-500 hover:bg-orange-600 text-white text-lg font-semibold shadow">
                                GET QUOTE
                            </a>
                            <a href="/pavetest" class="px-8 py-4 rounded-lg border-2 border-orange-500 text-orange-600 hover:bg-orange-50 text-lg font-semibold">
                                LEARN MORE
                            </a>
                        </div>
                    </div>
                    {{-- Right images --}}
                    <div class="flex items-center justify-center relative">
                        <div class="grid grid-cols-2 gap-4 w-full max-w-lg">
                            <div class="bg-gray-100 rounded-xl p-4 shadow-lg">
                                <img src="{{ asset('images/highlights/pavetest/pavetest1.jpg') }}" alt="Pavetest Equipment 1" class="w-full h-auto rounded-lg object-cover">
                            </div>
                            <div class="bg-gray-100 rounded-xl p-4 shadow-lg">
                                <img src="{{ asset('images/highlights/pavetest/pavetest2.jpg') }}" alt="Pavetest Equipment 2" class="w-full h-auto rounded-lg object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- ======================= END HERO ======================= --}}
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('landing-search');
    const searchSuggestions = document.getElementById('search-suggestions');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            if (query.length >= 2) {
                fetch(`/landing-search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            searchSuggestions.innerHTML = data.map(product => `
                                <a href="/shop?search=${encodeURIComponent(product.name)}" 
                                   class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-b-0">
                                    <div class="font-medium text-gray-900">${product.name}</div>
                                    <div class="text-sm text-gray-600">₱${parseFloat(product.unit_price).toLocaleString()}</div>
                                </a>
                            `).join('');
                            searchSuggestions.classList.remove('hidden');
                        } else {
                            searchSuggestions.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        searchSuggestions.classList.add('hidden');
                    });
            } else {
                searchSuggestions.classList.add('hidden');
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                searchSuggestions.classList.add('hidden');
            }
        });
    }
});
</script>
@endsection
                <!-- Mobile Menu Overlay -->
                <div class="mobile-menu-overlay" id="mobileMenu"><button class="mobile-menu-close" id="closeMenu">&times;</button>
                    <ul class="mobile-menu-list">
                        <li>
                            <button class="mobile-menu-main">News</button>
                            <ul class="mobile-menu-sub">
                                <li><a href="news.html">News</a></li>
                                <li><a href="blogs.html">Blogs</a></li>
                            </ul>
                        </li>
                        <li>
                            <button class="mobile-menu-main">Products</button>
                            <ul class="mobile-menu-sub">
                                <li><a href="aggregates.html">Aggregates</a></li>
                                <li><a href="asphalt-bitumen.html">Asphalt & Bitumen</a></li>
                                <li><a href="cement-mortar.html">Cement & Mortar</a></li>
                                <li><a href="concrete-mortar.html">Concrete & Mortar</a></li>
                                <li><a href="drilling-machine.html">Drilling Machine</a></li>
                                <li><a href="industrial-equipment.html">Industrial Equipment</a></li>
                                <li><a href="soil.html">Soil Testing</a></li>
                                <li><a href="steel.html">Steel Testing</a></li>
                                <li><a href="pavetest.html">Pavetest Equipment</a></li>
                            </ul>
                        </li>
                        <li>
                            <button class="mobile-menu-main">Services</button>
                            <ul class="mobile-menu-sub">
                                <li><a href="calibration.html">Calibration Services</a></li>
                                <li><a href="services.html">Repair Services</a></li>
                            </ul>
                        </li>
                        <li>
                            <button class="mobile-menu-main">About</button>
                            <ul class="mobile-menu-sub">
                                <li><a href="about.html">Company</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            <li><a href="customerfeedback.html">Customer Feedback</a></li>
</ul>
                        </li>
                                    </ul>
<!-- Quick Actions (mobile only) -->
<div class="mobile-actions">
  <a href="contact.html" class="action-btn quote-btn">
    <i class="fas fa-calculator"></i> Get Quote
  </a>
  <a href="tel:+639090879416" class="action-btn call-btn">
    <i class="fas fa-phone"></i> Call Now
  </a>
</div>
</div>
                
                <!-- Quick Actions -->
                <div class="nav-actions">
                    <a href="contact.html" class="action-btn quote-btn">
                        <i class="fas fa-calculator"></i> Get Quote
                    </a>
                    <a href="tel:+639090879416" class="action-btn call-btn">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                </div>
                
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Material Testing Highlights Section -->
    <section class="material-testing-highlights modern-hero" id="heroSection">
        <div class="highlights-background modern-bg"></div>
        <div class="container">
            <!-- Search Bar -->
            <div class="products-search modern-search" data-animate="fade-up" data-delay="0.2">
                <input type="search" class="search-input" placeholder="Search for products...">
                <button class="search-btn" type="button"><i class="fas fa-search"></i></button>
            </div>

            <div class="highlights-container">
                <div class="highlights-carousel modern-carousel">
                <div class="highlights-slide active modern-slide" data-slide="0">
                    <div class="highlights-content modern-content">
                        <div class="highlights-text modern-text" data-animate="slide-left" data-delay="0.3">
                            <h1 class="highlights-title modern-title">
                                <span class="text-white title-line" data-animate="slide-up" data-delay="0.4">CALIBRATION</span><br>
                                <strong class="title-line" data-animate="slide-up" data-delay="0.6">SERVICES</strong>
                            </h1>
                            <p class="highlights-description modern-description" data-animate="fade-up" data-delay="0.8">
                                Professional calibration services for all types of testing equipment. Our ISO-certified technicians ensure your instruments maintain accuracy and compliance with international standards, providing detailed calibration certificates and traceability.
                            </p>
                            <div class="highlights-actions modern-actions" data-animate="scale-in" data-delay="1.0">
                                <a href="/services" class="highlights-btn primary modern-btn">Get Quote</a>
                                <a href="/calibration" class="highlights-btn secondary modern-btn">Learn More</a>
                            </div>
                        </div>
                        <div class="highlights-images modern-images" data-animate="slide-right" data-delay="0.4">
                            <div class="compression-machines-showcase modern-showcase">
                                <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.6">
                                    <img src="{{ asset('/images/highlights/calibration/471297900_514765054922698_1512859822718235856_n.jpg') }}" alt="Calibration Service" class="machine-image modern-image">
                                </div>
                                <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.8">
                                    <img src="{{ asset('/images/highlights/calibration/505748620_640204149045454_5713118671588066311_n.jpg') }}" alt="Professional Calibration" class="machine-image modern-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="highlights-slide modern-slide" data-slide="1">
                    <div class="highlights-content modern-content">
                        <div class="highlights-text modern-text" data-animate="slide-left" data-delay="0.3">
                            <h1 class="highlights-title modern-title">
                                <span class="text-white title-line" data-animate="slide-up" data-delay="0.4">PAVETEST</span><br>
                                <strong class="title-line" data-animate="slide-up" data-delay="0.6">SOLUTIONS</strong>
                            </h1>
                            <p class="highlights-description modern-description" data-animate="fade-up" data-delay="0.8">
                                Advanced Pavetest equipment for comprehensive asphalt and bituminous materials testing. Our state-of-the-art systems deliver precise measurements and analysis for road construction and pavement research.
                            </p>
                            <div class="highlights-actions modern-actions" data-animate="scale-in" data-delay="1.0">
                                <a href="/contact" class="highlights-btn primary modern-btn">Get Quote</a>
                                <a href="/asphalt-bitumen" class="highlights-btn secondary modern-btn">Learn More</a>
                            </div>
                        </div>
                        <div class="highlights-images modern-images" data-animate="slide-right" data-delay="0.4">
                            <div class="compression-machines-showcase modern-showcase">
                                <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.6">
                                    <img src="{{ asset('/images/highlights/b265.jpg') }}" alt="Pavetest Testing Equipment" class="machine-image modern-image">
                                </div>
                                <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.8">
                                    <img src="{{ asset('/images/highlights/b210_72dpi.jpg') }}" alt="Pavetest System" class="machine-image modern-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="highlights-slide modern-slide" data-slide="2">
                    <div class="highlights-content modern-content">
                        <div class="highlights-text modern-text" data-animate="slide-left" data-delay="0.3">
                            <h1 class="highlights-title modern-title">
                                <span class="text-white title-line" data-animate="slide-up" data-delay="0.4">ON-SITE</span><br>
                                <strong class="title-line" data-animate="slide-up" data-delay="0.6">MAINTENANCE</strong>
                            </h1>
                            <p class="highlights-description modern-description" data-animate="fade-up" data-delay="0.8">
                                Expert maintenance and repair services at your location. Our skilled technicians provide preventive maintenance, troubleshooting, and repairs to keep your testing equipment in optimal condition.
                            </p>
                            <div class="highlights-actions modern-actions" data-animate="scale-in" data-delay="1.0">
                                <a href="/contact" class="highlights-btn primary modern-btn">Get Quote</a>
                                <a href="/services" class="highlights-btn secondary modern-btn">Learn More</a>
                            </div>
                        </div>
                        <div class="highlights-images modern-images" data-animate="slide-right" data-delay="0.4">
                            <div class="compression-machines-showcase modern-showcase">
                                <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.6">
                                    <img src="{{ asset('/images/highlights/calibration/viber_image_2025-09-04_08-39-35-055.jpg') }}" alt="Equipment Maintenance" class="machine-image modern-image">
                                </div>
                                <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.8">
                                    <img src="{{ asset('/images/highlights/calibration/viber_image_2025-09-04_08-39-34-788.jpg') }}" alt="On-site Service" class="machine-image modern-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Navigation dots -->
                <div class="highlights-dots modern-dots">
                    <button class="dot modern-dot active" data-slide="0"></button>
                    <button class="dot modern-dot" data-slide="1"></button>
                    <button class="dot modern-dot" data-slide="2"></button>
                </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.highlights-slide');
        const dots = document.querySelectorAll('.dot');
        let currentSlide = 0;
        const totalSlides = slides.length;

        function updateSlides(index) {
            slides.forEach(slide => {
                slide.classList.remove('active');
                slide.style.display = 'none';
            });
            
            dots.forEach(dot => {
                dot.classList.remove('active');
            });
            
            slides[index].classList.add('active');
            slides[index].style.display = 'block';
            
            dots[index].classList.add('active');
            
            currentSlide = index;
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                updateSlides(index);
            });
        });

        setInterval(() => {
            const nextSlide = (currentSlide + 1) % totalSlides;
            updateSlides(nextSlide);
        }, 5000);
        
        updateSlides(0);
    });
    </script>
                
                <!-- Drilling Category -->
                <div class="category-content" id="drilling">
                    <h3>Drilling Equipment</h3>
                    <p>Professional drilling equipment for core sampling and soil investigation</p>
                    <div class="category-products-grid">
                        <div class="category-product-card">
                            <div class="product-image-placeholder">
                                <i class="fas fa-image"></i>
                                <span>Product Image</span>
                            </div>
                            <div class="product-info">
                                <h4>Drilling Equipment</h4>
                                <p>Coming soon - Professional drilling equipment for geotechnical investigation.</p>
                                <button class="product-details-btn">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- UPM Category -->
                <div class="category-content" id="upm">
                    <h3>UPM Systems</h3>
                    <p>Universal testing machines for comprehensive material analysis</p>
                    <div class="category-products-grid">
                        <div class="category-product-card">
                            <div class="product-image-placeholder">
                                <i class="fas fa-image"></i>
                                <span>Product Image</span>
                            </div>
                            <div class="product-info">
                                <h4>UPM System</h4>
                                <p>Coming soon - Universal testing machines for multi-purpose material testing.</p>
                                <button class="product-details-btn">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Aggregate Testing Category -->
                <div class="category-content" id="aggregate">
                    <h3>Aggregate Testing Equipment</h3>
                    <p>Specialized equipment for aggregate quality assessment and analysis</p>
                    <div class="category-products-grid">
                        <div class="category-product-card">
                            <div class="product-image-placeholder">
                                <i class="fas fa-image"></i>
                                <span>Product Image</span>
                            </div>
                            <div class="product-info">
                                <h4>Aggregate Testing Equipment</h4>
                                <p>Coming soon - Professional aggregate testing equipment for quality assessment.</p>
                                <button class="product-details-btn">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="products-content">
                <h2>Our Products</h2>
                <p>Explore our comprehensive range of professional testing equipment and laboratory instruments</p>
                <div class="products-carousel-container">
                    <button class="carousel-btn carousel-btn-left" onclick="moveProductsCarousel(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-btn carousel-btn-right" onclick="moveProductsCarousel(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="products-carousel">
                        <div class="products-track" id="productsTrack">
                            @php
                                $featuredProducts = \App\Models\Product::where('is_active', true)->latest()->limit(15)->get();
                            @endphp
                            @forelse ($featuredProducts as $product)
                                @php
                                    $img = $product->firstImagePath();
                                    $imgUrl = $img ? asset('storage/' . $img) : asset('images/gemarclogo.png');
                                @endphp
                                <div class="product-card" data-product-card data-category-page="{{ route('shop.index', ['q' => $product->name]) }}"><img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="product-logo"><div class="product-name" data-product-name>{{ $product->name }}</div></div>
                            @empty
                                <!-- No products found message -->
                                <div class="product-card no-products">
                                    <div class="product-name">No products available</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <button class="carousel-btn carousel-btn-right" onclick="moveProductsCarousel(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>


    <!-- E-Brochures Section -->
    <section class="ebrochures-section">
        <div class="container">
            <div class="brochure-hero">
                <h2>Download Our Digital Brochure</h2>
                <p>Get comprehensive information about Gemarc Enterprises and our testing equipment solutions</p>
            </div>
            <div class="brochure-download-center">
                <a href="{{ asset('GEI 2025 brochure (1).pdf') }}" class="compact-download-btn" download>
                    <i class="fas fa-download"></i>
                    Download Company Brochure
                </a>
            </div>
        </div>
    </section>

    <!-- Partnership Section -->
    <section class="partnership-section">
        <div class="container">
            <div class="partnership-content">
                <h2>Our Global Partners</h2>
                <p>We collaborate with leading brands in the industry to deliver exceptional quality and service</p>
                <div class="partners-carousel-container">
                    <button class="carousel-btn carousel-btn-left" onclick="moveCarousel(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="partners-carousel">
                        <div class="partners-track" id="partnersTrack">
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/gilson_logo.png') }}" alt="Gilson" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/ehwa.png') }}" alt="Ehwa" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/labtech_logo.jpg') }}" alt="Labtech" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}" alt="Dual MFG" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}" alt="NL Scientific" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/QLab-Corporation.jpg') }}" alt="QLab Corporation" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/Tae-Sung-Co_logo.png') }}" alt="Tae Sung Co" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/toho-logo-200.jpg') }}" alt="Toho" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/WandJ.jpg') }}" alt="W&J" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/tbt-Nanjing_logo.jpg') }}" alt="TBT Nanjing" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/capping-gypsum-logo.png') }}" alt="Capping Gypsum" class="partner-logo">
                            </div>
                            <!-- Duplicate items for seamless loop -->
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/gilson_logo.png') }}" alt="Gilson" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/ehwa.png') }}" alt="Ehwa" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="{{ asset('images/highlights/partnership/labtech_logo.jpg') }}" alt="Labtech" class="partner-logo">
                            </div>
                        </div>
                    </div>
                    <button class="carousel-btn carousel-btn-right" onclick="moveCarousel(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    
    <script>
    // Partners Carousel Script
    function moveCarousel(direction) {
        const track = document.getElementById('partnersTrack');
        const partnerItems = track.querySelectorAll('.partner-item');
        
        if (!partnerItems.length) return;
        
        const itemWidth = partnerItems[0].offsetWidth + 40; // width + gap
        const visibleItems = Math.floor(track.parentElement.offsetWidth / itemWidth);
        
        // Calculate current position
        const currentTransform = track.style.transform || 'translateX(0px)';
        const currentPosition = parseInt(currentTransform.replace('translateX(', '').replace('px)', '')) || 0;
        
        // Calculate new position
        const moveAmount = direction * (itemWidth * 2);
        let newPosition = currentPosition + moveAmount;
        
        // Limit boundaries
        const minPosition = 0;
        const maxPosition = -(itemWidth * (partnerItems.length - visibleItems));
        
        if (newPosition > minPosition) newPosition = minPosition;
        if (newPosition < maxPosition) newPosition = maxPosition;
        
        track.style.transform = `translateX(${newPosition}px)`;
    }
    </script>

    <!-- Latest News & Updates Section -->
    <section class="news-blogs-section">
        <div class="container">
            <div class="section-header">
                <h2>Latest News & Updates</h2>
                <p>Stay updated with our latest news, industry insights, and company announcements</p>
            </div>
            
            <div class="news-grid">
                <!-- News Card 1 - ISO 9001 Training -->
                <a href="news.html" class="news-card">
                    <div class="news-image">
                        <img src="{{ asset('images/highlights/news/GEItrainingiso9001-1024x768.jpg') }}" alt="ISO 9001 Training">
                    </div>
                    <div class="news-content">
                        <h3>ISO 9001:2015 Quality Management Training</h3>
                        <p>Our team completed comprehensive training on ISO 9001:2015 Quality Management Systems to enhance our service delivery.</p>
                        <span class="read-more">Read More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>

                <!-- News Card 2 - Employee Recognition -->
                <a href="news.html" class="news-card">
                    <div class="news-image">
                        <img src="{{ asset('images/highlights/news/viber_image_2025-09-05_10-41-23-739.jpg') }}" alt="Employee Recognition 2025">
                    </div>
                    <div class="news-content">
                        <h3>Employee Recognition for the First Half of the Year 2025</h3>
                        <p>We celebrated and recognized the outstanding contributions of our dedicated employees during the first half of 2025.</p>
                        <span class="read-more">Read More <i class="fas fa-arrow-right"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="contact-cta-section modern-cta" id="about" data-aos="zoom-in">
        <div class="container">
            <div class="contact-cta-content modern-cta-content">
                <h2 class="cta-title">Finding something interesting ?</h2>
                <div class="cta-button-wrapper">
                    <a href="{{ route('contact') }}" class="contact-cta-btn modern-contact-btn">
                        <span class="btn-text">Contact Us Now</span>
                        <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                        <div class="btn-shine"></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Social Buttons -->
    <div class="floating-buttons">
        <a href="https://www.facebook.com/gmrcsales" target="_blank" class="floating-btn facebook-btn" title="Visit our Facebook Page">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="viber://chat?number=09090879416" class="floating-btn viber-btn" title="Contact us on Viber: 0909 087 9416">
            <i class="fab fa-viber"></i>
        </a>
    </div>

    <script src="{{ asset('website/script.js') }}"></script>
    <script src="{{ asset('website/search.js') }}"></script>
    <script src="{{ asset('website/product-card-handler.js') }}"></script>
    
    <!-- Modern CTA Button Enhancement Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctaButton = document.querySelector('.contact-cta-btn.modern-contact-btn');
        
        if (ctaButton) {
            // Add ripple effect on click
            ctaButton.addEventListener('click', function(e) {
                // Create ripple element
                const ripple = document.createElement('div');
                ripple.classList.add('ripple');
                
                // Calculate position
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                // Style the ripple
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.6);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    left: ${x - 10}px;
                    top: ${y - 10}px;
                    width: 20px;
                    height: 20px;
                    pointer-events: none;
                    z-index: 10;
                `;
                
                // Add ripple to button
                this.appendChild(ripple);
                
                // Remove ripple after animation
                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.parentNode.removeChild(ripple);
                    }
                }, 600);
                
                // Add loading state
                this.classList.add('loading');
                setTimeout(() => {
                    this.classList.remove('loading');
                }, 1000);
            });
            
            // Add magnetic effect on mouse move
            ctaButton.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                // Limit the magnetic effect
                const maxDistance = 20;
                const distance = Math.sqrt(x * x + y * y);
                const factor = Math.min(distance, maxDistance) / maxDistance;
                
                const moveX = (x / distance) * factor * 3;
                const moveY = (y / distance) * factor * 3;
                
                this.style.transform = `translateY(-8px) scale(1.05) translate(${moveX}px, ${moveY}px)`;
            });
            
            ctaButton.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        }
    });
    </script>
    
    <!-- Add ripple animation CSS -->
    <style>
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    </style>
    
    <!-- AOS Animation Library -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init({ once: true });</script>
    </div>
@endsection
