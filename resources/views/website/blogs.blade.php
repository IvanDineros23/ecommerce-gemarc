@extends('layouts.app')

@section('title', 'Blogs & Articles | Gemarc Enterprises Incorporated')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background for blogs page */
    .page-hero.hero-with-bg.hero-blog {
        position: relative;
        background: linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)), url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat !important;
        color: #fff;
    }
    .page-hero.hero-with-bg.hero-blog .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        background: url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat;
        opacity: 0.85;
    }
    .page-hero.hero-with-bg.hero-blog .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 4rem 0 3rem;
    }
    .page-hero.hero-with-bg.hero-blog h1 {
        font-size: clamp(2.2rem, 6vw, 3.5rem);
        font-weight: 800;
        margin-bottom: 1.2rem;
        letter-spacing: 0.5px;
    }
    .page-hero.hero-with-bg.hero-blog p {
        font-size: 1.15rem;
        color: #f1f5f9;
        margin-bottom: 2.5rem;
    }
    /* Blog article titles: firmer, not bold */
    .blogs-section .blog-post .blog-content h3.blog-title {
        font-weight: 600 !important;
        font-size: 1.18rem !important;
        letter-spacing: -0.3px !important;
        color: #1e293b !important;
        font-family: 'Montserrat', 'Segoe UI', Arial, sans-serif;
        margin-bottom: 0.7rem;
    }
    @media (min-width:1024px){
        .blogs-section .blog-post .blog-content h3.blog-title{font-size:1.22rem!important;}
    }
</style>
<style>
/* BLOG slideshow — extra smooth crossfade + gentle zoom */
.slideshow-container{
    position:relative; overflow:hidden; border-radius:1.25rem; background:#f8fafc;
}
.slideshow-container .slideshow-layer{
    position:absolute; inset:0; object-fit:cover; width:100%; height:260px;
    opacity:0; transform:scale(1); will-change:opacity, transform;
    transition: opacity 1.15s cubic-bezier(.22,.61,.36,1), transform 8s cubic-bezier(.22,.61,.36,1);
    display:block;
    border-radius:1.25rem;
}
@media (min-width:1024px){ .slideshow-container .slideshow-layer{ height:300px; } }
.slideshow-container .slideshow-layer.active{ opacity:1; transform:scale(1.045); }
.slideshow-container .slideshow-layer.outgoing{ opacity:0; transform:scale(1.01); }

/* Dots: center pill, no overlap, click-through outside the dots */
.slideshow-dots{
    position:absolute;
    bottom:10px;
    left:50%;
    transform:translateX(-50%);     /* true center */
    display:flex;
    gap:.45rem;
    padding:.25rem .5rem;            /* small pill padding */
    border-radius:999px;
    z-index:10;

    /* Important: wag ma-block ang ibang UI sa lapad ng image */
    pointer-events:none;             /* container is click-through */
    width:auto;                      /* no full-width overlay */
    max-width:calc(100% - 24px);     /* keep inside rounded corners */
}
.slideshow-dots .dot{
    width:10px; height:10px; border-radius:999px;
    background:#ffffff;              /* inactive */
    box-shadow:0 1px 4px rgba(0,0,0,.13);
    transition:transform .18s ease, background .18s ease, box-shadow .18s ease;

    /* Only the dots themselves are clickable */
    pointer-events:auto;
}
.slideshow-dots .dot.active{
    background:#16a34a;              /* active emerald */
    transform:scale(1.25);
    box-shadow:0 0 0 4px rgba(22,163,74,.18);
}

@media (prefers-reduced-motion: reduce){
    .slideshow-container .slideshow-layer{ transition:none !important; }
}
</style>
@endpush

