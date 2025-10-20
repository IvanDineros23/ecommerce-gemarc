@extends('layouts.app')

@section('title', 'Blogs & Articles | Gemarc Enterprises Incorporated')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">

<style>
/* ----------------------- CARD STYLES ----------------------- */
.page-hero.hero-with-bg.hero-blog{
  position:relative;
  background:linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),
    url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat !important;
  color:#fff;
}
.page-hero.hero-with-bg.hero-blog .hero-content{position:relative;z-index:2;text-align:center;padding:4rem 0 3rem;}
.page-hero.hero-with-bg.hero-blog h1{font-size:clamp(2.2rem,6vw,3.5rem);font-weight:800;margin-bottom:1.2rem;letter-spacing:.5px;}
.page-hero.hero-with-bg.hero-blog p{font-size:1.15rem;color:#f1f5f9;margin-bottom:2.5rem;}

.blogs-section .blog-post .blog-content h3.blog-title{
  font-weight:600!important;font-size:1.18rem!important;letter-spacing:-.3px!important;color:#1e293b!important;
  font-family:'Montserrat','Segoe UI',Arial,sans-serif;margin-bottom:.7rem;
}
@media (min-width:1024px){.blogs-section .blog-post .blog-content h3.blog-title{font-size:1.22rem!important;}}

/* -------------------- CARD SLIDESHOW (only cards) -------------------- */
.slideshow-container{
  position:relative;overflow:hidden;border-radius:1.25rem;background:#f8fafc;
}
.slideshow-container .slideshow-layer{
  position:absolute;inset:0;width:100%;height:260px;object-fit:cover;
  opacity:0;transform:scale(1);
  transition:opacity 1.1s cubic-bezier(.22,.61,.36,1),transform 8s cubic-bezier(.22,.61,.36,1);
  border-radius:1.25rem;
}
@media (min-width:1024px){ .slideshow-container .slideshow-layer{ height:300px; } }
.slideshow-container .slideshow-layer.active{opacity:1;transform:scale(1.045)}
.slideshow-container .slideshow-layer.outgoing{opacity:0;transform:scale(1.01)}

.slideshow-dots{
  position:absolute;bottom:10px;left:50%;transform:translateX(-50%);
  display:flex;gap:.45rem;padding:.25rem .5rem;border-radius:999px;z-index:10;
  pointer-events:none;max-width:calc(100% - 24px);
}
.slideshow-dots .dot{
  width:10px;height:10px;border-radius:999px;background:#fff;box-shadow:0 1px 4px rgba(0,0,0,.13);
  transition:transform .18s ease,background .18s ease,box-shadow .18s ease;pointer-events:auto;
}
.slideshow-dots .dot.active{background:#16a34a;transform:scale(1.25);box-shadow:0 0 0 4px rgba(22,163,74,.18)}

/* ----------------------- IMMERSIVE MODAL ----------------------- */
#blog-modal{
  position:fixed;inset:0;display:none;align-items:center;justify-content:center;
  z-index:99999; /* on top of everything */
  background:rgba(15,23,42,.65);backdrop-filter:blur(3px);
}
#blog-modal.show{display:flex;}

#blog-modal .modal-shell{
  width:min(96vw,1400px);height:min(92vh,900px);
  background:#fff;border-radius:22px;box-shadow:0 35px 90px rgba(2,6,23,.45);
  overflow:hidden;display:grid;grid-template-columns:1fr;gap:0;
  animation:fadeIn .32s cubic-bezier(.22,.61,.36,1);
}
@media (min-width:1024px){ #blog-modal .modal-shell{ grid-template-columns:1fr 1fr; } }

/* left: media (fills its column; no crop) */
#modal-media{ position:relative;background:#000;overflow:hidden; }
#modal-media .slideshow-container{ border-radius:0;height:100%; }
#modal-media .slideshow-layer{
  position:absolute;left:50%;top:50%;transform:translate(-50%,-50%) scale(1);
  width:100%;height:100%;max-width:100%;max-height:100%;object-fit:contain !important;border-radius:0;
  opacity:0;background:#000;
  transition:opacity 1.1s cubic-bezier(.22,.61,.36,1), transform 8s cubic-bezier(.22,.61,.36,1);
}
#modal-media .slideshow-layer.active{opacity:1;transform:translate(-50%,-50%) scale(1.02)}
#modal-media .slideshow-layer.outgoing{opacity:0;transform:translate(-50%,-50%) scale(1)}
#modal-media .slideshow-dots{ bottom:14px; }

