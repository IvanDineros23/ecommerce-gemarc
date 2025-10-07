﻿@extends('layouts.app')
@section('content')
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="index.html" class="logo-link">
                    <img src="{{ asset('website/images/gemarclogo.png') }}" alt="Gemarc Enterprises" class="logo-img">
// ...existing code...
@endsection
                </a>
            </div>
            <nav class="nav">
                                <ul class="nav-list desktop-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><i class="fas fa-newspaper"></i> News <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="news.html">News</a></li>
                            <li><a href="blogs.html">Blogs</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><i class="fas fa-industry"></i> Products <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="aggregates.html">Aggregates</a></li>
                            <li><a href="asphalt-bitumen.html">Asphalt & Bitumen</a></li>
                            <li><a href="cement-mortar.html">Cement & Mortar</a></li>
                            <li><a href="concrete-mortar.html">Concrete & Mortar</a></li>
                            <li><a href="drilling-machine.html">Drilling Machine</a></li>
                            <li><a href="industrial-equipment.html" class="active">Industrial Equipment</a></li>
                            <li><a href="soil.html">Soil Testing</a></li>
                            <li><a href="steel.html">Steel Testing</a></li>
                            <li><a href="pavetest.html">Pavetest Equipment</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><i class="fas fa-wrench"></i> Services <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="calibration.html">Calibration Services</a></li>
                            <li><a href="services.html">Repair Services</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><i class="fas fa-users"></i> About <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.html">Company</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        <li><a href="customerfeedback.html">Customer Feedback</a></li>