@section('content')
    <!-- Blogs Hero (identical to News) -->
    <section class="hero blogs-hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center/cover no-repeat; min-height: 400px; display: flex; align-items: center; justify-content: center;">
        <div class="hero-content" style="text-align: center; color: white; z-index: 2;">
            <h1 style="font-size: 3rem; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); margin-bottom: 1rem;">Blogs & Articles</h1>
            <p style="font-size: 1.2rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">Stay updated with industry insights and company updates</p>
        </div>
    </section>

    <!-- Blogs Section -->
    <section class="blogs-section">
        <div class="container">
            <!-- Unified Search Bar Component -->
            <div style="max-width:760px;margin:0 auto 2.5rem;">
                @include('components.searchbar')
            </div>
            
            <div class="blogs-grid">
                <!-- Blog Event Showcase: PICE MIDYEAR 2024 with Auto-Sliding Slideshow -->
                <article class="blog-post">
                    <div class="blog-image slideshow-container" data-images='@json([asset("images/blogs/pice.jpg"), asset("images/blogs/pice1.jpg"), asset("images/blogs/pice2.jpg")])' data-delay="0">
                        <img class="slideshow-img" src="{{ asset('images/blogs/pice.jpg') }}" alt="Gemarc at PICE MIDYEAR 2024">
                        <div class="slideshow-dots"></div>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3 class="blog-title">Gemarc Enterprises at PICE MIDYEAR 2024</h3>
                        <p>Gemarc Enterprises Incorporated participated in the PICE MIDYEAR 2024 event, showcasing our latest solutions and connecting with industry professionals. Our team engaged with civil engineers, shared insights on construction material testing, and demonstrated our commitment to quality and innovation in the field. The event provided a valuable opportunity to strengthen partnerships and stay updated with the latest trends in the engineering community.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: PHILCONSTRUCT 2024 with Auto-Sliding Slideshow -->
                <article class="blog-post">
                    <div class="blog-image slideshow-container" data-images='@json([asset("images/blogs/503561860_635097532889449_6670754882595751907_n.jpg")])' data-delay="1800">
                        <img class="slideshow-img" src="{{ asset('images/blogs/503561860_635097532889449_6670754882595751907_n.jpg') }}" alt="Gemarc at PHILCONSTRUCT 2024">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3 class="blog-title">Gemarc Enterprises at PHILCONSTRUCT 2024</h3>
                        <p>Gemarc Enterprises joined PHILCONSTRUCT 2024, the Philippines' premier construction industry event. Our booth featured innovative testing equipment and solutions for the modern construction sector. The team networked with industry leaders, demonstrated advanced technologies, and discussed best practices for quality assurance in building projects. The event was a great platform to connect with partners and showcase Gemarc’s commitment to supporting the country’s infrastructure growth.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: Revolutionizing Construction with AI for a Smarter Future -->
                <article class="blog-post">
                    <div class="blog-image">
                        <img class="slideshow-img" src="{{ asset('images/blogs/472007282_520297167702820_1441506957382829154_n.jpg') }}" alt="Revolutionizing Construction with AI for a Smarter Future">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3 class="blog-title">Revolutionizing Construction with AI for a Smarter Future</h3>
                        <p>Gemarc Enterprises attended the "Revolutionizing Construction with AI for a Smarter Future" event, where industry experts explored the impact of artificial intelligence on construction. The event highlighted how AI-driven solutions are transforming project management, safety, and efficiency. Gemarc’s participation reflects our dedication to staying at the forefront of technological advancements and delivering smarter, more reliable services to our clients.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: 2024 MIDYEAR NATIONAL CONVENTION with Auto-Sliding Slideshow -->
                <article class="blog-post">
                    <div class="blog-image slideshow-container" data-images='@json([asset("images/blogs/hilton1.jpg")])' data-delay="1200">
                        <img class="slideshow-img" src="{{ asset('images/blogs/hilton1.jpg') }}" alt="Gemarc at 2024 MIDYEAR NATIONAL CONVENTION">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3 class="blog-title">Gemarc Enterprises at 2024 MIDYEAR NATIONAL CONVENTION</h3>
                        <p>Gemarc Enterprises participated in the 2024 MIDYEAR NATIONAL CONVENTION, engaging with professionals and organizations from across the country. The event provided a venue for sharing knowledge, discussing industry trends, and presenting Gemarc’s latest offerings in calibration and testing services. Our presence underscored our ongoing commitment to excellence and collaboration within the engineering and construction community.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: DPWH RESEARCH SYMPOSIUM OCTOBER 2024 -->
                <article class="blog-post">
                    <div class="blog-image slideshow-container" data-images='@json([asset("images/blogs/viber_image_2025-09-10_10-55-08-384.jpg")])' data-delay="1800">
                        <img class="slideshow-img" src="{{ asset('images/blogs/viber_image_2025-09-10_10-55-08-384.jpg') }}" alt="DPWH Research Symposium October 2024">
                        <div class="slideshow-dots"></div>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3 class="blog-title">DPWH Research Symposium October 2024</h3>
                        <p>Gemarc Enterprises participated in the DPWH Research Symposium October 2024, an event dedicated to advancing research and innovation in public works. The team presented solutions for infrastructure quality and engaged with government officials, researchers, and industry peers. The symposium fostered collaboration and knowledge sharing, reinforcing Gemarc’s role in supporting national development through research-driven excellence.</p>
                    </div>
                </article>

                 <!-- Blog Event Showcase: PICE MARIKINA -->
                <article class="blog-post">
                    <div class="blog-image">
                        <img class="slideshow-img" src="{{ asset('images/blogs/viber_image_2025-09-10_14-06-45-090.jpg') }}" alt="PICE MARIKINA">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-category">Event</span>
                        </div>
                        <h3 class="blog-title">PICE MARIKINA</h3>
                        <p>The Gemarc Enterprises team participated in the PICE Marikina event, showcasing our calibration and testing services to engineers and industry professionals. Our booth highlighted equipment solutions and technical support, while our staff engaged with visitors to share expertise and build connections.</p>
                    </div>
                </article>

                <!-- Blog Event Showcase: PHILCONSTRUCT MINDANAO 2025 -->
                <article class="blog-post" data-date="2025-09-05">
                <div class="blog-image slideshow-container" data-images='@json([
                    asset("images/blogs/545784770_711306695268532_3844267213316285682_n.jpg"),
                    asset("images/blogs/545772537_711306681935200_2173725083123861357_n.jpg")
                ])' data-delay="2200">
                    <img class="slideshow-img" src="{{ asset('images/blogs/545772537_711306681935200_2173725083123861357_n.jpg') }}" alt="Gemarc at PHILCONSTRUCT Mindanao 2025">
                    <div class="slideshow-dots"></div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                    <span class="blog-category">Event</span>
                    </div>
                    <h3 class="blog-title">Gemarc Enterprises at PHILCONSTRUCT Mindanao 2025</h3>
                    <p>We joined PHILCONSTRUCT Mindanao 2025 to meet partners and customers in the region, showcase drilling and testing solutions, and discuss real-world applications for construction QA/QC and laboratory workflows.</p>
                </div>
                </article>


                <!-- Coming Soon Posts -->
                <article class="blog-post coming-soon">
                    <div class="blog-content">
                        <div class="coming-soon-icon">
                            <i class="fas fa-clock"></i>
                        </div>
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
document.addEventListener('DOMContentLoaded', function () {
    const wraps = document.querySelectorAll('.slideshow-container');

    wraps.forEach((wrap) => {
        // Read image list
        let imgs;
        try { imgs = JSON.parse(wrap.dataset.images); } catch { imgs = []; }
        if (!imgs || imgs.length <= 1) return;

        // Reuse the existing <img> as layer A, clone for layer B
        const firstImg = wrap.querySelector('.slideshow-img');
        firstImg.classList.add('slideshow-layer');
        const layerA = firstImg;                 // top in DOM
        const layerB = firstImg.cloneNode(true); // second buffer
        wrap.appendChild(layerB);

        // State
        let i = 0, onA = true, timer = null, hover = false;

        // Dots
        const dotsWrap = wrap.querySelector('.slideshow-dots');
        let dots = [];
        if (dotsWrap){
            dotsWrap.innerHTML = '';
            imgs.forEach((_, idx) => {
                const d = document.createElement('div');
                d.className = 'dot' + (idx === 0 ? ' active' : '');
                d.addEventListener('click', () => jumpTo(idx));
                dotsWrap.appendChild(d);
            });
            dots = [...dotsWrap.children];
        }
        const setDots = () => dots.forEach((d,idx)=>d.classList.toggle('active', idx===i));

        // Swap logic (crossfade)
        function swapTo(next){
            const incoming = onA ? layerB : layerA;
            const outgoing = onA ? layerA : layerB;

            incoming.src = imgs[next];
            incoming.classList.add('active');
            outgoing.classList.add('outgoing');
            outgoing.classList.remove('active');

            setTimeout(() => {
                outgoing.classList.remove('outgoing');
                onA = !onA;
                i = next;
                setDots();
            }, 1200); // match longer fade for extra smoothness
        }

        function next(){ if(!hover) swapTo((i + 1) % imgs.length); }
        function jumpTo(idx){ if(idx !== i){ stop(); swapTo(idx); start(); } }

        // Init first frame
        layerA.src = imgs[0];
        layerA.classList.add('active');
        setDots();

        // Autoplay (little jitter so multiple cards aren’t perfectly in sync)
        function start(){
            const base = parseInt(wrap.dataset.delay) || 3000;
            const jitter = Math.floor(Math.random()*250);
            timer = setInterval(next, base + 2200 + jitter);
        }
        function stop(){ if(timer){ clearInterval(timer); timer = null; } }

        // Pause on hover (feels nicer)
        wrap.addEventListener('pointerenter', ()=> hover = true);
        wrap.addEventListener('pointerleave', ()=> hover = false);

        // Fallback on load error
        [layerA, layerB].forEach(img=>{
            img.addEventListener('error', ()=> { img.src = '{{ asset('images/gemarclogo.png') }}'; });
        });

        start();
    });
});
</script>
@endpush

