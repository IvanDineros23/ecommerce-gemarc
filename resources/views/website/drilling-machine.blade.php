@extends('layouts.app')
@section('title', 'Drilling Machine Equipment | Gemarc Enterprises Inc.')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
/* === Adjust Search Bar Spacing under Hero === */
.blogs-section {
    padding-top: 30px !important;  /* dati 80px, binabaan natin */
}

.blogs-section .container > .search-bar-wrapper,
.browse-search, .products-search {
    margin-top: -20px !important;  /* itulak paakyat ang search bar */
}
    /* Hero background to match other pages */
    .page-hero.hero-with-bg.hero-drilling{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-drilling .hero-bg{
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}');
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08);
    }
    .page-hero.hero-with-bg.hero-drilling .hero-overlay{background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px)}

    /* Cards + brand header (aligned to cement-mortar page) */
    .blogs-section .blog-post{box-shadow:0 4px 12px rgba(0,0,0,.05);transition:all .3s ease}
    .blogs-section .blog-post:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,.1)}
    .blogs-section .blog-post .blog-content h3{font-weight:700!important;font-size:1.15rem!important;letter-spacing:-.3px!important}
    .blog-meta{display:flex;flex-wrap:wrap;align-items:center;margin-bottom:.5rem}
    .blog-category{display:inline-block;padding:3px 10px;background:#e8f5e9;color:#2e7d32;border-radius:4px;font-size:.8rem;font-weight:500}
    .blog-standard{margin-left:auto;font-size:.8rem;color:#666}
    .blog-image{position:relative;height:220px;overflow:hidden}
    .blog-image img{width:100%;height:100%;object-fit:cover;transition:all .5s ease}
    .blog-post:hover .blog-image img{transform:scale(1.05)}
    .product-code-badge{position:absolute;top:10px;right:10px;background:rgba(46,125,50,.85);color:#fff;padding:4px 8px;border-radius:4px;font-size:.85rem;font-weight:600}
    .brand-header{margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #e0e0e0}
    .brand-logo{height:64px;max-height:64px;width:auto;object-fit:contain}
    .brand-title{display:none!important}

    /* Product action buttons (same) */
    .blog-actions{display:flex;margin-top:1rem;gap:.5rem}
    .blog-actions .btn{flex:1;padding:8px 12px;font-size:.9rem;border-radius:6px;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .2s ease}
    .blog-actions .btn-pdf{background:#f5f5f5;color:#333}
    .blog-actions .btn-pdf:hover{background:#e0e0e0}
    .blog-actions .btn-details{background:#2e7d32;color:#fff}
    .blog-actions .btn-details:hover{background:#1b5e20}

    /* Modal + form (EXACT same pattern as cement-mortar) */
    .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.7);backdrop-filter:blur(5px);display:flex;align-items:center;justify-content:center;z-index:9999;opacity:0;visibility:hidden;transition:all .3s ease}
    .modal-overlay.active{opacity:1;visibility:visible}
    .modal-content{background:#fff;border-radius:12px;width:90%;max-width:900px;max-height:90vh;overflow:hidden;box-shadow:0 25px 50px -12px rgba(0,0,0,.25);transform:scale(.95);opacity:0;transition:all .3s ease}
    .modal-overlay.active .modal-content{transform:scale(1);opacity:1}
    .modal-header{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.5rem;border-bottom:1px solid #e0e0e0}
    .modal-title{margin:0;font-size:1.5rem;color:#2e7d32;font-weight:700}
    .modal-close{background:none;border:none;font-size:1.75rem;color:#666;cursor:pointer;transition:color .2s ease}
    .modal-close:hover{color:#d32f2f}
    .modal-body{padding:1.5rem;overflow-y:auto;max-height:calc(90vh - 70px)}
    .modal-product-info{display:grid;grid-template-columns:1fr 1.5fr;gap:2rem}
    .modal-product-image{background:#f5f5f5;border-radius:8px;padding:1rem;display:flex;align-items:center;justify-content:center}
    .modal-product-img{max-width:100%;max-height:300px;object-fit:contain}
    .modal-product-code{font-size:.9rem;color:#666;margin-bottom:.5rem}
    .modal-product-name{font-size:1.5rem;color:#1b5e20;font-weight:700;margin:.5rem 0 1rem}
    .modal-specs-section{margin-top:2rem}
    .modal-specs-title{font-size:1.25rem;color:#2e7d32;font-weight:600;padding-bottom:.5rem;border-bottom:1px solid #e0e0e0;margin-bottom:1rem}
    .modal-specs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem}
    .modal-spec-item{background:#f9f9f9;border-radius:6px;padding:.75rem 1rem}
    .modal-spec-label{font-weight:600;margin-bottom:.25rem}
    .modal-spec-value{color:#555}

    .modal-contact-section{margin-top:2rem;padding-top:1rem;border-top:1px solid #e0e0e0;display:flex;flex-direction:column;align-items:center}
    .modal-contact-title{font-size:1.1rem;color:#333;font-weight:600;margin-bottom:1rem;text-align:center}
    .modal-contact-btn{display:flex;align-items:center;justify-content:center;gap:.6rem;padding:.9rem 1.75rem;border:0;border-radius:12px;font-weight:700;letter-spacing:.2px;cursor:pointer;transition:transform .15s ease,box-shadow .15s ease,background .2s ease,filter .2s ease;outline:0}
    .modal-email-btn{background:linear-gradient(135deg,#2e7d32 0%,#1b5e20 100%);color:#fff;box-shadow:0 10px 20px rgba(46,125,50,.25),inset 0 1px 0 rgba(255,255,255,.15)}
    .modal-email-btn:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(46,125,50,.28);filter:saturate(1.1)}
    .modal-email-btn:active{transform:translateY(0);box-shadow:0 8px 16px rgba(46,125,50,.22)}
    .modal-email-btn:focus-visible{box-shadow:0 0 0 3px rgba(46,125,50,.35),0 10px 20px rgba(46,125,50,.25)}
    .modal-email-btn i{font-size:1rem;transition:transform .2s ease,opacity .2s ease}
    .modal-email-btn:hover i{transform:translateX(2px)}

    #inquiryForm form{background:#f7faf8;border:1px solid #e6efe8;border-radius:14px;padding:16px 18px;box-shadow:0 8px 20px rgba(0,0,0,.04)}
    #inquiryForm .form-label{display:block;font-weight:700;color:#2f3b2f;margin-bottom:.35rem}
    #inquiryForm .form-control{width:100%;padding:12px 14px;border:1px solid #e3e6e3;border-radius:10px;background:#fff;color:#333;transition:border-color .2s ease,box-shadow .2s ease,background .2s ease}
    #inquiryForm .form-control:focus{outline:0;border-color:#43a047;box-shadow:0 0 0 3px rgba(67,160,71,.18)}
    #inquiryForm textarea.form-control{min-height:110px;resize:vertical}
    #inquiryForm .mb-3{margin-bottom:1rem}
    #inquiryForm .btn-success.w-100{background:linear-gradient(135deg,#2e7d32,#1b5e20);color:#fff;border:0;border-radius:12px;font-weight:800;letter-spacing:.2px;padding:.85rem 1rem;box-shadow:0 10px 20px rgba(46,125,50,.25);transition:transform .15s ease,box-shadow .15s ease}
    #inquiryForm .btn-success.w-100:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(46,125,50,.32);color:#fff}
    #inquiryForm .btn-success.w-100:active{transform:none;box-shadow:0 8px 16px rgba(46,125,50,.22)}

    /* CTA */
    .more-products-cta{margin:3rem 0}
    .cta-card{background:linear-gradient(135deg,#1b5e20,#43a047);color:#fff;border-radius:14px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 10px 30px rgba(27,94,32,.25)}
    .cta-text h3{margin:0 0 6px;font-size:1.4rem;font-weight:800}
    .cta-text p{margin:0;opacity:.9}
    .cta-actions .cta-btn{display:inline-flex;align-items:center;gap:10px;background:#fff;color:#1b5e20;padding:12px 18px;border-radius:10px;font-weight:700;text-decoration:none;transition:transform .15s ease,box-shadow .15s ease;box-shadow:0 6px 18px rgba(0,0,0,.15)}
    .cta-actions .cta-btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.2)}

    @media(max-width:768px){
        .modal-product-info{grid-template-columns:1fr}
        .modal-specs-grid{grid-template-columns:1fr}
        .cta-card{flex-direction:column;gap:14px;align-items:flex-start}
    }
</style>
@endpush

@section('content')

    <!-- Hero -->
    <section class="page-hero hero-with-bg hero-drilling">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Drilling Machine Equipment</h1>
            <p>Geotechnical, soil sampling, and construction drilling solutions</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="blogs-section">
        <div class="container">
            <!-- Products Section (match concrete-mortar format) -->
    <section class="blogs-section">
        <div class="container">
             <!-- Search Bar -->
            @include('components.searchbar')

                <p>We provide comprehensive drilling machine equipment for geotechnical investigation, soil sampling, and construction applications. Our drilling equipment is designed for various soil conditions and project requirements.</p>

                <!-- TOHO Products Section (Aggregates-style cards) -->
                <div class="brand-section mt-5 mb-4">
                    <div class="brand-header d-flex align-items-center">
                        <img src="{{ asset('images/highlights/partnership/toho-logo-200.jpg') }}" alt="TOHO" class="brand-logo me-3">
                    </div>
                    <div class="blogs-grid">
                        <!-- AK-01 -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/AK-01.jpg') }}" alt="AK-01 Air operated Drill type" class="product-img">
                                <span class="product-code-badge">AK-01</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Drilling</span>
                                    <span class="blog-standard">Air Drilling</span>
                                </div>
                                <h3 class="blog-title">Air operated Drill type</h3>
                                <p>Able to reduce running cost and time using air driving method. High-torque drill head ideal for unstable stratum.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/AK-01.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                        code:'AK-01',
                                        name:'Air operated Drill type',
                                        standard:'Advanced Air Drilling Technology',
                                        description:'The AK-01 Air operated Drill is a high-performance drilling machine designed to reduce running costs and operational time through its efficient air driving method. Equipped with a drill head featuring reduction gear that exerts exceptional drilling torque, making it highly effective for drilling operations in unstable stratum conditions.',
                                        image:'{{ asset('images/highlights/AK-01.jpg') }}',
                                        manufacturer:'TOHO',
                                        specs:[
                                            {label:'Model',value:'AK-01'},
                                            {label:'Drilling Angle',value:'Free'},
                                            {label:'Down The Hole Drill',value:'ϕ65 mm'},
                                            {label:'DTH with Outer Casing',value:'ϕ105 mm (ID ϕ67 mm), Rod ϕ50 mm, Casing ϕ89.1 mm'},
                                            {label:'Spindle Speeds',value:'15-30 r/min'},
                                            {label:'Torque (Max)',value:'1.23 kN⋅m (3rd gear)'},
                                            {label:'Drive',value:'Air Motor + Chain'},
                                            {label:'Thrust / Balance',value:'7.84 kN (800 kgf) each'},
                                            {label:'Feed Length',value:'1400 mm (mast 3500 mm)'},
                                            {label:'Air Consumption',value:'10-15 m³/min × 1-1.5 MPa'},
                                            {label:'Dimensions',value:'2190 × 660 × 980 mm; Drive Unit 230 kg'}
                                        ]
                                    })"><i class="fas fa-eye"></i> View Details</button>
                                </div>
                            </div>
                        </article>
                        <!-- D2-K92 -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/Spindle-Type-D2-KS-58.png') }}" alt="D2-K92 Spindle Type" class="product-img">
                                <span class="product-code-badge">D2-K92</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Drilling</span>
                                    <span class="blog-standard">Hydraulic System</span>
                                </div>
                                <h3 class="blog-title">Spindle Type</h3>
                                <p>Oil hydraulic chuck and slide base. Low speed, high torque rotary spindle with left/right operation.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/D2-K92.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                        code:'D2-K92',
                                        name:'Spindle Type',
                                        standard:'Advanced Hydraulic Drilling System',
                                        description:'Advanced hydraulic spindle drill with oil hydraulic chuck and slide base. High torque rotary spindle for demanding applications.',
                                        image:'{{ asset('images/highlights/Spindle-Type-D2-KS-58.png') }}',
                                        manufacturer:'TOHO',
                                        specs:[
                                            {label:'I.D. of Spindle',value:'92 mm'},
                                            {label:'Speeds',value:'60-380/125-63 r/min; at 90 Lpm: 385/200-100 r/min'},
                                            {label:'Torque',value:'1.57 kN⋅m'},
                                            {label:'Stroke',value:'500 mm'},
                                            {label:'Thrust / Balance',value:'22.1 kN / 29.5 kN'},
                                            {label:'Slide System',value:'Oil Hydraulic Stroke 400 mm'},
                                            {label:'Power',value:'7.5 kW/4P or 15ps/1800 rpm'},
                                            {label:'Dimensions',value:'1800 × 870 × 1620 mm; 700 kg'}
                                        ]
                                    })"><i class="fas fa-eye"></i> View Details</button>
                                </div>
                            </div>
                        </article>
                        <!-- DM-03 -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/1618466271839904_116764.jpg') }}" alt="DM-03 Drilling Machine" class="product-img">
                                <span class="product-code-badge">DM-03</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Drilling</span>
                                    <span class="blog-standard">Hydraulic</span>
                                </div>
                                <h3 class="blog-title">Drilling Machine</h3>
                                <p>Professional hydraulic drilling machine for efficient operations in various geological conditions.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/DM-03.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                        code:'DM-03',
                                        name:'Drilling Machine',
                                        standard:'Professional Hydraulic Drilling System',
                                        description:'Professional-grade hydraulic drilling system engineered for reliable performance in construction and geotechnical work.',
                                        image:'{{ asset('images/highlights/1618466271839904_116764.jpg') }}',
                                        manufacturer:'TOHO',
                                        specs:[
                                            {label:'I.D. of Spindle',value:'47 mm'},
                                            {label:'Spindle Speeds',value:'65 : 125 : 370 r/min'},
                                            {label:'Torque',value:'0.54 kN⋅m'},
                                            {label:'Stroke of Spindle',value:'400 mm'},
                                            {label:'Thrust / Balance',value:'8.4 kN / 13.8 kN'},
                                            {label:'Power',value:'3.4kW/4P or 5ps/1800 rpm'},
                                            {label:'Dimensions',value:'1115 × 570 × 1060 mm; 240 kg'}
                                        ]
                                    })"><i class="fas fa-eye"></i> View Details</button>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <!-- FRASTE Products Section -->
                <div class="brand-section mt-5 mb-4">
                    <div class="brand-header d-flex align-items-center">
                        <img src="{{ asset('images/highlights/logo.svg') }}" alt="FRASTE" class="brand-logo me-3" style="max-height:60px;">
                    </div>
                    <div class="blogs-grid">
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/multidrill-xl-140DR_.jpg') }}" alt="MULTIDRILL XL 140 DR" class="product-img">
                                <span class="product-code-badge">XL 140 DR</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Geothermal</span>
                                    <span class="blog-standard">Dual Rotary</span>
                                </div>
                                <h3 class="blog-title">MULTIDRILL XL 140 DR</h3>
                                <p>Versatile and reliable geothermal drilling rig with dual rotary head for simultaneous drilling.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/XL 140 DR.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick='openProductModal({
                                    code: "XL 140 DR",
                                    name: "MULTIDRILL XL 140 DR",
                                    standard: "Geothermal Drilling Rig",
                                    description: "Experience, innovation, high quality, continuous ideas sharing with the final users are the strong points that in the course of time, made the FRASTE MULTIDRIL XL140 DR one of the most versatile and reliable Geothermal drilling rigs. Expressly designed for air drilling, its dual rotary head allows simultaneous drilling with drill pipe and casing pipe. It’s a friendly-use drill unit, thanks also to the employ of the Preventer, the cuttings conveyor that permits working without any drilling site and environment contamination. The MULTIDRILL XL 140 DR, like all Fraste rigs, assures the best safety factor with its ergonomic control panels and with all safety devices made under the most rigorous current laws and regulations. Different optional equipment are available for various drilling purposes.",
                                    image: "{{ asset('images/highlights/multidrill-xl-140DR_.jpg') }}",
                                    manufacturer: "FRASTE",
                                    manufacturerUrl: "https://www.fraste.com/en",
                                    specs: [
                                        {label: "Power", value: "CAT C4.4 - Stage V - Tier 4F - 110 kw (148 Hp) / CAT C4.4 - Stage IIIA - Tier 3 - 106 Kw (142 Hp)"},
                                        {label: "Rotary head stroke", value: "3700 mm (11,5 ft)"},
                                        {label: "Pull-up", value: "10000 daN (22480 lbf)"},
                                        {label: "Pull-down", value: "6800 daN (15287 lbf)"},
                                        {label: "Rotary head for drill pipes - Max torque", value: "1550 daNm (11432 ft lbf)"},
                                        {label: "Rotary head for drill pipes - Max speed", value: "160 rpm"},
                                        {label: "Rotary head for drill pipes - Speeds number", value: "2"},
                                        {label: "Rotary head for casing - Max torque", value: "2700 daNm (19914 ft lbf)"},
                                        {label: "Rotary head for casing - Max speed", value: "70 rpm"},
                                        {label: "Rotary head for casing - Speeds number", value: "2/3"},
                                        {label: "Clamp", value: "Ø 60-355 mm (2,3\"-14\")"},
                                        {label: "Weight", value: "~ 9400 Kg (~ 20723 lb)"}
                                    ]
                                })'>
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/multidrill-sl__1.jpg') }}" alt="MULTIDRILL SL" class="product-img">
                                <span class="product-code-badge">MULTIDRILL SL</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Compact Rig</span>
                                    <span class="blog-standard">Soil Investigation</span>
                                </div>
                                <h3 class="blog-title">MULTIDRILL SL</h3>
                                <p>Pocket-sized rig with high reliability and productivity. Perfect for soil investigation and monitoring.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/MULTIDRILL SL.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick='openProductModal({
                                    code: "MULTIDRILL SL",
                                    name: "MULTIDRILL SL",
                                    standard: "Compact Drilling Rig",
                                    description: "FRASTE MULTIDRILL SL: Innovation, Hi-Tech and Freshness. Pocket-sized: only 780 mm width and 2,5 ton weight, the standard version of the Multidrill SL features all high qualities of a large drilling rig! Updated and manufactured according to the strictest quality and safety standards, it will surprise you with its high reliability and productivity. Versatile: the modular mast and a great fitting availability to choose from, make the Multidrill SL perfect for different applications: soil investigation, environmental monitoring and small-size water wells. A great small drilling rig to make it stick!",
                                    image: "{{ asset('images/highlights/multidrill-sl__1.jpg') }}",
                                    manufacturer: "FRASTE",
                                    manufacturerUrl: "https://www.fraste.com/en",
                                    specs: [
                                        {label: "Power", value: "CAT C1.7 - Stage V - Tier 4F - 36 kw (48 Hp)"},
                                        {label: "Rotary head stroke", value: "1800 - 2300 - 2800 mm (5,9 - 7,6 - 9,2 ft)"},
                                        {label: "Pull-up", value: "2500 daN (5620 lbf)"},
                                        {label: "Pull-down", value: "2500 daN (5620 lbf)"},
                                        {label: "Max rotary head torque", value: "470 daNm (3466 ft lbf)"},
                                        {label: "Max rotary head speed", value: "900 rpm"},
                                        {label: "Clamp", value: "Ø 48-210 mm (1,9\"-8,3\")"},
                                        {label: "Weight", value: "~ 2500 Kg (~ 5511 lb)"}
                                    ]
                                })'>
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                
                <!-- Tae Sung Co. Products Section -->
                <div class="brand-section mt-5 mb-4">
                    <div class="brand-header d-flex align-items-center">
                        <img src="{{ asset('images/highlights/partnership/Tae-Sung-Co_logo.png') }}" alt="Tae Sung Co." class="brand-logo me-3">
                    </div>
                    <div class="blogs-grid">
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/impregnated-diamond-core-bits-01.jpg') }}" alt="Impregnated Diamond Core Bits" class="product-img">
                                <span class="product-code-badge">TS-IDCB-001</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Core Bits</span>
                                    <span class="blog-standard">Hard Rocks</span>
                                </div>
                                <h3 class="blog-title">Impregnated Diamond Core Bits</h3>
                                <p>Premium bits made from synthetic diamond powder; matrix tuned to formation strength.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/TS-IDCB-001.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                    code: 'TS-IDCB-001',
                                    name: 'Impregnated Diamond Core Bits',
                                    standard: 'Global Quality Level Diamond Core Drilling',
                                    description: 'Impregnated Diamond Core Bits are attached to the foremost part of the Core barrels to be used in direct drilling of the ground, and play the most important role among the equipments that are used in drilling. These premium bits are made from synthetic diamond powder, metal powder, and shank of top quality. The hardness of matrix is carefully selected based on rock conditions - large size diamond with strong matrix for soft rocks, medium size diamond with medium strength matrix for medium rocks, and small size diamond with soft matrix for strong rocks.',
                                    image: '{{ asset('images/highlights/impregnated-diamond-core-bits-01.jpg') }}',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'AX, BX, NX, AS, BS, NS, NS2, NS3, HS, HS3, PS, PS3, T76, T56, T46, T6116, T6101, T6131, T2101, NMLC, HMLC'},
                                        {label: 'Primary Use', value: 'Direct drilling of hard rocks'},
                                        {label: 'Application', value: 'Core drilling where core samples are needed'},
                                        {label: 'Quality Level', value: 'Global quality standard'},
                                        {label: 'Material', value: 'Premium synthetic diamond powder'},
                                        {label: 'Matrix Selection', value: 'Large diamond + strong matrix (soft rocks), Medium diamond + medium matrix (medium rocks), Small diamond + soft matrix (hard rocks)'},
                                        {label: 'Key Features', value: 'Excellent drilling rate in strong rocks'},
                                        {label: 'Performance', value: 'Adapted to hard and strong rock conditions'},
                                        {label: 'Market Position', value: 'Leading company in domestic market'},
                                        {label: 'Customization', value: 'Can be produced in any sizes and specifications needed'},
                                        {label: 'Drilling Speed', value: 'Excellent compared to other companies'},
                                        {label: 'Components', value: 'Synthetic diamond powder, metal powder, premium shank'},
                                        {label: 'Rock Adaptability', value: 'Korea strong rock conditions optimized'},
                                        {label: 'Economic Benefit', value: 'High effectiveness and economical drilling operations'},
                                        {label: 'Classification', value: 'Multiple types based on purpose and ground conditions'},
                                        {label: 'Quality Assurance', value: 'Top quality raw materials and manufacturing standards'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/reaming-shells-1.jpg') }}" alt="Diamond Reaming Shells" class="product-img">
                                <span class="product-code-badge">TS-DRS-002</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Reaming</span>
                                    <span class="blog-standard">Shells</span>
                                </div>
                                <h3 class="blog-title">Diamond Reaming Shells</h3>
                                <p>Connected with core bit for reaming; prevents early wear and hole wall deformation.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/TS-DRS-002.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                    code: 'TS-DRS-002',
                                    name: 'Diamond Reaming Shells',
                                    standard: 'Professional Reaming Technology',
                                    description: 'Diamond Reaming Shell is connected with a Bit to be used, and the drilling by Bit and grinding of side surface can be done simultaneously, but the drilled hole should be kept not smaller than the diameter of the Bit (Reaming). It prevents early wear and tear of the outer diameter of the Bit, and also prevents vibration and deformation of the hole walls. Has a cylindrical shape with diamond particles attached at outside diameter and touchable screws at both ends.',
                                    image: '{{ asset('images/highlights/reaming-shells-1.jpg') }}',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'AX, NX, NXD3, AS, BS, NS, NS3, HS, PS, T Series'},
                                        {label: 'Connection', value: 'Connected with core bit for simultaneous operation'},
                                        {label: 'Function', value: 'Drilling by bit and grinding of side surface simultaneously'},
                                        {label: 'Purpose', value: 'Prevent early wear of bit outer diameter'},
                                        {label: 'Shape', value: 'Cylindrical with diamond particles on outside diameter'},
                                        {label: 'Construction', value: 'Touchable screws at both ends'},
                                        {label: 'Diameter Design', value: 'Outside diameter larger than that of the bit'},
                                        {label: 'Types Available', value: '2 types - general rocks and screw type for strong rocks'},
                                        {label: 'Material Quality', value: 'High quality shank and natural diamond'},
                                        {label: 'Performance', value: 'Excellent life span and reaming ability'},
                                        {label: 'Vibration Control', value: 'Prevents vibration during drilling operations'},
                                        {label: 'Hole Wall Protection', value: 'Prevents deformation of hole walls'},
                                        {label: 'Reaming Function', value: 'Keeps drilled hole not smaller than bit diameter'},
                                        {label: 'Quality Advantage', value: 'Superior life span compared to competitors'},
                                        {label: 'Diamond Type', value: 'Natural diamond for optimal performance'},
                                        {label: 'Applications', value: 'General rocks and strong rock formations'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/surface-set-diamond-core-bits-01.jpg') }}" alt="Surface Set Diamond Core Bits" class="product-img">
                                <span class="product-code-badge">TS-SSDCB-003</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Core Bits</span>
                                    <span class="blog-standard">Soft Ground</span>
                                </div>
                                <h3 class="blog-title">Surface Set Diamond Core Bits</h3>
                                <p>Designed for soft ground; multiple step configurations and round type options.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/TS-SSDCB-003.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                    code: 'TS-SSDCB-003',
                                    name: 'Surface Set Diamond Core Bits',
                                    standard: 'Soft Ground Drilling Technology',
                                    description: 'Surface Set Diamond Core Bits are specifically designed for drilling operations in soft ground conditions. These bits feature natural diamonds set on the surface of the cutting matrix, providing excellent cutting performance in soft formations. Available in multiple configurations including Multi Type and Round Type designs to suit different drilling requirements.',
                                    image: '{{ asset('images/highlights/surface-set-diamond-core-bits-01.jpg') }}',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'BS, NS, HS, PS, NW, HW'},
                                        {label: 'Primary Application', value: 'Drilling in soft ground conditions'},
                                        {label: 'Diamond Type', value: 'High quality natural diamonds'},
                                        {label: 'Multi Type Options', value: '3 Steps, 5 Steps, 7 Steps configurations'},
                                        {label: 'Round Type', value: 'Available for specific applications'},
                                        {label: 'Ground Conditions', value: 'Specifically designed for soft ground'},
                                        {label: 'Life Span', value: 'Superior compared to other companies products'},
                                        {label: 'Diamond Quality', value: 'Made of natural diamond of high quality'},
                                        {label: 'Setting Method', value: 'Surface set diamond configuration'},
                                        {label: 'Performance', value: 'Excellent cutting in soft formations'},
                                        {label: 'Design Options', value: 'Multiple step configurations and round type'},
                                        {label: 'Material Quality', value: 'Premium natural diamond materials'},
                                        {label: 'Durability', value: 'Extended service life in soft ground conditions'},
                                        {label: 'Manufacturing', value: 'Taesung quality standards and processes'},
                                        {label: 'Cost Effectiveness', value: 'Superior life span provides economic advantage'},
                                        {label: 'Applications', value: 'Soft soil, clay, sand, and similar formations'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/impregnated-diamond-casing-shoe-1.jpg') }}" alt="Impregnated Diamond Casing Shoe" class="product-img">
                                <span class="product-code-badge">TS-IDCS-004</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Casing</span>
                                    <span class="blog-standard">Soft Ground</span>
                                </div>
                                <h3 class="blog-title">Impregnated Diamond Casing Shoe</h3>
                                <p>For drilling soil/soft ground with casing advance technique; prevents hole collapse.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/TS-IDCS-004.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                    code: 'TS-IDCS-004',
                                    name: 'Impregnated Diamond Casing Shoe',
                                    standard: 'Advanced Casing Drilling Technology',
                                    description: 'Impregnated Diamond Casing Shoe is used for drilling in soil or soft ground conditions, connected with casing pipe and designed to drill through holes that can collapse anytime. During operations, it should be buried under the ground surface. The Casing Shoe Bit variant is specifically used for drilling soft ground with much gravel content. Made with synthetic diamond of top quality and proper matrix for excellent performance.',
                                    image: '{{ asset('images/highlights/impregnated-diamond-casing-shoe-1.jpg') }}',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'BW, NW, HW, PW'},
                                        {label: 'Primary Application', value: 'Drilling of soil or soft ground'},
                                        {label: 'Connection', value: 'Connected with casing pipe'},
                                        {label: 'Hole Condition', value: 'Designed for collapsible hole drilling'},
                                        {label: 'Installation', value: 'Buried under ground surface during operations'},
                                        {label: 'Casing Shoe Type', value: 'Standard impregnated diamond casing shoe'},
                                        {label: 'Casing Shoe Bit', value: 'Variant for soft ground with much gravel'},
                                        {label: 'Diamond Type', value: 'Synthetic diamond of top quality'},
                                        {label: 'Matrix', value: 'Proper matrix design for optimal performance'},
                                        {label: 'Quality Level', value: 'Excellent quality manufacturing'},
                                        {label: 'Ground Types', value: 'Soil, soft ground, gravelly soft ground'},
                                        {label: 'Drilling Method', value: 'Casing advance drilling technique'},
                                        {label: 'Stability', value: 'Prevents hole collapse during drilling'},
                                        {label: 'Material Quality', value: 'Top grade synthetic diamonds'},
                                        {label: 'Manufacturing', value: 'Taesung quality standards and expertise'},
                                        {label: 'Performance', value: 'Excellent drilling in challenging soft formations'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/pdc-non-core-bits.jpg') }}" alt="PDC Bits & Tricone Bits" class="product-img">
                                <span class="product-code-badge">TS-PDC-005</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Bits</span>
                                    <span class="blog-standard">PDC, Tricone</span>
                                </div>
                                <h3 class="blog-title">PDC Bits & Tricone Bits</h3>
                                <p>High-performance drilling solutions engineered for various formations and conditions.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/TS-PDC-005.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                    code: 'TS-PDC-005',
                                    name: 'PDC Bits & Tricone Bits',
                                    standard: 'Advanced Drilling Bit Technology',
                                    description: 'Comprehensive range of PDC (Polycrystalline Diamond Compact) bits and Tricone bits designed for various drilling applications. These high-performance drilling solutions are engineered to handle different geological formations and drilling conditions. PDC bits offer excellent cutting efficiency and extended life in suitable formations, while Tricone bits provide versatile drilling capability across various rock types.',
                                    image: '{{ asset('images/highlights/pdc-non-core-bits.jpg') }}',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Bit Types', value: 'PDC (Polycrystalline Diamond Compact) Bits, Tricone Bits'},
                                        {label: 'PDC Technology', value: 'Polycrystalline diamond compact cutting elements'},
                                        {label: 'Tricone Design', value: 'Three-cone roller bit configuration'},
                                        {label: 'Applications', value: 'Various drilling applications and geological formations'},
                                        {label: 'Performance', value: 'High-performance drilling solutions'},
                                        {label: 'PDC Advantages', value: 'Excellent cutting efficiency and extended service life'},
                                        {label: 'Tricone Advantages', value: 'Versatile drilling capability across rock types'},
                                        {label: 'Formation Compatibility', value: 'Different geological formations and drilling conditions'},
                                        {label: 'Cutting Efficiency', value: 'Optimized for maximum drilling performance'},
                                        {label: 'Durability', value: 'Extended service life in suitable applications'},
                                        {label: 'Quality Standards', value: 'Taesung manufacturing excellence'},
                                        {label: 'Range', value: 'Comprehensive selection for various needs'},
                                        {label: 'Professional Grade', value: 'High-performance drilling solutions'},
                                        {label: 'Versatility', value: 'Suitable for multiple drilling scenarios'},
                                        {label: 'Innovation', value: 'Advanced drilling bit technology'},
                                        {label: 'Reliability', value: 'Consistent performance across applications'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/core-barrels-1.jpg') }}" alt="Core Barrels" class="product-img">
                                <span class="product-code-badge">TS-CB-006</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Sampling</span>
                                    <span class="blog-standard">Wireline/Tube</span>
                                </div>
                                <h3 class="blog-title">Core Barrels</h3>
                                <p>Single, double, triple tube and wire line systems for maximum core recovery across conditions.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/TS-CB-006.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                    code: 'TS-CB-006',
                                    name: 'Core Barrels',
                                    standard: 'Professional Core Sampling Systems',
                                    description: 'Core barrels are devices used to take cores drilled by the core bit, made of high-quality pipe materials. Available in multiple configurations including Single Tube, Double Tube, Triple Tube, and Wire Line systems. Each type is designed for specific applications and ground conditions, from simple core collection to complex geological sampling in challenging formations.',
                                    image: '{{ asset('images/highlights/core-barrels-1.jpg') }}',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Available Sizes', value: 'AX, BX, NX, NXD3, AS, BS, NS, NS3, HS, HS3, T76, T56'},
                                        {label: 'Single Tube (AX, BX, NX)', value: 'Used to increase collection rate at even ground, cannot be used in easily collapsed ground'},
                                        {label: 'Double Tube (AX, BX, NX, NXD3, T76, T56)', value: 'Outer and inner tube design, circulation water passes between tubes, increases core collection rate'},
                                        {label: 'Triple Tube (NS3, HS3, PS3)', value: 'Core case tube inside inner tube, easy removal with cores, for weak grounds or broken layers'},
                                        {label: 'Wire Line (BS, NS, HS, PS)', value: 'Inner tube hoisted with wire rope, reduces rod hoisting, ideal for deep drilling'},
                                        {label: 'Wire Line Components', value: 'Outer Tube, Inner Tube, Over Shot, Wire Line Drill Rods, Hoisting Plugs'},
                                        {label: 'Export Markets', value: 'Kazakhstan, Mongolia, Uzbekistan and various countries'},
                                        {label: 'Material Quality', value: 'Best quality raw materials appropriate for drilling'},
                                        {label: 'Performance', value: 'Excellent life span and quality'},
                                        {label: 'Core Collection', value: 'Optimized for maximum core recovery rates'},
                                        {label: 'Deep Drilling', value: 'Wire line system ideal for deep layer drilling'},
                                        {label: 'Efficiency', value: 'Reduced hoisting time and labor with wire line system'},
                                        {label: 'Safety', value: 'Less vibration, reduced hole collapse risk'},
                                        {label: 'Versatility', value: 'Multiple types for different geological conditions'},
                                        {label: 'Global Recognition', value: 'Currently exported to various countries worldwide'},
                                        {label: 'Manufacturing Standards', value: 'Taesung quality excellence and precision'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/drill-rods-casing-pipe-3.jpg') }}" alt="Drill Rods & Casing Pipe" class="product-img">
                                <span class="product-code-badge">TS-DRC-007</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Drill Rods</span>
                                    <span class="blog-standard">Casing Pipe</span>
                                </div>
                                <h3 class="blog-title">Drill Rods & Casing Pipe</h3>
                                <p>Premium drill rods and casing pipes with precise specs and heat treatment to meet standards.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/TS-DRC-007.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                    <button class="btn btn-details" onclick="openProductModal({
                                    code: 'TS-DRC-007',
                                    name: 'Drill Rods & Casing Pipe',
                                    standard: 'Premium Drilling Equipment Standards',
                                    description: 'Comprehensive range of drill rods and casing pipes manufactured to meet 100% of drilling standards using the best quality raw materials. Drill rods are maintained by the chuck of the drill rig and convey rotation, pressure, and drilling water while also handling rapid cooling and slime removal. Casing pipes provide structural support and prevent hole collapse during drilling operations.',
                                    image: '{{ asset('images/highlights/drill-rods-casing-pipe-3.jpg') }}',
                                    manufacturer: 'Tae Sung Co.',
                                    manufacturerUrl: 'https://www.taesungdia.com/?ckattempt=1',
                                    specs: [
                                        {label: 'Drill Rod Sizes', value: 'AW, BW, N, NS-3, H, P, NW, HW, HWT'},
                                        {label: 'P Drill Rods', value: '3000mm length, O.D: 114.3-114.5mm, I.D: 101.6-101.80mm'},
                                        {label: 'H Drill Rods', value: '3000mm length, O.D: 88.90-89.15mm, I.D: 77.8-78.0mm, Pin & Box (heat treatment)'},
                                        {label: 'N Drill Rods', value: '3000mm length, O.D: 69.85-70.05mm, I.D: 60.12-60.33mm'},
                                        {label: 'B Drill Rods', value: '3000mm length, O.D: 55.6-55.8mm, I.D: 46.0-46.2mm'},
                                        {label: 'Casing Pipe Sizes', value: 'RW, EW, AW, BW, NW, HW, PW (36.5mm to 139.7mm O.D)'},
                                        {label: 'Tensile Strength', value: 'Min. 900 N/mm²'},
                                        {label: 'Yield Stress', value: 'Min. 800 N/mm²'},
                                        {label: 'Extension', value: 'Min. 14%'},
                                        {label: 'Surface Hardness', value: 'HRC 30 ~ 35'},
                                        {label: 'Construction', value: 'Seamless, cold drawing'},
                                        {label: 'Roundness', value: '0.2 Max Standard'},
                                        {label: 'Straightness', value: '0.8/1000mm (Standard)'},
                                        {label: 'Thread Treatment', value: 'Pin & Box thread - High Frequency Heat Treated'},
                                        {label: 'Quality Standards', value: 'Meet 100% drilling standards'},
                                        {label: 'Material Quality', value: 'Best quality raw materials suitable for drilling'},
                                        {label: 'Manufacturing Process', value: 'Superior products with precision manufacturing'}
                                    ]
                                })">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

            <!-- CTA -->
            <div class="more-products-cta">
                <div class="cta-card">
                    <div class="cta-text">
                        <h3>Looking for more products?</h3>
                        <p>Contact our sales team for a comprehensive catalog and expert assistance.</p>
                    </div>
                    <div class="cta-actions">
                        <a href="{{ route('contact') }}" class="cta-btn"><i class="fas fa-envelope"></i> Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Unified Product Modal (same structure as cement-mortar) -->
    <div id="productModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Product Details</h2>
                <button class="modal-close" onclick="closeProductModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-product-info">
                    <div class="modal-product-image">
                        <img id="modalProductImage" src="" alt="" class="modal-product-img">
                    </div>
                    <div class="modal-product-details">
                        <div class="modal-product-code">
                            <span id="modalProductCodeBadge" class="product-code-badge" style="position:static;display:inline-block;margin-bottom:8px;"></span>
                        </div>
                        <h3 class="modal-product-name" id="modalProductName"></h3>
                        <div class="modal-product-standard"><strong>Standard:</strong> <span id="modalProductStandard"></span></div>
                        <div class="modal-product-description"><strong>Description:</strong><p id="modalProductDescription"></p></div>
                        <div class="modal-manufacturer mt-3"><strong>Manufacturer:</strong> <span id="modalProductManufacturer"></span></div>
                    </div>
                </div>

                <div class="modal-specs-section">
                    <h4 class="modal-specs-title">Technical Specifications</h4>
                    <div id="modalSpecsGrid" class="modal-specs-grid"></div>
                </div>

                <div class="modal-contact-section">
                    <h4 class="modal-contact-title">Need More Information?</h4>
                    <button type="button" class="modal-contact-btn modal-email-btn" onclick="showInquiryForm()">
                        <i class="fas fa-envelope"></i> Send Inquiry
                    </button>
                    <div id="inquiryForm" style="display:none;width:100%;max-width:600px;margin-top:20px;">
                        <form class="p-3 bg-light rounded">
                            <div class="mb-3">
                                <label for="inquiryName" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="inquiryName" required>
                            </div>
                            <div class="mb-3">
                                <label for="inquiryEmail" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="inquiryEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="inquiryProduct" class="form-label">Product</label>
                                <input type="text" class="form-control" id="inquiryProduct" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inquiryMessage" class="form-label">Message</label>
                                <textarea class="form-control" id="inquiryMessage" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Submit Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('website/script.js') }}"></script>
<script>
/* EXACT same helpers as cement-mortar page */
function openProductModal(product){
    document.getElementById('modalProductImage').src = product.image;
    document.getElementById('modalProductImage').alt = (product.code||'') + ' ' + (product.name||'');
    document.getElementById('modalProductCodeBadge').textContent = product.code || '';
    document.getElementById('modalProductName').textContent = product.name || '';
    document.getElementById('modalProductStandard').textContent = product.standard || '';
    document.getElementById('modalProductDescription').textContent = product.description || '';
    document.getElementById('modalProductManufacturer').textContent = product.manufacturer || 'Gemarc Enterprises Inc.';

    var inq = document.getElementById('inquiryProduct');
    if(inq) inq.value = (product.code||'') + ' - ' + (product.name||'');

    const grid = document.getElementById('modalSpecsGrid');
    grid.innerHTML = '';
    if (product.specs && product.specs.length){
        product.specs.forEach(function(s){
            const d = document.createElement('div');
            d.className = 'modal-spec-item';
            d.innerHTML = '<div class="modal-spec-label"><strong>'+s.label+'</strong></div><div class="modal-spec-value">'+s.value+'</div>';
            grid.appendChild(d);
        });
    }else{
        grid.innerHTML = '<p>No detailed specifications available. Please refer to the PDF or contact us.</p>';
    }

    document.getElementById('productModal').classList.add('active');
    document.body.style.overflow='hidden';
}
function closeProductModal(){
    document.getElementById('productModal').classList.remove('active');
    document.body.style.overflow='';
    var f = document.getElementById('inquiryForm');
    if(f) f.style.display='none';
}
function showInquiryForm(){
    const f = document.getElementById('inquiryForm');
    f.style.display = (f.style.display==='none'||!f.style.display) ? 'block' : 'none';
}
document.getElementById('productModal').addEventListener('click',function(e){ if(e.target===this) closeProductModal() });
document.addEventListener('keydown',function(e){ if(e.key==='Escape') closeProductModal() });

(function(){
    var _f = document.querySelector('#inquiryForm form');
    if(_f){
        _f.addEventListener('submit',function(e){
            e.preventDefault();
            alert('Thank you for your inquiry. Our team will contact you shortly.');
            document.getElementById('inquiryForm').style.display='none';
        });
    }
})();
</script>
@endpush
