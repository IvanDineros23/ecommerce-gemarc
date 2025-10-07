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
                            <li><a href="soil.html" class="active">Soil Testing</a></li>
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
                        <li><a href="industrial-equipment.html">Industrial Equipment</a></li>
                        <li><a href="soil.html" class="active">Soil Testing</a></li>
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
            <h1>Soil Testing Equipment</h1>
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
                <p>We provide comprehensive soil testing equipment for geotechnical investigation, foundation design, and construction projects. Our equipment meets international standards for soil analysis and testing procedures.</p>
                
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
                                <img src="images/S172-01.jpg" alt="S172-01N Motorized liquid limit device, NF" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">S172-01N</h4>
                                <h3 class="product-name">Motorized liquid limit device, NF</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM D4318 | AASHTO T89 | UNI 10014 comparable to: BS 1377-2 | UNE 7377</p>
                                <p class="product-description">This model is motor operated at 120 drops/min speed in order to ensure better uniformity and accuracy. Liquid limit device with bakelite base and chrome cup.</p>
                                <a href="downloadable content\S172-01N.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'S172-01N',
                                    name: 'Motorized liquid limit device, NF',
                                    standard: 'ASTM D4318 | AASHTO T89 | UNI 10014 comparable to: BS 1377-2 | UNE 7377',
                                    description: 'This model is motor operated at 120 drops/min speed in order to ensure better uniformity and accuracy. Liquid limit device with bakelite base and chrome cup. Used to evaluate the relationship between the moisture percentage of a soil sample and the number of blows required to close a groove made into the soil and therefore to determine when a clay soil changes from a plastic to a liquid state.',
                                    image: 'images/S172-01.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/en/',
                                    specs: [
                                        {label: 'Model Number', value: 'S172-01N'},
                                        {label: 'Operation Type', value: 'Motor operated'},
                                        {label: 'Drop Rate', value: '120 drops/min'},
                                        {label: 'Base Material', value: 'Bakelite base'},
                                        {label: 'Cup Material', value: 'Chrome cup'},
                                        {label: 'Weight', value: '4.5 Kg'},
                                        {label: 'Power Supply', value: '230V 1F 50Hz'},
                                        {label: 'Application', value: 'Liquid limit determination'},
                                        {label: 'Test Purpose', value: 'Determine clay soil plastic to liquid state transition'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/S165-02-KIT.jpg" alt="S165-02 Semiautomatic cone digital penetrometer" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">S165-02</h4>
                                <h3 class="product-name">Semiautomatic cone digital penetrometer</h3>
                                <p class="product-standard"><strong>Features:</strong> Magnetic Controller Device & Electronic Digital Programmable Timer</p>
                                <p class="product-description">Basically structured as mod. S165-01, but equipped with a magnetic controller device with an electronic digital programmable timer that automatically releases the plunger head and ensures free falling of the cone during the 5-second test.</p>
                                <a href="downloadable content\S165-02.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'S165-02',
                                    name: 'Semiautomatic cone digital penetrometer',
                                    standard: 'Various International Soil Testing Standards',
                                    description: 'Basically structured as mod. S165-01, but equipped with a magnetic controller device with an electronic digital programmable timer that automatically releases the plunger head and ensures free falling of the cone during the 5-second test. Supplied complete with all necessary accessories for precise soil consistency testing.',
                                    image: 'images/S165-02-KIT.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/en/',
                                    specs: [
                                        {label: 'Model Number', value: 'S165-02'},
                                        {label: 'Operation Type', value: 'Semiautomatic'},
                                        {label: 'Controller', value: 'Magnetic controller device'},
                                        {label: 'Timer', value: 'Electronic digital programmable timer'},
                                        {label: 'Test Duration', value: '5-second automatic test'},
                                        {label: 'Plunger Release', value: 'Automatic release system'},
                                        {label: 'Power Supply', value: '230V 1ph 50Hz 200W'},
                                        {label: 'Dimensions', value: '220x280x490 mm'},
                                        {label: 'Weight', value: '15 kg approx.'},
                                        {label: 'Supply Status', value: 'Supplied complete'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/S276-01-150x150.jpg" alt="S276-01M Auto ShearLab - Direct and Residual Shear Testing Machine" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">S276-01M</h4>
                                <h3 class="product-name">Auto ShearLab - Direct and Residual Shear Testing Machine</h3>
                                <p class="product-standard"><strong>Standard:</strong> NF P094-071-2 NF P94-071-1 AASHTO T236 UNI EN ISO 17892-10 ASTM D3080 STAS 8942-2-82</p>
                                <p class="product-description">Same model as S276-KIT but is composed of complete shear frame with digital Touch-Screen microprocessor, load cells, transducers, and weight set for comprehensive shear testing.</p>
                                <a href="downloadable content\S276-01M.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'S276-01M',
                                    name: 'Auto ShearLab - Direct and Residual Shear Testing Machine',
                                    standard: 'NF P094-071-2 NF P94-071-1 AASHTO T236 UNI EN ISO 17892-10 ASTM D3080 STAS 8942-2-82',
                                    description: 'Same model as S276-KIT but is composed of a comprehensive shear testing system. Test used by geotechnical engineers to measure the shear strength properties of soil or rock material, or of discontinuities in soil or rock masses. This advanced system provides accurate and reliable shear strength measurements for foundation design and slope stability analysis.',
                                    image: 'images/S276-01-150x150.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/en/',
                                    specs: [
                                        {label: 'Model Number', value: 'S276-01M'},
                                        {label: 'Main Component', value: 'S276-10M Shear Frame with digital Touch-Screen microprocessor'},
                                        {label: 'Load Cell', value: 'S277-20 Load Cell, electric, 3000 N capacity, complete with cable'},
                                        {label: 'Load Cell Alternative', value: '5000 N capacity available on request'},
                                        {label: 'Vertical Transducer', value: 'S336-11 Linear vertical transducer, 10 mm travel'},
                                        {label: 'Horizontal Transducer', value: 'S336-12 Linear horizontal transducer, 25 mm travel'},
                                        {label: 'Data Acquisition', value: 'S277-31 Firmware activating 3 connectors for basic data acquisition'},
                                        {label: 'Weight Set', value: 'S273-KIT Set of 50 kg of slotted weights'},
                                        {label: 'Additional Components', value: 'Beam loading device, shear box case with adaptors, transducer supports'},
                                        {label: 'Note', value: 'Shear box, hollow punch, tamper and Software not included (order separately)'}
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
                                <img src="images/NL-5002-X-010-150x150.png" alt="NL 5002 X / 010 Eco Smartz Advanced CBR Loading Tester 50kN" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 5002 X / 010</h4>
                                <h3 class="product-name">Eco Smartz Advanced CBR Loading Tester 50kN</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 13286-47, BS 1377:4, ASTM D1883, AASHTO T 193</p>
                                <p class="product-description">Immediate Bearing Index - Newly invented bench mounting type machine, with rigid & compact design compare with previous model. By using DC motorized drive system to achieve more reliable & high accurate testing result.</p>
                                <a href="downloadable content\NL 5002 X _ 010.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 5002 X / 010',
                                    name: 'Eco Smartz Advanced CBR Loading Tester 50kN',
                                    standard: 'EN 13286-47, BS 1377:4, ASTM D1883, AASHTO T 193',
                                    description: 'Immediate Bearing Index - Newly invented bench mounting type machine, with rigid & compact design compare with previous model. By using DC motorized drive system to achieve more reliable & high accurate testing result. Features compact, bench-mounting design with energy saving DC power motor, less vibration & noise during operation, and rapid platen adjustment.',
                                    image: 'images/NL-5002-X-010-150x150.png',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model Number', value: 'NL 5002 X / 010'},
                                        {label: 'Capacity', value: '50kN'},
                                        {label: 'BS CBR Testing Speed', value: '1 mm / min'},
                                        {label: 'ASTM CBR Testing Speed', value: '1.27mm / min'},
                                        {label: 'Vertical Clearance', value: '730 mm'},
                                        {label: 'Horizontal Clearance', value: '270 mm'},
                                        {label: 'Product Dimension (mm)', value: '800 (L) x 410 (W) x 1200 (H)'},
                                        {label: 'Packing Dimension (mm)', value: '900 (L) x 545 (W) x 1400 (H)'},
                                        {label: 'Approx. Product Weight', value: '85 kg'},
                                        {label: 'Approx. Packing Weight', value: '112 kg'},
                                        {label: 'Power', value: '220~240 V, 370 W, 50/60 Hz, 0.5 Hp'},
                                        {label: 'Design Features', value: 'Compact, bench-mounting design, Energy saving with DC power motor, Less vibration & noise during operation, Rapid platen adjustment'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/NL-5032-X-001-150x150.png" alt="NL 5032 X / 001 Electrical Density Gauge (EDG)" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 5032 X / 001</h4>
                                <h3 class="product-name">Electrical Density Gauge (EDG)</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM D7698, ASTM D1556, ASTM D2167, ASTM 2937, ASTM 4564, ASTM 6938, ASTM D 2216, ASTM D 4643, ASTM D 4744, ASTM D 4959</p>
                                <p class="product-description">The Electrical Density Gauge (EDG) is a portable and nuclear-free alternative device for determining the moisture and density content of compacted soils used in road beds and foundations directly in place.</p>
                                <a href="downloadable content\NL 5032 X _ 001.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 5032 X / 001',
                                    name: 'Electrical Density Gauge (EDG)',
                                    standard: 'ASTM D7698, ASTM D1556, ASTM D2167, ASTM 2937, ASTM 4564, ASTM 6938, ASTM D 2216, ASTM D 4643, ASTM D 4744, ASTM D 4959',
                                    description: 'The Electrical Density Gauge (EDG) is a portable and nuclear-free alternative device for determining the moisture and density content of compacted soils used in road beds and foundations directly in place. The testing involves placing the gauge on the material being tested, and the radioactive source emits gamma radiation which passes through the material and is detected by the sensor on the opposite side. The EDG is a portable, battery-powered instrument capable of being used anywhere without the concerns and regulations associated with nuclear safety. Its user-friendly, step-by-step menu guides the user through each step of the testing procedure.',
                                    image: 'images/NL-5032-X-001-150x150.png',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model', value: 'NL 5032 X / 001'},
                                        {label: 'Soil Compaction Range', value: 'Standard field compaction range'},
                                        {label: 'Test Range Depth', value: '30 cm'},
                                        {label: 'Control Device', value: 'Compact steel case with touchscreen'},
                                        {label: 'Soil Sensor Probe', value: 'Internal Built-In'},
                                        {label: 'Data Transfer', value: 'USB Port or Bluetooth (Optional)'},
                                        {label: 'GPS Accuracy', value: '3 meters (optional)'},
                                        {label: 'Wet Density Range', value: 'Typical Compacted Earth Sites Range'},
                                        {label: 'Dry Density Range', value: 'Within 3% of standard tests'},
                                        {label: 'Moisture Content Range', value: 'Typical Compacted Earth Sites Range'},
                                        {label: 'Moisture Content Accuracy', value: 'Within 2 % of standard tests'},
                                        {label: 'Operating Temperature', value: '0 - 50 ˚C'},
                                        {label: 'Ambient Operating Humidity', value: '5 - 90 %, non-condensing'},
                                        {label: 'Power', value: 'Li-Ion Battery (AAA Battery Optional)'},
                                        {label: 'Battery Life', value: 'Approx. 20 Hours'},
                                        {label: 'Battery Charger', value: '220~240 V, 50/60 Hz'},
                                        {label: 'Battery Capacity', value: '18650 / 2600 mAh'},
                                        {label: 'Case Dimensions', value: '420(L) x 330(W) x 220(H) mm'},
                                        {label: 'Weight', value: '5.5 kg'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/NL-5025X-150x150.jpg" alt="NL 5025 X / SAS Automatic CBR or MOD Soil Compactor" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 5025 X / SAS</h4>
                                <h3 class="product-name">Automatic CBR or MOD Soil Compactor</h3>
                                <p class="product-standard"><strong>Standard:</strong> SANS 3001-GR31 : 2010</p>
                                <p class="product-description">The Automatic CBR/MOD Compaction Hammer is designed to provide a uniform compaction of specified effort, thus ensuring repeatable test results and eliminating any operator fatigue during the tests.</p>
                                <a href="downloadable content\NL 5025 X _ SAS.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 5025 X / SAS',
                                    name: 'Automatic CBR or MOD Soil Compactor',
                                    standard: 'SANS 3001-GR31 : 2010',
                                    description: 'The Automatic CBR/MOD Compaction Hammer is designed to provide a uniform compaction of specified effort, thus ensuring repeatable test results and eliminating any operator fatigue during the tests. The unique design is to allow the hammer to drop at the required height (305 and 460 mm) onto the specimen that also rotates the mould circularly to distribute the blows uniformly over the surface of the specimen. The robust steel frame design housing the motors with durable gearboxes and lifting mechanism which assure uniformity of drop height at all specimen levels.',
                                    image: 'images/NL-5025X-150x150.jpg',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model Number', value: 'NL 5025 X / SAS'},
                                        {label: 'Blow Rate', value: '50 - 60 blows / min'},
                                        {label: 'Adjustable Rammer Weight', value: '2.5 kg / 4.5 kg'},
                                        {label: 'Adjustable Drop Height', value: '305 mm or 460 mm'},
                                        {label: 'Product Dimension (mm)', value: '490 (L) x 360 (W) x 1370 (H)'},
                                        {label: 'Packing Dimension (mm)', value: '590 (L) x 460 (W) x 1570 (H)'},
                                        {label: 'Approx. Product Weight', value: '150 kg'},
                                        {label: 'Approx. Packing Weight', value: '180 kg'},
                                        {label: 'Power', value: '220 ~ 240 V, 250 W, 8 A, 1 Ph, 50/60 Hz'},
                                        {label: 'Design Features', value: 'Robust steel frame, Durable gearboxes, Uniform drop height at all specimen levels, Circular mould rotation'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Dual Manufacturing Products Section -->
                <div class="brand-section dual-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/dualmfg-logo.jpg" alt="Dual Manufacturing" class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/0003510_polycarbonate-sieve-kits.jpeg" alt="Polycarbonate Sieve Kits" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">PSK-001</h4>
                                <h3 class="product-name">Polycarbonate Sieve Kits</h3>
                                <p class="product-standard"><strong>Features:</strong> Accurate Mechanical Sieve Analysis</p>
                                <p class="product-description">An accurate mechanical sieve kit designed to provide reliable grain size analysis! 20 stainless steel screens including various U.S. Sieve Sizes placed into five clear 2" acrylic cylinders.</p>
                                <a href="downloadable content\PSK-001.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'PSK-001',
                                    name: 'Polycarbonate Sieve Kits',
                                    standard: 'U.S. Standard Sieve Sizes',
                                    description: 'An accurate mechanical sieve kit designed to provide reliable grain size analysis! 20 stainless steel screens including one each of the following U.S. Sieve Sizes: 4, 6, 8, 10, 12, 14, 16, 18, 20, 25, 30, 35, 40, 60, 100, 120, 140, 200, 230 and 270. Samples are placed into five clear 2 inch acrylic cylinders and volumetric percentages are indicated on the shaker frame.',
                                    image: 'images/0003510_polycarbonate-sieve-kits.jpeg',
                                    manufacturer: 'Dual Manufacturing Co, Inc',
                                    manufacturerUrl: 'https://www.dualmfg.com/',
                                    specs: [
                                        {label: 'Kit Contents', value: '20 stainless steel screens'},
                                        {label: 'U.S. Sieve Sizes Included', value: '4, 6, 8, 10, 12, 14, 16, 18, 20, 25, 30, 35, 40, 60, 100, 120, 140, 200, 230, 270'},
                                        {label: 'Sample Containers', value: 'Five clear 2 inch acrylic cylinders'},
                                        {label: 'Measurement Range', value: '0 to 100% in 5% increments'},
                                        {label: 'Frame Indicators', value: 'Volumetric percentages indicated on shaker frame'},
                                        {label: 'Material', value: 'Stainless steel screens, polycarbonate cylinders'},
                                        {label: 'Application', value: 'Grain size analysis and particle distribution testing'},
                                        {label: 'Design Features', value: 'Accurate mechanical sieve analysis, Reliable grain size determination'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/Metric-Frame-Sieves-150x150.jpeg" alt="Metric Frame Sieves" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">MFS-001</h4>
                                <h3 class="product-name">Metric Frame Sieves</h3>
                                <p class="product-standard"><strong>Standard:</strong> ISO 3310-1 specification</p>
                                <p class="product-description">Conforms to ISO 3310-1 specification. Available in full height (200 mm diameter x 50 mm depth) and half height (200 mm diameter x 25 mm depth) configurations.</p>
                                <a href="downloadable content\MFS-001.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'MFS-001',
                                    name: 'Metric Frame Sieves',
                                    standard: 'ISO 3310-1 specification',
                                    description: 'Conforms to ISO 3310-1 specification. Available in full height and half height configurations with all mesh supplied in stainless steel. In addition to the listed mesh sizes, all US standard mesh sizes can be installed, providing flexibility for various testing requirements.',
                                    image: 'images/Metric-Frame-Sieves-150x150.jpeg',
                                    manufacturer: 'Dual Manufacturing Co, Inc',
                                    manufacturerUrl: 'https://www.dualmfg.com/',
                                    specs: [
                                        {label: 'Standard Compliance', value: 'ISO 3310-1 specification'},
                                        {label: 'Full Height Sieves', value: '200 mm diameter x 50 mm depth'},
                                        {label: 'Half Height Sieves', value: '200 mm diameter x 25 mm depth'},
                                        {label: 'Mesh Material', value: 'Stainless steel'},
                                        {label: 'Mesh Size Compatibility', value: 'ISO standard mesh sizes + US standard mesh sizes'},
                                        {label: 'Frame Material', value: 'Precision manufactured metric frame'},
                                        {label: 'Application', value: 'Particle size analysis and material classification'},
                                        {label: 'Quality Features', value: 'High precision mesh, Durable construction, International standard compliance'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="0003520_market-grade-sieves.jpeg" alt="Market Grade Sieves" class="product-img">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">Market Grade Sieves</h3>
                                <p class="product-standard"><strong>Features:</strong> Dual Manufacturing Market Grade Sieves</p>
                                <p class="product-description">Market grade sieves designed for reliable particle size analysis in various industries.</p>
                                <a href="downloadable content\Market Grade Sieves.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    name: 'Market Grade Sieves',
                                    standard: 'Dual Manufacturing Standards',
                                    description: 'Market grade sieves designed for reliable particle size analysis in various industries.',
                                    image: '0003520_market-grade-sieves.jpeg',
                                    manufacturer: 'Dual Manufacturing Co, Inc',
                                    manufacturerUrl: 'https://www.dualmfg.com/',
                                    specs: [
                                        {label: 'Brand', value: 'Dual Manufacturing'},
                                        {label: 'Mesh Sizes', value: 'Available in various mesh sizes'},
                                        {label: 'Operation Type', value: 'Mechanical (no electrical power required)'},
                                        {label: 'Application', value: 'Laboratory and field weighing applications'},
                                        {label: 'Precision', value: 'High-accuracy mechanical weighing system'},
                                        {label: 'Durability', value: 'Robust construction for long-term reliability'},
                                        {label: 'Environment Suitability', value: 'Suitable for various testing environments'},
                                        {label: 'Key Features', value: 'No power required, Consistent performance, Wide capacity range, Ohaus quality construction'}
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

