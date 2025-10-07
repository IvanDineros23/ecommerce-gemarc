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
                            <li><a href="asphalt-bitumen.html" class="active">Asphalt & Bitumen</a></li>
                            <li><a href="cement-mortar.html">Cement & Mortar</a></li>
                            <li><a href="concrete-mortar.html">Concrete & Mortar</a></li>
                            <li><a href="drilling-machine.html">Drilling Machine</a></li>
                            <li><a href="industrial-equipment.html">Industrial Equipment</a></li>
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
                        <li><a href="asphalt-bitumen.html" class="active">Asphalt & Bitumen</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Asphalt & Bitumen Testing Equipment</h1>
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
                <p>We provide comprehensive asphalt and bitumen testing equipment to ensure the quality and performance of road construction materials. Our equipment meets international standards for testing bituminous materials and asphalt mixtures.</p>
                
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
                                <img src="images/B011.jpg" alt="B011 Centrifuge Extractor" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">B011</h4>
                                <h3 class="product-name">Centrifuge Extractor</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM D2172, AASHTO T164A, EN 12697-1</p>
                                <p class="product-description">Used for the determination of bitumen percentage in bituminous mixtures. It consists of a removable, precision machined aluminium rotor bowl, placed into a cylindrical aluminium box.</p>
                                <a href="downloadable content/B011.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'B011',
                                    name: 'Centrifuge Extractor',
                                    standard: 'ASTM D2172, AASHTO T164A, EN 12697-1',
                                    description: 'Used for the determination of bitumen percentage in bituminous mixtures. It consists of a removable, precision machined aluminium rotor bowl, placed into a cylindrical aluminium box.',
                                    image: 'images/B011.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                        {label: 'Capacity', value: 'ROTAREX 1500 / 3000 g'},
                                        {label: 'Bowl Type', value: 'Removable, precision machined aluminium rotor bowl'},
                                        {label: 'Housing', value: 'Cylindrical aluminium box'},
                                        {label: 'Control Panel', value: 'Electronic card fitted with AC drive'},
                                        {label: 'Speed Range', value: '0 to 3600 rpm automatic rotation ramp'},
                                        {label: 'Rotation Control', value: 'Fast stop bowl rotation at end of test'},
                                        {label: 'Display', value: 'Digital display monitoring the frequency'},
                                        {label: 'Speed Regulator', value: 'Included'},
                                        {label: 'Power Supply', value: '230V 1ph 50-60Hz 600W'},
                                        {label: 'Dimensions', value: '480x330x530 mm'},
                                        {label: 'Weight', value: '50 kg approx.'},
                                        {label: 'Note', value: 'Supplied without aluminium bowl+cover and filter discs (order separately)'},
                                        {label: 'Upgrading Option', value: 'B011-10: Safety electromagnetic micro-switch system to prevent opening during operation (CE Safety Directive compliant)'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/B043-KIT.jpg" alt="B043 KIT Digital Marshall Tester 50kN Capacity" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">B043 KIT</h4>
                                <h3 class="product-name">Digital Marshall Tester 50kN Capacity</h3>
                                <p class="product-standard"><strong>Standards:</strong> EN 12697-34, 12697-23, 12697-12 ASTM D6927, D5581, D1559 | AASHTO T245 BS 598107 | NF P98-251-2</p>
                                <p class="product-description">In this testing frame, the load is measured by an electric cell 50 kN capacity with high precision strain transducers; the flow is measured by an electronic displacement transducer 50 mm stroke and ± 0.1% linearity.</p>
                                <a href="downloadable content/B043-KIT.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'B043 KIT',
                                    name: 'Digital Marshall Tester 50kN Capacity',
                                    standard: 'EN 12697-34, 12697-23, 12697-12 ASTM D6927, D5581, D1559 | AASHTO T245 BS 598107 | NF P98-251-2',
                                    description: 'In this testing frame, the load is measured by an electric cell 50 kN capacity with high precision strain transducers; the flow is measured by an electronic displacement transducer 50 mm stroke and ± 0.1% linearity.',
                                    image: 'images/B043-KIT.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                        {label: 'Load Cell Capacity', value: '50 kN with high precision strain transducers'},
                                        {label: 'Flow Measurement', value: 'Electronic displacement transducer 50 mm stroke, ± 0.1% linearity'},
                                        {label: 'Display Unit', value: 'Cyber-Plus Progress 8 channels digital display with microprocessor'},
                                        {label: 'Measurements', value: 'Stability in kN and flow in mm with pick hold features'},
                                        {label: 'Data Transfer', value: 'RS232 port for PC and printer connection'},
                                        {label: 'Included', value: 'Complete with Stability mould'},
                                        {label: 'Power Supply', value: '230 V 1 ph 50 Hz 900 W'},
                                        {label: 'Dimensions', value: '650x400x1100 mm'},
                                        {label: 'Weight', value: '120 kg'},
                                        {label: 'Additional Tests', value: 'Direct Shear (Leutner) between bituminous strata'},
                                        {label: 'Tensile Strength', value: 'Determination of indirect tensile strength'},
                                        {label: 'Water Sensitivity', value: 'Water sensitivity testing of bituminous samples'},
                                        {label: 'Accessories Available', value: 'Various testing heads, transducers, and software for extended functionality'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/B055.jpg" alt="B055 Ductilometer with Cooling System" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">B055</h4>
                                <h3 class="product-name">Ductilometer with Cooling System</h3>
                                <p class="product-standard"><strong>Standards:</strong> EN 13398, EN 13589 | ASTM D113, D6084 | AASHTO T51</p>
                                <p class="product-description">Used to determine the bituminous ductility, that is the distance to which a briquette of molten bitumen can be extended under controlled conditions, before breaking. Equipped with incorporated refrigerating unit for tests with water temperature from + 5° to + 25°C.</p>
                                <a href="downloadable content/B055.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'B055',
                                    name: 'Ductilometer with Cooling System',
                                    standard: 'EN 13398, EN 13589 | ASTM D113, D6084 | AASHTO T51',
                                    description: 'Used to determine the bituminous ductility, that is the distance to which a briquette of molten bitumen can be extended under controlled conditions, before breaking. Equipped with incorporated refrigerating unit for tests with water temperature from + 5° to + 25°C.',
                                    image: 'images/B055.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                        {label: 'Test Type', value: 'Bituminous ductility determination'},
                                        {label: 'Function', value: 'Measures extension distance of bitumen briquette before breaking'},
                                        {label: 'Temperature Control', value: 'Incorporated refrigerating unit'},
                                        {label: 'Temperature Range', value: '+5° to +25°C'},
                                        {label: 'Cooling System', value: 'Built-in refrigeration for precise temperature control'},
                                        {label: 'Test Conditions', value: 'Controlled conditions for accurate ductility measurement'},
                                        {label: 'Dimensions', value: '1880x360x680 mm'},
                                        {label: 'Weight', value: '130 kg'},
                                        {label: 'Based On', value: 'Same design as B054 with added cooling capability'},
                                        {label: 'Application', value: 'Bitumen quality testing and material characterization'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- NL Scientific Products Section -->
                <div class="brand-section nl-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/NL-Scientific_logo.png" alt="NL Scientific" class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\NL 1012 X 008.png" alt="NL 1012 X / 008 Point Load Tester, Digimatic" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 1012 X / 008</h4>
                                <h3 class="product-name">Point Load Tester, Digimatic</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM D5731</p>
                                <p class="product-description">Point Load Tester is used to measure the strength values of rock specimen or concrete in geotechnical engineering. New rigid design load frame with hydraulic loading ram actuated by hand pump.</p>
                                <a href="downloadable content/NL 1012 X _ 008.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 1012 X / 008',
                                    name: 'Point Load Tester, Digimatic',
                                    standard: 'ASTM D5731',
                                    description: 'Point Load Tester is used to measure the strength values of rock specimen or concrete in geotechnical engineering. New rigid design load frame with hydraulic loading ram actuated by hand pump.',
                                    image: 'images/NL 1012 X 008.png',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Application', value: 'Measure strength values of rock specimen or concrete in geotechnical engineering'},
                                        {label: 'Design', value: 'New rigid design load frame with hydraulic loading ram'},
                                        {label: 'Actuation', value: 'Hand pump actuated'},
                                        {label: 'Display', value: 'Digimatic display for precise readings'},
                                        {label: 'Standard', value: 'ASTM D5731 compliant'},
                                        {label: 'Use', value: 'Field and laboratory testing applications'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/NL-2001-X-005.png" alt="NL 2001 X / 005 Digital Penetrometer" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 2001 X / 005</h4>
                                <h3 class="product-name">Digital Penetrometer</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 1426, ASTM D5, AASHTO T49</p>
                                <p class="product-description">Newly invented instrument for determine the consistency of sample from the depth penetration thru penetration needle under standard load condition.</p>
                                <a href="downloadable content/NL 2001 X _ 005.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 2001 X / 005',
                                    name: 'Digital Penetrometer',
                                    standard: 'EN 1426, ASTM D5, AASHTO T49',
                                    description: 'Newly invented instrument for determine the consistency of sample from the depth penetration thru penetration needle under standard load condition.',
                                    image: 'images/NL-2001-X-005.png',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Penetration Depth & Displayed Unit', value: '40 x 0.01 mm'},
                                        {label: 'Spindle Weight', value: '47.5 ± 0.05'},
                                        {label: 'Product Dimension', value: '310 (L) x 210 (W) x 480 (H) mm'},
                                        {label: 'Packing Dimension', value: '330 (L) x 230 (W) x 510 (H) mm'},
                                        {label: 'Approx. Product Weight', value: '6.5 kg'},
                                        {label: 'Approx. Packing Weight', value: '7.5 kg'},
                                        {label: 'Power', value: '220 - 240 V, 1 ph, 50 / 60 Hz'},
                                        {label: 'Design', value: 'Light weight with compact design'},
                                        {label: 'Recording', value: 'Automated record penetration result'},
                                        {label: 'Accuracy', value: 'High accuracy using digital measuring device'},
                                        {label: 'Operation', value: 'Enable auto or manual test operation'},
                                        {label: 'LED Lighting', value: 'LED lighting stand for better visibility'},
                                        {label: 'Levelling', value: 'Levelling bubble & vertical fine adjustable knob'},
                                        {label: 'Operation Speed', value: 'Simple & quick operation'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/NL-2007-X-002.png" alt="NL 2007 X Vacuum Pyknometer" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 2007 X</h4>
                                <h3 class="product-name">Vacuum Pyknometer</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 12697-5, EN 13108, ASTM D2041, AASHTO T209 & T283</p>
                                <p class="product-description">Used for determining the theoretical maximum specific gravity of uncompacted bituminous paving mixtures. It can also be used for the calculation of the percent air voids in compacted bituminous mixtures & the amount of bitumen absorbed by the aggregates.</p>
                                <a href="downloadable content/NL 2007 X.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 2007 X',
                                    name: 'Vacuum Pyknometer',
                                    standard: 'EN 12697-5, EN 13108, ASTM D2041, AASHTO T209 & T283',
                                    description: 'Used for determining the theoretical maximum specific gravity of uncompacted bituminous paving mixtures. It can also be used for the calculation of the percent air voids in compacted bituminous mixtures & the amount of bitumen absorbed by the aggregates.',
                                    image: 'images/NL-2007-X-002.png',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Product Dimension', value: '400 (L) x 430 (W) x 700 (H) mm'},
                                        {label: 'Approx. Weight', value: '42 kg'},
                                        {label: 'Power', value: '220~240 V, 0.36 kW, 1 Ph, 50/60 Hz, 1.5 A, 0.48 Hp'},
                                        {label: 'Application', value: 'Determination of Maximum Density'},
                                        {label: 'Usage', value: 'Theoretical maximum specific gravity testing'},
                                        {label: 'Calculations', value: 'Percent air voids and bitumen absorption measurements'},
                                        {label: 'Capacity Options', value: 'Three different capacity pyknometers available for selection'}
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
                        <li>Supply of asphalt and bitumen testing equipment</li>
                        <li>Calibration and verification services</li>
                        <li>Equipment maintenance and repair</li>
                        <li>Technical support and training</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

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

    <script>
    // Simple expand/collapse for product specs (unique to this page)
    function toggleProductSpecs(specsId) {
        var specsDiv = document.getElementById(specsId);
        if (!specsDiv) return;
        var btn = specsDiv.previousElementSibling;
        if (!btn) return;
        if (specsDiv.style.display === 'none' || specsDiv.style.display === '') {
            specsDiv.style.display = 'block';
            btn.innerHTML = '<i class="fas fa-chevron-up"></i> Hide Specifications';
            btn.classList.add('expanded');
        } else {
            specsDiv.style.display = 'none';
            btn.innerHTML = '<i class="fas fa-chevron-down"></i> View Specifications';
            btn.classList.remove('expanded');
        }
    }
    </script>
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

