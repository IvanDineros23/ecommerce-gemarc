@extends('layouts.app')
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
        <!-- Desktop -->
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
              <li><a href="/soil">Soil Testing</a></li>
              <li><a href="/steel">Steel Testing</a></li>
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
                <li><a href="/soil">Soil Testing</a></li>
                <li><a href="/steel">Steel Testing</a></li>
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
          <span></span><span></span><span></span>
        </div>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero about-hero">
    <div class="hero-content">
      <h1>Customer Feedback & Partners</h1>
      <p>Real stories, trusted partners, and proof of performance</p>
    </div>
  </section>

  <!-- Page Content -->
  <section class="page-content">
    <div class="container">

      <!-- Search Bar -->
      <div class="products-search">
        <input type="search" placeholder="Search products, services..." class="search-input" autocomplete="off">
        <button class="search-btn" type="button"><i class="fas fa-search"></i></button>
      </div>

      <!-- Trust Metrics
      <div class="stats-grid" >
        <div class="stat-card">
          <h2>200+</h2><p>Active Clients</p>
        </div>
        <div class="stat-card">
          <h2>1,000+</h2><p>Projects Delivered</p>
        </div>
        <div class="stat-card">
          <h2>30+ Years</h2><p>Industry Experience</p>
        </div>
        <div class="stat-card">
          <h2>98%</h2><p>Client Satisfaction</p>
        </div>
      </div> -->

      <!-- Testimonials TSAKA NA LAGYAN PAG MERON NA TALAGA -->
     <!-- <section class="testimonials-section">
        <div class="section-header">
          <h2>What Our Customers Say</h2>
          <p>Selected feedback from engineering firms, contractors, and laboratories</p>
        </div>

        <div class="testimonials-grid" >
          <article class="testimonial-card">
            <div class="testimonial-header">
              <img src="images/avatars/avatar1.png" alt="Client 1" class="avatar">
              <div>
                <h4>Engr. Maria Santos</h4>
                <span>QA/QC Head, PrimeBuild Corp.</span>
              </div>
            </div>
            <p class="testimonial-quote">“Responsive service at mabilis ang delivery ng calibrated equipment. Nakaabot kami sa project milestones nang walang downtime.”</p>
            <div class="rating">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
          </article>

          <article class="testimonial-card">
            <div class="testimonial-header">
              <img src="images/avatars/avatar2.png" alt="Client 2" class="avatar">
              <div>
                <h4>Ar. Kevin Dela Cruz</h4>
                <span>Project Manager, MetroInfra</span>
              </div>
            </div>
            <p class="testimonial-quote">“From procurement to after-sales, professional at maayos kausap ang Gemarc. Reliable yung test results — pasado sa audit.”</p>
            <div class="rating">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            </div>
          </article>

          <article class="testimonial-card">
            <div class="testimonial-header">
              <img src="images/avatars/avatar3.png" alt="Client 3" class="avatar">
              <div>
                <h4>Engr. Liza Ramos</h4>
                <span>Laboratory Supervisor, GeoTest Labs</span>
              </div>
            </div>
            <p class="testimonial-quote">“Complete lineup ng material testing equipment at mabilis ang support. Highly recommended for labs and contractors.”</p>
            <div class="rating">
              <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
          </article>
        </div>
      </section> -->

                     <h2>Our Global Partners</h2>
                <p>We collaborate with leading brands in the industry to deliver exceptional quality and service</p>
                <div class="partners-carousel-container">
                    <button class="carousel-btn carousel-btn-left" onclick="moveCarousel(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="partners-carousel">
                        <div class="partners-track" id="partnersTrack">
                            <div class="partner-item">
                                <img src="images/partnership/gilson_logo.png" alt="Gilson" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/logo-matest.png" alt="Matest" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/ehwa.png" alt="Ehwa" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/labtech_logo.jpg" alt="Labtech" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/dualmfg-logo.jpg" alt="Dual MFG" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/NL-Scientific_logo.png" alt="NL Scientific" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/QLab-Corporation.jpg" alt="QLab Corporation" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/Tae-Sung-Co_logo.png" alt="Tae Sung Co" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/toho-logo-200.jpg" alt="Toho" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/WandJ.jpg" alt="W&J" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/tbt-Nanjing_logo.jpg" alt="TBT Nanjing" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/capping-gypsum-logo.png" alt="Capping Gypsum" class="partner-logo">
                            </div>
                            <!-- Duplicate items for seamless loop -->
                            <div class="partner-item">
                                <img src="images/partnership/gilson_logo.png" alt="Gilson" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/logo-matest.png" alt="Matest" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/ehwa.png" alt="Ehwa" class="partner-logo">
                            </div>
                            <div class="partner-item">
                                <img src="images/partnership/labtech_logo.jpg" alt="Labtech" class="partner-logo">
                            </div>
                        </div>
                    </div>
                    <button class="carousel-btn carousel-btn-right" onclick="moveCarousel(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

      <!-- CTA -->
      <section class="cta-section">
  <div class="container">
    <h2>Want to share your experience with Gemarc?</h2>
    <p>We’d love to hear from you. Send us your feedback or request a case study.</p>
    <div class="cta-buttons">
      <a class="highlights-btn primary" href="contact.html">Send Feedback</a>
    </div>
  </div>
</section>



    </div>
  </section>

  <!-- Footer scripts -->
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
  <script src="script.js" defer></script>
  <script src="search.js" defer></script>
</body>
</html>
