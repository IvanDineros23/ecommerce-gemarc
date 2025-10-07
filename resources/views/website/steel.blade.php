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
                            <li><a href="industrial-equipment.html">Industrial Equipment</a></li>
                            <li><a href="soil.html">Soil Testing</a></li>
                            <li><a href="steel.html" class="active">Steel Testing</a></li>
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
                        <li><a href="industrial-equipment.html">Industrial Equipment</a></li>
                        <li><a href="soil.html">Soil Testing</a></li>
                        <li><a href="steel.html" class="active">Steel Testing</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Steel Testing Equipment</h1>
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
                <p>We provide comprehensive steel testing equipment for quality control and material characterization in construction and manufacturing industries. Our equipment meets international standards for steel testing and analysis.</p>
                
                <!-- GOTECH Products Section -->
                <div class="brand-section gotech-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/logo_en.png" alt="GOTECH" class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card featured-product">
                            <div class="product-image">
                                <img src="images/UN-7001-LAS.jpg" alt="AI-7000-LAU Servo Control System Universal Testing Machine" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">AI-7000-LAU</h4>
                                <h3 class="product-name">Servo Control System Universal Testing Machine</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 10002, EN 10080, EN 15630-1, EN 15630-3 | EN ISO 6892-1, 7500-1 | ASTM A370, ASTM E8</p>
                                <p class="product-description">Featuring an advanced servo control system and high-capacity measurement capability, the AI-7000-LAU is a heavy-duty universal testing machine designed for various types of materials testing. With its robust design and high-rigidity structure, this heavy-duty model is capable of performing high test loads on sturdy specimens.</p>
                                <a href="downloadable content\AI-7000-LAU.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'AI-7000-LAU',
                                    name: 'Servo Control System Universal Testing Machine',
                                    image: 'images/UN-7001-LAS.jpg',
                                    standard: 'EN 10002, EN 10080, EN 15630-1, EN 15630-3 | EN ISO 6892-1, 7500-1 | ASTM A370, ASTM E8',
                                    description: 'Featuring an advanced servo control system and high-capacity measurement capability, the AI-7000-LAU is a heavy-duty universal testing machine designed for various types of materials testing. With its robust design and high-rigidity structure, this heavy-duty model is capable of performing high test loads on sturdy specimens.',
                                    manufacturer: 'GOTECH',
                                    manufacturerUrl: 'https://www.gotech.biz/',
                                    specs: [
                                        {label: 'Model Variants', value: 'AI-7000-LAU5: 50kN | AI-7000-LAU10: 100kN | AI-7000-LAU20: 200kN | AI-7000-LAU30: 300kN | AI-7000-LAU50: 500kN'},
                                        {label: 'Unit (Switchable)', value: 'kgf, lbf, N, kN, kPa, Mpa'},
                                        {label: 'Load Resolution', value: '1/500,000'},
                                        {label: 'Load Accuracy', value: '±0.5%'},
                                        {label: 'Load Range', value: 'Rangeless (full scales at the same ampification)'},
                                        {label: 'Stroke (exclude grips)', value: '1050 mm'},
                                        {label: 'Effective Width', value: '570 mm'},
                                        {label: 'Test Speed', value: '0.0001~500 mm/min Selectable, 0.001~250 mm/min Selectable'},
                                        {label: 'Speed Accuracy', value: '±0.5%'},
                                        {label: 'Stroke Resolution', value: '0.00003mm'},
                                        {label: 'Computer Acquisition Frequency', value: '200 times/sec (or 500 times/sec)'},
                                        {label: 'Communication Interface', value: 'RJ45'},
                                        {label: 'Motor', value: 'AC servo motor'},
                                        {label: 'Main Unit Dimension (W×D×H)', value: 'LAU5/10: 114×70×214cm, LAU20: 126×80×222cm, LAU30: 126×85×247cm, LAU50: 126×90×275cm'},
                                        {label: 'Computer/Desk Dimension', value: '109×65×116 cm'},
                                        {label: 'Main Unit Weight (approx.)', value: 'LAU5/10: 717kg, LAU20: 1050kg, LAU30: 1230kg, LAU50: 1750kg (excluding control cabinet and grips)'},
                                        {label: 'Computer/Desk Weight', value: '102 kg'},
                                        {label: 'Power', value: 'LAU5/10: 3∮220V,20A/3∮380V,15A | LAU20/30/50: 3∮220V,25A/3∮380V,20A 50Hz/60Hz'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- TBT Nanjing Products Section -->
                <div class="brand-section tbt-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/tbt-Nanjing_logo.jpg" alt="TBT Nanjing" class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card featured-product">
                            <div class="product-image">
                                <img src="images/TBTUTM-1000A.jpg" alt="WA-100C/WA-300C/WA-600C/WA-1000C Universal Testing Machine" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">WA-100C/WA-300C/WA-600C/WA-1000C</h4>
                                <h3 class="product-name">Universal Testing Machine with PC&Servo Control</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 10002, EN 10080, EN 15630-1, EN 15630-3 | EN ISO 6892-1, 7500-1 | ASTM A370, ASTM E8</p>
                                <p class="product-description">The testing machine is mainly designed for the tension test, compression test and bending test of metal, also for non-metal of compression test, such as concrete and stone. If the proper jigs are provided, it can be used for various tests in the laboratories of mills, factories, colleges and research units concerned.</p>
                                <a href="downloadable content\WA-100C_WA-300C_WA-600C_WA-1000C.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'WA-100C/WA-300C/WA-600C/WA-1000C',
                                    name: 'Universal Testing Machine with PC&Servo Control',
                                    image: 'images/TBTUTM-1000A.jpg',
                                    standard: 'EN 10002, EN 10080, EN 15630-1, EN 15630-3 | EN ISO 6892-1, 7500-1 | ASTM A370, ASTM E8',
                                    description: 'The testing machine is mainly designed for the tension test, compression test and bending test of metal, also for non-metal of compression test, such as concrete and stone. If the proper jigs are provided, it can be used for various tests in the laboratories of mills, factories, colleges and research units concerned. It is featured with hydraulic loading, electronic force measurement, the load, the test process with curve can be displayed on the computer screen, and the data can be saved and printed out. It is overload protection. The oil cylinder is fitted on the bottom of the main frame, which is suitable for the compression test and all the annex will be provided for the technological tests of the metal.',
                                    manufacturer: 'TBT Nanjing',
                                    manufacturerUrl: 'https://www.tbt-scietech.com/',
                                    specs: [
                                        {label: 'Model Variants', value: 'WA-100C, WA-300C, WA-600C, WA-1000C'},
                                        {label: 'Key Components', value: '1. O-ring, 2. Oil flow control valve, 3. Oil return valve, 4. Oil pump, 5. Motor, 6. PC'},
                                        {label: 'Loading System', value: 'Hydraulic loading with electronic force measurement'},
                                        {label: 'Display Features', value: 'Load and test process with curve displayed on computer screen'},
                                        {label: 'Data Management', value: 'Data can be saved and printed out'},
                                        {label: 'Safety Features', value: 'Overload protection'},
                                        {label: 'Oil Cylinder Position', value: 'Fitted on the bottom of the main frame'},
                                        {label: 'Test Capabilities', value: 'Tension test, compression test, bending test for metal and non-metal materials'},
                                        {label: 'Applications', value: 'Suitable for laboratories of mills, factories, colleges and research units'},
                                        {label: 'Material Testing', value: 'Metal materials, concrete, stone and other materials with proper jigs'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Inquiry Banner -->
                <div class="inquiry-banner">
                <p>
                    <i class="fas fa-circle-question"></i>
                    Finding something? Some items may not be listed yet.  
                    <a href="mailto:sales@gemarcph.com">Email us</a> or 
                    <a href="tel:+639090879416">call us</a> for inquiries.
                </p>
                </div>
                
                <div class="services-offered">
                    <h3>Our Services Include:</h3>
                    <ul>
                        <li>Supply of steel testing equipment</li>
                        <li>Material testing and certification services</li>
                        <li>Calibration and verification services</li>
                        <li>Equipment maintenance and repair</li>
                        <li>Technical support and training</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

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
