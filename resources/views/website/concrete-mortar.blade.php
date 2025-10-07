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
                            <li><a href="concrete-mortar.html" class="active">Concrete & Mortar</a></li>
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
                        <li><a href="asphalt-bitumen.html">Asphalt & Bitumen</a></li>
                        <li><a href="cement-mortar.html">Cement & Mortar</a></li>
                        <li><a href="concrete-mortar.html" class="active">Concrete & Mortar</a></li>
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
            <h1>Concrete & Mortar Testing Equipment</h1>
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
                <p>We provide comprehensive concrete and mortar testing equipment to ensure quality control in construction projects. Our equipment meets international standards for testing concrete properties and performance characteristics.</p>
                
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
                                <img src="images\c386-astuccio.jpg" alt="C386M Digital concrete test hammer with microprocessor" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">C386M</h4>
                                <h3 class="product-name">Digital Concrete Test Hammer with Microprocessor</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM C805, EN 12504-2</p>
                                <p class="product-description">This digital concrete test hammer, entirely designed and manufactured by Matest with advanced technology, is capable of assessing concrete strength and detecting potential structural issues early on.

This capability enables the planning of preventive maintenance interventions before more severe damage occurs. By identifying areas in need of maintenance, it helps avoid the necessity of carrying out repairs across the entire structure.</p>

<a href="downloadable content\C386M.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>

