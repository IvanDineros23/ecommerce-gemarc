@extends('layouts.app')
@section('title', 'Customer Feedback & Partners | Gemarc Enterprises Incorporated')

@push('styles')
<style>
/* ===== Header: force WHITE ===== */
.header{
  background:#fff !important;
  box-shadow:0 4px 16px rgba(0,0,0,.06);
}
.header .nav-list > li > a,
.header .dropdown-toggle,
.header .dropdown-toggle i{
  color:#0f172a !important;   /* dark text for white nav */
}
.header .hamburger span{ background:#0f172a !important; }


/* ===== Hero ===== */
.cf-hero{
  position:relative; min-height:52vh; padding:5rem 0 6rem; color:#fff; overflow:hidden;
  display:flex; align-items:center; justify-content:center;
}
.cf-hero::before{
  content:""; position:absolute; inset:0;
  background:linear-gradient(rgba(0,0,0,.78),rgba(0,0,0,.78)),
             url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat;
  opacity:.95;
}
.cf-hero .hero-content{position:relative; z-index:2; text-align:center; max-width:1000px; margin:0 auto;}
.cf-hero h1{font-size:clamp(2.2rem,6vw,3.5rem); font-weight:800; margin:0 0 1rem;}
.cf-hero p{font-size:1.1rem; color:#f1f5f9;}

/* ===== Page wrapper & local search ===== */
.page-content{background:#fff; padding:2.5rem 0 2rem;}
.page-content .products-search{
  max-width:720px; margin:1rem auto 2rem; display:flex; align-items:center; gap:.75rem;
  background:#fff; border:1px solid #e5e7eb; border-radius:9999px; padding:.5rem .75rem;
  box-shadow:0 6px 20px -8px rgba(0,0,0,.12);
}
.page-content .products-search .search-input{flex:1; height:46px; padding:0 1rem; border:0; outline:0; background:transparent;}
.page-content .products-search .search-btn{
  width:46px; height:46px; border:0; border-radius:9999px; background:#16a34a; color:#fff;
  display:inline-flex; align-items:center; justify-content:center;
}
@media (max-width:480px){
  .page-content .products-search{padding:.35rem .5rem;}
  .page-content .products-search .search-input{height:40px;}
  .page-content .products-search .search-btn{width:40px; height:40px;}
}

/* ================= PARTNERS SLIDER (same as index) ================= */
.partner-logo{
  height:60px; width:180px; flex:0 0 180px; object-fit:contain;
  transition:.3s ease; filter:grayscale(.2); scroll-snap-align:start;
}
.partner-logo:hover{ filter:grayscale(0); transform:scale(1.05); }
#partners-track{
  display:flex; gap:2rem; scroll-behavior:smooth;
  -ms-overflow-style:none; scrollbar-width:none;
}
#partners-track::-webkit-scrollbar{ display:none; }
#partners-track-container{ overflow-x:hidden; margin:0 3rem; }
@media (max-width:768px){
  .partner-logo{ height:50px; width:140px; flex:0 0 140px; }
  #partners-track{ gap:1rem; }
  #partners-track-container{ margin:0 2rem; }
}

/* ===== CTA ===== */
.cta-section{background:#f8fafc; padding:2.25rem 0;}
.cta-section .container{max-width:1100px; margin:0 auto; text-align:center; padding:0 1rem;}
.highlights-btn.primary{
  display:inline-flex; align-items:center; gap:.5rem; padding:.9rem 1.4rem; border-radius:14px;
  text-decoration:none; font-weight:700; color:#fff;
  background:linear-gradient(135deg,#f59e0b,#ea580c); box-shadow:0 12px 32px -8px rgba(234,88,12,.45);
}
.highlights-btn.primary:hover{filter:brightness(1.05); transform:translateY(-1px);}
</style>
@endpush

@section('content')
  {{-- HERO --}}
  <section class="cf-hero">
    <div class="hero-content">
      <h1>Customer Feedback & Partners</h1>
      <p>Real stories, trusted partners, and proof of performance</p>
    </div>
  </section>

  {{-- PAGE CONTENT --}}
  <section class="page-content">
    <div class="container">

      {{-- Search Bar --}}
      <div class="products-search">
        <input type="search" class="search-input" placeholder="Search products, services..." autocomplete="off" aria-label="Search products and services">
        <button class="search-btn" type="button" aria-label="Search"><i class="fas fa-search"></i></button>
      </div>

      {{-- ===== Our Global Partners (copied from index) ===== --}}
      <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
          <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Global Partners</h2>
            <p class="text-xl text-gray-600">Trusted by leading companies worldwide</p>
          </div>

          <div class="relative max-w-6xl mx-auto">
            <button type="button" id="partners-prev"
              class="absolute left-0 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-white text-gray-700 rounded-full shadow z-10">
              <i class="fas fa-chevron-left"></i>
            </button>
            <button type="button" id="partners-next"
              class="absolute right-0 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center bg-white text-gray-700 rounded-full shadow z-10">
              <i class="fas fa-chevron-right"></i>
            </button>

            <div id="partners-track-container" class="overflow-hidden mx-10">
              <div id="partners-track" class="flex gap-8 snap-x snap-mandatory scroll-pl-8" style="scroll-behavior:smooth;">
                <img src="{{ asset('images/highlights/partnership/gilson_logo.png') }}" alt="Gilson" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/ehwa.png') }}" alt="Ehwa" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/labtech_logo.jpg') }}" alt="Labtech" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}" alt="Dual MFG" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}" alt="NL Scientific" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/QLab-Corporation.jpg') }}" alt="QLab" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/Tae-Sung-Co_logo.png') }}" alt="Tae Sung" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/toho-logo-200.jpg') }}" alt="Toho" class="partner-logo snap-start">
                <img src="{{ asset('images/highlights/partnership/WandJ.jpg') }}" alt="W&J" class="partner-logo snap-start">
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </section>

  {{-- CTA --}}
  <section class="cta-section">
    <div class="container">
      <h2>Want to share your experience with Gemarc?</h2>
      <p>We’d love to hear from you. Send us your feedback or request a case study.</p>
      <div class="cta-buttons">
        <a class="highlights-btn primary" href="{{ url('/contact') }}">Send Feedback</a>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
/* Partners slider — same logic as index */
document.addEventListener('DOMContentLoaded', function() {
  const partnersTrack = document.getElementById('partners-track');
  if(!partnersTrack) return;

  const logos = partnersTrack.querySelectorAll('.partner-logo');
  const prevBtn = document.getElementById('partners-prev');
  const nextBtn = document.getElementById('partners-next');

  let logosPerView = window.innerWidth < 768 ? 2 : 4;
  let currentPosition = 0;

  function updateNavigation(){
    prevBtn.disabled = currentPosition <= 0;
    nextBtn.disabled = currentPosition >= logos.length - logosPerView;
    prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
    nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
  }

  function scrollPartners(direction){
    const newPos = currentPosition + direction;
    if(newPos < 0 || newPos > logos.length - logosPerView) return;
    currentPosition = newPos;

    const targetLogo = logos[currentPosition];
    targetLogo?.scrollIntoView({ behavior:'smooth', block:'nearest', inline:'start' });

    updateNavigation();
  }

  prevBtn?.addEventListener('click', ()=> scrollPartners(-1));
  nextBtn?.addEventListener('click', ()=> scrollPartners(1));
  window.addEventListener('resize', ()=>{
    logosPerView = window.innerWidth < 768 ? 2 : 4;
    updateNavigation();
  });

  updateNavigation();
});
</script>
@endpush
