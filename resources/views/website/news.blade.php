@extends('layouts.app')

@section('title', 'News | Gemarc Enterprises Incorporated')

@section('content')
    
    <style>
        .news-section { margin: 20px 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .featured-news, .news-article { 
            background: white; 
            margin: 20px 0; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: 1px solid #e1e5e9;
        }
        .news-header { 
            cursor: pointer; 
            position: relative;
            padding-right: 40px; /* Space for dropdown icon */
            text-align: left; /* Align everything to the left */
        }
        .news-header h2 {
            margin: 5px 0 10px 0; /* Reduced top margin */
            padding-right: 30px; /* Prevent overlap with icon */
            line-height: 1.3;
            text-align: left; /* Ensure title is left aligned */
        }
        .dropdown-icon {
            position: absolute;
            top: 15px; /* Adjust position */
            right: 10px;
            font-size: 18px;
            color: #666;
            transition: transform 0.3s ease;
        }
        .dropdown-icon.rotated {
            transform: rotate(180deg);
        }
        .news-meta {
            margin: 8px 0;
            clear: both;
            text-align: left; /* Left align meta info */
        }
        .news-badge { 
            background: #28a745; 
            color: white; 
            padding: 6px 12px; 
            border-radius: 4px; 
            font-size: 12px; 
            font-weight: 600;
            display: inline-block;
            margin-bottom: 8px; /* Space between tag and title */
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .news-badge.recent { background: #007bff; }
        .news-badge.update { background: #ffc107; color: #000; }
        .news-content.collapsed { display: none; }
        .news-content { 
            margin-top: 15px; 
            animation: slideDown 0.3s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hero { min-height: 300px; margin-bottom: 30px; }
        
        /* Additional styling for better layout */
        .news-header-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Left align all content */
        }
    </style>

    <!-- Hero Section -->
    <section class="hero news-hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; justify-content: center;">
        <div class="hero-content" style="text-align: center; color: white; z-index: 2;">
            <h1 style="font-size: 3rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); margin-bottom: 1rem;">Company News</h1>
            <p style="font-size: 1.2rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Stay updated with our latest developments and achievements</p>
        </div>
    </section>

    <!-- News Content -->
    <section class="news-section">
        <div class="container">
            <!-- Search Bar flush and aligned like homepage -->
            <div style="max-width:760px;margin:0 auto 2.5rem;">
                @include('components.searchbar')
            </div>
            
            <!-- Featured News -->
            <article class="featured-news">
                <div class="news-header clickable-header" onclick="toggleNewsContent(this)">
                    <div class="news-header-content">
                        <span class="news-badge">Featured</span>
                        <h2>Gemarc Enterprises Pursues ISO 9001 Quality Management System Certification</h2>
                        <div class="news-meta">
                            <span class="news-category"><i class="fas fa-tag"></i> Quality Management</span>
                        </div>
                    </div>
                    <div class="dropdown-icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>

                <div class="news-content collapsed">
                    <p class="lead">We are proud to announce that Gemarc Enterprises Incorporated is currently in the process of implementing and pursuing ISO 9001 Quality Management System certification, demonstrating our unwavering commitment to delivering exceptional quality and service to our valued clients.</p>
                    
                    <div class="slideshow-container">
                        <div class="slide active">
                            <img src="{{ asset('images/highlights/news/GEItrainingiso9001-1024x768.jpg') }}" alt="ISO 9001 Training Session - Overview">
                            <div class="slide-caption">
                                <h3>ISO 9001 Training Overview</h3>
                                <p>Our team participating in comprehensive ISO 9001 quality management system training</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="{{ asset('images/highlights/news/2GEItrainingiso9001.jpg') }}" alt="ISO 9001 Training Session - Team Engagement">
                            <div class="slide-caption">
                                <h3>Team Engagement</h3>
                                <p>Active participation and learning during the ISO 9001 implementation training</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="{{ asset('images/highlights/news/3GEItrainingiso9001.jpg') }}" alt="ISO 9001 Training Session - Interactive Learning">
                            <div class="slide-caption">
                                <h3>Interactive Learning</h3>
                                <p>Hands-on training sessions to ensure proper understanding of quality management principles</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="{{ asset('images/highlights/news/4GEItrainingiso9001.jpg') }}" alt="ISO 9001 Training Session - Knowledge Building">
                            <div class="slide-caption">
                                <h3>Knowledge Building</h3>
                                <p>Building expertise in quality management systems and best practices</p>
                            </div>
                        </div>

                        <!-- Navigation arrows -->
                        <button class="slide-btn prev-btn" onclick="changeSlide(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slide-btn next-btn" onclick="changeSlide(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Slide indicators -->
                        <div class="slide-indicators">
                            <span class="indicator active" onclick="currentSlide(1)"></span>
                            <span class="indicator" onclick="currentSlide(2)"></span>
                            <span class="indicator" onclick="currentSlide(3)"></span>
                            <span class="indicator" onclick="currentSlide(4)"></span>
                        </div>
                    </div>

                    <div class="news-body">
                        <h3>Our Commitment to Quality Excellence</h3>
                        <p>ISO 9001 is the international standard for Quality Management Systems that helps organizations ensure they meet customer and regulatory requirements while continuously improving their processes. By pursuing this certification, we demonstrate our dedication to delivering exceptional quality and service.</p>
                        
                        <div class="quality-highlights">
                            <div class="highlight-item">
                                <i class="fas fa-award"></i>
                                <span>Enhanced Product Quality</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-chart-line"></i>
                                <span>Continuous Improvement</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-shield-alt"></i>
                                <span>Risk Management</span>
                            </div>
                            <div class="highlight-item">
                                <i class="fas fa-users"></i>
                                <span>Customer Satisfaction</span>
                            </div>
                        </div>

                        <p class="closing-statement">We look forward to completing this certification process and continuing to serve our clients with the highest standards of quality and excellence.</p>
                    </div>
                </div>
            </article>
            
            <!-- Employee Recognition Article -->
            <article class="news-article">
                <div class="news-header clickable-header" onclick="toggleNewsContent(this)">
                    <div class="news-header-content">
                        <span class="news-badge recent">Recent</span>
                        <h2>Employee Recognition for the First Half of the Year 2025</h2>
                        <div class="news-meta">
                            <span class="news-category"><i class="fas fa-award"></i> Employee Recognition</span>
                        </div>
                    </div>
                    <div class="dropdown-icon">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>

                <div class="news-content collapsed">
                    <p class="lead">We are thrilled to celebrate and recognize the outstanding contributions of our dedicated employees during the first half of 2025. This recognition program acknowledges the hard work, dedication, and exceptional performance of our team members who have gone above and beyond in their roles.</p>
                    
                    <div class="slideshow-container employee-recognition-slides">
                        <div class="slide active">
                            <img src="{{ asset('images/highlights/news/viber_image_2025-09-05_10-41-23-739.jpg') }}" alt="Recognition Program">
                            <div class="slide-caption">
                                <h3>Recognition Program Overview</h3>
                                <p>Our comprehensive employee recognition program highlights excellence and dedication</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="{{ asset('images/highlights/news/viber_image_2025-09-05_10-41-22-958.jpg') }}" alt="Employee Recognition Ceremony">
                            <div class="slide-caption">
                                <h3>Employee Recognition Ceremony</h3>
                                <p>Celebrating our outstanding employees for their exceptional performance in the first half of 2025</p>
                            </div>
                        </div>

                        <div class="slide">
                            <img src="{{ asset('images/highlights/news/viber_image_2025-09-05_13-17-06-854.jpg') }}" alt="Recognition Event">
                            <div class="slide-caption">
                                <h3>Recognition Event</h3>
                                <p>Special recognition event highlighting outstanding team performance</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="{{ asset('images/highlights/news/viber_image_2025-09-05_13-17-23-930.jpg') }}" alt="Achievement Celebration">
                            <div class="slide-caption">
                                <h3>Achievement Celebration</h3>
                                <p>Celebrating individual and team achievements throughout the first half of 2025</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="{{ asset('images/highlights/news/viber_image_2025-09-05_13-17-46-318.jpg') }}" alt="Performance Recognition">
                            <div class="slide-caption">
                                <h3>Performance Recognition</h3>
                                <p>Acknowledging exceptional performance and dedication to company values</p>
                            </div>
                        </div>
                        <!-- Navigation arrows -->
                        <button class="slide-btn prev-btn" onclick="changeEmployeeSlide(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slide-btn next-btn" onclick="changeEmployeeSlide(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Slide indicators -->
                        <div class="slide-indicators">
                            <span class="indicator active" onclick="currentEmployeeSlide(1)"></span>
                            <span class="indicator" onclick="currentEmployeeSlide(2)"></span>
                            <span class="indicator" onclick="currentEmployeeSlide(3)"></span>
                            <span class="indicator" onclick="currentEmployeeSlide(4)"></span>
                            <span class="indicator" onclick="currentEmployeeSlide(5)"></span>
                        </div>
                    </div>
                    

                    <div class="news-body">
                        <h3>Celebrating Excellence and Dedication</h3>
                        <p>Our employee recognition program for the first half of 2025 celebrates the remarkable achievements and contributions of our team members who have demonstrated exceptional performance, innovation, and commitment to our company values.</p>

                        <p class="closing-statement">Congratulations to all our recognized employees! Your dedication and commitment to excellence continue to drive our company's success.</p>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    // Initialize AOS animations
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // News toggle functionality
    function toggleNewsContent(header) {
        const content = header.nextElementSibling;
        const icon = header.querySelector('.dropdown-icon i');
        const dropdownIcon = header.querySelector('.dropdown-icon');
        
        if (content && content.classList.contains('collapsed')) {
            content.classList.remove('collapsed');
            content.style.display = 'block';
            if (icon) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
            if (dropdownIcon) {
                dropdownIcon.classList.add('rotated');
            }
        } else if (content) {
            content.classList.add('collapsed');
            content.style.display = 'none';
            if (icon) {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
            if (dropdownIcon) {
                dropdownIcon.classList.remove('rotated');
            }
        }
    }

    // Slideshow functionality
    let currentSlide = 1;
    let currentEmployeeSlide = 1;

    function changeSlide(direction) {
        showSlide(currentSlide += direction);
    }

    function currentSlideFunc(n) {
        showSlide(currentSlide = n);
    }

    function showSlide(n) {
        const slides = document.querySelectorAll('.slideshow-container:not(.employee-recognition-slides) .slide');
        const indicators = document.querySelectorAll('.slideshow-container:not(.employee-recognition-slides) .indicator');
        
        if (n > slides.length) { currentSlide = 1; }
        if (n < 1) { currentSlide = slides.length; }
        
        slides.forEach(slide => slide.style.display = 'none');
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        if (slides[currentSlide - 1]) {
            slides[currentSlide - 1].style.display = 'block';
        }
        if (indicators[currentSlide - 1]) {
            indicators[currentSlide - 1].classList.add('active');
        }
    }

    // Employee recognition slideshow
    function changeEmployeeSlide(direction) {
        showEmployeeSlide(currentEmployeeSlide += direction);
    }

    function currentEmployeeSlideFunc(n) {
        showEmployeeSlide(currentEmployeeSlide = n);
    }

    function showEmployeeSlide(n) {
        const slides = document.querySelectorAll('.employee-recognition-slides .slide');
        const indicators = document.querySelectorAll('.employee-recognition-slides .indicator');
        
        if (n > slides.length) { currentEmployeeSlide = 1; }
        if (n < 1) { currentEmployeeSlide = slides.length; }
        
        slides.forEach(slide => slide.style.display = 'none');
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        if (slides[currentEmployeeSlide - 1]) {
            slides[currentEmployeeSlide - 1].style.display = 'block';
        }
        if (indicators[currentEmployeeSlide - 1]) {
            indicators[currentEmployeeSlide - 1].classList.add('active');
        }
    }
</script>
@endpush