/* right: content */
#modal-content-wrap{display:flex;flex-direction:column;min-height:0;}
#modal-head{padding:12px;display:flex;justify-content:flex-end;order:-1}
#modal-close{
  width:42px;height:42px;border-radius:999px;background:#fff;border:none;cursor:pointer;
  display:flex;align-items:center;justify-content:center;font-size:22px;color:#334155;
  box-shadow:0 8px 22px rgba(0,0,0,.18);
}
#modal-main{padding:18px 22px 22px;overflow:auto;}
#modal-meta{margin-bottom:.4rem;color:#166534;font-weight:700;font-size:.92rem}
#modal-title{font-size:clamp(1.6rem,2vw,2.1rem);font-weight:800;color:#0f172a;margin-bottom:.75rem}
#modal-body{color:#374151;line-height:1.7;font-size:1rem}

/* lock scroll + hide search magnifier while open */
body.modal-open{overflow:hidden;}
body.modal-open .products-search .search-btn{opacity:0!important;pointer-events:none!important}

@keyframes fadeIn{from{opacity:0;transform:scale(.985)}to{opacity:1;transform:scale(1)}}
</style>
@endpush

@section('content')
  <!-- Hero -->
  <section class="hero blogs-hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; justify-content: center;">
    <div class="hero-content" style="text-align:center;color:white;z-index:2;">
      <h1 style="font-size:3rem;font-weight:bold;text-shadow:2px 2px 4px rgba(0,0,0,0.8);margin-bottom:1rem;">Blogs & Articles</h1>
      <p style="font-size:1.2rem;text-shadow:1px 1px 2px rgba(0,0,0,0.8);">Stay updated with industry insights and company updates</p>
    </div>
  </section>

  <!-- Single, global MODAL (do not duplicate this anywhere else) -->
  <div id="blog-modal" aria-hidden="true">
    <div class="modal-shell" tabindex="-1" role="dialog" aria-modal="true" aria-label="Article details">
      <!-- left: media -->
      <div id="modal-media"></div>
      <!-- right: content -->
      <div id="modal-content-wrap">
        <div id="modal-head"><button id="modal-close" aria-label="Close">&times;</button></div>
        <div id="modal-main">
          <div id="modal-meta"></div>
          <h2 id="modal-title"></h2>
          <div id="modal-body"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Blogs -->
  <section class="blogs-section">
    <div class="container">
      <div style="max-width:760px;margin:0 auto 2.5rem;">
        @include('components.searchbar')
      </div>

      <div class="blogs-grid">
        {{-- ====== CARDS (unchanged content; sample set) ====== --}}
        <article class="blog-post cursor-pointer transition hover:shadow-2xl" tabindex="0" role="button" aria-label="Open article">
          <div class="blog-image slideshow-container" data-images='@json([asset("images/blogs/pice.jpg"), asset("images/blogs/pice1.jpg"), asset("images/blogs/pice2.jpg")])' data-delay="0">
            <img class="slideshow-img" src="{{ asset('images/blogs/pice.jpg') }}" alt="Gemarc at PICE MIDYEAR 2024">
            <div class="slideshow-dots"></div>
          </div>
          <div class="blog-content">
            <div class="blog-meta"><span class="blog-category">Event</span></div>
            <h3 class="blog-title">Gemarc Enterprises at PICE MIDYEAR 2024</h3>
            <p>Gemarc Enterprises Incorporated participated in the PICE MIDYEAR 2024 event, showcasing our latest solutions and connecting with industry professionals. Our team engaged with civil engineers, shared insights on construction material testing, and demonstrated our commitment to quality and innovation in the field. The event provided a valuable opportunity to strengthen partnerships and stay updated with the latest trends in the engineering community.</p>
          </div>
        </article>

        <article class="blog-post cursor-pointer transition hover:shadow-2xl" tabindex="0" role="button" aria-label="Open article">
          <div class="blog-image slideshow-container" data-images='@json([asset("images/blogs/503561860_635097532889449_6670754882595751907_n.jpg")])' data-delay="1800">
            <img class="slideshow-img" src="{{ asset('images/blogs/503561860_635097532889449_6670754882595751907_n.jpg') }}" alt="Gemarc at PHILCONSTRUCT 2024">
          </div>
          <div class="blog-content">
            <div class="blog-meta"><span class="blog-category">Event</span></div>
            <h3 class="blog-title">Gemarc Enterprises at PHILCONSTRUCT 2024</h3>
            <p>Gemarc Enterprises joined PHILCONSTRUCT 2024, the Philippines' premier construction industry event. Our booth featured innovative testing equipment and solutions for the modern construction sector. The team networked with industry leaders, demonstrated advanced technologies, and discussed best practices for quality assurance in building projects. The event was a great platform to connect with partners and showcase Gemarc’s commitment to supporting the country’s infrastructure growth.</p>
          </div>
        </article>

        <article class="blog-post cursor-pointer transition hover:shadow-2xl" tabindex="0" role="button" aria-label="Open article">
          <div class="blog-image">
            <img class="slideshow-img" src="{{ asset('images/blogs/472007282_520297167702820_1441506957382829154_n.jpg') }}" alt="Revolutionizing Construction with AI for a Smarter Future">
          </div>
          <div class="blog-content">
            <div class="blog-meta"><span class="blog-category">Event</span></div>
            <h3 class="blog-title">Revolutionizing Construction with AI for a Smarter Future</h3>
            <p>Gemarc Enterprises attended the "Revolutionizing Construction with AI for a Smarter Future" event, where industry experts explored the impact of artificial intelligence on construction. The event highlighted how AI-driven solutions are transforming project management, safety, and efficiency. Gemarc’s participation reflects our dedication to staying at the forefront of technological advancements and delivering smarter, more reliable services to our clients.</p>
          </div>
        </article>

        <article class="blog-post cursor-pointer transition hover:shadow-2xl" tabindex="0" role="button" aria-label="Open article">
          <div class="blog-image slideshow-container" data-images='@json([asset("images/blogs/hilton1.jpg")])' data-delay="1200">
            <img class="slideshow-img" src="{{ asset('images/blogs/hilton1.jpg') }}" alt="Gemarc at 2024 MIDYEAR NATIONAL CONVENTION">
          </div>
          <div class="blog-content">
            <div class="blog-meta"><span class="blog-category">Event</span></div>
            <h3 class="blog-title">Gemarc Enterprises at 2024 MIDYEAR NATIONAL CONVENTION</h3>
            <p>Gemarc Enterprises participated in the 2024 MIDYEAR NATIONAL CONVENTION, engaging with professionals and organizations from across the country. The event provided a venue for sharing knowledge, discussing industry trends, and presenting Gemarc’s latest offerings in calibration and testing services. Our presence underscored our ongoing commitment to excellence and collaboration within the engineering and construction community.</p>
          </div>
        </article>

        <article class="blog-post cursor-pointer transition hover:shadow-2xl" tabindex="0" role="button" aria-label="Open article">
          <div class="blog-image slideshow-container" data-images='@json([asset("images/blogs/viber_image_2025-09-10_10-55-08-384.jpg")])' data-delay="1800">
            <img class="slideshow-img" src="{{ asset('images/blogs/viber_image_2025-09-10_10-55-08-384.jpg') }}" alt="DPWH Research Symposium October 2024">
            <div class="slideshow-dots"></div>
          </div>
          <div class="blog-content">
            <div class="blog-meta"><span class="blog-category">Event</span></div>
            <h3 class="blog-title">DPWH Research Symposium October 2024</h3>
            <p>Gemarc Enterprises participated in the DPWH Research Symposium October 2024, an event dedicated to advancing research and innovation in public works. The team presented solutions for infrastructure quality and engaged with government officials, researchers, and industry peers. The symposium fostered collaboration and knowledge sharing, reinforcing Gemarc’s role in supporting national development through research-driven excellence.</p>
          </div>
        </article>

        <article class="blog-post cursor-pointer transition hover:shadow-2xl" tabindex="0" role="button" aria-label="Open article">
          <div class="blog-image">
            <img class="slideshow-img" src="{{ asset('images/blogs/viber_image_2025-09-10_14-06-45-090.jpg') }}" alt="PICE MARIKINA">
          </div>
          <div class="blog-content">
            <div class="blog-meta"><span class="blog-category">Event</span></div>
            <h3 class="blog-title">PICE MARIKINA</h3>
            <p>The Gemarc Enterprises team participated in the PICE Marikina event, showcasing our calibration and testing services to engineers and industry professionals. Our booth highlighted equipment solutions and technical support, while our staff engaged with visitors to share expertise and build connections.</p>
          </div>
        </article>

        <article class="blog-post cursor-pointer transition hover:shadow-2xl" tabindex="0" role="button" aria-label="Open article">
          <div class="blog-image slideshow-container" data-images='@json([
            asset("images/blogs/545784770_711306695268532_3844267213316285682_n.jpg"),
            asset("images/blogs/545772537_711306681935200_2173725083123861357_n.jpg")
          ])' data-delay="2200">
            <img class="slideshow-img" src="{{ asset('images/blogs/545772537_711306681935200_2173725083123861357_n.jpg') }}" alt="Gemarc at PHILCONSTRUCT Mindanao 2025">
            <div class="slideshow-dots"></div>
          </div>
          <div class="blog-content">
            <div class="blog-meta"><span class="blog-category">Event</span></div>
            <h3 class="blog-title">Gemarc Enterprises at PHILCONSTRUCT Mindanao 2025</h3>
            <p>We joined PHILCONSTRUCT Mindanao 2025 to meet partners and customers in the region, showcase drilling and testing solutions, and discuss real-world applications for construction QA/QC and laboratory workflows.</p>
          </div>
        </article>

        <article class="blog-post coming-soon">
          <div class="blog-content">
            <div class="coming-soon-icon"><i class="fas fa-clock"></i></div>
            <h3 class="blog-title">More Articles Coming Soon</h3>
            <p>We're working on bringing you more valuable content about construction testing, equipment calibration, and industry insights.</p>
          </div>
        </article>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
