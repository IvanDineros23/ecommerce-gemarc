<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{{ asset('images/gemarclogo.png') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Dashboard | Gemarc Enterprises Inc.')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
        
        <!-- Website Styles -->
        <link rel="stylesheet" href="{{ asset('website/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/highlights.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modern-cta.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome-fix.css') }}">
        
        <!-- Custom Styles for better homepage appearance -->
        <style>
            /* Hide scrollbar for product carousel */
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            
            /* Custom styling for hero section */
            .hero-section {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 70vh;
            }
            
            /* Product card hover effects */
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }
            
            /* Feature grid styling */
            .feature-card {
                transition: all 0.3s ease;
            }
            
            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }
        </style>
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <!-- Header -->
        <header class="header">
            <div class="container">
                <div class="logo">
                    <a href="/" class="logo-link">
                        <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc Enterprises" class="logo-img">
                    </a>
                </div>
                <nav class="nav">
                    <!-- Desktop nav-list -->
                    <ul class="nav-list desktop-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"><i class="fas fa-newspaper"></i> News <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('news') }}">News</a></li>
                                <li><a href="/blogs">Blogs</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"><i class="fas fa-industry"></i> Products <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('browse') }}">Browse Products</a></li>
                                <li><a href="/aggregates">Aggregates</a></li>
                                <li><a href="/asphalt-bitumen">Asphalt & Bitumen</a></li>
                                <li><a href="/cement-mortar">Cement & Mortar</a></li>
                                <li><a href="/concrete-mortar">Concrete & Mortar</a></li>
                                <li><a href="/drilling-machine">Drilling Machine</a></li>
                                <li><a href="/industrial-equipment">Industrial Equipment</a></li>
                                <li><a href="/soil-testing">Soil Testing</a></li>
                                <li><a href="/steel-testing">Steel Testing</a></li>
                                <li><a href="/pavetest">Pavetest Equipment</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"><i class="fas fa-wrench"></i> Services <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="/calibration">Calibration Services</a></li>
                                <li><a href="/services">Repair Services</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle"><i class="fas fa-users"></i> About <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="/about">Company</a></li>
                                <li><a href="/contact">Contact</a></li>
                                <li><a href="/customer-feedback">Customer Feedback</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                    <!-- Mobile Menu Overlay -->
                    <div class="mobile-menu-overlay" id="mobileMenu">
                        <button class="mobile-menu-close" id="closeMenu">&times;</button>
                        <ul class="mobile-menu-list">
                            <li>
                                <button class="mobile-menu-main">News</button>
                                <ul class="mobile-menu-sub">
                                    <li><a href="{{ route('news') }}">News</a></li>
                                    <li><a href="/blogs">Blogs</a></li>
                                </ul>
                            </li>
                            <li>
                                <button class="mobile-menu-main">Products</button>
                                <ul class="mobile-menu-sub">
                                    <li><a href="{{ route('browse') }}">Browse Products</a></li>
                                    <li><a href="/aggregates">Aggregates</a></li>
                                    <li><a href="/asphalt-bitumen">Asphalt & Bitumen</a></li>
                                    <li><a href="/cement-mortar">Cement & Mortar</a></li>
                                    <li><a href="/concrete-mortar">Concrete & Mortar</a></li>
                                    <li><a href="/drilling-machine">Drilling Machine</a></li>
                                    <li><a href="/industrial-equipment">Industrial Equipment</a></li>
                                    <li><a href="/soil-testing">Soil Testing</a></li>
                                    <li><a href="/steel-testing">Steel Testing</a></li>
                                    <li><a href="/pavetest">Pavetest Equipment</a></li>
                                </ul>
                            </li>
                            <li>
                                <button class="mobile-menu-main">Services</button>
                                <ul class="mobile-menu-sub">
                                    <li><a href="/calibration">Calibration Services</a></li>
                                    <li><a href="/services">Repair Services</a></li>
                                </ul>
                            </li>
                            <li>
                                <button class="mobile-menu-main">About</button>
                                <ul class="mobile-menu-sub">
                                    <li><a href="/about">Company</a></li>
                                    <li><a href="/contact">Contact</a></li>
                                    <li><a href="/customer-feedback">Customer Feedback</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                        <!-- Quick Actions (mobile only) -->
                        <div class="mobile-actions">
                            <a href="{{ route('auth.welcome') }}" class="action-btn quote-btn">
                                <i class="fas fa-calculator"></i> Get Quote
                            </a>
                            <a href="tel:+639090879416" class="action-btn call-btn">
                                <i class="fas fa-phone"></i> Call Now
                            </a>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="nav-actions">
                        <a href="{{ route('auth.welcome') }}" class="action-btn quote-btn">
                            <i class="fas fa-file-invoice"></i>Get Quote
                        </a>
                        <a href="tel:+639090879416" class="action-btn call-btn">
                            <i class="fas fa-phone"></i> Call Now
                        </a>
                    </div>
                    
                    <div class="hamburger" id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex flex-col min-h-screen">
            <main class="flex-grow">
                @yield('content')
        </main>