</ul>
                    </li>
                </ul>
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
                                                <li><a href="industrial-equipment.html" class="active">Industrial Equipment</a></li>
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
                        </ul>
                    </li>
                </ul>
                
                <!-- Quick Actions -->
                <div class="nav-actions">
                    <a href="contact.html" class="action-btn quote-btn">
                        <i class="fas fa-calculator"></i> Get Quote
                    </a>
                    <a href="tel:+639090879416" class="action-btn call-btn">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                </div>
                </ul>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Industrial Equipment</h1>
        </div>
    </section>

    <!-- Main Content -->
    <section class="page-content">
        <div class="container">
            <!-- Search Bar -->
            <div class="products-search">
                <input type="search" placeholder="Search products, services..." class="search-input" autocomplete="off">
                <button class="search-btn" type="button"><i class="fas fa-search"></i></button>
            </div>
            
            <div class="content-wrapper">
                <p>We provide comprehensive industrial equipment solutions for construction, manufacturing, and testing applications. Our range includes high-quality equipment designed for demanding industrial environments.</p>
                
                <!-- GOTECH Products Section -->
                <div class="brand-section gotech-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/logo_en.png" alt="GOTECH" class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/GT-7010-D2EP.jpg" alt="GT-7010-D2ELP Micro-Computer Tensile Strength Tester" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">GT-7010-D2ELP</h4>
                                <h3 class="product-name">Micro-Computer Tensile Strength Tester</h3>
                                <p class="product-standard"><strong>Features:</strong> Single column floor type with high precision control</p>
                                <p class="product-description">The GT-7010-D2ELP is a single column and floor type tensile strength tester. Equipped with high precision micro-computer control system, extensometer, and printer, it fulfills the testing needs for various strength tests.</p>
                               <a href="downloadable content\GT-7010-D2ELP.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'GT-7010-D2ELP',
                                    name: 'Micro-Computer Tensile Strength Tester',
                                    standard: 'Various Industrial Testing Standards',
                                    description: 'The GT-7010-D2ELP is a single column and floor type tensile strength tester. Equipped with high precision micro-computer control system, extensometer, and printer, it fulfills the testing needs for various strength tests. This machine is capable of performing a variety of tests including tension, compression, bending, tearing, peeling, shearing, and bonding across diverse industries, such as rubber, plastics, footwear, leather, cables, and packaging, with a focus on mid to low range test loads.',
                                    image: 'images/GT-7010-D2EP.jpg',
                                    manufacturer: 'GOTECH',
                                    manufacturerUrl: 'https://www.gotech.biz/',
                                    specs: [
                                        {label: 'Capacity (optional)', value: '100, 200, 500 N; 1, 2, 5 kN'},
                                        {label: 'Unit', value: 'kgf, gf, tonf, lbf, N, kN'},
                                        {label: 'Load resolution', value: '1/50,000 (U26)'},
                                        {label: 'Load accuracy', value: '±0.5%'},
                                        {label: 'Stroke (excluding grips)', value: '1000 mm'},
                                        {label: 'Speed control method', value: 'Closed-loop speed control'},
                                        {label: 'Test speed', value: '5 to 500 mm/min (adjustable)'},
                                        {label: 'Stroke resolution', value: 'Stroke: 0.00125 mm / extensometer: 0.025 mm'},
                                        {label: 'Sample rate', value: '16 times/sec'},
                                        {label: 'Indicator', value: 'Printable, display elongation value, test values, max. value & break values'},
                                        {label: 'Motor', value: 'AC servo motor'},
                                        {label: 'Dimensions (W×D×H)', value: '55×35×182 cm'},
                                        {label: 'Weight (approx.)', value: '115 kg (excluding control cabinet and grips)'},
                                        {label: 'Power', value: '1∮, 220V, 5A, 50Hz/60Hz (or specify)'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/GT-7013-MP.jpg" alt="GT-7013-MPA Digital Type Bursting Strength Tester" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">GT-7013-MPA</h4>
                                <h3 class="product-name">Digital Type Bursting Strength Tester</h3>
                                <p class="product-standard"><strong>Features:</strong> Automatic and manual mode operation</p>
                                <p class="product-description">The GT-7013-MPA is an ideal solution for assessing the bursting strength of materials such as paper, fabrics, and leather. Operators can easily switch between automatic and manual modes.</p>
                                <a href="downloadable content\GT-7013-MPA.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'GT-7013-MPA',
                                    name: 'Digital Type Bursting Strength Tester',
                                    standard: 'GB/T 1539, ISO 2758, GB/T 454, TAPPI T403, ASTM D3786',
                                    description: 'The GT-7013-MPA is an ideal solution for assessing the bursting strength of materials such as paper, fabrics, and leather. Operators can easily switch between automatic and manual modes. In automatic mode, the tester detects the specimen after placement, runs the test, calculates the results, and saves the data, ensuring a seamless and efficient testing process from start to finish. Features automatic rubber diaphragm pressure compensation and infrared sensor specimen detection.',
                                    image: 'images/GT-7013-MP.jpg',
                                    manufacturer: 'GOTECH',
                                    manufacturerUrl: 'https://www.gotech.biz/',
                                    specs: [
                                        {label: 'Models Available', value: 'High pressure, Low pressure, High pressure with low flow rate'},
                                        {label: 'Conformance', value: 'GB/T 1539, ISO 2758, GB/T 454, TAPPI T403, ASTM D3786, ASTM D3786M-18'},
                                        {label: 'Feature', value: 'Automatic rubber diaphragm pressure compensation'},
                                        {label: 'Specimen detection', value: 'Infrared sensor'},
                                        {label: 'Interface', value: 'Touchscreen+PLC'},
                                        {label: 'Sensor', value: 'Pressure transducer'},
                                        {label: 'Capacity (High pressure)', value: '100 kg/c㎡'},
                                        {label: 'Capacity (Low pressure)', value: '16 kg/c㎡'},
                                        {label: 'Pumping rate (High pressure)', value: '170±15 mL/min'},
                                        {label: 'Pumping rate (Low pressure)', value: '95±5 mL/min'},
                                        {label: 'Inner dia. upper clamp', value: '31.5±0.1 mm / 30.5 mm / 31±0.75 mm'},
                                        {label: 'Inner dia. lower clamp', value: '31.5±0.1 mm / 33.1±0.1 mm / 31±0.75 mm'},
                                        {label: 'Clamp type', value: 'Pneumatic clamp'},
                                        {label: 'Specimen clamping pressure', value: 'Dial pressure gauge: 0 to 50 kg/c㎡'},
                                        {label: 'Air pressure source', value: 'Must be greater than 6 kg/c㎡'},
                                        {label: 'Power', value: '1∮, AC 220V, 50/60Hz, 3A (or specify)'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/GT-7001-DSU.jpg" alt="GT-7001-DSU Servo Control Container Compression Tester" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">GT-7001-DSU</h4>
                                <h3 class="product-name">Servo Control Container Compression Tester</h3>
                                <p class="product-standard"><strong>Features:</strong> High precision servo control system</p>
                                <p class="product-description">The GT-7001-DSU is specifically designed to assess the compressive strength of cardboard boxes and containers. The specimen, placed between two parallel plates, is compressed under a constant force.</p>
                                <a href="downloadable content\GT-7001-DSU.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'GT-7001-DSU',
                                    name: 'Servo Control Container Compression Tester',
                                    standard: 'International Container Testing Standards',
                                    description: 'The GT-7001-DSU is specifically designed to assess the compressive strength of cardboard boxes and containers. The specimen, placed between two parallel plates, is compressed under a constant force. The test load and displacement are recorded upon specimen failure or when a predetermined load or stroke is reached. This testing equipment uses dynamic pressure-holding technology to simulate stacking conditions during transportation and storage.',
                                    image: 'images/GT-7001-DSU.jpg',
                                    manufacturer: 'GOTECH',
                                    manufacturerUrl: 'https://www.gotech.biz/',
                                    specs: [
                                        {label: 'Capacity', value: '20, 50, 100 kN'},
                                        {label: 'Unit', value: 'Kgf, lbf, N, kN, kPa, Mpa'},
                                        {label: 'Load resolution', value: '1/500,000'},
                                        {label: 'Load accuracy', value: '±0.5%'},
                                        {label: 'Test space (L ×W ×H)', value: '1200 × 1200 × 1000mm (or specify)'},
                                        {label: 'Display', value: 'U70 materials testing software'},
                                        {label: 'Compression speed', value: '0.001 to 200mm/min (adjustable)'},
                                        {label: 'Speed accuracy', value: '±0.5%'},
                                        {label: 'Motor', value: 'AC servo motor'},
                                        {label: 'Dimensions - Main unit (D×W×H)', value: '196×120×199 cm'},
                                        {label: 'Dimensions - Computer/Desk (D×W×H)', value: '109× 65 × 116 cm'},
                                        {label: 'Weight - Main unit (approx.)', value: '1240kg'},
                                        {label: 'Weight - Computer/Desk (approx.)', value: '60kg'},
                                        {label: 'Power', value: '3∮, AC220V, 50/60HZ, 15A / 3∮, AC 380V, 50/60HZ, 12A (or specify)'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <!-- Inquiry Banner -->
                <div class="inquiry-banner">
                <p>
                    <i class="fas fa-circle-question"></i>
                    Finding something? Some items may not be listed yet.  
                    <a href="mailto:sales@gemarcph.com">Email us</a> or 
                    <a href="tel:+639090879416">call us</a> for inquiries.
                </p>
                </div>

    <!-- Product Modal -->
    <div id="productModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Product Details</h2>
                <button class="modal-close" onclick="closeProductModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-product-info">
                    <div class="modal-product-image">
                        <img id="modalProductImage" src="" alt="" class="modal-product-img">
                    </div>
                    <div class="modal-product-details">
                        <div class="modal-product-code">
                            <strong>Product Code:</strong> <span id="modalProductCode"></span>
                            <span id="modalProductCodeSub" style="display: none;"></span>
                        </div>
                        <h3 class="modal-product-name" id="modalProductName"></h3>
                        <div class="modal-product-standard">
                            <strong>Standard:</strong> <span id="modalProductStandard"></span>
                        </div>
                        <div class="modal-product-description">
                            <strong>Description:</strong>
                            <p id="modalProductDescription"></p>
                        </div>
                    </div>
                </div>
                
                <div class="modal-specs-section">
                    <h4 class="modal-specs-title">Technical Specifications</h4>
                    <div id="modalSpecsGrid" class="modal-specs-grid">
                        <!-- Specifications will be populated by JavaScript -->
                    </div>
                </div>
                <br>
                                <!-- GEMARC Inline Inquiry (drop-in) -->
                <div class="gem-inquiry" data-emails="sales@gemarcph.com,technical@gemarcph.com">
                <button type="button" class="modal-contact-btn modal-email-btn js-show-inquiry is-full">
                    <i class="fas fa-envelope"></i> Send Inquiry
                </button>
                <div class="inquiry-email-panel js-inquiry-panel" hidden></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content horizontal-footer">
                <div class="footer-section">
                    <h4><i class="fas fa-map-marker-alt"></i> Office Address</h4>
                    <p>No. 15 Chile St. Ph1 Greenheights Subdivision, Concepcion 1, Marikina City, Philippines 1807</p>
                </div>
                <div class="footer-section">
                    <h4><i class="fas fa-phone"></i> Telephone Numbers</h4>
                    <p>(632)8-997-7959 | (632)8-584-5572</p>
                </div>
                <div class="footer-section">
                    <h4><i class="fas fa-mobile-alt"></i> Mobile Numbers</h4>
                    <p>+63 909 087 9416<br>+63 928 395 3532 | +63 918 905 8316</p>
                </div>
                <div class="footer-section">
                    <h4><i class="fas fa-envelope"></i> Email Address</h4>
                    <p>sales@gemarcph.com<br>technical@gemarcph.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Gemarc Enterprises Incorporated. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    <script src="search.js"></script>
    <!-- Floating Social Buttons -->
    <div class="floating-buttons">
        <a href="https://www.facebook.com/gmrcsales" target="_blank" class="floating-btn facebook-btn" title="Visit our Facebook Page">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="viber://chat?number=09090879416" class="floating-btn viber-btn" title="Contact us on Viber: 0909 087 9416">
            <i class="fab fa-viber"></i>
        </a>
    </div>


</body>
</html>