/* ------------------------- Card slideshow (cover) ------------------------- */
function initCardSlideshow(wrap){
  let imgs; try{ imgs = JSON.parse(wrap.dataset.images) }catch{ imgs=[] }
  if(!imgs || imgs.length <= 1) return;

  const firstImg = wrap.querySelector('.slideshow-img');
  firstImg.classList.add('slideshow-layer');
  const layerA = firstImg;
  const layerB = firstImg.cloneNode(true);
  wrap.appendChild(layerB);

  let i=0, onA=true, timer=null, hover=false;

  const dotsWrap = wrap.querySelector('.slideshow-dots') || (() => {
    const d=document.createElement('div'); d.className='slideshow-dots'; wrap.appendChild(d); return d;
  })();
  dotsWrap.innerHTML='';
  const dots = imgs.map((_,idx)=>{
    const d=document.createElement('div');
    d.className='dot'+(idx===0?' active':'');
    d.addEventListener('click',()=>jumpTo(idx));
    dotsWrap.appendChild(d);
    return d;
  });
  const setDots = () => dots.forEach((d,idx)=>d.classList.toggle('active', idx===i));

  function swapTo(next){
    const incoming = onA ? layerB : layerA;
    const outgoing = onA ? layerA : layerB;
    incoming.src = imgs[next];
    incoming.classList.add('active');
    outgoing.classList.add('outgoing');
    outgoing.classList.remove('active');
    setTimeout(()=>{ outgoing.classList.remove('outgoing'); onA=!onA; i=next; setDots(); }, 1100);
  }
  function next(){ if(!hover) swapTo((i+1)%imgs.length); }
  function jumpTo(idx){ if(idx!==i){ stop(); swapTo(idx); start(); } }

  layerA.src = imgs[0]; layerA.classList.add('active'); setDots();

  function start(){ const base=parseInt(wrap.dataset.delay)||3000; const jitter=Math.floor(Math.random()*250); timer=setInterval(next, base+2000+jitter); }
  function stop(){ if(timer){ clearInterval(timer); timer=null; } }

  wrap.addEventListener('pointerenter', ()=>hover=true);
  wrap.addEventListener('pointerleave', ()=>hover=false);
  [layerA,layerB].forEach(img=>img.addEventListener('error',()=>{ img.src='{{ asset('images/gemarclogo.png') }}'; }));
  start();
}

