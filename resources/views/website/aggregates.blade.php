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
                            <li><a href="aggregates.html" class="active">Aggregates</a></li>
                            <li><a href="asphalt-bitumen.html">Asphalt & Bitumen</a></li>
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
                        <li><a href="aggregates.html" class="active">Aggregates</a></li>
                        <li><a href="asphalt-bitumen.html">Asphalt & Bitumen</a></li>
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
            <h1>Aggregates Testing Equipment</h1>
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
                <p>We provide comprehensive aggregates testing equipment and services to ensure the quality and performance of construction materials. Our range includes equipment for testing various properties of aggregates used in construction and infrastructure projects.</p>
                
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
                                <img src="images/A024N.jpg" alt="A024N Ceramic Muffle Furnace" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">A024N</h4>
                                <h3 class="product-name">Ceramic Muffle Furnace</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 196-2, EN 196-21, EN 459-2</p>
                                <p class="product-description">Used to determine the loss on ignition of cement and lime; chloride, carbon dioxide, alkali content of cement.</p>
                                <a href="downloadable content/A024N.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openA024NModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/A075N.jpg" alt="A075N Los Angeles Machine" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">A075N</h4>
                                <h3 class="product-name">LOS ANGELES ABRASION MACHINE</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM C131, EN 12697-17, EN 12697-43, NF P18-573, AASHTO T96, CNR N. 34</p>
                                <p class="product-description">Used to determine the resistance of aggregates to abrasion.</p>
                                <a href="downloadable content/A075N.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'A075N',
                                    name: 'LOS ANGELES ABRASION MACHINE',
                                    standard: 'ASTM C131, EN 12697-17, EN 12697-43, NF P18-573, AASHTO T96, CNR N. 34',
                                    description: 'Used to determine the resistance of aggregates to abrasion.',
                                    image: 'images/A075N.jpg',
                                    manufacturer: 'MATEST',
                                    manufacturerUrl: 'https://www.matest.com/',
                                    specs: [
                                        {label: 'Cylinder Dimensions', value: '711 mm (ID) x 508 mm (Length)'},
                                        {label: 'Rotation Speed', value: '31-33 rpm'},
                                        {label: 'Material', value: 'Heavy steel construction'},
                                        {label: 'Drive', value: 'Gear motor with speed reducer'},
                                        {label: 'Counter', value: 'Automatic digital counter, presettable'},
                                        {label: 'Filling Opening', value: 'Counterbalanced, push-button positioning'},
                                        {label: 'Control Panel', value: 'Wall fixed or bench placed'},
                                        {label: 'Power Supply', value: '230V 50Hz 1ph 750W'},
                                        {label: 'Dimensions', value: '1000x800x1000 mm'},
                                        {label: 'Weight', value: '370 kg approx.'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/A125N.jpg" alt="A125N Digital Point Load Tester" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">A125N</h4>
                                <h3 class="product-name">Digital Point Load Tester 56 KN (ROCK STRENGTH INDEX)</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM D5731, ISRM</p>
                                <p class="product-description">Used to determine the strength values of a rock specimen both in the field and in the laboratory.</p>
                                <a href="downloadable content/A125N.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openA125NModal()">
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
        <img src="images/nl1002x002-01.jpg" alt="NL 1002 X / 002 Aggregate Impact Value Apparatus (AIV)" class="product-img">
    </div>
    <div class="product-info">
        <h4 class="product-code">NL 1002 X / 002</h4>
        <h3 class="product-name">Aggregate Impact Value Apparatus (AIV)</h3>
        <p class="product-standard"><strong>Standard:</strong> BS 812, NF P18-574</p>
        <p class="product-description">
            Used to determine the aggregate impact value by measuring the resistance of an aggregate to sudden impact or shock loading,
            which may vary from its resistance to gradually applied compressive loads on construction materials such as crushed stones and gravel.
            It is determined by subjecting a sample of aggregate to a standard amount of impact, usually in a testing machine,
            and then measuring the percentage of fines produced.
        </p>
        <a href="downloadable content/NL 1002 X _ 002.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
        <button class="expand-btn" onclick="openNL1002X002Modal()">
            <i class="fas fa-eye"></i> View Details
        </button>
    </div>
</div>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/NL-1015-X-011.jpg" alt="NL 1015 X / 011 ECO-SMARTZ Multi Amplitude Triple Motion Sieves Shaker" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 1015 X / 011</h4>
                                <h3 class="product-name">Sieve Shaker, Triple Motion (From 200 up to 450 mm Dia.)</h3>
                                <p class="product-standard"><strong>Standard:</strong> EN 932-5, ISO 3310-1, ASTM C136</p>
                                <p class="product-description">Triple motion functionality incorporating vertical, horizontal, and rotational motions for thorough and efficient sieving. Features variable speed control, digital timer, and can accommodate sieves from 200mm to 450mm diameter.</p>
                                <a href="downloadable content/NL 1015 X _ 011.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openNL1015X011Modal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/NL-1003-X.jpg" alt="NL 1003 X Bulk Density Measurement" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">NL 1003 X</h4>
                                <h3 class="product-name">Bulk Density Measure</h3>
                                <p class="product-standard"><strong>Standard:</strong> ASTM C29, BS EN 1097-3</p>
                                <p class="product-description">Steel constructed with handles for capacity 1 litre and above. Used to determine the loose bulk density and void of aggregate. Available in multiple capacities for different testing requirements.</p>
                                <a href="downloadable content/NL 1003 X.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openNL1003XModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- LabTech BioMedic Products Section -->

                <div class="brand-section labtech-section">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <img src="images/partnership/labtech_logo.jpg" alt="LabTech BioMedic" class="brand-logo-img">
                        </div>
                    </div>
                    <div class="products-grid">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/LDO-060E.jpg" alt="LDO-060E Universal Drying Oven" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">LDO-060E</h4>
                                <h3 class="product-name">Natural Convection Oven</h3>
                                <p class="product-standard"><strong>Features:</strong> Advanced Temperature Control & Natural Convection</p>
                                <p class="product-description">Stainless Steel chamber for excellent corrosion resistance and easy cleaning. Insulation and sealing structure with silicone packing enable excellent temp. uniformity. Natural convection of heated air w/o a separate fan. Temp. auto - tuning function available.</p>
                                <a href="downloadable content/LDO-060E.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openLDO060EModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/LBD-2045-D.jpg" alt="LBD-2045D Hotplate & Stirrer" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">LBD-2045D</h4>
                                <h3 class="product-name">Hotplate & Stirrer</h3>
                                <p class="product-standard"><strong>Features:</strong> High Density Ceramic Coating & Temperature Control</p>
                                <p class="product-description">High density ceramic coated stainless steel top plate for excellent chemical resistance. High class powder coated aluminium casting body for excellent heat and corrosion resistance. A heater that is durable and excellent in heat transfer is equipped.</p>
                                <a href="downloadable content/LBD-2045D.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'LBD-2045D',
                                    name: 'Hotplate & Stirrer',
                                    standard: 'High Density Ceramic Coating & Temperature Control',
                                    description: 'High density ceramic coated stainless steel top plate for excellent chemical resistance. High class powder coated aluminium casting body for excellent heat and corrosion resistance. A heater that is durable and excellent in heat transfer is equipped.',
                                    image: 'images/LBD-2045-D.jpg',
                                    manufacturer: 'LabTech BioMedic',
                                    manufacturerUrl: 'https://www.labtech.co.kr/',
                                    specs: [
                                        {label: 'Top Plate', value: 'High density ceramic coated stainless steel for excellent chemical resistance'},
                                        {label: 'Body', value: 'High class powder coated aluminium casting body for excellent heat and corrosion resistance'},
                                        {label: 'Heater', value: 'Durable heater with excellent heat transfer'},
                                        {label: 'Application', value: 'Laboratory heating and stirring applications'},
                                        {label: 'Features', value: 'Temperature control and stirring capabilities'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="images/LWB-111D.jpg" alt="LWB-111D Digital Water Bath" class="product-img">
                            </div>
                            <div class="product-info">
                                <h4 class="product-code">LWB-111D</h4>
                                <h3 class="product-name">Digital Water Bath</h3>
                                <p class="product-standard"><strong>Features:</strong> Stainless Steel Construction & Auto Tuning</p>
                                <p class="product-description">Durable to use in many fields for general purpose. Seamless stainless-steel bath for excellent corrosion resistance and easy cleaning. Heater cover is provided to protect the heater and sensor from unexpected damage. Temp. auto tuning function available</p>
                                <a href="downloadable content/LWB-111D.pdf" class="expand-btn" target="_blank"><i class="fas fa-file-pdf"></i> View PDF Specs</a>
                                <button class="expand-btn" onclick="openProductModal({
                                    code: 'LWB-111D',
                                    name: 'Digital Water Bath',
                                    standard: 'Stainless Steel Construction & Auto Tuning',
                                    description: 'Durable to use in many fields for general purpose. Seamless stainless-steel bath for excellent corrosion resistance and easy cleaning. Heater cover is provided to protect the heater and sensor from unexpected damage. Temp. auto tuning function available',
                                    image: 'images/LWB-111D.jpg',
                                    manufacturer: 'LabTech BioMedic',
                                    manufacturerUrl: 'https://www.labtech.co.kr/',
                                    specs: [
                                        {label: 'General Purpose', value: 'Durable to use in many fields for general purpose'},
                                        {label: 'Bath Construction', value: 'Seamless stainless steel bath for excellent corrosion resistance and easy cleaning'},
                                        {label: 'Design', value: 'Compact design to be able to use in various places'},
                                        {label: 'Protection', value: 'Heater cover is provided to protect the heater and sensor from unexpected damage'},
                                        {label: 'Standard Accessory', value: 'Stainless steel flat lid is included as standard'},
                                        {label: 'Controller', value: 'Digital PID controller provides precise control'},
                                        {label: 'Auto-Tuning', value: 'Temperature auto-tuning function available'},
                                        {label: 'Timer', value: 'Timer 99hr. 59min. available (Timer end alarm available)'},
                                        {label: 'Temperature Alarm', value: 'High/Low temperature alarm'},
                                        {label: 'Memory Function', value: 'Setting value is preserved even when the power supply is cut and resupplied'},
                                        {label: 'Temperature Range', value: 'Ambient + 5°C to 99°C'},
                                        {label: 'Material Interior', value: 'Seamless stainless steel (STS304)'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <div class="product-specs-dropdown" id="specs-lwb111d" style="display:none;">
                                    <ul>
                                        <li><strong>General Purpose:</strong> Durable to use in many fields for general purpose</li>
                                        <li><strong>Bath Construction:</strong> Seamless stainless steel bath for excellent corrosion resistance and easy cleaning</li>
                                        <li><strong>Design:</strong> Compact design to be able to use in various places</li>
                                        <li><strong>Protection:</strong> Heater cover is provided to protect the heater and sensor from unexpected damage</li>
                                        <li><strong>Standard Accessory:</strong> Stainless steel flat lid is included as standard</li>
                                        <li><strong>Controller:</strong> Digital PID controller provides precise control</li>
                                        <li><strong>Auto-Tuning:</strong> Temperature auto-tuning function available</li>
                                        <li><strong>Timer:</strong> Timer 99hr. 59min. available (Timer end alarm available)</li>
                                        <li><strong>Temperature Alarm:</strong> High/Low temperature alarm</li>
                                        <li><strong>Memory Function:</strong> Setting value is preserved even when the power supply is cut and resupplied</li>
                                        <li><strong>Temperature Range:</strong> Ambient + 5°C to 99°C</li>
                                        <li><strong>Controller:</strong> Digital PID controller with LED display</li>
                                        <li><strong>Timer:</strong> 99 hr. 59 min. / Continuous</li>
                                        <li><strong>Material Interior:</strong> Seamless stainless steel (STS304)</li>
                                        <li><strong>Material Exterior:</strong> Powder coated steel</li>
                                        <li><strong>Safety Features:</strong> Over temperature protection, Earth leakage circuit breaker</li>
                                        <li><strong>Electric Supply:</strong> 110 V, 60 Hz or 220 V, 50 or 60 Hz, 1 Phase</li>
                                        <li><strong>Power Consumption (220V):</strong> 3 A (LWB-106D), 4 A (LWB-111D), 7 A (LWB-122D)</li>
                                    </ul>
                                </div>
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
                        <li>Supply of aggregates testing equipment</li>
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
                
                <div class="modal-contact-section">
                    <h4 class="modal-contact-title">Need More Information?</h4>

                   <!-- GEMARC Inline Inquiry (drop-in) -->
                    <div class="gem-inquiry" data-emails="sales@gemarcph.com,technical@gemarcph.com">
                    <button type="button" class="modal-contact-btn modal-email-btn js-show-inquiry is-full">
                        <i class="fas fa-envelope"></i> Send Inquiry
                    </button>

                      <!-- PDF Specs Button -->
                        <div class="modal-downloads" style="margin-top:12px;">
                        <!-- Removed redundant View PDF Specs button from modal -->
                        </div>


                    <!-- auto-filled panel; leave empty -->
                    <div class="inquiry-email-panel js-inquiry-panel" hidden></div>
                    </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
    // Product modal functions for aggregates page
    function openA024NModal() {
        openProductModal({
            code: 'A024N',
            name: 'Ceramic Muffle Furnace',
            standard: 'EN 196-2, EN 196-21, EN 459-2',
            description: 'Used to determine the loss on ignition of cement and lime; chloride, carbon dioxide, alkali content of cement.',
            image: 'images/A024N.jpg',
            manufacturer: 'MATEST',
            manufacturerUrl: 'https://www.matest.com/',
            pdf: 'downloadable content/A024N.pdf',
            specs: [
                {label: 'Temperature Range', value: 'Up to 1100°C'},
                {label: 'Chamber Size', value: '300 x 200 x 100 mm'},
                {label: 'Heating Elements', value: 'Silicon Carbide'},
                {label: 'Controller', value: 'Digital PID controller'},
                {label: 'Accuracy', value: '±2°C'},
                {label: 'Power Supply', value: '230V, 50/60Hz'},
                {label: 'Power', value: '3.5 kW'},
                {label: 'Safety Features', value: 'Over-temp protection, door safety switch'}
            ]
        });
    }

    function openA075NModal() {
        openProductModal({
            code: 'A075N',
            name: 'LOS ANGELES ABRASION MACHINE',
            standard: 'ASTM C131, EN 12697-17, EN 12697-43, NF P18-573, AASHTO T96, CNR N. 34',
            description: 'Used to determine the resistance of aggregates to abrasion.',
            image: 'images/A075N.jpg',
            manufacturer: 'MATEST',
            manufacturerUrl: 'https://www.matest.com/',
            pdf: 'downloadable content/A075N.pdf',
            specs: [
                {label: 'Cylinder Dimensions', value: '711 mm (ID) x 508 mm (Length)'},
                {label: 'Rotation Speed', value: '31-33 rpm'},
                {label: 'Material', value: 'Heavy steel construction'},
                {label: 'Drive', value: 'Gear motor with speed reducer'},
                {label: 'Counter', value: 'Automatic digital counter, presettable'},
                {label: 'Filling Opening', value: 'Counterbalanced, push-button positioning'},
                {label: 'Control Panel', value: 'Wall fixed or bench placed'},
                {label: 'Power Supply', value: '230V 50Hz 1ph 750W'},
                {label: 'Dimensions', value: '1000x800x1000 mm'},
                {label: 'Weight', value: '370 kg approx.'}
            ]
        });
    }

    function openA125NModal() {
        openProductModal({
            code: 'A125N',
            name: 'Digital Point Load Tester 56 KN (ROCK STRENGTH INDEX)',
            standard: 'ASTM D5731, ISRM',
            description: 'Used to determine the strength values of a rock specimen both in the field and in the laboratory.',
            image: 'images/A125N.jpg',
            manufacturer: 'MATEST',
            manufacturerUrl: 'https://www.matest.com/',
            pdf: 'downloadable content/A125N.pdf',
            specs: [
                {label: 'Load Cell', value: 'High precision electric'},
                {label: 'Capacity', value: '56 kN (100 kN mod. A126)'},
                {label: 'Max Core Specimen', value: '4" (101.6 mm)'},
                {label: 'Distance Reading', value: 'Graduated scale'},
                {label: 'Display Unit', value: 'Digital, 0-56 kN, 65,000 divisions, 0.001 kN resolution'},
                {label: 'Linearity', value: '0.05%'},
                {label: 'Hysteresis', value: '0.03%'},
                {label: 'Repeatability', value: '0.02%'},
                {label: 'Supplied With', value: 'Wooden carrying case, goggles, accessories'},
                {label: 'Dimensions', value: '370x520x720 mm'},
                {label: 'Weight', value: '28 kg approx.'}
            ]
        });
    }

    function openNL1002X002Modal() {
    openProductModal({
        code: 'NL 1002 X / 002',
        name: 'Aggregate Impact Value Apparatus (AIV)',
        standard: 'BS 812, NF P18-574',
        description: 'Used to determine the aggregate impact value by measuring the resistance of an aggregate to sudden impact or shock loading, which may vary from its resistance to gradually applied compressive loads on construction materials such as crushed stones and gravel. It is determined by subjecting a sample of aggregate to a standard amount of impact, usually in a testing machine, and then measuring the percentage of fines produced.',
        image: 'images/nl1002x002-01.jpg',
        manufacturer: 'NL Scientific',
        manufacturerUrl: 'https://nl-test.com/',
        pdf: 'downloadable content/NL 1002 X _ 002.pdf',
        specs: [
            {label: 'Dimensions', value: '470 (L) x 330 (W) x 850 (H)'},
            {label: 'Weight', value: '48 kg'}
        ]
    });
}


    function openNL1015X011Modal() {
        openProductModal({
            code: 'NL 1015 X / 011',
            name: 'Sieve Shaker, Triple Motion (From 200 up to 450 mm Dia.)',
            standard: 'EN 932-5, ISO 3310-1, ASTM C136',
            description: 'Triple motion functionality incorporating vertical, horizontal, and rotational motions for thorough and efficient sieving. Features variable speed control, digital timer, and can accommodate sieves from 200mm to 450mm diameter.',
            image: 'images/NL-1015-X-011.jpg',
            manufacturer: 'NL Scientific',
            manufacturerUrl: 'https://nl-test.com/',
            pdf: 'downloadable content/NL 1015 X _ 011.pdf',
            specs: [
                {label: 'Model Number', value: 'NL 1015 X / 009A'},
                {label: 'Accommodates', value: '11 nos 200mm/8" Dia. Full Height Sieves plus lid and receiver, 9 nos 300mm/12" Dia. Full Height Sieves plus lid and receiver, 7 nos. 450mm Dia. Full Height Sieves plus lid and pan'},
                {label: 'Timer', value: '1 - 60 min'},
                {label: 'Dimensions (mm)', value: '585 (L) x 460 (W) x 1250 (H)'},
                {label: 'Weight', value: '105 kg approx.'},
                {label: 'Power', value: '220V, 1ph, 1/2 Hp, 50/60 Hz, 375W'},
                {label: 'Motion Types', value: 'Vertical, Horizontal, and Rotational'},
                {label: 'Speed Control', value: 'Variable speed control'},
                {label: 'Features', value: 'Digital timer, Low noise pollution, Quick clamping & release mechanism'},
                {label: 'Construction', value: 'Durable materials for continuous laboratory use'},
                {label: 'Included Parts', value: 'Clamping Knobs (Pair), Clamping Beam, Threaded Column Set, Manual Instruction'},
                {label: 'Optional Accessories', value: 'Noise Reduction Cabinet (NL 1015 X / SPC)'}
            ]
        });
    }

    function openNL1003XModal() {
        openProductModal({
            code: 'NL 1003 X',
            name: 'Bulk Density Measure',
            standard: 'ASTM C29, BS EN 1097-3',
            description: 'Steel constructed with handles for capacity 1 litre and above. Used to determine the loose bulk density and void of aggregate. Available in multiple capacities for different testing requirements.',
            image: 'images/NL-1003-X.jpg',
            manufacturer: 'NL Scientific',
            manufacturerUrl: 'https://nl-test.com/',
            pdf: 'downloadable content/NL 1003 X.pdf',
            specs: [
                {label: 'Construction', value: 'Steel with handles'},
                {label: 'Application', value: 'Determination of loose bulk density and void of aggregate'},
                {label: 'BS EN 1097-3 Models', value: '1L (NL 1003 X / 001), 5L (NL 1003 X / 002), 10L (NL 1003 X / 003), 20L (NL 1003 X / 004)'},
                {label: 'ASTM C29 Models', value: '14L (NL 1003 X / 005), 28L (NL 1003 X / 007), 2.8L (NL 1003 X / 010), 9.3L (NL 1003 X / 011)'},
                {label: 'Additional Accessories', value: 'Straight Edge 300x30x3mm (NL 5001 X / 001 - A 023), Glass Plate 300x300x8mm (NL 7030 G / 002)'},
                {label: 'Capacity Range', value: '1 litre to 28 litres'},
                {label: 'Standards Compliance', value: 'ASTM C29 and BS EN 1097-3'},
                {label: 'Material', value: 'Durable steel construction'},
                {label: 'Handle Design', value: 'Ergonomic handles for easy handling'},
                {label: 'Applications', value: 'Construction materials testing, aggregate quality control, concrete mix design'}
            ]
        });
    }

    function openLDO060EModal() {
        openProductModal({
            code: 'LDO-060E',
            name: 'Natural Convection Oven',
            standard: 'Advanced Temperature Control & Natural Convection',
            description: 'Stainless Steel chamber for excellent corrosion resistance and easy cleaning. Insulation and sealing structure with silicone packing enable excellent temp. uniformity. Natural convection of heated air w/o a separate fan. Temp. auto - tuning function available.',
            image: 'images/LDO-060E.jpg',
            manufacturer: 'LabTech BioMedic',
            manufacturerUrl: 'https://www.labtech.co.kr/',
            pdf: 'downloadable content/LDO-060E.pdf',
            specs: [
                {label: 'Chamber Material', value: 'Stainless steel for excellent corrosion resistance and easy cleaning'},
                {label: 'Insulation', value: 'Sealing structure with silicone packing for excellent temperature uniformity'},
                {label: 'Air Circulation', value: 'Natural convection of heated air without a separate fan'},
                {label: 'Ventilation', value: 'A vent port is installed on the top for emitting gas'},
                {label: 'Shelves', value: 'Stainless steel wire shelves are included as standard'},
                {label: 'Controller', value: 'Microprocessor PID digital controller provides excellent precise control'},
                {label: 'Auto-Tuning', value: 'Temperature auto-tuning function available'},
                {label: 'Timer Options', value: 'Timer 99hr. 59min. available (Timer end alarm available)'},
                {label: 'Temperature Alarms', value: 'High/Low temperature alarm'},
                {label: 'Memory Function', value: 'Setting value is preserved even when the power supply is cut'},
                {label: 'Capacity Options', value: 'LDO-030E: 35ℓ, LDO-060E: 64ℓ, LDO-100E: 100ℓ, LDO-150E: 150ℓ'},
                {label: 'Temperature Range', value: 'Ambient +5°C to 250°C Max.'},
                {label: 'Temperature Accuracy', value: '±1.0°C'},
                {label: 'Temperature Uniformity', value: '±5.0°C at 120°C'},
                {label: 'Display', value: 'LED 4 Digit display'},
                {label: 'Interior Material', value: 'Stainless steel polished'},
                {label: 'Exterior Material', value: 'Epoxy powder coated steel'},
                {label: 'Insulation', value: 'Glass wool'},
                {label: 'Shelves', value: '2 EA'},
                {label: 'Safety Features', value: 'Over temperature protection, Electric leakage circuit breaker'},
                {label: 'Electric Supply', value: '110 V, 60 Hz or 220 V, 50 or 60 Hz, 1 Phase'}
            ]
        });
    }
    function openLBD2045DModal() {
  openProductModal({
    code: 'LBD-2045D',
    name: 'Hotplate & Stirrer',
    standard: 'High Density Ceramic Coating & Temperature Control',
    description: 'High density ceramic coated stainless steel top plate for excellent chemical resistance. High class powder coated aluminium casting body for excellent heat and corrosion resistance. A heater that is durable and excellent in heat transfer is equipped.',
    image: 'images/LBD-2045-D.jpg',
    manufacturer: 'LabTech BioMedic',
    manufacturerUrl: 'https://www.labtech.co.kr/',

    // PDF specs (forward slashes para safe):
    pdf: 'downloadable content\LBD-2045D.pdf',
    specs: [
      {label: 'Top Plate', value: 'High density ceramic coated stainless steel for excellent chemical resistance'},
      {label: 'Body', value: 'High class powder coated aluminium casting body for excellent heat and corrosion resistance'},
      {label: 'Heater', value: 'Durable heater with excellent heat transfer'},
      {label: 'Application', value: 'Laboratory heating and stirring applications'},
      {label: 'Features', value: 'Temperature control and stirring capabilities'}
    ]
  });
}

function openLWB111DModal() {
  openProductModal({
    code: 'LWB-111D',
    name: 'Digital Water Bath',
    standard: 'Stainless Steel Construction & Auto Tuning',
    description: 'Durable to use in many fields for general purpose. Seamless stainless-steel bath for excellent corrosion resistance and easy cleaning. Heater cover is provided to protect the heater and sensor from unexpected damage. Temp. auto tuning function available',
    image: 'images/LWB-111D.jpg',
    manufacturer: 'LabTech BioMedic',
    manufacturerUrl: 'https://www.labtech.co.kr/',
    // PDF specs:
    pdf: 'downloadable content\LWB-111D.pdf',
    specs: [
      {label: 'General Purpose', value: 'Durable to use in many fields for general purpose'},
      {label: 'Bath Construction', value: 'Seamless stainless steel bath for excellent corrosion resistance and easy cleaning'},
      {label: 'Design', value: 'Compact design to be able to use in various places'},
      {label: 'Protection', value: 'Heater cover protects heater and sensor from unexpected damage'},
      {label: 'Standard Accessory', value: 'Stainless steel flat lid included as standard'},
      {label: 'Controller', value: 'Digital PID controller provides precise control (LED display)'},
      {label: 'Auto-Tuning', value: 'Temperature auto-tuning function available'},
      {label: 'Timer', value: '99 hr. 59 min. / Continuous (with end alarm)'},
      {label: 'Temperature Alarm', value: 'High/Low temperature alarm'},
      {label: 'Memory Function', value: 'Settings preserved even after power interruption'},
      {label: 'Temperature Range', value: 'Ambient + 5°C to 99°C'},
      {label: 'Material Interior', value: 'Seamless stainless steel (STS304)'},
      {label: 'Material Exterior', value: 'Powder coated steel'},
      {label: 'Safety Features', value: 'Over temperature protection, Earth leakage circuit breaker'},
      {label: 'Electric Supply', value: '110 V 60 Hz or 220 V 50/60 Hz, 1 Phase'},
      {label: 'Power Consumption (220V)', value: '3 A (LWB-106D), 4 A (LWB-111D), 7 A (LWB-122D)'}
    ]
  });
}
    </script>
    </body>
</html>

