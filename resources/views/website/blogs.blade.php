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
                
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Blogs Hero -->
    <section class="page-hero">
        <div class="hero-content">
            <h1>Blogs & Articles</h1>
            <p>Stay updated with industry insights and company updates</p>
        </div>
    </section>

    <!-- Blogs Section -->
    <section class="blogs-section">
        <div class="container">
            <!-- Search Bar -->
            <div class="products-search">
                <input type="search" placeholder="Search products, services..." class="search-input" autocomplete="off">
                <button class="search-btn" type="button"><i class="fas fa-search"></i></button>
            </div>
            
            <div class="blogs-grid">
                <!-- Blog Event Showcase: PICE MIDYEAR 2024 with Auto-Sliding Slideshow -->
                <article class="blog-post">
                    <div class="blog-image slideshow-container" data-images='["images/blogs/pice.jpg","images/blogs/pice1.jpg","images/blogs/pice2.jpg"]' data-delay="0">
                        <img class="slideshow-img" src="images/blogs/pice.jpg" alt="Gemarc at PICE MIDYEAR 2024">
                        <div class="slideshow-dots"></div>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3>Gemarc Enterprises at PICE MIDYEAR 2024</h3>
                        <p>Gemarc Enterprises Incorporated participated in the PICE MIDYEAR 2024 event, showcasing our latest solutions and connecting with industry professionals. Our team engaged with civil engineers, shared insights on construction material testing, and demonstrated our commitment to quality and innovation in the field. The event provided a valuable opportunity to strengthen partnerships and stay updated with the latest trends in the engineering community.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: PHILCONSTRUCT 2024 with Auto-Sliding Slideshow -->
                <article class="blog-post">
                    <div class="blog-image slideshow-container" data-images='["images\blogs\503561860_635097532889449_6670754882595751907_n.jpg"]' data-delay="1800">
                        <img class="slideshow-img" src="images\blogs\503561860_635097532889449_6670754882595751907_n.jpg" alt="Gemarc at PHILCONSTRUCT 2024">
                       
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3>Gemarc Enterprises at PHILCONSTRUCT 2024</h3>
                        <p>Gemarc Enterprises joined PHILCONSTRUCT 2024, the Philippines' premier construction industry event. Our booth featured innovative testing equipment and solutions for the modern construction sector. The team networked with industry leaders, demonstrated advanced technologies, and discussed best practices for quality assurance in building projects. The event was a great platform to connect with partners and showcase Gemarc’s commitment to supporting the country’s infrastructure growth.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: Revolutionizing Construction with AI for a Smarter Future -->
                <article class="blog-post">
                    <div class="blog-image">
                        <img class="slideshow-img" src="images\blogs\472007282_520297167702820_1441506957382829154_n.jpg" alt="Revolutionizing Construction with AI for a Smarter Future">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3>Revolutionizing Construction with AI for a Smarter Future</h3>
                        <p>Gemarc Enterprises attended the "Revolutionizing Construction with AI for a Smarter Future" event, where industry experts explored the impact of artificial intelligence on construction. The event highlighted how AI-driven solutions are transforming project management, safety, and efficiency. Gemarc’s participation reflects our dedication to staying at the forefront of technological advancements and delivering smarter, more reliable services to our clients.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: 2024 MIDYEAR NATIONAL CONVENTION with Auto-Sliding Slideshow -->
                <article class="blog-post">
                    <div class="blog-image slideshow-container" data-images='["images/blogs/hilton1.jpg"]' data-delay="1200">
                        <img class="slideshow-img" src="images/blogs/hilton1.jpg" alt="Gemarc at 2024 MIDYEAR NATIONAL CONVENTION">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3>Gemarc Enterprises at 2024 MIDYEAR NATIONAL CONVENTION</h3>
                        <p>Gemarc Enterprises participated in the 2024 MIDYEAR NATIONAL CONVENTION, engaging with professionals and organizations from across the country. The event provided a venue for sharing knowledge, discussing industry trends, and presenting Gemarc’s latest offerings in calibration and testing services. Our presence underscored our ongoing commitment to excellence and collaboration within the engineering and construction community.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: DPWH RESEARCH SYMPOSIUM OCTOBER 2024 -->
                <article class="blog-post">
                    <div class="blog-image slideshow-container" data-images='["images\blogs\viber_image_2025-09-10_10-55-08-384.jpg"]' data-delay="1800">
                        <img class="slideshow-img" src="images\blogs\viber_image_2025-09-10_10-55-08-384.jpg" alt="DPWH Research Symposium October 2024">
                        </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3>DPWH Research Symposium October 2024</h3>
                        <p>Gemarc Enterprises participated in the DPWH Research Symposium October 2024, an event dedicated to advancing research and innovation in public works. The team presented solutions for infrastructure quality and engaged with government officials, researchers, and industry peers. The symposium fostered collaboration and knowledge sharing, reinforcing Gemarc’s role in supporting national development through research-driven excellence.</p>
                    </div>
                </article>

                 <!-- Blog Event Showcase: PICE MARIKINA -->
                <article class="blog-post">
                    <div class="blog-image">
                        <img class="slideshow-img" src="images\blogs\viber_image_2025-09-10_14-06-45-090.jpg" alt="PICE MARIKINA">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3>PICE MARIKINA</h3>
                        <p>The Gemarc Enterprises team participated in the PICE Marikina event, showcasing our calibration and testing services to engineers and industry professionals. Our booth highlighted equipment solutions and technical support, while our staff engaged with visitors to share expertise and build connections.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: PHILCONSTRUCT MINDANAO 2025 -->
                <article class="blog-post" data-date="2025-09-05">
                <div class="blog-image slideshow-container"
                    data-images='["images\blogs\545784770_711306695268532_3844267213316285682_n.jpg","images\blogs\545772537_711306681935200_2173725083123861357_n.jpg"]'
                    data-delay="2200">
                    <img class="slideshow-img" src="images\blogs\545772537_711306681935200_2173725083123861357_n.jpg"
                    alt="Gemarc at PHILCONSTRUCT Mindanao 2025">
                    <div class="slideshow-dots"></div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                    <span class="blog-category">Event</span>
                    </div>
                    <h3>Gemarc Enterprises at PHILCONSTRUCT Mindanao 2025</h3>
                    <p>We joined PHILCONSTRUCT Mindanao 2025 to meet partners and customers in the region, showcase drilling and
                    testing solutions, and discuss real-world applications for construction QA/QC and laboratory workflows.</p>
                </div>
                </article>


                <!-- Coming Soon Posts -->
                <article class="blog-post coming-soon">
                    <div class="blog-content">
                        <div class="coming-soon-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>More Articles Coming Soon</h3>
                        <p>We're working on bringing you more valuable content about construction testing, equipment calibration, and industry insights.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="contact-cta-section">
        <div class="container">
            <div class="contact-cta-content">
                <h2>Have Questions About Our Services?</h2>
                <h3><a href="contact.html">Contact Us Now</a></h3>
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