/* ------------------ Modal slideshow (contain; no crop) ------------------ */
function initModalSlideshow(wrap){
  let imgs; try{ imgs = JSON.parse(wrap.dataset.images) }catch{ imgs=[] }

  // Single image: just make it fill with contain
  if(!imgs || imgs.length <= 1){
    const one = wrap.querySelector('img');
    if(one){
      one.classList.add('slideshow-layer','active');
      Object.assign(one.style,{ width:'100%',height:'100%',objectFit:'contain',left:'50%',top:'50%',transform:'translate(-50%,-50%)' });
    }
    return;
  }

  const first = wrap.querySelector('img');
  first.classList.add('slideshow-layer');
  const layerA = first;
  const layerB = first.cloneNode(true);
  wrap.appendChild(layerB);

  // ensure both layers are full-size contain
  [layerA,layerB].forEach(el=>{
    Object.assign(el.style,{ width:'100%',height:'100%',objectFit:'contain',left:'50%',top:'50%',transform:'translate(-50%,-50%)' });
  });

  let i=0, onA=true, timer=null, hover=false;

  const dotsWrap = wrap.querySelector('.slideshow-dots') || (() => {
    const d=document.createElement('div'); d.className='slideshow-dots'; wrap.appendChild(d); return d;
  })();
  dotsWrap.innerHTML='';
  const dots = imgs.map((_,idx)=>{
    const d=document.createElement('div');
    d.className='dot'+(idx===0?' active':'');
    d.addEventListener('click',()=>jumpTo(idx));
    dotsWrap.appendChild(d);
    return d;
  });
  const setDots = () => dots.forEach((d,idx)=>d.classList.toggle('active', idx===i));

  function swapTo(next){
    const incoming = onA ? layerB : layerA;
    const outgoing = onA ? layerA : layerB;
    incoming.src = imgs[next];
    incoming.classList.add('active');
    outgoing.classList.add('outgoing');
    outgoing.classList.remove('active');
    setTimeout(()=>{ outgoing.classList.remove('outgoing'); onA=!onA; i=next; setDots(); }, 1100);
  }
  function next(){ if(!hover) swapTo((i+1)%imgs.length); }
  function jumpTo(idx){ if(idx!==i){ stop(); swapTo(idx); start(); } }

  layerA.src = imgs[0]; layerA.classList.add('active'); setDots();

  function start(){ const base=parseInt(wrap.dataset.delay)||3000; const jitter=Math.floor(Math.random()*250); timer=setInterval(next, base+2000+jitter); }
  function stop(){ if(timer){ clearInterval(timer); timer=null; } }

  wrap.addEventListener('pointerenter', ()=>hover=true);
  wrap.addEventListener('pointerleave', ()=>hover=false);
  [layerA,layerB].forEach(img=>img.addEventListener('error',()=>{ img.src='{{ asset('images/gemarclogo.png') }}'; }));
  start();
}

