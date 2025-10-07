@extends('layouts.app')
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
                            <li><a href="steel.html">Steel Testing</a></li>
                            <li><a href="pavetest.html" class="active">Pavetest Equipment</a></li>
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
                        <li><a href="steel.html">Steel Testing</a></li>
                        <li><a href="pavetest.html" class="active">Pavetest Equipment</a></li>
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
            <h1>Pavetest Equipment</h1>
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
                <p>We offer a full range of pavement testing equipment designed for accurate analysis of road surfaces, ensuring that your pavement construction projects meet the highest standards. Our machines provide precise measurements for load testing, surface roughness, and core sampling, helping you assess the quality and durability of your pavement. Trusted by engineers and construction professionals worldwide, our equipment supports safe and efficient roadway construction practices.</p>
                
                <!-- Matest Products Section -->
                <div class="brand-section matest-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/logo-matest.png" alt="Matest" class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\b210_72dpi.jpg" alt="B210 Pavement Deflectometer" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">B210</h4>
                                <h3 class="product-name">Pavement Deflectometer</h3>
                                <p class="product-description">This model is designed for accurate measurement of pavement deflection under load. It features a robust construction and advanced sensors for precise data collection.</p>
                                <a href="downloadable content\B210.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'B210',
                                    name: 'Pavement Deflectometer',
                                    description: 'This model is designed for accurate measurement of pavement deflection under load. It features a robust construction and advanced sensors for precise data collection.',
                                    image: 'images/b210_72dpi.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/en/',
                                    specs: [
                                        { label: 'Space Between Columns', value: '380 mm' },
                                        { label: 'Vertical Space', value: '778 mm' },
                                        { label: 'Actuator Stroke', value: '50 mm' },
                                        { label: 'Frequency', value: 'Up to 100 Hz' },
                                        { label: 'Static Load', value: '12 kN' },
                                        { label: 'Dynamic Load', value: '18 kN' },
                                        { label: 'Temperature Range (Thermoelectric Unit)', value: '2°C to 60°C' },
                                        { label: 'Temperature Range (Refrigeration Unit)', value: '-10°C to +60°C' },
                                        { label: 'Operation Type', value: 'Motor operated' },
                                        { label: 'Precision Electro-Mechanical Actuator', value: 'Silent operation' },
                                        { label: 'Integrated Climatic Chamber', value: 'Yes' },
                                        { label: 'Compact & Self-Contained', value: 'Fully precision-engineered unit' },
                                        { label: 'Configuration', value: 'Fully configurable for a wide range of testing applications' },
                                        { label: 'Test Area', value: 'Gull-wing door with three accessible sides' },
                                        { label: 'Control & Data Acquisition', value: '4-axis control, 16-channel data acquisition' }
                                        ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\dts16-altaluce-03702jpeg_72.jpg" alt="B220-01-KIT Servo-pneumatic Dynamic Testing System - DTS-16 Manual" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">B220-01-KIT</h4>
                                <h3 class="product-name">Servo-pneumatic Dynamic Testing System - DTS-16 Manual</h3>
                                <p class="product-description">The DTS-16 Dynamic Testing System is a servo-pneumatically controlled testing machine utilizing digital control of a pneumatic servo valve to provide accurate loading wave shapes up to 70 Hz. The DTS-16 can be operated in tension, compression dynamic loading and is suited to testing a diverse range of materials such as asphalt, soil, unbound granular materials, fibres and plastics.</p>
                                <a href="downloadable content\B220-01-KIT.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'B220-01-KIT',
                                    name: 'Servo-pneumatic Dynamic Testing System - DTS-16 Manual',
                                    description: 'The DTS-16 Dynamic Testing System is a servo-pneumatically controlled testing machine utilizing digital control of a pneumatic servo valve to provide accurate loading wave shapes up to 70 Hz. The DTS-16 can be operated in tension, compression dynamic loading and is suited to testing a diverse range of materials such as asphalt, soil, unbound granular materials, fibres and plastics.',
                                    image: 'images/dts16-altaluce-03702jpeg_72.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/en/',
                                   specs: [
                                            { label: 'Space Between Columns', value: '345 mm' },
                                            { label: 'Vertical Space', value: '650 mm' },
                                            { label: 'Servo Actuator Capacity', value: '± 16 kN' },
                                            { label: 'Frequency', value: 'Up to 70 Hz' },
                                            { label: 'Stroke', value: '30 mm' },
                                            { label: 'Air Supply', value: 'Clean dry air' },
                                            { label: 'Pressure', value: '800-900 kPa' },
                                            { label: 'Minimum Air Supply Rate', value: 'Up to 5 litres/sec' },
                                            { label: 'Power Supply', value: '90-264V 50-60Hz 1ph 240W (B220-11), 230V 50Hz 1ph 100W (B220-12), 230V 50Hz 1ph 1450W (B221)' },
                                            { label: 'Dimensions (B220-11 Load Frame)', value: '1262(h) x 400(d) x 470(w) mm' },
                                            { label: 'Dimensions (B220-12 Load Frame)', value: '1262(h) x 400(d) x 510(w) mm' },
                                            { label: 'Dimensions (Temp-Controlled Cabinet)', value: '2170(h) x 840(d) x 760(w) mm' },
                                            { label: 'Weight (B220-11 Load Frame)', value: '80 kg' },
                                            { label: 'Weight (B220-12 Load Frame)', value: '125 kg' },
                                            { label: 'Weight (Temp-Controlled Cabinet)', value: '160 kg' },
                                            { label: 'Design', value: 'Compact, robust 2-column load frame' },
                                            { label: 'Engineered', value: 'Precision engineered' },
                                            { label: 'Positioning', value: 'Optional motorized crosshead positioning' },
                                            { label: 'Configuration', value: 'Fully configurable for a wide range of testing applications' },
                                            { label: 'Control System', value: 'Digital Servo-Pneumatic control' },
                                            { label: 'Data Acquisition', value: '4-axis control, 16-channel control and data acquisition system' }
                                            ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\b265.jpg" alt="B265 SmartPulse | Electro-Mechanical Dynamic Testing System" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">B265</h4>
                                <h3 class="product-name">SmartPulse | Electro-Mechanical Dynamic Testing System</h3>
                                <p class="product-description">The SmartPulse 18 kN Electro-Mechanical Dynamic Testing System offers superior performance for testing a wide range of materials such as asphalt, soil, and unbound granular materials. Featuring a precision electro-mechanical actuator, this system is capable of applying both static and dynamic loads with unparalleled accuracy.</p>
                               <a href="downloadable content\B265.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'B265',
                                    name: 'B265 SmartPulse | Electro-Mechanical Dynamic Testing System',
                                    description: 'The SmartPulse 18 kN Electro-Mechanical Dynamic Testing System offers superior performance for testing a wide range of materials such as asphalt, soil, and unbound granular materials. Featuring a precision electro-mechanical actuator, this system is capable of applying both static and dynamic loads with unparalleled accuracy. The integrated climatic chamber ensures temperature control from 2°C to 60°C, while an optional refrigeration unit extends this range to -10°C to +60°C. The SmartPulse’s digital control system (CDAS2) and 16-channel data acquisition guarantee seamless operation, making it a versatile and reliable solution for dynamic testing across various applications.',
                                    image: 'images/b265.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/en/',
                                    specs: [
                                            { label: 'Space Between Columns', value: '380 mm' },
                                            { label: 'Vertical Space', value: '778 mm' },
                                            { label: 'Servo Actuator Stroke', value: '50 mm' },
                                            { label: 'Frequency', value: 'Up to 100 Hz' },
                                            { label: 'Static Load', value: '12 kN' },
                                            { label: 'Dynamic Load', value: '18 kN' },
                                            { label: 'Temperature Range (Thermoelectric Unit)', value: '2°C to 60°C' },
                                            { label: 'Temperature Range (Refrigeration Unit)', value: '-10°C to +60°C' },
                                            { label: 'Power Supply', value: '230V, 50-60 Hz, 1ph, 10A / 110V, 60Hz, 1ph, 19A' },
                                            { label: 'Dimensions', value: '1900(h) x 1000(d) x 850(w) mm' },
                                            { label: 'Weight', value: '380 kg approx.' },
                                            { label: 'Design', value: 'Compact, fully self-contained, precision-engineered unit' },
                                            { label: 'Actuator Type', value: 'Precision electro-mechanical actuator (silent operation)' },
                                            { label: 'Climatic Chamber', value: 'Integrated climatic chamber with low-consumption thermoelectric conditioning' },
                                            { label: 'Test Area Access', value: 'Gull-wing door offering three accessible sides' },
                                            { label: 'Data Acquisition System', value: '4-axis control, 16-channel data acquisition as standard' },
                                            { label: 'Electro-Mechanical Unit', value: 'Applies static or dynamic waveform loading in load or displacement control to a specimen' },
                                            { label: 'Cooling System', value: 'Portable refrigeration unit, various models with different temperature ranges' }
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
                        <li>Supply of soil testing equipment</li>
                        <li>Geotechnical investigation services</li>
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

    <!-- Floating Social Buttons -->
    <div class="floating-buttons">
        <a href="https://www.facebook.com/gmrcsales" target="_blank" class="floating-btn facebook-btn" title="Visit our Facebook Page">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="viber://chat?number=09090879416" class="floating-btn viber-btn" title="Contact us on Viber: 0909 087 9416">
            <i class="fab fa-viber"></i>
        </a>
    </div>

    <script src="script.js"></script>
    <script src="search.js"></script>

</body>
</html>