@extends('layouts.app')
@section('title', 'About Us | Gemarc Enterprises Incorporated')

@push('styles')
<style>
/* ===== Hero ===== */
.about-hero-bg{
  position:absolute;inset:0;z-index:0;
 background:linear-gradient(rgba(0,0,0,.82),rgba(0,0,0,.82)),
             url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat;
  opacity:.95;
}
.about-hero-section{
  position:relative;min-height:60vh;padding:5rem 0 6rem;color:#fff;overflow:hidden;
  display:flex;align-items:center;justify-content:center;
}
.about-hero-content{position:relative;z-index:2;max-width:900px;margin:0 auto;text-align:center;}
.about-hero-content h1{font-size:clamp(2.5rem,6vw,4rem);font-weight:800;margin-bottom:1.5rem;letter-spacing:.5px;}
.about-hero-content p{font-size:1.15rem;color:#f1f5f9;margin-bottom:2.5rem;}

/* ===== Title strip ===== */
.about-title-strip{background:#222;color:#ffc107;padding:.7rem 0;text-align:center;letter-spacing:2px;font-weight:700;margin-bottom:0;}
.about-title-strip h2{margin:0;font-size:1.3rem;font-weight:700;letter-spacing:2px;}

/* ===== Content wrapper ===== */
.about-content-list{background:#fff;padding:2.5rem 0 2rem;}

/* (kept) Search bar container spacing only; styles inherited from site */
.products-search{max-width:720px;margin:0 auto 2rem;display:flex;gap:.5rem}
<style>
/* --- About page search bar override (scoped) --- */
.about-content-list .products-search{
  max-width: 720px;
  margin: 1rem auto 1.5rem;
  display: flex;
  align-items: center;
  gap: .75rem;
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 9999px;
  padding: .5rem .75rem;
  box-shadow: 0 6px 20px -8px rgba(0,0,0,.12);
}
.about-content-list .products-search .search-input{
  width: 100%;
  height: 46px;
  padding: 0 1rem;
  font-size: 1rem;
  border: 0;
  outline: 0;
  background: transparent;
  color: #111;
}
.about-content-list .products-search .search-input::placeholder{
  color: #9ca3af;
}
.about-content-list .products-search .search-btn{
  width: 46px;
  height: 46px;
  border: 0;
  border-radius: 9999px;
  background: #16a34a;
  color: #fff;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: transform .15s ease, filter .15s ease;
}
.about-content-list .products-search .search-btn:hover{
  transform: translateY(-1px);
  filter: brightness(1.05);
}
.about-content-list .products-search .search-btn i{
  font-size: 1.1rem;
}
@media (max-width: 480px){
  .about-content-list .products-search{ padding: .35rem .5rem; }
  .about-content-list .products-search .search-input{ height: 40px; font-size: .95rem; }
  .about-content-list .products-search .search-btn{ width: 40px; height: 40px; }
}


/* ===== Tabs (minimal, functional) ===== */
.about-tabs{max-width:1100px;margin:0 auto;}
.tab-buttons{display:flex;gap:.75rem;background:#fff;border-radius:14px;padding:.5rem;box-shadow:0 6px 18px -8px rgba(0,0,0,.12);overflow:auto;}
.tab-btn{
  flex:1;padding:1rem 1.25rem;border:none;border-radius:12px;background:#f8fafc;
  font-weight:700;color:#374151;cursor:pointer;white-space:nowrap
}
.tab-btn.active{background:#e8f5ee;color:#166534;box-shadow:inset 0 0 0 2px #16a34a;}
.tab-content{display:none;margin-top:1.25rem;}
.tab-content.active{display:block;}

/* ===== Simple text blocks ===== */
.about-list{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:1.2rem;max-width:1100px;margin:0 auto;padding:0;list-style:none;}
.about-list li{font-size:1.08rem;color:#222;margin-bottom:.5rem;background:#f8fafc;border-radius:1rem;box-shadow:0 4px 18px -8px rgba(0,0,0,.13);padding:1.5rem;}
.government-logos{display:flex;gap:1rem;align-items:center;flex-wrap:wrap;margin:1rem 0;}
.gov-logo{height:120px;width:auto;object-fit:contain;background:#fff;border-radius:10px;padding:.35rem;border:1px solid #e5e7eb}

/* ===== What we do cards ===== */
.what-we-do{max-width:1100px;margin:2.5rem auto 0;}
.what-we-do h2{font-size:1.75rem;font-weight:800;margin-bottom:1rem;color:#111;}
.services-overview{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1rem;}
.service-overview-card{background:#f8fafc;border-radius:14px;padding:1.25rem;box-shadow:0 6px 18px -10px rgba(0,0,0,.08);}
.service-overview-card i{font-size:1.4rem;color:#16a34a}
.service-overview-card h4{margin:.5rem 0;font-weight:800;color:#111}

/* ===== Profile download card ===== */
.profile-download-section{margin:1rem 0;}
.download-card{display:grid;grid-template-columns:56px 1fr auto;gap:1rem;align-items:center;background:#f8fafc;border-radius:14px;padding:1rem;border:1px solid #e5e7eb;}
.download-icon{display:flex;align-items:center;justify-content:center;font-size:1.6rem;color:#dc2626;}
.download-btn{display:inline-flex;align-items:center;gap:.5rem;background:#16a34a;color:#fff;padding:.65rem 1rem;border-radius:10px;text-decoration:none;font-weight:700;}
.highlight-list{list-style:none;padding-left:0;margin-top:.75rem;}
.highlight-list li{margin:.35rem 0;color:#374151}
.highlight-list i{color:#16a34a;margin-right:.35rem}

@media (max-width:700px){
  .about-hero-content h1{font-size:2.2rem;}
  .about-list{grid-template-columns:1fr 1fr;}
}
@media (max-width:480px){
  .about-hero-content h1{font-size:1.5rem;}
  .about-list{grid-template-columns:1fr;}
}
/* ---------- FIX: Company Profile download card icon overlap ---------- */
.about-content-list .download-card{
  display:flex;
  align-items:center;
  gap:16px;
  background:#fff;
  border:1px solid #e5e7eb;
  border-radius:16px;
  padding:20px 24px;
  box-shadow:0 8px 24px -12px rgba(0,0,0,.15);
  border-left:6px solid #16a34a;
  overflow:hidden;
}
.about-content-list .download-icon{
  flex:0 0 56px;
  width:56px;
  height:56px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#fff;
  border-radius:12px;
  box-shadow:0 4px 14px -6px rgba(0,0,0,.18);
  position:relative;
  left:auto; margin:0;
}
.about-content-list .download-icon i{
  font-size:30px;
  color:#ef4444; /* PDF red */
  line-height:1;
}
.about-content-list .download-info{
  flex:1 1 auto;
  min-width:0;
  <style>
  /* === FIX: make sure the PDF icon renders === */
  .about-content-list .download-icon i{
    font-family: "Font Awesome 6 Free","Font Awesome 5 Free",sans-serif;
    font-weight: 900; /* required for solid glyphs */
    font-size: 30px;
    color: #ef4444;   /* PDF red */
    line-height: 1;
    display: inline-block;
  }
  .about-content-list .download-icon img{
    max-width: 32px;
    max-height: 32px;
    display: block;
  }
  .about-content-list .download-icon i::before{
    content: "\f1c1";
  }

}
.about-content-list .download-info h4{
  margin:0 0 4px;
  font-weight:800;
  color:#14532d;
}
.about-content-list .file-type{
  display:inline-block;
  font-size:.85rem;
  color:#6b7280;
  background:#f3f4f6;
  border-radius:9999px;
  padding:.25rem .6rem;
}
.about-content-list .download-action .download-btn{
  display:inline-flex;
  align-items:center;
  gap:.5rem;
  background:#16a34a;
  color:#fff;
  padding:.75rem 1rem;
  border-radius:10px;
  font-weight:700;
  text-decoration:none;
  box-shadow:0 8px 20px -8px rgba(22,163,74,.45);
  transition:transform .15s ease, box-shadow .15s ease, filter .15s ease;
  white-space:nowrap;
}
.about-content-list .download-action .download-btn:hover{
  transform:translateY(-1px);
  box-shadow:0 12px 28px -8px rgba(22,163,74,.55);
  filter:brightness(1.05);
}
@media (max-width:640px){
  .about-content-list .download-card{ 
    flex-wrap:wrap; 
    gap:12px; 
    padding:16px; 
  }
  .about-content-list .download-action{ width:100%; }
  .about-content-list .download-action .download-btn{ width:100%; justify-content:center; }
}

</style>
@endpush

@section('content')
<section class="about-hero-section">
  <div class="about-hero-bg"></div>
  <div class="container">
    <div class="about-hero-content">
      <h1>About Us</h1>
      <p>Learn more about our company, mission, and values</p>
    </div>
  </div>
</section>

<section class="about-title-strip">
  <div class="container">
    <h2>COMPANY HISTORY, MISSION & PROFILE</h2>
  </div>
</section>

<section class="about-content-list">
  <div class="container">

    <!-- Search Bar -->
            @include('components.searchbar')

    <!-- Tabs -->
    <div class="about-tabs">
      <div class="tab-buttons">
        <button class="tab-btn active" data-tab="company-history">Company History</button>
        <button class="tab-btn" data-tab="mission-vision">Mission Vision</button>
        <button class="tab-btn" data-tab="company-profile">Company Profile</button>
      </div>

      <!-- Company History -->
      <div id="company-history" class="tab-content active">
        <div class="tab-header">
          <h3>Our Story</h3>
          <p>GEMARC ENTERPRISES INC. is a 100% Filipino owned corporation, duly registered and accredited with Securities and Exchange Commission (SEC), Department of Trade & Industry (DTI), and Bureau of Domestic Trade (BDT).</p>
          <p>The company started as an enterprise on May 1974 engaged primarily in safety shoe manufacturing. As the company continued to grow, it consequently became a Corporation on March 16, 1997.</p>
          <p>To take advantage of the growing opportunities in construction, it diversified to the supply of material testing equipment for Soil & Rock, Concrete & Aggregates, Cement, Asphalt, Steel, and laboratory testing equipment.</p>
          <p>It then started developing the market for batching plants, R&amp;D labs, testing centers, cement companies, universities and contractors (private and government).</p>
          <div class="government-logos">
            <img src="{{ asset('images/highlights/DTIWEB_Masthead.jpg') }}" alt="DTI" class="gov-logo">
            <img src="{{ asset('images/highlights/sec-150x150.png') }}" alt="SEC" class="gov-logo">
            <img src="{{ asset('images/dpwh.png') }}" alt="DPWH" class="gov-logo">
          </div>
        </div>

        <div class="company-history-content">
          <h3>About Us</h3>
          <p>GEMARC grew from a small trader to a major player through a lean, dedicated workforce, striving to be the preferred choice in the market.</p>
          <p>For two decades, our customers have recognized our commitment to quality products and services—becoming part of their success.</p>
          <p>As we improve our processes to match client needs, we remain focused on exceeding customer expectations at all times.</p>
        </div>
      </div>

      <!-- Mission Vision -->
      <div id="mission-vision" class="tab-content">
        <div class="mission-vision-content">
          <div class="vision-section">
            <h3>Our Vision</h3>
            <p>To be the leading provider of high-quality and branded material testing, industrial, and laboratory equipment.</p>
          </div>
          <div class="mission-section">
            <h3>Our Mission</h3>
            <p>With the guidance of our God Almighty and to satisfy our customers' needs, we commit to:</p>
            <ul class="mission-list">
              <li>Introduce innovative and pioneering imported products and brands in the market,</li>
              <li>continuously improve our internal business processes and systems, and</li>
              <li>equip our personnel with technical knowledge and skills for professional growth.</li>
            </ul>
          </div>
          <div class="core-values-section">
            <h3>Our Values</h3>
            <div class="values-grid">
              <div class="value-item"><strong>G</strong> - <em>God-Centered</em></div>
              <div class="value-item"><strong>E</strong> - <em>Excellence in Customer Service</em></div>
              <div class="value-item"><strong>M</strong> - <em>Malasakit</em></div>
              <div class="value-item"><strong>A</strong> - <em>Action-Oriented</em></div>
              <div class="value-item"><strong>R</strong> - <em>Respect for the Individual</em></div>
              <div class="value-item"><strong>C</strong> - <em>Continuous Improvement</em></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Company Profile -->
      <div id="company-profile" class="tab-content">
        <div class="company-profile-content">
          <div class="profile-header">
            <h3>Company Profile</h3>
            <p>Get comprehensive information about Gemarc Enterprises Incorporated in our detailed company profile document.</p>
          </div>

          <div class="profile-download-section">
            <div class="download-card">
              <div class="download-icon"><i class="fas fa-file-pdf"></i></div>
              <div class="download-info">
                <h4>Company Profile</h4>
                <p>Complete overview of our company, services, and capabilities</p>
                <span class="file-type">PDF Document</span>
              </div>
              <div class="download-action">
                <a href="{{ asset('downloadable content/COMPANY PROFILE_F.pdf') }}" class="download-btn" target="_blank">
                  <i class="fas fa-download"></i> Download Here
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
    </div> <!-- /about-tabs -->

    <!-- What We Do -->
    <div class="what-we-do" style="margin-top:2.5rem;">
      <h2>What We Do</h2>
      <div class="services-overview">
        <div class="service-overview-card">
          <i class="fas fa-truck"></i>
          <h4>Supply Solutions</h4>
          <p>We provide a comprehensive range of construction materials and specialized equipment for projects of all sizes.</p>
        </div>
        <div class="service-overview-card">
          <i class="fas fa-desktop"></i>
          <h4>Calibration Services</h4>
          <p>Certified calibration and verification services to keep your equipment compliant and accurate.</p>
        </div>
        <div class="service-overview-card">
          <i class="fas fa-tools"></i>
          <h4>Maintenance & Repair</h4>
          <p>Expert repair and maintenance that maximize equipment lifespan and efficiency.</p>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script>
// Minimal tabs logic (no extra fluff)
document.addEventListener('DOMContentLoaded', function () {
  const btns = document.querySelectorAll('.tab-btn');
  const panes = document.querySelectorAll('.tab-content');

  btns.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-tab');
      // buttons
      btns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      // panes
      panes.forEach(p => p.classList.remove('active'));
      document.getElementById(id)?.classList.add('active');
    });
  });
});
</script>
@endpush