<button class="expand-btn" onclick="openProductModal({
                                    code: 'C386M',
                                    name: 'Digital Concrete Test Hammer with Microprocessor',
                                    standard: 'ASTM C805, EN 12504-2',
                                    description: 'This digital concrete test hammer, entirely designed and manufactured by Matest with advanced technology, is capable of assessing concrete strength and detecting potential structural issues early on. This capability enables the planning of preventive maintenance interventions before more severe damage occurs. By identifying areas in need of maintenance, it helps avoid the necessity of carrying out repairs across the entire structure. Additionally, conducting targeted preventive maintenance interventions reduces the amount of waste generated from demolitions and reconstructions.',
                                    image: 'images/c386-astuccio.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                            { label: 'Impact Energy', value: '2.207 Joule (Nm)' },
                                            { label: 'Measuring Range', value: '10 – 120 N/mm² (MPa)' },
                                            { label: 'Interface', value: 'USB' },
                                            { label: 'Power Source', value: '6 rechargeable AA NiMh batteries 2400 mA/h' },
                                            { label: 'Battery Life', value: '60 hours with automatic shutdown' },
                                            { label: 'Operating Temperature', value: '-10°C to +60°C' },
                                            { label: 'Supplied Accessories', value: 'Software, USB cable, charger, abrasive stone, carrying case' },
                                            { label: 'Dimensions with Case', value: '330 × 180 × 120 mm' },
                                            { label: 'Weight', value: '3 Kg' }
                                            ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/F34A423B90EF6F2F48E0B84F8D9D5733.jpg" alt="Concrete Pipe Testing Machine" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">C093-05</h4>
                                <h3 class="product-name">Concrete Pipe Testing Machine</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 1916 comparable to ASTM C301, C497, BS 5911, DIN 4035</p>
                                <p class="product-description">Designed and manufactured to test concrete sewer and drain pipes used in drainage works, water and irrigation supply systems etc.</p>
                                <a href="downloadable content\C093-05.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'C093-05',
                                    name: 'Concrete Pipe Testing Machine',
                                    standard: 'EN 1916 comparable to ASTM C301, C497, BS 5911, DIN 4035',
                                    description: 'Designed and manufactured to test concrete sewer and drain pipes used in drainage works, water and irrigation supply systems etc.',
                                    image: 'images/F34A423B90EF6F2F48E0B84F8D9D5733.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                            { label: 'Pipe Max. Diameter (External)', value: '2600 mm' },
                                            { label: 'Pipe Min. Diameter (External)', value: '450 mm' },
                                            { label: 'Pipe Max. Length', value: '2500 mm' },
                                            { label: 'Lower Bearers', value: '2500 mm long' },
                                            { label: 'Upper Crossbeam', value: '2500 mm long' },
                                            { label: 'Frame Construction', value: 'Structural steel, bolted with high strength bolts; easily assembled/disassembled for delivery or site displacement. Must be locked to a concrete base prepared by customer.' },
                                            { label: 'Upper Crossbeams', value: 'Two beams, raised/lowered by motor two-speed operated winch; locked in position by pins through columns' },
                                            { label: 'Lower Bearers Support', value: 'Supplied flat and “V” shaped as per EN 1916 specification' },
                                            { label: 'Upper Loading Beam', value: 'Floating on a seat' },
                                            { label: 'Power Supply (Winch)', value: '230/400V 3ph 50Hz 2000W' },
                                            { label: 'Frame Dimensions', value: '3700 x 2500 x 6900 mm approx.' },
                                            { label: 'Weight', value: '7000 Kg approx.' }
                                            ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\c089-02n-1.jpg" alt="Compression Testing Machine" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">C089-21N</h4>
                                <h3 class="product-name">Compression Testing Machine (High end)</h3>
                                <p class="product-standard"><strong>Standard:</strong>ASTM C39, AASHTO T22, NF P18-411, BS 1610, GOST 10180</p>
                                <p class="product-description">Compression testing machine 2000 kN motorized with Cyber-Plus Progress touch-screen control unit (semi-automatic model), high stability, to test blocks max. 500x300 mm, cubes up to 200 mm side and cylinders up to dia. 160x320 mm.</p>
                                <a href="downloadable content\C089-21N.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'C089-21N',
                                    name: 'Compression Testing Machine (High end)',
                                    standard: 'ASTM C39, AASHTO T22, NF P18-411, BS 1610, GOST 10180',
                                    description: 'Compression testing machine 2000 kN motorized with Cyber-Plus Progress touch-screen control unit (semi-automatic model), high stability, to test blocks max. 500x300 mm, cubes up to 200 mm side and cylinders up to dia. 160x320 mm.',
                                    image: 'images/c089-02n-1.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                   specs: [
                                        { label: 'Max Vertical Daylight', value: '336 mm' },
                                        { label: 'Horizontal Daylight Between Columns', value: '272 mm' },
                                        { label: 'Compression Platens', value: 'Ø 287 x 51 mm' },
                                        { label: 'Frame Design', value: 'High stiffness and heavy weight 4 columns frame (German-style)' },
                                        { label: 'Calibration Accuracy', value: 'Class 1' },
                                        { label: 'Max Ram Travel', value: '55 mm approx.' },
                                        { label: 'Power Supply', value: '230V 1ph 50Hz 750W' },
                                        { label: 'Dimensions', value: '500 x 500 x 1100 mm approx.' },
                                        { label: 'Weight', value: '1050…1120 Kg' }
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
                                <img src="images/nl-4000-032.jpg" alt="NL 4000 X / 016U Automatic Compression Machine 2000kN Touch Screen" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 4000 X / 016U</h4>
                                <h3 class="product-name">Automatic Compression Machine 2000kN Touch Screen</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 12390-3/772-1/12390-5/12390-6 ASTM C39/C293, AASHTO T 22</p>
                                <p class="product-description">Used to determine the compressive Strength of the Concrete with automatic control and touch screen display, streamlining the testing process with minimal human intervention.</p>
                               <a href="downloadable content\NL 4000 X _ 016U.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 4000 X / 016U',
                                    name: 'Automatic Compression Machine 2000kN Touch Screen',
                                    standard: 'EN 12390-3/772-1/12390-5/12390-6, ASTM C39/C293, AASHTO T 22',
                                    description: 'Automatic Compression Machine is used to determine the compressive strength of concrete by gradually and uniformly applying specific compressive to a concrete sample with the ability to control the force load and record data automatically through a touch screen display. Features a clear, easy-to-read LCD touchscreen display measuring 155mm x 85mm, maximum force hold facility, real-time Force vs Time graphs, and automatic conversion from kN to MPa. Newly upgraded model with brand new outlook, old AC motor replaced by imported DC motor for more durability, low noise pollution, low oil temperature & low power consumption.',
                                    image: 'images/nl-4000-032.jpg',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model Number', value: 'NL 4000 X / 016U'},
                                        {label: 'Max. Vertical Clearance', value: '425 mm'},
                                        {label: 'Max. Horizontal Clearance', value: '270 mm'},
                                        {label: 'Capacity', value: '2000 kN'},
                                        {label: 'Low Range Sensitivity', value: '0 - 999 x 0.1 kN'},
                                        {label: 'High Range Sensitivity', value: '1000 - 2000 x 1kN'},
                                        {label: 'Units Selection', value: 'kN & MPa, kgf & kgf/cm²'},
                                        {label: 'Compression Platen Diameter', value: '295 mm'},
                                        {label: 'Piston Ram Diameter', value: '250 mm'},
                                        {label: 'Piston Ram Travel', value: '50 mm'},
                                        {label: 'Column Diameter', value: 'Ø70 mm'},
                                        {label: 'Accuracy', value: 'Class 1'},
                                        {label: 'Product Dimension', value: '970 (L) x 610 (W) x 1300 (H) mm'},
                                        {label: 'Packing Dimension', value: '1020 (L) x 650 (W) x 1400 (H) mm'},
                                        {label: 'Approx. Product Weight', value: '783 kg'},
                                        {label: 'Approx. Packing Weight', value: '805 kg'},
                                        {label: 'Power', value: '220 V, 2.5 Amp, 50 / 60 Hz, 1 ph'},
                                        {label: 'Display', value: 'LCD touchscreen 155mm x 85mm'},
                                        {label: 'Energy Saving', value: 'Designed to consume less power during operation'},
                                        {label: 'Vibration & Noise', value: 'Minimized vibration and noise levels'},
                                        {label: 'Auto Result Saving', value: 'Up to 450 specimens'},
                                        {label: 'Operation System', value: 'Simple operation with intuitive controls'},
                                        {label: 'Dual Channels', value: 'Ready for compression & flexural testing'},
                                        {label: 'Safety Features', value: 'Piston travel switch, fully covered safety enclosure'},
                                        {label: 'Data Export', value: 'USB port to export test results'},
                                        {label: 'Motor Type', value: 'Imported DC motor for durability and low noise'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/NL-4021-X-002.jpg" alt="NL 4021 X / 004 Digital Concrete Test Hammer" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 4021 X / 004</h4>
                                <h3 class="product-name">Digital Concrete Test Hammer</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM C805, BS 1881-202, DIN 1048, UNI 9198, EN12504-2</p>
                                <p class="product-description">Used to determine the compressive strength of concrete. Fully aluminium construction, high quality internal mechanism, extra durability up to 50,000 test cycle and with additional soft silicone cap for comfortable usage.</p>
                                <a href="downloadable content\NL 4021 X _ 004.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 4021 X / 004',
                                    name: 'Digital Concrete Test Hammer',
                                    standard: 'ASTM C805, BS 1881-202, DIN 1048, UNI 9198, EN12504-2',
                                    description: 'A Digital Concrete Test Hammer is used to determine the compressive strength of concrete by measuring the rebound of a spring-loaded mass impacting the surface of the concrete with continuous automatic recording of all parameters, registering and processing data, and then transferring them to a PC. Equipped with an electronic transducer that measures the rebound values and supplies automatically the results on a graphic display. When the Hammer strikes the concrete surface, it rebounds, and the rebound distance is measured by the device.',
                                    image: 'images/NL-4021-X-002.jpg',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model Number', value: 'NL 4021 X / 004'},
                                        {label: 'Impact Energy', value: '2.207 Nm'},
                                        {label: 'Display Graphic', value: 'High-contrast Graphic Display 256x64 (pixel) - LED Blue Display'},
                                        {label: 'Spring Tension', value: '785±30 N/m'},
                                        {label: 'Stretch Tension Spring', value: '75±0.3 mm'},
                                        {label: 'Measuring Range', value: '10 N/mm² to 70 N/mm²'},
                                        {label: 'Battery Lifetime Power', value: '3.7 V (lithium battery 1600 mAh)'},
                                        {label: 'Test Result Storage', value: '240 Group'},
                                        {label: 'Reading Unit', value: 'MPa, Psi & kgf/cm²'},
                                        {label: 'Casing Dimension', value: '320 (L) x 190 (W) x 90 (H) mm'},
                                        {label: 'Weight', value: '2 kg'},
                                        {label: 'Accuracy & Stability', value: 'Higher accuracy and stability of readings'},
                                        {label: 'Display Features', value: 'Wide LCD Display for intensity of result viewing'},
                                        {label: 'Auto Recording', value: 'Test result automatically recorded, calculated, and stored'},
                                        {label: 'Efficiency', value: 'Works efficiency of rebound detection and reduction'},
                                        {label: 'Data Transfer', value: 'Data transfer to PC or mini printer (optional)'},
                                        {label: 'Construction', value: 'Fully aluminium construction with high quality internal mechanism'},
                                        {label: 'Durability', value: 'Extra durability up to 50,000 test cycles'},
                                        {label: 'Comfort Features', value: 'Additional soft silicone cap for comfortable usage'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\nl4023x002003-01.jpg" alt="Air Entrainment Meter (NL4023X / 002 & 003)" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL4023X / 002 & 003</h4>
                                <h3 class="product-name">Air Entrainment Meter</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 12350-7 / DIN 1048, ASTM C231</p>
                                <p class="product-description">Used to determining the air content in fresh concrete. An aluminium vessel connected to the measuring gauge showing directly the air content in percentage. Come with two types operation, manually & electrically operated.</p>
                                <a href="downloadable content\NL4023X _ 002 & 003.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL4023X / 002 & 003',
                                    name: 'Air Entrainment Meter',
                                    standard: 'EN 12350-7 / DIN 1048, ASTM C231',
                                    description: 'Air Entrainment Meter is used for measuring the air content in fresh concrete, mortar or similar materials. Especially designed for daily test in laboratory use, on site in construction. Built according to the EN 12350-7, BS 1881-106, ASTM C 231 test standard. The kit is supplied with all accessories needed to determine air content in concrete samples.',
                                    image: 'images/nl4023x002003-01.jpg',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model Options', value: 'NL4023X / 002 (Manual) - NL4023X / 003 (Electrical)'},
                                        {label: 'Chamber Capacity', value: '8 Litres'},
                                        {label: 'Operation Type', value: 'Manual operation (002) / Electrical operation (003)'},
                                        {label: 'Air Content Range', value: '0-10%'},
                                        {label: 'Pressure Control', value: 'Hand pumping and pressure relief (002) / Electrical pumping (003)'},
                                        {label: 'Pressure Gauge', value: 'High-accuracy pressure gauge for precise measurements'},
                                        {label: 'Construction Material', value: 'High-grade aluminum construction'},
                                        {label: 'Seal System', value: 'Double sealing system to prevent air leakage'},
                                        {label: 'Portability', value: 'Portable design for field testing'},
                                        {label: 'Compliance', value: 'Fully compliant with international standards'},
                                        {label: 'Applications', value: 'Fresh concrete testing, Quality control, Laboratory testing, Site construction'},
                                        {label: 'Key Features', value: 'Easy-to-read dial, Durable construction, Quick test results, Reliable measurements'},
                                        {label: 'Standard Accessories', value: 'Measuring cup, Tamping rod, Scoop, Pressure pump, Calibration vessel'},
                                        {label: 'Weight (Approximate)', value: 'NL4023X / 002: 15 kg, NL4023X / 003: 18 kg'},
                                        {label: 'Calibration', value: 'Factory calibrated with calibration certificate'},
                                        {label: 'Warranty', value: 'Standard manufacturer warranty included'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Capstone Products Section -->
                <div class="brand-section capstone-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/capping-gypsum-logo.png" alt="Capstone" class="brand-logo-img brand-logo-small">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\TC_S350.png" alt="CAPSTONE S-350" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">CAPSTONE S-350</h4>
                                <h3 class="product-name">CAPSTONE S-350</h3>
                                <p class="product-standard"><strong>Features:</strong> Most Popular Concrete Capping Product</p>
                                <p class="product-description">S-350 is the most popular concrete capping products of Capstone Series. S-350 provides the best balance of working ability and strength performance for concrete capping.</p>
                                <a href="downloadable content\CAPSTONE S-350.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'CAPSTONE S-350',
                                    name: 'CAPSTONE S-350',
                                    standard: 'Concrete Capping Gypsum - Most Popular Series',
                                    description: 'S-350 is the most popular concrete capping products of Capstone Series. S-350 provides the best balance of working ability and strength performance for concrete capping. The water and gypsum ratio for S-350 is recommended to be 23-24%. After simply mixing with water, the gypsum can be used immediately and will fully harden in approximately 30 minutes with strength reaching over 350 kgf/cm², equals to 5000psi.',
                                    image: 'images/TC_S350.png',
                                    manufacturer: 'Taiwan Capstone',
                                    manufacturerUrl: 'https://www.twcapstone.com/en/',
                                    specs: [
                                        {label: 'Product Series', value: 'Capstone S-350'},
                                        {label: 'Strength Performance', value: 'Over 350 kgf/cm² (5000 psi)'},
                                        {label: 'Water to Gypsum Ratio', value: '23-24%'},
                                        {label: 'Working Time', value: 'Immediate use after mixing with water'},
                                        {label: 'Hardening Time', value: 'Approximately 30 minutes'},
                                        {label: 'Application', value: 'Concrete capping for compression testing'},
                                        {label: 'Key Features', value: 'Best balance of working ability and strength performance'},
                                        {label: 'Popularity', value: 'Most popular concrete capping product in Capstone Series'},
                                        {label: 'Usage Instructions', value: 'Simply mix with water and use immediately'},
                                        {label: 'Final Strength', value: '350+ kgf/cm² (equivalent to 5000+ psi)'},
                                        {label: 'Material Type', value: 'High-quality gypsum-based capping compound'},
                                        {label: 'Industry Standard', value: 'Widely accepted for concrete testing applications'},
                                        {label: 'Storage', value: 'Store in dry conditions away from moisture'},
                                        {label: 'Shelf Life', value: 'Extended shelf life when stored properly'},
                                        {label: 'Quality Assurance', value: 'Manufactured under strict quality control standards'},
                                        {label: 'Technical Support', value: 'Full technical support available from Taiwan Capstone'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\S-560.png" alt="CAPSTONE S-560" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">CAPSTONE S-560</h4>
                                <h3 class="product-name">CAPSTONE S-560</h3>
                                <p class="product-standard"><strong>Features:</strong> Extremely High Strength Gypsum</p>
                                <p class="product-description">S-560 represents the extremely high strength gypsum, which is exclusive in capping gypsum application. Many governments critical construction in Taiwan requested S-560 as the capping material. Such as the Taiwan High-Speed Rail, highway and bridge construction, etc. The extremely high strength gypsum S-560 is believed to be a trend in the near future.</p>
                                <a href="downloadable content\CAPSTONE S-560.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'CAPSTONE S-560',
                                    name: 'CAPSTONE S-560',
                                    standard: 'Extremely High Strength Capping Gypsum',
                                    description: 'S-560 represents the extremely high strength gypsum, which is exclusive in capping gypsum application. Many government critical construction projects in Taiwan requested S-560 as the capping material, such as the Taiwan High-Speed Rail, highway and bridge construction, etc. The extremely high strength gypsum S-560 is believed to be a trend in the near future. The water to gypsum ratio for S-560 is recommended to be 17-18%. After simply mixing with water, the gypsum is ready to use immediately and will fully harden after approximately 30 minutes, reaching strength over 560 kgf/cm², equal to 8000psi.',
                                    image: 'images/S-560.png',
                                    manufacturer: 'Taiwan Capstone',
                                    manufacturerUrl: 'https://www.twcapstone.com/en/',
                                    specs: [
                                        {label: 'Product Series', value: 'Capstone S-560'},
                                        {label: 'Strength Performance', value: 'Over 560 kgf/cm² (8000 psi)'},
                                        {label: 'Water to Gypsum Ratio', value: '17-18%'},
                                        {label: 'Working Time', value: 'Ready to use immediately after mixing'},
                                        {label: 'Hardening Time', value: 'Approximately 30 minutes'},
                                        {label: 'Application Type', value: 'Extremely high strength capping gypsum'},
                                        {label: 'Government Projects', value: 'Taiwan High-Speed Rail, highway and bridge construction'},
                                        {label: 'Market Position', value: 'Exclusive in capping gypsum application'},
                                        {label: 'Industry Trend', value: 'Believed to be the future trend in high-strength capping'},
                                        {label: 'Final Strength', value: '560+ kgf/cm² (equivalent to 8000+ psi)'},
                                        {label: 'Critical Applications', value: 'Government critical construction projects'},
                                        {label: 'Usage Instructions', value: 'Simply mix with water at 17-18% ratio and use immediately'},
                                        {label: 'Performance Level', value: 'Extremely high strength performance'},
                                        {label: 'Quality Standards', value: 'Meets requirements for critical infrastructure projects'},
                                        {label: 'Recommended Use', value: 'High-strength concrete testing applications'},
                                        {label: 'Technical Excellence', value: 'Represents cutting-edge capping gypsum technology'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\S-630.png" alt="CAPSTONE S-630" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">CAPSTONE S-630</h4>
                                <h3 class="product-name">CAPSTONE S-630</h3>
                                <p class="product-standard"><strong>Features:</strong> Newest Product with Unbeatable Strength</p>
                                <p class="product-description">S-630 is the newest product launched in 2012. The strength has reached 9000psi unbeatably. It shows the highest technique of capping gypsum at present all over the world and the R&D ability of TAIWAN CAPSTONE Lab. The holding time is slightly longer than any other products at 40 mins. it fits the highest strength concrete compressive test.</p>
                                <a href="downloadable content\CAPSTONE S-630.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'CAPSTONE S-630',
                                    name: 'CAPSTONE S-630',
                                    standard: 'Newest Product with Unbeatable 9000psi Strength',
                                    description: 'S-630 is the newest product launched in 2012. The strength has reached 9000psi unbeatably. It shows the highest technique of capping gypsum at present all over the world and the R&D ability of TAIWAN CAPSTONE Lab. The holding time is slightly longer than any other products at 40 minutes. It fits the highest strength concrete compressive test. The water to gypsum ratio for S-630 is recommended to be 15.5-16%. After simply mixing with water, it can be used immediately. The gypsum will fully harden after 30 minutes and reach the strength over 630 kgf/cm², equals to 9000psi.',
                                    image: 'images/S-630.png',
                                    manufacturer: 'Taiwan Capstone',
                                    manufacturerUrl: 'https://www.twcapstone.com/en/',
                                    specs: [
                                        {label: 'Product Series', value: 'Capstone S-630'},
                                        {label: 'Launch Year', value: '2012 (Newest Product)'},
                                        {label: 'Strength Performance', value: 'Over 630 kgf/cm² (9000 psi) - Unbeatable'},
                                        {label: 'Water to Gypsum Ratio', value: '15.5-16%'},
                                        {label: 'Working Time', value: 'Can be used immediately after mixing'},
                                        {label: 'Hardening Time', value: '30 minutes (full hardening)'},
                                        {label: 'Holding Time', value: '40 minutes (slightly longer than other products)'},
                                        {label: 'Technical Excellence', value: 'Highest technique of capping gypsum worldwide'},
                                        {label: 'R&D Achievement', value: 'Demonstrates TAIWAN CAPSTONE Lab R&D ability'},
                                        {label: 'Application', value: 'Fits the highest strength concrete compressive test'},
                                        {label: 'Global Recognition', value: 'Highest technique at present all over the world'},
                                        {label: 'Final Strength', value: '630+ kgf/cm² (equivalent to 9000+ psi)'},
                                        {label: 'Innovation Level', value: 'State-of-the-art capping gypsum technology'},
                                        {label: 'Target Use', value: 'Ultra-high strength concrete testing'},
                                        {label: 'Quality Leadership', value: 'Industry-leading performance standards'},
                                        {label: 'Manufacturing Excellence', value: 'Represents pinnacle of Taiwan Capstone technology'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- EHWA Products Section -->
                <div class="brand-section ehwa-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/ehwa.png" alt="EHWA" class="brand-logo-img brand-logo-medium">
                        </div>
                    </div>
                    
                    <div class="single-product-container single-product-center">
                        <div class="product-card featured-product">
                            <div class="product-image">
                                <img src="images/ehwa-core-bits.png" alt="EHWA Core Bits for Drilling" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">EHWA-CB-001</h4>
                                <h3 class="product-name">Core Bits for Drilling</h3>
                                <p class="product-standard"><strong>Features:</strong> Diamond Core Drilling Technology</p>
                                <p class="product-description">High-performance diamond core drilling bits designed for precision drilling in concrete, masonry, and other construction materials. Features advanced diamond cutting technology for superior performance and longer service life in demanding drilling applications.</p>
                                <a href="downloadable content\EHWA-CB-001.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'EHWA Core Bit',
                                    name: 'Core Bit',
                                    standard: 'Diamond Core Drilling Technology',
                                    description: 'Professional-grade diamond core drilling bits engineered for precision drilling operations in concrete, masonry, stone, and other construction materials. These core bits feature advanced diamond cutting segments that deliver superior cutting performance, extended service life, and exceptional drilling accuracy. Designed for use with core drilling machines ranging from 2-5kW power output, suitable for both hard and soft materials with optimized application-specific designs.',
                                    image: 'images/ehwa-core-bits.png',
                                    manufacturer: 'EHWA Diamond',
                                    manufacturerUrl: 'https://ehwadia.com/',
                                    specs: [
                                        {label: 'Model Range', value: 'ZD-R10, ZD-R20, ZD-R30'},
                                        {label: 'Machine Power', value: '2-2.5 kW (ZD-R10), 2.5-3.3 kW (ZD-R20), 3.5+ kW (ZD-R30)'},
                                        {label: 'Hard Materials Application', value: 'R10 (ZD-R10), R20 (ZD-R20), R30 (ZD-R30)'},
                                        {label: 'Medium Materials Application', value: 'Optimized cutting segments for medium density materials'},
                                        {label: 'Soft Materials Application', value: 'Specialized design for soft material drilling'},
                                        {label: 'Diamond Technology', value: 'High-grade diamond cutting segments'},
                                        {label: 'Core Bit Construction', value: 'Steel body with diamond-impregnated cutting segments'},
                                        {label: 'Cutting Performance', value: 'Superior cutting speed and precision'},
                                        {label: 'Service Life', value: 'Extended operational life in demanding applications'},
                                        {label: 'Drilling Accuracy', value: 'Precise core sample extraction'},
                                        {label: 'Material Compatibility', value: 'Concrete, masonry, stone, reinforced concrete'},
                                        {label: 'Power Range', value: '2.0 kW to 5+ kW machine compatibility'},
                                        {label: 'Application Types', value: 'Construction testing, core sampling, material analysis'},
                                        {label: 'Quality Standards', value: 'Professional-grade manufacturing standards'},
                                        {label: 'Usage Recommendations', value: 'Match core bit model to machine power and material type'},
                                        {label: 'Technical Support', value: 'Full technical support and application guidance available'}
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
                            <img src="images/tbt-Nanjing_logo.jpg" alt="TBT Nanjing" class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="single-product-container single-product-center">
                        <div class="product-card featured-product">
                            <div class="product-image">
                                <img src="images/TBTCTM-2000N-300x300.jpg" alt="TBTCTM-2000N Compression Testing Machine" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">TBTCTM-2000N</h4>
                                <h3 class="product-name">Compression Testing Machine w/ Digital Display</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 12390-3/772-1/12390-5/12390-6 ASTM C39/C293, AASHTO T 22</p>
                                <p class="product-description">The testing machine is designed for testing the compressive strength of building materials such as brick, cement mortar and concrete; it is electro-hydraulically powered and the pressure applied on the specimen can be displayed directly; The maximum force value can be maintained and the data measured can be saved when the power is off; The test data can be processed automatically and the test report can be printed.</p>
                                <a href="downloadable content\TBTCTM-2000N.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'TBTCTM-2000N',
                                    name: 'Compression Testing Machine w/ Digital Display',
                                    standard: 'EN 12390-3/772-1/12390-5/12390-6 ASTM C39/C293, AASHTO T 22',
                                    description: 'Advanced electro-hydraulically powered compression testing machine designed for testing the compressive strength of building materials such as brick, cement mortar and concrete. Features digital display for direct pressure readings, maximum force value maintenance, and data preservation during power outages. Equipped with automatic test data processing capabilities and integrated test report printing functionality.',
                                    image: 'images/TBTCTM-2000N-300x300.jpg',
                                    manufacturer: 'TBT Nanjing',
                                    manufacturerUrl: 'https://www.tbt-scietech.com/',
                                    specs: [
                                        {label: 'Model', value: 'TBTCTM-2000N'},
                                        {label: 'Maximum Load Capacity', value: '2000 kN (200 tons)'},
                                        {label: 'Power System', value: 'Electro-hydraulically powered'},
                                        {label: 'Display Type', value: 'Digital display with direct pressure readings'},
                                        {label: 'Data Storage', value: 'Data saved during power outages'},
                                        {label: 'Force Value Maintenance', value: 'Maximum force value retention capability'},
                                        {label: 'Test Materials', value: 'Brick, cement mortar, concrete, building materials'},
                                        {label: 'Data Processing', value: 'Automatic test data processing'},
                                        {label: 'Report Generation', value: 'Integrated test report printing'},
                                        {label: 'Control System', value: 'Microprocessor-controlled operation'},
                                        {label: 'Loading Rate', value: 'Variable loading rate control'},
                                        {label: 'Specimen Size', value: 'Standard concrete cube and cylinder specimens'},
                                        {label: 'Platens', value: 'Hardened steel compression platens'},
                                        {label: 'Safety Features', value: 'Emergency stop, overload protection'},
                                        {label: 'Power Requirements', value: '380V/50Hz three-phase power supply'},
                                        {label: 'Accuracy Class', value: 'Class 1 accuracy according to EN standards'},
                                        {label: 'Calibration', value: 'Factory calibrated with certificate'},
                                        {label: 'Dimensions (approx)', value: '1200 × 800 × 2200 mm (L×W×H)'},
                                        {label: 'Weight', value: 'Approximately 1500 kg'},
                                        {label: 'Applications', value: 'Quality control, research, construction testing'}
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
                        <li>Supply of concrete and mortar testing equipment</li>
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

