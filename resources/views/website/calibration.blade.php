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
                <!-- Desktop nav-list (unchanged, for desktop view) -->
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

    <!-- Professional Calibration Services Section -->
    <section class="calibration-hero">
        <div class="container">
            <div class="calibration-hero-content">
                <h1>Professional Calibration Services</h1>
                <p>At Gemarc Enterprises, we provide comprehensive calibration services for construction and materials testing equipment. Our team of certified technicians ensures that your equipment meets the highest standards of accuracy and reliability, following ISO 9001 quality management protocols.</p>
            </div>
        </div>
    </section>

    <!-- Recent Calibration Work Gallery -->
    <!-- === CALIBRATION SERVICES TITLE STRIP (like the screenshot) === -->
<section class="calib-title-strip">
  <div class="container">
    <h2>CALIBRATION SERVICES</h2>
  </div>
</section>

<!-- === NUMBERED SERVICE LIST (multi-column, responsive) === -->
<section class="calib-services-list">
  <div class="container">
    <ul class="calib-list">
      <li>Concrete Batching Plant</li>
      <li>Asphalt Batching Plant</li>
      <li>Stressing Jacks</li>
      <li>Rebound Hammer</li>
      <li>Digital/Analog Balance</li>
      <li>Speedy Moisture</li>
      <li>Laboratory Oven</li>
      <li>Compression Machine</li>
      <li>Universal Testing Machine</li>
      <li>Air Meter</li>
      <li>CBR Machine</li>
      <li>Marshall Machine</li>
      <li>Water Bath</li>
      <li>Unconfined Machine</li>
      <li>Direct Shear Tester</li>
      <li>Odometer</li>
      <li>Thermometer</li>
      <li>Moisture Cabinet</li>
      <li>LA Machine</li>
      <li>Muffle Furnace</li>
      <li>Caliper</li>
      <li>Dial Gauge</li>
      <li>Melting Pot</li>
      <li>Dynamic Cone Penetrometer</li>
      <li>Vicat Apparatus</li>
      <li>Penetrometer Apparatus</li>
      <li>Length Comparator</li>
      <li>Autoclave</li>
      <li>Water Refrigerator</li>
      <li>Cooling Device</li>
      <li>Micro Computer Ring Crush Tester</li>
      <li>Box Tester</li>
      <li>Micro Tensile Tester</li>
    </ul>
  </div>
</section>

<!-- === ONE CONSOLIDATED GALLERY (showcase) === -->
<section class="calib-gallery-wrap">
  <div class="container">
    <header class="clickable-header" onclick="toggleCalibGallery(this)">
      <h3><i class="fas fa-images"></i> Showcase: Recent Calibration Work</h3>
      <p>Proof of completed calibrations by our technical team</p>
      <span class="chev"><i class="fas fa-chevron-down"></i></span>
    </header>

    <div class="calib-gallery collapsed" id="calibGallery">
      <!-- Drop as many images as you want here; keep forward slashes in paths -->
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-04_08-39-34-126.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-04_08-39-34-214.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-04_08-39-34-308.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-04_08-39-34-718.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-04_08-39-34-788.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-04_08-39-34-898.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-04_08-39-35-027.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-10_11-40-05-229.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/viber_image_2025-09-10_11-40-06-130.jpg" alt=""></div>

      <!-- your Facebook album images (fixed to forward slashes) -->
      <div class="cg-item"><img src="images/calibration/492944049_610384578694078_3648091509823792302_n.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/504268189_640204125712123_6277874478571758863_n.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/504428235_640204199045449_4608588939321091082_n.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/504428926_640204169045452_5758812348746634334_n.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/505596594_640204202378782_8321184957891935740_n.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/505748620_640204149045454_5713118671588066311_n.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/518278555_669110816154787_8607938420397116506_n.jpg" alt=""></div>
      <div class="cg-item"><img src="images/calibration/518296567_669110862821449_8469632100392611821_n.jpg" alt=""></div>
    </div>
  </div>
</section>


            <div class="gallery-content collapsed">
                <div class="calibration-grid">
                    <div class="calibration-item">
                        <img src="./images/calibration/viber_image_2025-09-04_08-39-34-126.jpg" alt="Recent Calibration Work 1">
                    </div>
                    <div class="calibration-item">
                        <img src="./images/calibration/viber_image_2025-09-04_08-39-34-214.jpg" alt="Recent Calibration Work 2">
                    </div>
                    <div class="calibration-item">
                        <img src="./images/calibration/viber_image_2025-09-04_08-39-34-308.jpg" alt="Recent Calibration Work 3">
                    </div>
                    <div class="calibration-item">
                        <img src="./images/calibration/viber_image_2025-09-04_08-39-34-718.jpg" alt="Recent Calibration Work 4">
                    </div>
                    <div class="calibration-item">
                        <img src="./images/calibration/viber_image_2025-09-04_08-39-34-788.jpg" alt="Recent Calibration Work 5">
                    </div>
                    <div class="calibration-item">
                        <img src="./images/calibration/viber_image_2025-09-04_08-39-34-898.jpg" alt="Recent Calibration Work 6">
                    </div>
                    <div class="calibration-item">
                        <img src="./images/calibration/viber_image_2025-09-04_08-39-35-027.jpg" alt="Recent Calibration Work 7">
                    </div>
                    <div class="calibration-item">
                        <img src="images\calibration\492944049_610384578694078_3648091509823792302_n.jpg" alt="Recent Calibration Work 8">
                    </div>
                     <div class="calibration-item">
                        <img src="images\calibration\504268189_640204125712123_6277874478571758863_n.jpg" alt="Recent Calibration Work 9">
                    </div>
                     <div class="calibration-item">
                        <img src="images\calibration\504428235_640204199045449_4608588939321091082_n.jpg" alt="Recent Calibration Work 10">
                    </div>
                     <div class="calibration-item">
                        <img src="images\calibration\504428926_640204169045452_5758812348746634334_n.jpg" alt="Recent Calibration Work 11">
                    </div>
                        <div class="calibration-item">
                            <img src="images\calibration\505596594_640204202378782_8321184957891935740_n.jpg" alt="Recent Calibration Work 12">
                        </div>
                        <div class="calibration-item">
                            <img src="images\calibration\505748620_640204149045454_5713118671588066311_n.jpg" alt="Recent Calibration Work 13">
                        </div>
                        <div class="calibration-item">
                            <img src="images\calibration\518278555_669110816154787_8607938420397116506_n.jpg" alt="Recent Calibration Work 14">
                        </div>
                        <div class="calibration-item">
                            <img src="images\calibration\518296567_669110862821449_8469632100392611821_n.jpg" alt="Recent Calibration Work 15">
                        </div>
                        <div class="calibration-item">
                            <img src="images\calibration\492944049_610384578694078_3648091509823792302_n.jpg" alt="Recent Calibration Work 16">
                        </div>
            </div>
        </div>
    </div>

<br><br>

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

</body>
</html>
