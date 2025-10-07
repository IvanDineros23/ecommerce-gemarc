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
                            <li><a href="cement-mortar.html" class="active">Cement & Mortar</a></li>
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
                        <li><a href="asphalt-bitumen.html">Asphalt & Bitumen</a></li>
                        <li><a href="cement-mortar.html" class="active">Cement & Mortar</a></li>
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
            <h1>Cement & Mortar Testing Equipment</h1>
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
                <p>We provide comprehensive cement and mortar testing equipment to ensure quality control in construction materials. Our equipment meets international standards for testing cement properties and mortar performance.</p>
                
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
                                <img src="images/E070.jpg" alt="E070 Autoclave" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">E070</h4>
                                <h3 class="product-name">Autoclave</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM C151, AASHTO T107</p>
                                <p class="product-description">It consists of a high-pressure boiler made from special alloy steel, inside dia. 154x430 mm high, receiving a holding rack for 10 cement specimens. The heating system is achieved by electric resistances.</p>
                                <a href="downloadable content\E070.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'E070',
                                    name: 'Autoclave',
                                    standard: 'ASTM C151, AASHTO T107',
                                    description: 'It consists of a high pressure boiler made from special alloy steel, inside dia. 154x430 mm high, receiving a holding rack for 10 cement specimens. The heating system is achieved by electric resistances. The separate control panel encloses a digital thermometer to visualize the boiler temperature, pressure gauge scale 0 - 600 psi with built in pressure regulator and power switches. Supplied complete with rack for holding the specimens and safety valve with ISPEL calibration certificate.',
                                    image: 'images/E070.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                        {label: 'Application', value: 'SOUNDNESS (EXPANSION) OF PORTLAND CEMENT'},
                                        {label: 'Boiler Material', value: 'High pressure boiler made from special alloy steel'},
                                        {label: 'Internal Dimensions', value: 'Inside dia. 154x430 mm high'},
                                        {label: 'Specimen Capacity', value: 'Holding rack for 10 cement specimens'},
                                        {label: 'Heating System', value: 'Electric resistances'},
                                        {label: 'Control Panel', value: 'Separate control panel with digital thermometer'},
                                        {label: 'Temperature Display', value: 'Digital thermometer to visualize boiler temperature'},
                                        {label: 'Pressure Gauge', value: 'Scale 0 - 600 psi with built in pressure regulator'},
                                        {label: 'Controls', value: 'Power switches'},
                                        {label: 'Included', value: 'Complete with rack for holding specimens'},
                                        {label: 'Safety Features', value: 'Safety valve with ISPEL calibration certificate'},
                                        {label: 'Power Supply', value: '230V 1ph 50Hz 3500W 295psi'},
                                        {label: 'Dimensions', value: '490x490x980 mm'},
                                        {label: 'Weight', value: '150 Kg approx.'},
                                        {label: 'Note', value: 'Not sellable on CE market'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/E009-KIT.jpg" alt="E009-KIT Manual Blaine Air Permeability Apparatus" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">E009-KIT</h4>
                                <h3 class="product-name">Manual Blaine Air Permeability Apparatus</h3>
                                <p class="product-standard"><strong>Standard:</strong> AASHTO T153, BS 4359-2, EN 196-6, ASTM C204</p>
                                <p class="product-description">This apparatus is used to determine the fineness of Portland cement in terms of the specific surface expressed as total surface area in square centimetres per gram of cement.</p>
                                <a href="downloadable content\E009-KIT.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'E009-KIT',
                                    name: 'Manual Blaine Air Permeability Apparatus',
                                    standard: 'EN 196-6, ASTM C204, AASHTO T153, BS 4359-2',
                                    description: 'This apparatus is used to determine the fineness of Portland cement in terms of the specific surface expressed as total surface area in square centimetres per gram of cement. The apparatus is supplied with a glass U-tube manometer with valve, steel stand, test cell with disk and plunger all in stainless steel, rubber aspirator bulb, 1000 filter paper disks, manometric liquid, vaseline grease for better coupling tube/cell, funnel, brush. The instrument conforms to EN 196-6 Standard and it is comparable to ASTM, AASHTO and BS standards.',
                                    image: 'images/E009-KIT.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                        {label: 'Function', value: 'Determine the fineness of Portland cement'},
                                        {label: 'Measurement', value: 'Specific surface expressed as total surface area in square centimetres per gram of cement'},
                                        {label: 'Manometer', value: 'Glass U-tube manometer with valve'},
                                        {label: 'Stand', value: 'Steel stand'},
                                        {label: 'Test Cell', value: 'Test cell with disk and plunger all in stainless steel'},
                                        {label: 'Aspirator', value: 'Rubber aspirator bulb'},
                                        {label: 'Filter Papers', value: '1000 filter paper disks included'},
                                        {label: 'Manometric Liquid', value: 'Included'},
                                        {label: 'Coupling', value: 'Vaseline grease for better coupling tube/cell'},
                                        {label: 'Accessories', value: 'Funnel and brush included'},
                                        {label: 'Primary Standard', value: 'EN 196-6'},
                                        {label: 'Compatible Standards', value: 'ASTM, AASHTO and BS'},
                                        {label: 'Dimensions', value: '220x180x470 mm'},
                                        {label: 'Weight', value: '12 Kg approx.'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/E138.jpg" alt="E138 Large Capacity Curing Cabinet" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">E138</h4>
                                <h3 class="product-name">Large Capacity Curing Cabinet</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 196-1, 196-08 | ISO 679 | ASTM C109, C511</p>
                                <p class="product-description">For curing large quantities of mortar, cement and concrete specimens at controlled humidity and temperature</p>
                                <a href="downloadable content\E138.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'E138',
                                    name: 'Large Capacity Curing Cabinet',
                                    standard: 'EN 196-1, EN 196-08, ISO 679, ASTM C109, ASTM C511',
                                    description: 'For curing large quantities of mortar, cement and concrete specimens at controlled humidity and temperature. Aluminium and polycarbonate made, it is complete with a precision digital thermostat and four robust shelves. The humidity from 90% to saturation is maintained through water nebulizers activated by compressed air, and the temperature by an immersion heater and refrigerator unit (accessory mod. E141). The cabinet requires a compressed air source (see accessory).',
                                    image: 'images/E138.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                        {label: 'Application', value: 'Curing large quantities of mortar, cement and concrete specimens'},
                                        {label: 'Control', value: 'Controlled humidity and temperature'},
                                        {label: 'Construction', value: 'Aluminium and polycarbonate made'},
                                        {label: 'Thermostat', value: 'Precision digital thermostat'},
                                        {label: 'Shelves', value: 'Four robust shelves'},
                                        {label: 'Humidity Range', value: 'From 90% to saturation'},
                                        {label: 'Humidity System', value: 'Water nebulizers activated by compressed air'},
                                        {label: 'Temperature Control', value: 'Immersion heater and refrigerator unit (accessory mod. E141)'},
                                        {label: 'Temperature Range', value: 'From ambient to +30 °C'},
                                        {label: 'Temperature Accuracy', value: '± 1 °C'},
                                        {label: 'Air Supply Required', value: 'Compressed air source (see accessory)'},
                                        {label: 'Inside Dimensions', value: '1090x470x1200 mm'},
                                        {label: 'Overall Dimensions', value: '1350x570x1600 mm'},
                                        {label: 'Power Supply', value: '230 V 1ph 50/60 Hz 2000 W'},
                                        {label: 'Weight', value: '100 Kg approx.'}
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
                                <img src="images\nl3031x006-01.jpg" alt="NL 3031 X / 006 Mortar Mixer (Automatic)" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 3031 X / 006</h4>
                                <h3 class="product-name">Mortar Mixer (Automatic)</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 196-1, ASTM C 305, AASHTO T 162, ISO 679</p>
                                <p class="product-description">This apparatus has specially been designed to prepare cement mortar for strength determination as specified in standard. It can also be used in mixing lime with pozzolanic materials for determination of lime reactivity (as per IS 1727) & for uniform mixing of soils with additives such as lime, cement, etc.</p>
                                <a href="downloadable content\NL 3031 X _ 006.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 3031 X / 006',
                                    name: 'Mortar Mixer (Automatic)',
                                    standard: 'EN 196-1, ASTM C 305, AASHTO T 162, ISO 679',
                                    description: 'Automatic mortar mixers are machines designed specifically to streamline the mixing process. In construction, mortar is a vital material used for binding bricks, stones, or other building units together. This apparatus has specially been designed to prepare cement mortar for strength determination as specified in standard. It can also be used in mixing lime with pozzolanic materials for determination of lime reactivity & for uniform mixing of soils with additives such as lime, cement, etc. New Mortar Mixer comes with built in door for better safety.',
                                    image: 'images\\nl3031x006-01.jpg',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model Number', value: 'NL 3031 X / 006'},
                                        {label: 'Capacity', value: '5L'},
                                        {label: 'Planetary Speeds', value: '62/125 r.p.m.'},
                                        {label: 'Beater Speeds', value: '140/285 r.p.m.'},
                                        {label: 'Dimension', value: '480 (L) x 313 (W) x 770 (H) mm'},
                                        {label: 'Approx. Weight', value: '44 kg'},
                                        {label: 'Power', value: '220 V, 1 ph, 50 / 60 Hz, 0.5 Hp'},
                                        {label: 'Automation', value: 'Automatically mix mortar ingredients without manual intervention'},
                                        {label: 'Loading/Unloading', value: 'Efficient mechanisms with tilting drums or removable mixing paddles'},
                                        {label: 'Power Options', value: 'Can be powered by electricity, gasoline, or diesel'},
                                        {label: 'Speed Control', value: 'Variable speed settings for different mortar types and consistency'},
                                        {label: 'Safety Feature', value: 'Built-in door for better safety'},
                                        {label: 'Applications', value: 'Cement mortar preparation, lime with pozzolanic materials mixing, soil additives mixing'},
                                        {label: 'Design', value: 'Rotating drum or paddles with automatic rotation and agitation'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\nl3004a001-01.jpg" alt="NL 3004 A / 001 Flow Cone Apparatus" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 3004 A / 001</h4>
                                <h3 class="product-name">Flow Cone Apparatus</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 445</p>
                                <p class="product-description">Used for determining the flow properties of mortars, grouts, muds and many other type of fluid materials.</p>
                               <a href="downloadable content\NL 3004 A _ 001.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 3004 A / 001',
                                    name: 'Flow Cone Apparatus',
                                    standard: 'EN 445',
                                    description: 'Used for determining the flow properties of mortars, grouts, muds and many other type of fluid materials. This apparatus is designed to measure the flow proprieties of grouts, muds & other fluid materials, providing essential data for construction and engineering applications where material flow characteristics are critical for proper application and performance.',
                                    image: 'images\\nl3004a001-01.jpg',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model Number', value: 'NL 3004 A / 001'},
                                        {label: 'Application', value: 'Flow Properties Of Grouts, Muds & Other Fluid Materials'},
                                        {label: 'Function', value: 'Determining the flow properties of mortars, grouts, muds and fluid materials'},
                                        {label: 'Dimension', value: '240 (L) x 160 (W) x 610 (H) mm'},
                                        {label: 'Approx. Weight', value: '7 kg'},
                                        {label: 'Material Testing', value: 'Mortars, grouts, muds, and various fluid materials'},
                                        {label: 'Design', value: 'Cone-shaped apparatus for consistent flow measurement'},
                                        {label: 'Purpose', value: 'Quality control and material characterization'},
                                        {label: 'Construction Applications', value: 'Essential for proper material application and performance evaluation'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images\nl3012x004-01-01.jpg" alt="NL 3012 X / 004 Vicat Apparatus, Manual, ASTM & AASHTO" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 3012 X / 004</h4>
                                <h3 class="product-name">Vicat Apparatus, Manual, ASTM & AASHTO</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM C187-04, ASTM C191-04, AASHTO T 129-06, AASHTO T131-06</p>
                                <p class="product-description">The vicat frame consists essentially of a metal stand with a sliding rod. An adjustable indicator moves over a graduated scale. The needle or plunger is attached to the bottom end of the rod to make up the test weight of 300 g.</p>
                               <a href="downloadable content\NL 3012 X _ 004.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                               <button class="expand-btn" onclick="openProductModal({
                                    code: 'NL 3012 X / 004',
                                    name: 'Vicat Apparatus, Manual, ASTM & AASHTO',
                                    standard: 'ASTM C187-04, ASTM C191-04, AASHTO T 129-06, AASHTO T131-06',
                                    description: 'The Vicat Apparatus is used to determine the setting time and consistency of cement paste, mortar, and concrete. The apparatus consists of a plunger, a mold, and a measuring device. The test involves placing a cement sample in the mold and applying a standard plunger to create an indentation in the sample. The setting time is determined by measuring the depth of penetration of the plunger over time. The vicat frame consists essentially of a metal stand with a sliding rod.',
                                    image: 'images\\nl3012x004-01-01.jpg',
                                    manufacturer: 'NL Scientific',
                                    manufacturerUrl: 'https://nl-test.com/',
                                    specs: [
                                        {label: 'Model Number', value: 'NL 3012 X / 004'},
                                        {label: 'Standard Compliance', value: 'ASTM / AASHTO'},
                                        {label: 'Dimension', value: '215(W)x160(L)x323(H) mm'},
                                        {label: 'Approx. Weight', value: '4.0 kg'},
                                        {label: 'Function', value: 'Determine setting time and consistency of cement paste, mortar, and concrete'},
                                        {label: 'Metal Stand', value: 'Metal frame with sliding rod mechanism'},
                                        {label: 'Adjustable Indicator', value: 'Moves over graduated scale for accurate measurement'},
                                        {label: 'Plunger/Needle', value: 'Attached to bottom end of sliding rod'},
                                        {label: 'Test Weight', value: '300 g standard test weight'},
                                        {label: 'Graduated Scale', value: 'Marked in millimeters for precise penetration measurement'},
                                        {label: 'Accessories', value: 'ASTM & AASHTO compliant accessories included'},
                                        {label: 'Measurement', value: 'Depth of penetration over time for setting time determination'},
                                        {label: 'Application', value: 'Construction material testing and quality control'}
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
                        <li>Supply of cement and mortar testing equipment</li>
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