<!-- Footer Styles -->
<style>
  html, body { height: 100%; margin: 0; }
  /* wrapper: already meron kang flex/min-h-screen; this just ensures no surprises */
  .site-shell { min-height: 100vh; display: flex; flex-direction: column; }
  main { flex: 1 0 auto; }

  /* FOOTER */
  .site-footer {
    flex-shrink: 0;
    background: #2E7D32; /* Dark green background */
    padding: 0;
    margin: 0;
    width: 100%;
    border-top: none;
    color: white;
  }
  .site-footer__wrap {
    max-width: 1400px;
    margin: 0 auto;
  }

  /* 4 even columns – pantay gamit grid */
  .site-footer__grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 0;
    background-color: #2E7D32; /* Dark green */
  }
  .site-footer__item {
    padding: 30px 20px;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
  }
  .site-footer__item:last-child { border-right: 0; }

  .site-footer__title {
    display: flex; align-items: center; gap: 8px;
    color: white; font-size: 1.05rem; font-weight: 600;
    margin: 0 0 8px 0;
    white-space: nowrap;
  }
  .site-footer__title i { color: #FFA000; font-size: 1.2rem; } /* Amber color for icons */
  .site-footer__text { margin: 0; color: rgba(255, 255, 255, 0.9); line-height: 1.6; }

  /* bottom bar – full width, walang extra space */
  .site-footer__bar {
    text-align: center;
    padding: 16px 0;
    color: #fff;
    background: #1B5E20; /* Darker green for the copyright bar */
    font-size: 0.95rem; font-weight: 500;
  }

  /* responsive: stack columns; pantay pa rin via borders */
  @media (max-width: 900px) {
    .site-footer__grid { grid-template-columns: 1fr; }
    .site-footer__item { border-right: 0; border-bottom: 1px solid #e5e7eb; }
    .site-footer__item:last-child { border-bottom: 0; }
    .site-footer__title { justify-content: center; }
    .site-footer__text { text-align: center; }
  }
</style>

<!-- Footer -->
<footer class="site-footer">
  <div class="site-footer__wrap">
    <div class="site-footer__grid">
      <div class="site-footer__item">
        <h4 class="site-footer__title"><i class="fas fa-map-marker-alt"></i> Office Address</h4>
        <p class="site-footer__text">
          No. 15 Chile St. Ph1 Greenheights Subdivision, Concepcion 1, Marikina City, Philippines 1807
        </p>
      </div>
      <div class="site-footer__item">
        <h4 class="site-footer__title"><i class="fas fa-phone"></i> Telephone Numbers</h4>
        <p class="site-footer__text">
          (632)8-997-7959 &nbsp;|&nbsp; (632)8-584-5572
        </p>
      </div>
      <div class="site-footer__item">
        <h4 class="site-footer__title"><i class="fas fa-mobile-alt"></i> Mobile Numbers</h4>
        <p class="site-footer__text">
          +63 909 087 9416<br>
          +63 928 395 3532 &nbsp;|&nbsp; +63 918 905 8316
        </p>
      </div>
      <div class="site-footer__item">
        <h4 class="site-footer__title"><i class="fas fa-envelope"></i> Email Address</h4>
        <p class="site-footer__text">
          sales@gemarcph.com<br>
          technical@gemarcph.com
        </p>
      </div>
    </div>
  </div>

  <div class="site-footer__bar">
    &copy; 2025 Gemarc Enterprises Incorporated. All rights reserved.
  </div>
</footer>

<!-- Floating Social Buttons -->
<div class="floating-buttons">
    <a href="https://www.facebook.com/gmrcsales" target="_blank" class="floating-btn facebook-btn" title="Visit our Facebook Page">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a href="viber://chat?number=09090879416" class="floating-btn viber-btn" title="Contact us on Viber: 0909 087 9416">
        <i class="fab fa-viber"></i>
    </a>
</div>

<script>
// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMenu = document.getElementById('closeMenu');

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', function() {
            mobileMenu.classList.add('active');
        });
    }

    if (closeMenu && mobileMenu) {
        closeMenu.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
        });
    }

    // Mobile submenu functionality
    const mobileMenuMains = document.querySelectorAll('.mobile-menu-main');
    mobileMenuMains.forEach(function(main) {
        main.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            if (submenu) {
                submenu.classList.toggle('active');
                this.classList.toggle('active');
            }
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (mobileMenu && !mobileMenu.contains(event.target) && !hamburger.contains(event.target)) {
            mobileMenu.classList.remove('active');
        }
    });
});
</script>

</body>
@stack('scripts')
</html>
