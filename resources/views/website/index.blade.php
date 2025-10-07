@extends('layouts.app')

@section('title', 'Home | Gemarc Enterprises Inc.')

@section('content')
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
                                    <a href="{{ route('shop.index') }}" class="highlights-btn primary modern-btn">Get Quote</a>
                                    <a href="/calibration" class="highlights-btn secondary modern-btn">Learn More</a>
                                </div>
                            </div>
                            <div class="highlights-images modern-images" data-animate="slide-right" data-delay="0.4">
                                <div class="compression-machines-showcase modern-showcase">
                                    <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.6">
                                        <img src="{{ asset('/images/highlights/calibration/471297900_514765054922698_1512859822718235856_n.jpg') }}" alt="Calibration Service" class="machine-image modern-image">
                                    </div>
                                    <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.8">
                                        <img src="{{ asset('/images/highlights/calibration/471347068_514765084922695_8318647298850508928_n.jpg') }}" alt="Equipment Testing" class="machine-image modern-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="highlights-slide modern-slide" data-slide="1">
                        <div class="highlights-content modern-content">
                            <div class="highlights-text modern-text" data-animate="slide-left" data-delay="0.3">
                                <h1 class="highlights-title modern-title">
                                    <span class="text-white title-line" data-animate="slide-up" data-delay="0.4">TRIAXIAL</span><br>
                                    <strong class="title-line" data-animate="slide-up" data-delay="0.6">SYSTEMS</strong>
                                </h1>
                                <p class="highlights-description modern-description" data-animate="fade-up" data-delay="0.8">
                                    Advanced triaxial testing systems for geotechnical engineering and soil mechanics. Our equipment provides precise measurement of soil strength parameters for foundation design, slope stability, and soil behavior analysis.
                                </p>
                                <div class="highlights-actions modern-actions" data-animate="scale-in" data-delay="1.0">
                                    <a href="{{ route('shop.index') }}" class="highlights-btn primary modern-btn">Get Quote</a>
                                    <a href="/soil" class="highlights-btn secondary modern-btn">Learn More</a>
                                </div>
                            </div>
                            <div class="highlights-images modern-images" data-animate="slide-right" data-delay="0.4">
                                <div class="compression-machines-showcase modern-showcase">
                                    <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.6">
                                        <img src="{{ asset('/images/highlights/triaxial/471332334_514765131589357_2842058084863031705_n.jpg') }}" alt="Triaxial System" class="machine-image modern-image">
                                    </div>
                                    <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.8">
                                        <img src="{{ asset('/images/highlights/triaxial/471396906_514765164922687_6504037593464406827_n.jpg') }}" alt="Soil Testing Equipment" class="machine-image modern-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="highlights-slide modern-slide" data-slide="2">
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
                                    <a href="{{ route('shop.index') }}" class="highlights-btn primary modern-btn">Get Quote</a>
                                    <a href="/pavetest" class="highlights-btn secondary modern-btn">Learn More</a>
                                </div>
                            </div>
                            <div class="highlights-images modern-images" data-animate="slide-right" data-delay="0.4">
                                <div class="compression-machines-showcase modern-showcase">
                                    <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.6">
                                        <img src="{{ asset('/images/highlights/pavetest/pavetest1.jpg') }}" alt="Pavetest Equipment 1" class="machine-image modern-image">
                                    </div>
                                    <div class="machine-item modern-machine" data-animate="zoom-in" data-delay="0.8">
                                        <img src="{{ asset('/images/highlights/pavetest/pavetest2.jpg') }}" alt="Pavetest Equipment 2" class="machine-image modern-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Controls -->
                <div class="carousel-controls modern-controls">
                    <button class="carousel-btn carousel-prev modern-nav-btn" data-animate="fade-left" data-delay="1.2">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="carousel-indicators modern-indicators" data-animate="fade-up" data-delay="1.4">
                        <button class="indicator active" data-slide="0"></button>
                        <button class="indicator" data-slide="1"></button>
                        <button class="indicator" data-slide="2"></button>
                    </div>
                    <button class="carousel-btn carousel-next modern-nav-btn" data-animate="fade-right" data-delay="1.2">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose modern-features" data-animate="fade-up">
        <div class="container">
            <div class="section-header" data-animate="slide-up" data-delay="0.2">
                <h2 class="section-title">Why Choose Gemarc Enterprises?</h2>
                <p class="section-subtitle">Leading provider of material testing equipment with over 25 years of experience</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card" data-animate="zoom-in" data-delay="0.3">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="feature-title">ISO Certified</h3>
                    <p class="feature-description">All our equipment and services meet international ISO standards for quality and reliability.</p>
                </div>
                
                <div class="feature-card" data-animate="zoom-in" data-delay="0.4">
                    <div class="feature-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="feature-title">Expert Support</h3>
                    <p class="feature-description">Professional technical support and maintenance services by certified engineers.</p>
                </div>
                
                <div class="feature-card" data-animate="zoom-in" data-delay="0.5">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3 class="feature-title">Fast Delivery</h3>
                    <p class="feature-description">Quick delivery and installation services nationwide with comprehensive training.</p>
                </div>
                
                <div class="feature-card" data-animate="zoom-in" data-delay="0.6">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="feature-title">Calibration Services</h3>
                    <p class="feature-description">Professional calibration services with detailed certificates and traceability.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Categories Section -->
    <section class="product-categories modern-products" data-animate="fade-up">
        <div class="container">
            <div class="section-header" data-animate="slide-up" data-delay="0.2">
                <h2 class="section-title">Our Product Categories</h2>
                <p class="section-subtitle">Comprehensive range of material testing equipment for various industries</p>
            </div>
            
            <div class="categories-grid">
                <div class="category-card" data-animate="slide-up" data-delay="0.3">
                    <div class="category-image">
                        <img src="{{ asset('/images/categories/concrete.jpg') }}" alt="Concrete Testing" class="category-img">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Concrete & Mortar</h3>
                        <p class="category-description">Compression machines, flexural testing equipment, and concrete testing accessories.</p>
                        <a href="/concrete-mortar" class="category-link">View Products <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="category-card" data-animate="slide-up" data-delay="0.4">
                    <div class="category-image">
                        <img src="{{ asset('/images/categories/soil.jpg') }}" alt="Soil Testing" class="category-img">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Soil Testing</h3>
                        <p class="category-description">Triaxial systems, consolidation apparatus, and geotechnical testing equipment.</p>
                        <a href="/soil" class="category-link">View Products <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="category-card" data-animate="slide-up" data-delay="0.5">
                    <div class="category-image">
                        <img src="{{ asset('/images/categories/asphalt.jpg') }}" alt="Asphalt Testing" class="category-img">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Asphalt & Bitumen</h3>
                        <p class="category-description">Marshall stability apparatus, penetration testing, and asphalt analysis equipment.</p>
                        <a href="/asphalt-bitumen" class="category-link">View Products <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="category-card" data-animate="slide-up" data-delay="0.6">
                    <div class="category-image">
                        <img src="{{ asset('/images/categories/steel.jpg') }}" alt="Steel Testing" class="category-img">
                    </div>
                    <div class="category-content">
                        <h3 class="category-title">Steel Testing</h3>
                        <p class="category-description">Universal testing machines, tensile testing equipment, and metal analysis tools.</p>
                        <a href="/steel" class="category-link">View Products <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="modern-cta" data-animate="fade-up">
        <div class="container">
            <div class="cta-content" data-animate="zoom-in" data-delay="0.3">
                <h2 class="cta-title">Ready to Get Started?</h2>
                <p class="cta-description">Contact us today for a free consultation and quote on your material testing equipment needs.</p>
                <div class="cta-actions">
                    <a href="{{ route('shop.index') }}" class="cta-btn primary">Browse Products</a>
                    <a href="/contact" class="cta-btn secondary">Get Quote</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Social Buttons -->
    <div class="floating-social" data-animate="slide-right" data-delay="2.0">
        <a href="https://www.facebook.com/gemarcenterprises" target="_blank" class="floating-btn facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://viber.click/639090879416" target="_blank" class="floating-btn viber">
            <i class="fab fa-viber"></i>
        </a>
    </div>

    <script>
        // Initialize modern animations and carousel
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS animations
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    offset: 120,
                    easing: 'ease-in-out',
                    once: true
                });
            }

            // Modern carousel functionality
            const slides = document.querySelectorAll('.highlights-slide');
            const indicators = document.querySelectorAll('.indicator');
            const prevBtn = document.querySelector('.carousel-prev');
            const nextBtn = document.querySelector('.carousel-next');
            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                indicators.forEach(indicator => indicator.classList.remove('active'));
                
                slides[index].classList.add('active');
                indicators[index].classList.add('active');
                currentSlide = index;
            }

            // Indicator clicks
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => showSlide(index));
            });

            // Navigation buttons
            prevBtn.addEventListener('click', () => {
                const prevIndex = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
                showSlide(prevIndex);
            });

            nextBtn.addEventListener('click', () => {
                const nextIndex = currentSlide === slides.length - 1 ? 0 : currentSlide + 1;
                showSlide(nextIndex);
            });

            // Auto-advance slides
            setInterval(() => {
                const nextIndex = currentSlide === slides.length - 1 ? 0 : currentSlide + 1;
                showSlide(nextIndex);
            }, 5000);

            // Search functionality
            const searchInput = document.querySelector('.search-input');
            const searchBtn = document.querySelector('.search-btn');

            if (searchBtn) {
                searchBtn.addEventListener('click', function() {
                    const query = searchInput.value.trim();
                    if (query) {
                        window.location.href = `{{ route('shop.index') }}?search=${encodeURIComponent(query)}`;
                    }
                });
            }

            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        searchBtn.click();
                    }
                });
            }
        });
    </script>
@endsection