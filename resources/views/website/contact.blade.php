@extends('layouts.app')
@section('title', 'Contact Us | Gemarc Enterprises Incorporated')

@push('styles')
<style>
/* ===== Hero ===== */
.contact-hero-bg{
  position:absolute; inset:0; z-index:0;
  background:linear-gradient(rgba(0,0,0,.82),rgba(0,0,0,.82)),
             url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat;
  opacity:.95;
}
.contact-hero{
  position:relative; min-height:52vh; padding:5rem 0 6rem; color:#fff; overflow:hidden;
  display:flex; align-items:center; justify-content:center;
}
.contact-hero .hero-content{
  position:relative; z-index:2; text-align:center; max-width:900px; margin:0 auto;
}
.contact-hero .hero-content h1{
  font-size:clamp(2.2rem,6vw,3.5rem);
  font-weight:700;
  letter-spacing:.5px; margin:0 0 1rem;
}
.contact-hero .hero-content p{
  font-size:1.1rem; color:#f1f5f9; font-weight:400;
}

/* ===== Title strip (matches About) ===== */
.page-title-strip{background:#222; color:#ffc107; padding:.7rem 0; text-align:center; letter-spacing:2px; font-weight:600;}
.page-title-strip h2{margin:0; font-size:1.2rem; font-weight:600;}

/* ===== Content wrapper ===== */
.contact-section{background:#fff; padding:2.5rem 0 2rem;}

/* ===== Two-column layout ===== */
.contact-content{ max-width:1100px; margin:0 auto; display:grid; grid-template-columns:1.1fr .9fr; gap:1.5rem; }
@media (max-width:900px){ .contact-content{grid-template-columns:1fr;} }

.contact-info, .contact-form{
  background:#fff; border:1px solid #e5e7eb; border-radius:16px; padding:1.25rem 1.25rem 1.5rem;
  box-shadow:0 8px 24px -12px rgba(0,0,0,.12);
}
.contact-info h2, .contact-form h2{font-weight:600; color:#111; margin:.25rem 0 1rem;}
.contact-info p{color:#374151; font-weight:400;}

/* Contact methods */
.contact-methods{display:grid; grid-template-columns:1fr; gap:12px; margin-top:.75rem;}
.contact-method{
  display:grid; grid-template-columns:48px 1fr; gap:.85rem; align-items:start;
  background:#f8fafc; border-radius:12px; padding:12px; border:1px solid #eef2f7;
}
.contact-icon{
  width:48px; height:48px; display:flex; align-items:center; justify-content:center; border-radius:12px; background:#fff;
  box-shadow:0 4px 14px -6px rgba(0,0,0,.18);
}
.contact-icon i{
  font-family:"Font Awesome 6 Free","Font Awesome 5 Free",sans-serif;
  font-weight:900; font-size:18px; color:#16a34a; line-height:1;
}
.contact-details h4{margin:0 0 .25rem; font-weight:600; color:#111;}
.contact-details p{margin:0; color:#374151; font-weight:400;}

/* Form */
.form-group{display:flex; flex-direction:column; gap:.35rem; margin-bottom:.75rem;}
.form-group label{font-weight:500; color:#374151;}
.form-group input, .form-group select, .form-group textarea{
  border:1px solid #e5e7eb; border-radius:10px; padding:.7rem .85rem; outline:0; background:#fff; font-weight:400;
}
.submit-btn{
  display:inline-flex; align-items:center; gap:.5rem; padding:.8rem 1.2rem; border-radius:10px;
  border:0; background:#16a34a; color:#fff; font-weight:700; box-shadow:0 10px 22px -10px rgba(22,163,74,.45); cursor:pointer;
}
.submit-btn:hover{filter:brightness(1.05); transform:translateY(-1px);}

/* Map */

.map-section {
  background: #f8fafc;
  padding: 2.25rem 0;
  min-height: 480px;
  clear: both;
  display: block !important;
  position: relative;
  z-index: 1;
}
.map-section h2 {
  max-width: 1100px;
  margin: 0 auto 1rem;
  font-weight: 600;
  color: #111;
}
.map-container {
  max-width: 1100px;
  margin: 0 auto;
  border-radius: 16px;
  overflow: visible !important;
  background: #fff;
  border: 1px solid #e5e7eb;
  min-height: 420px;
  display: block;
}
.google-maps {
  width: 100%;
  height: 420px;
  border: 0;
  display: block;
  min-height: 420px;
  background: #fff;
}
.map-address {
  padding: 12px 14px;
  color: #374151;
}

/* Ensure FA icons show even if kit defaults to regular */
.contact-details i, .submit-btn i{font-family:"Font Awesome 6 Free","Font Awesome 5 Free"; font-weight:900;}

/* ---- Search suggestions alignment fix (make same as other pages) ---- */
.search-suggestions,
.search-suggestions .section-title,
.search-suggestions .item,
.search-suggestions .item .meta,
.search-suggestions .item .meta .name,
.search-suggestions .item .meta .type{
  text-align:left !important;
}
</style>
@endpush

@section('content')
  {{-- HERO --}}
  <section class="contact-hero">
    <div class="contact-hero-bg"></div>
    <div class="container">
      <div class="hero-content">
        <h1>Contact Us</h1>
        <p>Get in touch with our team for any inquiries or support</p>
      </div>
    </div>
  </section>

  {{-- TITLE STRIP --}}
  <section class="page-title-strip">
    <div class="container">
      <h2>GET IN TOUCH WITH GEMARC</h2>
    </div>
  </section>

  {{-- MAIN CONTENT --}}
  <section class="contact-section">
    <div class="container">

      <!-- Search Bar (shared component) -->
      @include('components.searchbar')

      <div class="contact-content">
        {{-- LEFT: Company info --}}
        <div class="contact-info">
          <h2>Get In Touch</h2>
          <p>We're here to help and answer any questions you might have. We look forward to hearing from you.</p>

          <div class="contact-methods">
            <div class="contact-method">
              <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
              <div class="contact-details">
                <h4>Office Address</h4>
                <p>No. 15 Chile St. Ph1 Greenheights Subdivision<br>Concepcion 1, Marikina City, Philippines 1807</p>
              </div>
            </div>

            <div class="contact-method">
              <div class="contact-icon"><i class="fas fa-phone"></i></div>
              <div class="contact-details">
                <h4>Telephone Numbers</h4>
                <p>(632)8-997-7959</p>
                <h4 style="margin-top:.5rem">Mobile Numbers</h4>
                <p>+63 909 087 9416 | Marketing Department<br>+63 928 395 3532 | Technical Department<br> +63 918 905 8316</p>
              </div>
            </div>

            <div class="contact-method">
              <div class="contact-icon"><i class="fas fa-envelope"></i></div>
              <div class="contact-details">
                <h4>Email Address</h4>
                <p>sales@gemarcph.com<br>technical@gemarcph.com<br>gemarcent.fo@gmail.com<br>gemarc.fo@gemarcph.com</p>
              </div>
            </div>

            <div class="contact-method">
              <div class="contact-icon"><i class="fas fa-clock"></i></div>
              <div class="contact-details">
                <h4>Business Hours</h4>
                <p>Monday - Thursday: 7:00 AM - 5:00 PM</p>
                <p>Friday: 7:00 AM - 4:00 PM</p>
              </div>
            </div>
          </div>
        </div>

        {{-- RIGHT: Form --}}
        <div class="contact-form">
          <h2>Send Us a Message</h2>
          @if(session('success'))
            <!-- Success Modal -->
            <div id="successModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
              <div class="bg-white rounded-xl shadow-lg p-8 max-w-sm w-full text-center">
                <svg class="mx-auto mb-4 text-green-600" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10" stroke="#16a34a" stroke-width="2" fill="#dcfce7"/>
                  <path d="M8 12l2 2 4-4" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="text-lg font-bold text-green-700 mb-2">Successfully sent a message!</div>
                <div class="text-gray-700 mb-4">{{ session('success') }}</div>
                <button onclick="document.getElementById('successModal').style.display='none'" class="bg-green-600 text-white px-4 py-2 rounded font-semibold">OK</button>
              </div>
            </div>
            <script>setTimeout(function(){ document.getElementById('successModal').style.display = 'none'; }, 2000);</script>
          @endif

          <form id="contactForm" method="POST" action="{{ route('contact.submit') }}" novalidate>
            @csrf
            @if(session('success'))
            <div id="successAlert" class="mb-3 p-3 rounded bg-green-100 text-green-800 font-semibold border border-green-300 text-center">
              <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif
            <div class="form-group">
              <label for="fullname">Full Name *</label>
              <input type="text" id="fullname" name="fullname" required autocomplete="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
              <label for="email">Email Address *</label>
              <input type="email" id="email" name="email" required autocomplete="email" pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" placeholder="Enter your email address">
            </div>
            <div class="form-group">
              <label for="phone">Phone Number *</label>
              <div style="display:flex;gap:8px;align-items:center;">
                <select id="countryCode" name="countryCode" required style="max-width:130px;">
                  <option value="+63">+63 PH</option>
                  <option value="+1">+1 US</option>
                  <option value="+44">+44 UK</option>
                  <option value="+61">+61 AU</option>
                  <option value="+81">+81 JP</option>
                  <option value="+65">+65 SG</option>
                  <option value="+91">+91 IN</option>
                  <option value="+86">+86 CN</option>
                  <option value="+49">+49 DE</option>
                  <option value="+33">+33 FR</option>
                  <option value="+39">+39 IT</option>
                  <option value="+7">+7 RU</option>
                  <option value="+34">+34 ES</option>
                  <option value="+82">+82 KR</option>
                  <option value="+971">+971 AE</option>
                  <option value="+62">+62 ID</option>
                  <option value="+855">+855 KH</option>
                  <option value="+852">+852 HK</option>
                  <option value="+20">+20 EG</option>
                  <option value="+27">+27 ZA</option>
                  <option value="+90">+90 TR</option>
                  <option value="+234">+234 NG</option>
                  <option value="+212">+212 MA</option>
                  <option value="+972">+972 IL</option>
                  <option value="+48">+48 PL</option>
                  <option value="+351">+351 PT</option>
                  <option value="+358">+358 FI</option>
                  <option value="+46">+46 SE</option>
                  <option value="+31">+31 NL</option>
                  <option value="+47">+47 NO</option>
                  <option value="+45">+45 DK</option>
                  <option value="+43">+43 AT</option>
                  <option value="+41">+41 CH</option>
                  <option value="+36">+36 HU</option>
                  <option value="+420">+420 CZ</option>
                  <option value="+48">+48 PL</option>
                  <option value="+380">+380 UA</option>
                  <option value="+66">+66 TH</option>
                  <option value="+84">+84 VN</option>
                  <option value="+64">+64 NZ</option>
                  <!-- Add more as needed -->
                </select>
                <input type="tel" id="phone" name="phone" required pattern="[0-9]{7,15}" autocomplete="tel" placeholder="9123456789">
              </div>
            </div>
            <div class="form-group">
              <label for="company">Company</label>
              <input type="text" id="company" name="company" autocomplete="organization" placeholder="Enter your company">
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
              <textarea id="message" name="message" rows="5" required placeholder="Type your message here..."></textarea>
            </div>

            {{-- reCAPTCHA widget --}}
            <div style="display:flex;justify-content:center;align-items:center;width:100%;margin:18px 0 0 0;">
              <div class="g-recaptcha" data-sitekey="6LcgmsUrAAAAAIj2wLxxrKoNsxrQ_CBXXBriafOF"></div>
            </div>
            <br>
            <button type="submit" class="submit-btn" id="submitBtn" disabled style="pointer-events:none;filter:grayscale(1);opacity:.6;">
              <i class="fas fa-paper-plane"></i> Send Message
            </button>
            <!-- NOTE: The Send Message button is always enabled for testing. Please restore the 'disabled' attribute and validation logic after testing. -->
          </form>
        </div>
      </div>

    </div>
  </section>

  {{-- MAP --}}
  <section class="map-section">
    <div class="container">
      <h2>Find Our Location</h2>
      <div class="map-container">
        <iframe
          class="google-maps"
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3859.94306266505!2d121.10408508413086!3d14.659172652449712!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b99399a4ddfb%3A0xcab776440353b7c7!2sGemarc%20Enterprises%2C%20Incorporated!5e0!3m2!1sen!2sph!4v1756255790321!5m2!1sen!2sph"
          allowfullscreen
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <div class="map-address">
          <p><strong>Our Office:</strong> No. 15 Chile St. Ph1 Greenheights Subdivision, Concepcion 1, Marikina City, Philippines 1807</p>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contactForm');
  const statusDiv = document.getElementById('form-status');
  if (!form || !statusDiv) return;

  form.addEventListener('submit', function () {
    statusDiv.style.display = 'block';
    statusDiv.textContent = 'Sending...';
    statusDiv.style.background = '#fff3cd';
    statusDiv.style.color = '#856404';
  });
});
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush