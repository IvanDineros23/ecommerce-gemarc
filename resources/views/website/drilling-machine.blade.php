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
                            <li><a href="drilling-machine.html" class="active">Drilling Machine</a></li>
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
                        <li><a href="concrete-mortar.html">Concrete & Mortar</a></li>
                        <li><a href="drilling-machine.html" class="active">Drilling Machine</a></li>
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
            <h1>Drilling Machine Equipment</h1>
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
                <p>We provide comprehensive drilling machine equipment for geotechnical investigation, soil sampling, and construction applications. Our drilling equipment is designed for various soil conditions and project requirements.</p>

                <!-- TOHO Products Section -->
                <div class="brand-section toho-section" style="margin-bottom: 32px;">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/toho-logo-200.jpg" alt="TOHO" class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card" style="margin-bottom: 24px;">
                            <div class="product-image">
                                <img src="images/AK-01.jpg" alt="AK-01 Air operated Drill type" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">AK-01</h4>
                                <h3 class="product-name">Air operated Drill type</h3>
                                <p class="product-description">Able to reduce running cost and time using air driving method. Drill head with reduction gear exerts great drilling torque Makes it easy to drill into unstable stratum</p>
                                <a href="downloadable content\AK-01.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'AK-01',
                                    name: 'Air operated Drill type',
                                    standard: 'Advanced Air Drilling Technology',
                                    description: 'The AK-01 Air operated Drill is a high-performance drilling machine designed to reduce running costs and operational time through its efficient air driving method. Equipped with a drill head featuring reduction gear that exerts exceptional drilling torque, making it highly effective for drilling operations in unstable stratum conditions. The air-driven system provides reliable operation with reduced maintenance requirements compared to traditional hydraulic systems.',
                                    image: 'images/AK-01.jpg',
                                    manufacturer: 'TOHO',
                                    manufacturerUrl: 'https://www.tohochikakoki.co.jp',
                                    specs: [
                                        {label: 'Model', value: 'AK-01'},
                                        {label: 'Drilling Angle', value: 'Free'},
                                        {label: 'Down The Hole Drill', value: 'ϕ65 mm'},
                                        {label: 'Down The Hole Drill with Outer Casing', value: 'Drilling Diameter: ϕ105 mm (Inside Diameter ϕ67 mm), Drill Rod: ϕ50 mm, Outer Casing: ϕ89.1 mm (ϕ105 mm Bit Dia.)'},
                                        {label: 'Spindle Speeds', value: '15-30 r/min'},
                                        {label: 'Torque (Max)', value: '1.23 kN⋅m (3rd gear)'},
                                        {label: 'Drill Frame', value: 'Air Motor + Chain Drive'},
                                        {label: 'Thrust Force (Max)', value: '7.84 kN (800 kgf)'},
                                        {label: 'Balance Force (Max)', value: '7.84 kN (800 kgf)'},
                                        {label: 'Feed Length', value: '1400 mm'},
                                        {label: 'Air Consumption', value: '10-15 m³/min × 1-1.5 MPa'},
                                        {label: 'Dimensions (L × W × H)', value: '2190 × 660 × 980 mm'},
                                        {label: 'Net Weight', value: 'Drive Unit: 230 kg'},
                                        {label: 'Disassembly', value: 'Drill Head: 65 kg, Mast: 125 kg, Base: 40 kg'},
                                        {label: 'Operation Stand', value: '65 kg'},
                                        {label: 'Feed Length', value: '3500 mm'},
                                        {label: 'Key Features', value: 'Air drilling, Drill head with strong air motor, Double tube drilling'},
                                        {label: 'Benefits', value: 'Reduced running cost and time, Great drilling torque, Easy drilling in unstable stratum'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card" style="margin-bottom: 24px;">
                            <div class="product-image">
                                <img src="images/Spindle-Type-D2-KS-58.png" alt="D2-K92 Spindle Type" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">D2-K92</h4>
                                <h3 class="product-name">Spindle Type</h3>
                                <p class="product-description">Oil hydraulic chuck Oil hydraulic slide base Low speed and high torque rotary spindle Both right and left side operation available</p>
                                <a href="downloadable content\D2-K92.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'D2-K92',
                                    name: 'Spindle Type',
                                    standard: 'Advanced Hydraulic Drilling System',
                                    description: 'The D2-K92 Spindle Type drilling machine represents advanced hydraulic drilling technology with versatile operation capabilities. Features oil hydraulic chuck and slide base systems for precision drilling operations. Designed with low speed and high torque rotary spindle configuration, providing exceptional drilling power for demanding applications. The machine offers both right and left side operation flexibility, making it adaptable to various drilling site configurations and operational requirements.',
                                    image: 'images/Spindle-Type-D2-KS-58.png',
                                    manufacturer: 'TOHO',
                                    manufacturerUrl: 'https://www.tohochikakoki.co.jp',
                                    specs: [
                                        {label: 'Model', value: 'D2-K92'},
                                        {label: 'Standard Equipment', value: 'Oil hydraulic slide base'},
                                        {label: 'I.D. of Spindle', value: '92 mm'},
                                        {label: 'Spindle Speeds', value: 'At 60-380/125-63 r/min, At 90 Lpm: 385/200-100 r/min'},
                                        {label: 'Torque', value: '1.57 kN⋅m (160 kg⋅m)'},
                                        {label: 'Stroke of Spindle', value: '500 mm'},
                                        {label: 'Thrust Force', value: '22.1 kN (2260 kgf)'},
                                        {label: 'Balance Force', value: '29.5 kN (3010 kgf)'},
                                        {label: 'Slide System', value: 'Oil Hydraulic Stroke 400 mm'},
                                        {label: 'Power', value: '7.5 kW/4P or 15ps/1800 rpm'},
                                        {label: 'Dimensions (L × W × H)', value: '1800 × 870 × 1620 mm'},
                                        {label: 'Net Weight', value: '700 kg'},
                                        {label: 'Maximum Equipment', value: 'Oil hydraulic chuck is optional equipment'},
                                        {label: 'Low Speed & High Torque', value: 'Rotary spindle for demanding applications'},
                                        {label: 'Operation Flexibility', value: 'Both right and left side operation available'},
                                        {label: 'Long Brake & Hoist Lever', value: 'Easy hoisting operation'},
                                        {label: 'Chuck System', value: 'Oil hydraulic slide base is standard equipment'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card" style="margin-bottom: 24px;">
                            <div class="product-image">
                                <img src="images/1618466271839904_116764.jpg" alt="DM-03 Drilling Machine" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">DM-03</h4>
                                <h3 class="product-name">Drilling Machine</h3>
                                <p class="product-description">Professional drilling machine with hydraulic operation system designed for efficient drilling operations in various geological conditions and construction applications.</p>
                                <a href="downloadable content\DM-03.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'DM-03',
                                    name: 'Drilling Machine',
                                    standard: 'Professional Hydraulic Drilling System',
                                    description: 'The DM-03 Drilling Machine is a professional-grade hydraulic drilling system engineered for efficient drilling operations across various geological conditions. This versatile drilling machine combines robust construction with advanced hydraulic technology to deliver reliable performance in construction, geotechnical investigation, and foundation work applications. Designed for both precision and durability, the DM-03 offers excellent drilling capabilities with user-friendly operation.',
                                    image: 'images/1618466271839904_116764.jpg',
                                    manufacturer: 'TOHO',
                                    manufacturerUrl: 'https://www.tohochikakoki.co.jp',
                                    specs: [
                                        {label: 'Model', value: 'DM-03'},
                                        {label: 'I.D. of Spindle', value: '47 mm'},
                                        {label: 'Spindle Speeds', value: '65 : 125 : 370 r/min'},
                                        {label: 'Torque', value: '0.54 kN⋅m (55 kg⋅m)'},
                                        {label: 'Stroke of Spindle', value: '400 mm'},
                                        {label: 'Thrust Force', value: '8.4 kN (860 kgf)'},
                                        {label: 'Balance Force', value: '13.8 kN (1410 kgf)'},
                                        {label: 'Power', value: '3.4kW/4P or 5ps/1800 rpm'},
                                        {label: 'Dimensions (L × W × H)', value: '1115 × 570 × 1060 mm'},
                                        {label: 'Net Weight', value: '240 kg'},
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FRASTE Products Section -->
                <div class="brand-section fraste-section">
                    <div class="brand-header" style="margin-top: 40px;">
                        <div class="brand-logo">
                            <img src="images/logo.svg" alt="FRASTE" class="brand-logo-img" style="max-height:60px;">
                        </div>
                    </div>
                    <div class="products-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/multidrill-xl-140DR_.jpg" alt="MULTIDRILL XL 140 DR" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">MULTIDRILL XL 140 DR</h4>
                                <h3 class="product-name">MULTIDRILL XL 140 DR</h3>
                                <p class="product-description">Experience, innovation, high quality, continuous ideas sharing with the final users are the strong points that in the course of time, made the FRASTE MULTIDRIL XL140 DR one of the most versatile and reliable Geothermal drilling rigs. Expressly designed for air drilling, its dual rotary head allows simultaneous drilling with drill pipe and casing pipe.</p>
                                <a href="downloadable content\XL 140 DR.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick='openProductModal({
                                    code: "XL 140 DR",
                                    name: "MULTIDRILL XL 140 DR",
                                    standard: "Geothermal Drilling Rig",
                                    description: "Experience, innovation, high quality, continuous ideas sharing with the final users are the strong points that in the course of time, made the FRASTE MULTIDRIL XL140 DR one of the most versatile and reliable Geothermal drilling rigs. Expressly designed for air drilling, its dual rotary head allows simultaneous drilling with drill pipe and casing pipe. It’s a friendly-use drill unit, thanks also to the employ of the Preventer, the cuttings conveyor that permits working without any drilling site and environment contamination. The MULTIDRILL XL 140 DR, like all Fraste rigs, assures the best safety factor with its ergonomic control panels and with all safety devices made under the most rigorous current laws and regulations. Different optional equipment are available for various drilling purposes.",
                                    image: "images/multidrill-xl-140DR_.jpg",
                                    manufacturer: "FRASTE",
                                    manufacturerUrl: "https://www.fraste.com/en",
                                    specs: [
                                        {label: "Power", value: "CAT C4.4 - Stage V - Tier 4F - 110 kw (148 Hp) / CAT C4.4 - Stage IIIA - Tier 3 - 106 Kw (142 Hp)"},
                                        {label: "Rotary head stroke", value: "3700 mm (11,5 ft)"},
                                        {label: "Pull-up", value: "10000 daN (22480 lbf)"},
                                        {label: "Pull-down", value: "6800 daN (15287 lbf)"},
                                        {label: "Rotary head for drill pipes - Max torque", value: "1550 daNm (11432 ft lbf)"},
                                        {label: "Rotary head for drill pipes - Max speed", value: "160 rpm"},
                                        {label: "Rotary head for drill pipes - Speeds number", value: "2"},
                                        {label: "Rotary head for casing - Max torque", value: "2700 daNm (19914 ft lbf)"},
                                        {label: "Rotary head for casing - Max speed", value: "70 rpm"},
                                        {label: "Rotary head for casing - Speeds number", value: "2/3"},
                                        {label: "Clamp", value: "Ø 60-355 mm (2,3\"-14\")"},
                                        {label: "Weight", value: "~ 9400 Kg (~ 20723 lb)"}
                                    ]
                                })'>
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/multidrill-sl__1.jpg" alt="MULTIDRILL SL" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">MULTIDRILL SL</h4>
                                <h3 class="product-name">MULTIDRILL SL</h3>
                                <p class="product-description">FRASTE MULTIDRILL SL: Innovation, Hi-Tech and Freshness. Pocket-sized: only 780 mm width and 2,5 ton weight, the standard version of the Multidrill SL features all high qualities of a large drilling rig! Updated and manufactured according to the strictest quality and safety standards, it will surprise you with its high reliability and productivity.</p>
                                <a href="downloadable content\MULTIDRILL SL.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick='openProductModal({
                                    code: "MULTIDRILL SL",
                                    name: "MULTIDRILL SL",
                                    standard: "Compact Drilling Rig",
                                    description: "FRASTE MULTIDRILL SL: Innovation, Hi-Tech and Freshness. Pocket-sized: only 780 mm width and 2,5 ton weight, the standard version of the Multidrill SL features all high qualities of a large drilling rig! Updated and manufactured according to the strictest quality and safety standards, it will surprise you with its high reliability and productivity. Versatile: the modular mast and a great fitting availability to choose from, make the Multidrill SL perfect for different applications: soil investigation, environmental monitoring and small-size water wells. A great small drilling rig to make it stick!",
                                    image: "images/multidrill-sl__1.jpg",
                                    manufacturer: "FRASTE",
                                    manufacturerUrl: "https://www.fraste.com/en",
                                    specs: [
                                        {label: "Power", value: "CAT C1.7 - Stage V - Tier 4F - 36 kw (48 Hp)"},
                                        {label: "Rotary head stroke", value: "1800 - 2300 - 2800 mm (5,9 - 7,6 - 9,2 ft)"},
                                        {label: "Pull-up", value: "2500 daN (5620 lbf)"},
                                        {label: "Pull-down", value: "2500 daN (5620 lbf)"},
                                        {label: "Max rotary head torque", value: "470 daNm (3466 ft lbf)"},
                                        {label: "Max rotary head speed", value: "900 rpm"},
                                        {label: "Clamp", value: "Ø 48-210 mm (1,9\"-8,3\")"},
                                        {label: "Weight", value: "~ 2500 Kg (~ 5511 lb)"}
                                    ]
                                })'>
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tae Sung Co. Products Section -->
                <div class="brand-section taesung-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/Tae-Sung-Co_logo.png" alt="Tae Sung Co." class="brand-logo-img">
                        </div>
                    </div>
                    
                    <div class="products-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/impregnated-diamond-core-bits-01.jpg" alt="Impregnated Diamond Core Bits" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">TS-IDCB-001</h4>
                                <h3 class="product-name">Impregnated Diamond Core Bits</h3>
                                <p class="product-description">Premium impregnated diamond core bits attached to the foremost part of core barrels for direct drilling of hard rocks. Available in multiple sizes and designed for optimal performance based on ground conditions.</p>
                                <a href="downloadable content\TS-IDCB-001.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'TS-IDCB-001',
                                    name: 'Impregnated Diamond Core Bits',
                                    standard: 'Global Quality Level Diamond Core Drilling',
                                    description: 'Impregnated Diamond Core Bits are attached to the foremost part of the Core barrels to be used in direct drilling of the ground, and play the most important role among the equipments that are used in drilling. These premium bits are made from synthetic diamond powder, metal powder, and shank of top quality. The hardness of matrix is carefully selected based on rock conditions - large size diamond with strong matrix for soft rocks, medium size diamond with medium strength matrix for medium rocks, and small size diamond with soft matrix for strong rocks.',
                                    image: 'images/impregnated-diamond-core-bits-01.jpg',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'AX, BX, NX, AS, BS, NS, NS2, NS3, HS, HS3, PS, PS3, T76, T56, T46, T6116, T6101, T6131, T2101, NMLC, HMLC'},
                                        {label: 'Primary Use', value: 'Direct drilling of hard rocks'},
                                        {label: 'Application', value: 'Core drilling where core samples are needed'},
                                        {label: 'Quality Level', value: 'Global quality standard'},
                                        {label: 'Material', value: 'Premium synthetic diamond powder'},
                                        {label: 'Matrix Selection', value: 'Large diamond + strong matrix (soft rocks), Medium diamond + medium matrix (medium rocks), Small diamond + soft matrix (hard rocks)'},
                                        {label: 'Key Features', value: 'Excellent drilling rate in strong rocks'},
                                        {label: 'Performance', value: 'Adapted to hard and strong rock conditions'},
                                        {label: 'Market Position', value: 'Leading company in domestic market'},
                                        {label: 'Customization', value: 'Can be produced in any sizes and specifications needed'},
                                        {label: 'Drilling Speed', value: 'Excellent compared to other companies'},
                                        {label: 'Components', value: 'Synthetic diamond powder, metal powder, premium shank'},
                                        {label: 'Rock Adaptability', value: 'Korea strong rock conditions optimized'},
                                        {label: 'Economic Benefit', value: 'High effectiveness and economical drilling operations'},
                                        {label: 'Classification', value: 'Multiple types based on purpose and ground conditions'},
                                        {label: 'Quality Assurance', value: 'Top quality raw materials and manufacturing standards'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/reaming-shells-1.jpg" alt="Diamond Reaming Shells" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">TS-DRS-002</h4>
                                <h3 class="product-name">Diamond Reaming Shells</h3>
                                <p class="product-description">Cylindrical diamond reaming shells connected with bits for simultaneous drilling and side surface grinding. Prevents early wear of bit outer diameter and hole wall deformation.</p>
                               <a href="downloadable content\TS-DRS-002.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'TS-DRS-002',
                                    name: 'Diamond Reaming Shells',
                                    standard: 'Professional Reaming Technology',
                                    description: 'Diamond Reaming Shell is connected with a Bit to be used, and the drilling by Bit and grinding of side surface can be done simultaneously, but the drilled hole should be kept not smaller than the diameter of the Bit (Reaming). It prevents early wear and tear of the outer diameter of the Bit, and also prevents vibration and deformation of the hole walls. Has a cylindrical shape with diamond particles attached at outside diameter and touchable screws at both ends.',
                                    image: 'images/reaming-shells-1.jpg',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'AX, NX, NXD3, AS, BS, NS, NS3, HS, PS, T Series'},
                                        {label: 'Connection', value: 'Connected with core bit for simultaneous operation'},
                                        {label: 'Function', value: 'Drilling by bit and grinding of side surface simultaneously'},
                                        {label: 'Purpose', value: 'Prevent early wear of bit outer diameter'},
                                        {label: 'Shape', value: 'Cylindrical with diamond particles on outside diameter'},
                                        {label: 'Construction', value: 'Touchable screws at both ends'},
                                        {label: 'Diameter Design', value: 'Outside diameter larger than that of the bit'},
                                        {label: 'Types Available', value: '2 types - general rocks and screw type for strong rocks'},
                                        {label: 'Material Quality', value: 'High quality shank and natural diamond'},
                                        {label: 'Performance', value: 'Excellent life span and reaming ability'},
                                        {label: 'Vibration Control', value: 'Prevents vibration during drilling operations'},
                                        {label: 'Hole Wall Protection', value: 'Prevents deformation of hole walls'},
                                        {label: 'Reaming Function', value: 'Keeps drilled hole not smaller than bit diameter'},
                                        {label: 'Quality Advantage', value: 'Superior life span compared to competitors'},
                                        {label: 'Diamond Type', value: 'Natural diamond for optimal performance'},
                                        {label: 'Applications', value: 'General rocks and strong rock formations'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/surface-set-diamond-core-bits-01.jpg" alt="Surface Set Diamond Core Bits" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">TS-SSDCB-003</h4>
                                <h3 class="product-name">Surface Set Diamond Core Bits</h3>
                                <p class="product-description">Surface set diamond core bits designed for drilling in soft ground conditions. Available in multiple types with superior life span using high quality natural diamonds.</p>
                                <a href="downloadable content\TS-SSDCB-003.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'TS-SSDCB-003',
                                    name: 'Surface Set Diamond Core Bits',
                                    standard: 'Soft Ground Drilling Technology',
                                    description: 'Surface Set Diamond Core Bits are specifically designed for drilling operations in soft ground conditions. These bits feature natural diamonds set on the surface of the cutting matrix, providing excellent cutting performance in soft formations. Available in multiple configurations including Multi Type and Round Type designs to suit different drilling requirements.',
                                    image: 'images/surface-set-diamond-core-bits-01.jpg',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'BS, NS, HS, PS, NW, HW'},
                                        {label: 'Primary Application', value: 'Drilling in soft ground conditions'},
                                        {label: 'Diamond Type', value: 'High quality natural diamonds'},
                                        {label: 'Multi Type Options', value: '3 Steps, 5 Steps, 7 Steps configurations'},
                                        {label: 'Round Type', value: 'Available for specific applications'},
                                        {label: 'Ground Conditions', value: 'Specifically designed for soft ground'},
                                        {label: 'Life Span', value: 'Superior compared to other companies products'},
                                        {label: 'Diamond Quality', value: 'Made of natural diamond of high quality'},
                                        {label: 'Setting Method', value: 'Surface set diamond configuration'},
                                        {label: 'Performance', value: 'Excellent cutting in soft formations'},
                                        {label: 'Design Options', value: 'Multiple step configurations and round type'},
                                        {label: 'Material Quality', value: 'Premium natural diamond materials'},
                                        {label: 'Durability', value: 'Extended service life in soft ground conditions'},
                                        {label: 'Manufacturing', value: 'Taesung quality standards and processes'},
                                        {label: 'Cost Effectiveness', value: 'Superior life span provides economic advantage'},
                                        {label: 'Applications', value: 'Soft soil, clay, sand, and similar formations'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/impregnated-diamond-casing-shoe-1.jpg" alt="Impregnated Diamond Casing Shoe" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">TS-IDCS-004</h4>
                                <h3 class="product-name">Impregnated Diamond Casing Shoe</h3>
                                <p class="product-description">Impregnated diamond casing shoes for drilling in soil or soft ground. Connected with casing pipe for drilling through collapsible holes with excellent quality synthetic diamonds.</p>
                                <a href="downloadable content\TS-IDCS-004.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'TS-IDCS-004',
                                    name: 'Impregnated Diamond Casing Shoe',
                                    standard: 'Advanced Casing Drilling Technology',
                                    description: 'Impregnated Diamond Casing Shoe is used for drilling in soil or soft ground conditions, connected with casing pipe and designed to drill through holes that can collapse anytime. During operations, it should be buried under the ground surface. The Casing Shoe Bit variant is specifically used for drilling soft ground with much gravel content. Made with synthetic diamond of top quality and proper matrix for excellent performance.',
                                    image: 'images/impregnated-diamond-casing-shoe-1.jpg',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'BW, NW, HW, PW'},
                                        {label: 'Primary Application', value: 'Drilling of soil or soft ground'},
                                        {label: 'Connection', value: 'Connected with casing pipe'},
                                        {label: 'Hole Condition', value: 'Designed for collapsible hole drilling'},
                                        {label: 'Installation', value: 'Buried under ground surface during operations'},
                                        {label: 'Casing Shoe Type', value: 'Standard impregnated diamond casing shoe'},
                                        {label: 'Casing Shoe Bit', value: 'Variant for soft ground with much gravel'},
                                        {label: 'Diamond Type', value: 'Synthetic diamond of top quality'},
                                        {label: 'Matrix', value: 'Proper matrix design for optimal performance'},
                                        {label: 'Quality Level', value: 'Excellent quality manufacturing'},
                                        {label: 'Ground Types', value: 'Soil, soft ground, gravelly soft ground'},
                                        {label: 'Drilling Method', value: 'Casing advance drilling technique'},
                                        {label: 'Stability', value: 'Prevents hole collapse during drilling'},
                                        {label: 'Material Quality', value: 'Top grade synthetic diamonds'},
                                        {label: 'Manufacturing', value: 'Taesung quality standards and expertise'},
                                        {label: 'Performance', value: 'Excellent drilling in challenging soft formations'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/pdc-non-core-bits.jpg" alt="PDC Bits & Tricone Bits" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">TS-PDC-005</h4>
                                <h3 class="product-name">PDC Bits & Tricone Bits</h3>
                                <p class="product-description">Professional PDC (Polycrystalline Diamond Compact) bits and Tricone bits for various drilling applications. High-performance drilling solutions for different geological formations.</p>
                                <a href="downloadable content\TS-PDC-005.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'TS-PDC-005',
                                    name: 'PDC Bits & Tricone Bits',
                                    standard: 'Advanced Drilling Bit Technology',
                                    description: 'Comprehensive range of PDC (Polycrystalline Diamond Compact) bits and Tricone bits designed for various drilling applications. These high-performance drilling solutions are engineered to handle different geological formations and drilling conditions. PDC bits offer excellent cutting efficiency and extended life in suitable formations, while Tricone bits provide versatile drilling capability across various rock types.',
                                    image: 'images/pdc-non-core-bits.jpg',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Bit Types', value: 'PDC (Polycrystalline Diamond Compact) Bits, Tricone Bits'},
                                        {label: 'PDC Technology', value: 'Polycrystalline diamond compact cutting elements'},
                                        {label: 'Tricone Design', value: 'Three-cone roller bit configuration'},
                                        {label: 'Applications', value: 'Various drilling applications and geological formations'},
                                        {label: 'Performance', value: 'High-performance drilling solutions'},
                                        {label: 'PDC Advantages', value: 'Excellent cutting efficiency and extended service life'},
                                        {label: 'Tricone Advantages', value: 'Versatile drilling capability across rock types'},
                                        {label: 'Formation Compatibility', value: 'Different geological formations and drilling conditions'},
                                        {label: 'Cutting Efficiency', value: 'Optimized for maximum drilling performance'},
                                        {label: 'Durability', value: 'Extended service life in suitable applications'},
                                        {label: 'Quality Standards', value: 'Taesung manufacturing excellence'},
                                        {label: 'Range', value: 'Comprehensive selection for various needs'},
                                        {label: 'Professional Grade', value: 'High-performance drilling solutions'},
                                        {label: 'Versatility', value: 'Suitable for multiple drilling scenarios'},
                                        {label: 'Innovation', value: 'Advanced drilling bit technology'},
                                        {label: 'Reliability', value: 'Consistent performance across applications'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/core-barrels-1.jpg" alt="Core Barrels" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">TS-CB-006</h4>
                                <h3 class="product-name">Core Barrels</h3>
                                <p class="product-description">Comprehensive range of core barrels including single, double, triple tube, and wire line systems. Made of best quality raw materials for excellent life span and currently exported worldwide.</p>
                                <a href="downloadable content\TS-CB-006.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'TS-CB-006',
                                    name: 'Core Barrels',
                                    standard: 'Professional Core Sampling Systems',
                                    description: 'Core barrels are devices used to take cores drilled by the core bit, made of high-quality pipe materials. Available in multiple configurations including Single Tube, Double Tube, Triple Tube, and Wire Line systems. Each type is designed for specific applications and ground conditions, from simple core collection to complex geological sampling in challenging formations.',
                                    image: 'images/core-barrels-1.jpg',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'AX, BX, NX, NXD3, AS, BS, NS, NS3, HS, HS3, T76, T56'},
                                        {label: 'Single Tube (AX, BX, NX)', value: 'Used to increase collection rate at even ground, cannot be used in easily collapsed ground'},
                                        {label: 'Double Tube (AX, BX, NX, NXD3, T76, T56)', value: 'Outer and inner tube design, circulation water passes between tubes, increases core collection rate'},
                                        {label: 'Triple Tube (NS3, HS3, PS3)', value: 'Core case tube inside inner tube, easy removal with cores, for weak grounds or broken layers'},
                                        {label: 'Wire Line (BS, NS, HS, PS)', value: 'Inner tube hoisted with wire rope, reduces rod hoisting, ideal for deep drilling'},
                                        {label: 'Wire Line Components', value: 'Outer Tube, Inner Tube, Over Shot, Wire Line Drill Rods, Hoisting Plugs'},
                                        {label: 'Export Markets', value: 'Kazakhstan, Mongolia, Uzbekistan and various countries'},
                                        {label: 'Material Quality', value: 'Best quality raw materials appropriate for drilling'},
                                        {label: 'Performance', value: 'Excellent life span and quality'},
                                        {label: 'Core Collection', value: 'Optimized for maximum core recovery rates'},
                                        {label: 'Deep Drilling', value: 'Wire line system ideal for deep layer drilling'},
                                        {label: 'Efficiency', value: 'Reduced hoisting time and labor with wire line system'},
                                        {label: 'Safety', value: 'Less vibration, reduced hole collapse risk'},
                                        {label: 'Versatility', value: 'Multiple types for different geological conditions'},
                                        {label: 'Global Recognition', value: 'Currently exported to various countries worldwide'},
                                        {label: 'Manufacturing Standards', value: 'Taesung quality excellence and precision'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/drill-rods-casing-pipe-3.jpg" alt="Drill Rods & Casing Pipe" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">TS-DRC-007</h4>
                                <h3 class="product-name">Drill Rods & Casing Pipe</h3>
                                <p class="product-description">Superior drill rods and casing pipes that meet 100% of drilling standards. Made from best quality raw materials with precise specifications and heat treatment for optimal performance.</p>
                                <a href="downloadable content\TS-DRC-007.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'TS-DRC-007',
                                    name: 'Drill Rods & Casing Pipe',
                                    standard: 'Premium Drilling Equipment Standards',
                                    description: 'Comprehensive range of drill rods and casing pipes manufactured to meet 100% of drilling standards using the best quality raw materials. Drill rods are maintained by the chuck of the drill rig and convey rotation, pressure, and drilling water while also handling rapid cooling and slime removal. Casing pipes provide structural support and prevent hole collapse during drilling operations.',
                                    image: 'images/drill-rods-casing-pipe-3.jpg',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Drill Rod Sizes', value: 'AW, BW, N, NS-3, H, P, NW, HW, HWT'},
                                        {label: 'P Drill Rods', value: '3000mm length, O.D: 114.3-114.5mm, I.D: 101.6-101.80mm'},
                                        {label: 'H Drill Rods', value: '3000mm length, O.D: 88.90-89.15mm, I.D: 77.8-78.0mm, Pin & Box (heat treatment)'},
                                        {label: 'N Drill Rods', value: '3000mm length, O.D: 69.85-70.05mm, I.D: 60.12-60.33mm'},
                                        {label: 'B Drill Rods', value: '3000mm length, O.D: 55.6-55.8mm, I.D: 46.0-46.2mm'},
                                        {label: 'Casing Pipe Sizes', value: 'RW, EW, AW, BW, NW, HW, PW (36.5mm to 139.7mm O.D)'},
                                        {label: 'Tensile Strength', value: 'Min. 900 N/mm²'},
                                        {label: 'Yield Stress', value: 'Min. 800 N/mm²'},
                                        {label: 'Extension', value: 'Min. 14%'},
                                        {label: 'Surface Hardness', value: 'HRC 30 ~ 35'},
                                        {label: 'Construction', value: 'Seamless, cold drawing'},
                                        {label: 'Roundness', value: '0.2 Max Standard'},
                                        {label: 'Straightness', value: '0.8/1000mm (Standard)'},
                                        {label: 'Thread Treatment', value: 'Pin & Box thread - High Frequency Heat Treated'},
                                        {label: 'Quality Standards', value: 'Meet 100% drilling standards'},
                                        {label: 'Material Quality', value: 'Best quality raw materials suitable for drilling'},
                                        {label: 'Manufacturing Process', value: 'Superior products with precision manufacturing'}
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
                        <li>Supply of drilling machine equipment</li>
                        <li>Equipment rental and leasing</li>
                        <li>Maintenance and repair services</li>
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