/* ---------------------------- Modal plumbing ---------------------------- */
document.addEventListener('DOMContentLoaded', () => {
  // init all card slideshows
  document.querySelectorAll('.slideshow-container').forEach(initCardSlideshow);

  const modal = document.getElementById('blog-modal');
  const modalShell = modal.querySelector('.modal-shell');
  const modalClose = document.getElementById('modal-close');
  const modalMedia = document.getElementById('modal-media');
  const modalMeta  = document.getElementById('modal-meta');
  const modalTitle = document.getElementById('modal-title');
  const modalBody  = document.getElementById('modal-body');
  let lastActive = null;

  function openModal(article){
    lastActive = document.activeElement;

    modalTitle.textContent = article.querySelector('.blog-title')?.textContent || '';
    modalMeta.textContent  = article.querySelector('.blog-category')?.textContent || '';
    modalBody.innerHTML    = article.querySelector('.blog-content p')?.innerHTML || '';

    // clone media into left side and re-init (contain)
    modalMedia.innerHTML = '';
    const imgWrap = article.querySelector('.slideshow-container') || article.querySelector('.blog-image');
    if(imgWrap){
      const clone = imgWrap.cloneNode(true);
      clone.querySelectorAll('[id]').forEach(el=>el.removeAttribute('id')); // avoid duplicate IDs
      // force the container to fill left column
      clone.style.height = '100%';
      modalMedia.appendChild(clone);
      initModalSlideshow(clone);
    }

    modal.classList.add('show');
    document.body.classList.add('modal-open');
    modalShell.focus();
  }

  function closeModal(){
    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
    if(lastActive) lastActive.focus();
  }

  // open from each card
  document.querySelectorAll('.blog-post').forEach(article=>{
    article.addEventListener('click', ()=> openModal(article));
    article.addEventListener('keydown', e=>{
      if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); openModal(article); }
    });
  });

  // close handlers
  modalClose.addEventListener('click', closeModal);
  modal.addEventListener('click', e=>{ if(e.target === modal) closeModal(); });
  document.addEventListener('keydown', e=>{
    if(e.key === 'Escape' && modal.classList.contains('show')) closeModal();
  });
});
</script>
@endpush
