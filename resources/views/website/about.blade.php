﻿@extends('layouts.app')
@section('content')
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="{{ url('/static') }}" class="logo-link">
                    <img src="{{ asset('website/images/gemarclogo.png') }}" alt="Gemarc Enterprises" class="logo-img">
                </a>
            </div>
// ...existing code...
@endsection
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
    <section class="hero about-hero">
        <div class="hero-content">
            <h1>About Us</h1>
            <p>Learn more about our company, mission, and values</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <!-- Search Bar -->
            <div class="products-search">
                <input type="search" placeholder="Search products, services..." class="search-input" autocomplete="off">
                <button class="search-btn" type="button"><i class="fas fa-search"></i></button>
            </div>
            
            <!-- Tabs Navigation -->
            <div class="about-tabs">
                <div class="tab-buttons">
                    <button class="tab-btn active" onclick="showTab('company-history')">Company History</button>
                    <button class="tab-btn" onclick="showTab('mission-vision')">Mission Vision</button>
                    <button class="tab-btn" onclick="showTab('company-profile')">Company Profile</button>
                </div>
                
                <!-- Company History Tab Content -->
                <div id="company-history" class="tab-content active">
                    <div class="tab-header">
                        <h3>Our Story</h3>
                        <p>GEMARC ENTERPRISES INC. is a 100% Filipino owned corporation, duly registered and accredited with Securities and Exchange Commission (SEC), Department of Trade & Industry (DTI), and Bureau of Domestic Trade (BDT).</p>
                        
                        <p>The company started as an enterprise on May 1974 engaged primarily in safety shoemanufacturing. As the company continued to grow, it consequently became a Corporation on March 16, 1997.</p>
                        
                        <p>To take advantage of the emerging, and growing opportunities brought about by the economic recovery particularly in the construction sector, it diversified from shoemanufacturing business to supply of material testing equipment and apparatus under the line of Soil & Rock, Concrete & Aggregates, Cement, Asphalt and Steel and laboratory testing equipment.</p>
                        
                        <p>It then started developing the market for batching plants, research and development, laboratory testing centers, cement companies, universities and contractors (both private and government agencies).</p>
                        
                        <div class="government-logos">
                            <img src="images/DTIWEB_Masthead.jpg" alt="Department of Trade and Industry" class="gov-logo">
                            <img src="images/sec-150x150.png" alt="Securities and Exchange Commission" class="gov-logo">
                            <img src="images/dpwh.png" alt="Department of Public Works and Highways" class="gov-logo">
                        </div>
                    </div>
                    
                    <div class="company-history-content">
                        <h3>About Us</h3>
                        <p>GEMARC rose from a small-scale trader to becoming a major player in the industry. And with passion and dedication of its lean but mean workforce, the company is continuing its quest to be the preferred choice of customers in the market today.</p>
                        
                        <p>For the past two decades, our customers have recognized our commitment to provide them with quality products and services which eventually become the foundation of their success.</p>
                        
                        <p>As the company embarks on improving its processes and systems attuned to the needs and requirements of the clientele it serves, it will remain true to its ultimate goal of exceeding customers expectations at all times.</p>
                    </div>
                </div>
                
                <!-- Mission Vision Tab Content -->
                <div id="mission-vision" class="tab-content">
                    <div class="mission-vision-content">
                        <div class="vision-section">
                            <h3>Our Vision</h3>
                            <p>To be the leading provider of high-quality and branded material testing, industrial, and laboratory equipment.</p>
                        </div>
                        
                        <div class="mission-section">
                            <h3>Our Mission</h3>
                            <p>With the guidance of our God Almighty and in order to satisfy our customer's needs, we are committed to:</p>
                            <ul class="mission-list">
                                <li></i> Introduce innovative and pioneering imported products and brands in the market,</li>
                                <li></i> continuously improve our internal business processes and systems, and</li>
                                <li></i> equip our personnel with technical knowledge and skills for professional growth and personal advancement.</li>
                            </ul>
                        </div>
                        
                        <div class="core-values-section">
                            <h3>Our Values</h3>
                            <div class="values-grid">
                                <div class="value-item">
                                    <strong>G</strong> - <em>God-Centered</em>
                                </div>
                                <div class="value-item">
                                    <strong>E</strong> - <em>Excellence in Customer Service</em>
                                </div>
                                <div class="value-item">
                                    <strong>M</strong> - <em>Malasakit</em>
                                </div>
                                <div class="value-item">
                                    <strong>A</strong> - <em>Action-Oriented</em>
                                </div>
                                <div class="value-item">
                                    <strong>R</strong> - <em>Respect for the Individual</em>
                                </div>
                                <div class="value-item">
                                    <strong>C</strong> - <em>Continuous Improvement</em>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Company Profile Tab Content -->
                <div id="company-profile" class="tab-content">
                    <div class="company-profile-content">
                        <div class="profile-header">
                            <h3>Company Profile</h3>
                            <p>Get comprehensive information about Gemarc Enterprises Incorporated, our capabilities, products, and services in our detailed company profile document.</p>
                        </div>
                        
                        <div class="profile-download-section">
                            <div class="download-card">
                                <div class="download-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="download-info">
                                    <h4>Company Profile</h4>
                                    <p>Complete overview of our company, services, and capabilities</p>
                                    <span class="file-type">PDF Document</span>
                                </div>
                                <div class="download-action">
                                    <a href="downloadable content/COMPANY PROFILE_F.pdf" class="download-btn" target="_blank">
                                        <i class="fas fa-download"></i>
                                        Download Here
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="profile-highlights">
                            <h4>What's Inside</h4>
                            <ul class="highlight-list">
                                <li><i class="fas fa-check"></i> Complete company background and history</li>
                                <li><i class="fas fa-check"></i> Detailed product and service offerings</li>
                                <li><i class="fas fa-check"></i> Technical specifications and capabilities</li>
                                <li><i class="fas fa-check"></i> Certifications and accreditations</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- What We Do -->
            <div class="what-we-do">
                <h2>What We Do</h2>
                <div class="services-overview">
                    <div class="service-overview-card">
                        <i class="fas fa-truck"></i>
                        <h4>Supply Solutions</h4>
                        <p>We provide a comprehensive range of construction materials including aggregates, cement, asphalt, and specialized industrial equipment to support projects of all sizes.</p>
                    </div>
                    <div class="service-overview-card">
                        <i class="fas fa-desktop"></i>
                        <h4>Calibration Services</h4>
                        <p>Our certified calibration and verification services ensure your equipment meets industry standards and regulatory requirements for optimal performance.</p>
                    </div>
                    <div class="service-overview-card">
                        <i class="fas fa-tools"></i>
                        <h4>Maintenance & Repair</h4>
                        <p>Expert repair and maintenance services for construction equipment and industrial machinery, helping you maximize equipment lifespan and efficiency.</p>
                    </div>
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

    <script src="script.js"></script>
    <script src="search.js"></script>

</body>
</html>
