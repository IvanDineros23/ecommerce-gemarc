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
                        <li><a href="about.html">Company Profile</a></li>
                        <li><a href="contact.html" class="active">Contact Us</a></li>
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
    <section class="hero contact-hero">
        <div class="hero-content">
            <h1>Contact Us</h1>
            <p>Get in touch with our team for any inquiries or support</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <!-- Search Bar -->
            <div class="products-search">
                <input type="search" placeholder="Search products, services..." class="search-input" autocomplete="off">
                <button class="search-btn" type="button"><i class="fas fa-search"></i></button>
            </div>
            
            <div class="contact-content">
                <div class="contact-info">
                    <h2>Get In Touch</h2>
                    <p>We're here to help and answer any questions you might have. We look forward to hearing from you.</p>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Office Address</h4>
                                <p>No. 15 Chile St. Ph1 Greenheights Subdivision<br>
                                Concepcion 1, Marikina City, Philippines 1807</p>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Telephone Numbers</h4>
                                <p>(632)8-997-7959 | (632)8-584-5572<br></p>
                                <br>
                                <h4>Mobile Numbers</h4>
                                <p>+63 909 087 9416<br>+63 928 395 3532 | +63 918 905 8316</p>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email Address</h4>
                                <p>
                                    <br>sales@gemarcph.com
                                    <br>technical@gemarcph.com
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Business Hours</h4>
                                <p>Monday - Friday: 7:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h2>Send Us a Message</h2>
                                         <div id="form-status" style="display:none; margin-bottom:1rem; padding:10px; border-radius:6px;"></div>
                                         <form id="contactForm" method="POST" novalidate>
                                                 <div class="form-group">
                                                         <label for="fullname">Full Name *</label>
                                                         <input type="text" id="fullname" name="fullname" required>
                                                 </div>
                                                 <div class="form-group">
                                                         <label for="email">Email Address *</label>
                                                         <input type="email" id="email" name="email" required>
                                                 </div>
                                                 <div class="form-group">
                                                         <label for="phone">Phone Number</label>
                                                         <input type="tel" id="phone" name="phone">
                                                 </div>
                                                 <div class="form-group">
                                                         <label for="company">Company</label>
                                                         <input type="text" id="company" name="company">
                                                 </div>
                                                 <div class="form-group">
                                                         <label for="service">Service Interest</label>
                                                         <select id="service" name="service" required>
                                                                 <option value="" disabled selected>Select a service</option>
                                                                 <option value="Supply">Supply</option>
                                                                 <option value="Calibration & Verification">Calibration & Verification</option>
                                                                 <option value="Repair & Maintenance">Repair & Maintenance</option>
                                                                 <option value="General Inquiry">General Inquiry</option>
                                                         </select>
                                                 </div>
                                                 <div class="form-group">
                                                         <label for="message">Message *</label>
                                                         <textarea id="message" name="message" rows="5" required></textarea>
                                                 </div>
                                                 <br>
                                                 <!-- reCAPTCHA widget -->
                                                <div class="g-recaptcha" data-sitekey="6LcgmsUrAAAAAIj2wLxxrKoNsxrQ_CBXXBriafOF">

                                                </div>
                                                 <br>
                                                 <button type="submit" class="submit-btn">
                                                         <i class="fas fa-paper-plane"></i>
                                                         Send Message
                                                 </button>
                                                             </form>
                                                                                                                         <script>
                                                                                                                             const form = document.getElementById("contactForm");
                                                                                                                             const statusDiv = document.getElementById("form-status");
                                                                                                                             form.addEventListener("submit", function() {
                                                                                                                                 statusDiv.style.display = "block";
                                                                                                                                 statusDiv.textContent = "Sending...";
                                                                                                                                 statusDiv.style.background = "#fff3cd";
                                                                                                                                 statusDiv.style.color = "#856404";
                                                                                                                             });
                                                                                                                         </script>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <h2>Find Our Location</h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3859.94306266505!2d121.10408508413086!3d14.659172652449712!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b99399a4ddfb%3A0xcab776440353b7c7!2sGemarc%20Enterprises%2C%20Incorporated!5e0!3m2!1sen!2sph!4v1756255790321!5m2!1sen!2sph" width="600" height="450" class="google-maps" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="map-address">
                    <p><strong>Our Office:</strong> No. 15 Chile St. Ph1 Greenheights Subdivision, Concepcion 1, Marikina City, Philippines 1807</p>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


</body>
</html>
