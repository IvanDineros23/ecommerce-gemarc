@extends('layouts.app')

@section('title', 'Concrete & Mortar Testing Equipment | Gemarc Enterprises Inc.')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background override for Concrete & Mortar */
    .page-hero.hero-with-bg.hero-concrete-mortar{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-concrete-mortar .hero-bg{
        /* Use an existing hero image (similar treatment as aggregates) */
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') !important;
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08); /* compensate blur crop */
    }
    .page-hero.hero-with-bg.hero-concrete-mortar .hero-overlay{
        background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px);
    }
    /* Product cards with shadow on hover */
    .blogs-section .blog-post{box-shadow:0 4px 12px rgba(0,0,0,0.05);transition:all 0.3s ease;}
    .blogs-section .blog-post:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,0.1);}
    /* Product title styling */
    .blogs-section .blog-post .blog-content h3{font-weight:700!important;font-size:1.15rem!important;letter-spacing:-.3px!important;}
    /* If still gray, apply fallback background directly */
    /* Fallback background if hero-bg fails to load */
    .page-hero.hero-with-bg.hero-concrete-mortar.no-image{background:linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),url('{{ asset('images/hero/compression2.png') }}') center/cover no-repeat!important;}
    /* Ensure stacking context correct */
    .page-hero.hero-with-bg.hero-concrete-mortar .hero-bg, .page-hero.hero-with-bg.hero-concrete-mortar::after{will-change:transform;}
    /* Product cards styling */
    .blog-image {position:relative;height:220px;overflow:hidden;}
    .blog-image img {width:100%;height:100%;object-fit:cover;transition:all 0.5s ease;}
    .blog-post:hover .blog-image img {transform:scale(1.05);}
    .product-code-badge {position:absolute;top:10px;right:10px;background:rgba(46,125,50,0.85);color:white;padding:4px 8px;border-radius:4px;font-size:0.85rem;font-weight:600;}
    .blog-meta {display:flex;flex-wrap:wrap;align-items:center;margin-bottom:0.5rem;}
    .blog-category {display:inline-block;padding:3px 10px;background:#e8f5e9;color:#2e7d32;border-radius:4px;font-size:0.8rem;font-weight:500;}
    .blog-standard {margin-left:auto;font-size:0.8rem;color:#666;}
    .blog-actions {display:flex;margin-top:1rem;gap:0.5rem;}
    .blog-actions .btn {flex:1;padding:8px 12px;font-size:0.9rem;border-radius:6px;display:flex;align-items:center;justify-content:center;gap:6px;transition:all 0.2s ease;}
    .blog-actions .btn-pdf {background:#f5f5f5;color:#333;}
    .blog-actions .btn-pdf:hover {background:#e0e0e0;}
    .blog-actions .btn-details {background:#2e7d32;color:white;}
    .blog-actions .btn-details:hover {background:#1b5e20;}
    /* Brand section styling */
    .brand-header {margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #e0e0e0;}
    /* Standardize brand logos */
    .brand-logo{height:64px;max-height:64px;width:auto;object-fit:contain;}
    /* Hide brand title text if present (legacy markup safety) */
    .brand-title{display:none!important}
    
    /* Modern CTA Styles */
    .more-products-cta{margin:3rem 0}
    .cta-card{
        background:linear-gradient(135deg,#1b5e20,#43a047);
        color:#fff;border-radius:14px;padding:24px 28px;
        display:flex;align-items:center;justify-content:space-between;
        box-shadow:0 10px 30px rgba(27,94,32,.25);
    }
    .cta-text h3{margin:0 0 6px;font-size:1.4rem;font-weight:800;letter-spacing:-.2px}
    .cta-text p{margin:0;opacity:.9}
    .cta-actions .cta-btn{
        display:inline-flex;align-items:center;gap:10px;
        background:#ffffff;color:#1b5e20;padding:12px 18px;border-radius:10px;
        font-weight:700;text-decoration:none;transition:transform .15s ease,box-shadow .15s ease;
        box-shadow:0 6px 18px rgba(0,0,0,.15)
    }
    .cta-actions .cta-btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.2)}
    @media (max-width:768px){.cta-card{flex-direction:column;align-items:flex-start;gap:14px}}
    
    /* Enhanced modal styling (copied from aggregates page) */
    .modal-overlay {
        position:fixed;top:0;left:0;right:0;bottom:0;
        background:rgba(0,0,0,0.7);backdrop-filter:blur(5px);
        display:flex;align-items:center;justify-content:center;
        z-index:9999;opacity:0;visibility:hidden;transition:all 0.3s ease;
    }
    .modal-overlay.active {opacity:1;visibility:visible;}
    .modal-content {
        background:#fff;border-radius:12px;width:90%;max-width:900px;
        max-height:90vh;overflow:hidden;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);
        transform:scale(0.95);opacity:0;transition:all 0.3s ease;
    }
    .modal-overlay.active .modal-content {transform:scale(1);opacity:1;}
    .modal-header {
        display:flex;align-items:center;justify-content:space-between;
        padding:1rem 1.5rem;border-bottom:1px solid #e0e0e0;
    }
    .modal-title {margin:0;font-size:1.5rem;color:#2e7d32;font-weight:700;}
    .modal-close {
        background:none;border:none;font-size:1.75rem;color:#666;
        cursor:pointer;transition:color 0.2s ease;
    }
    .modal-close:hover {color:#d32f2f;}
    .modal-body {padding:1.5rem;overflow-y:auto;max-height:calc(90vh - 70px);} 
    .modal-product-info {display:grid;grid-template-columns:1fr 1.5fr;gap:2rem;}
    .modal-product-image {
        background:#f5f5f5;border-radius:8px;padding:1rem;
        display:flex;align-items:center;justify-content:center;
    }
    .modal-product-img {max-width:100%;max-height:300px;object-fit:contain;}
    .modal-product-code {font-size:0.9rem;color:#666;margin-bottom:0.5rem;}
    .modal-product-name {font-size:1.5rem;color:#1b5e20;font-weight:700;margin:0.5rem 0 1rem;}
    .modal-product-standard, .modal-product-description {margin-bottom:1rem;}
    .modal-specs-section {margin-top:2rem;}
    .modal-specs-title {
        font-size:1.25rem;color:#2e7d32;font-weight:600;
        padding-bottom:0.5rem;border-bottom:1px solid #e0e0e0;
        margin-bottom:1rem;
    }
    .modal-specs-grid {
        display:grid;grid-template-columns:repeat(auto-fill, minmax(300px, 1fr));
        gap:1rem;
    }
    .modal-spec-item {background:#f9f9f9;border-radius:6px;padding:0.75rem 1rem;}
    .modal-spec-label {font-weight:600;margin-bottom:0.25rem;}
    .modal-spec-value {color:#555;}
    .modal-contact-section {
        margin-top:2rem;padding-top:1rem;
        border-top:1px solid #e0e0e0;
        display:flex;flex-direction:column;align-items:center;
    }
    .modal-contact-title {
        font-size:1.1rem;color:#333;font-weight:600;
        margin-bottom:1rem;text-align:center;
    }
    /* Inquiry form styles inside modal (from aggregates) */
    #inquiryForm form{background:#f7faf8;border:1px solid #e6efe8;border-radius:14px;padding:16px 18px;box-shadow:0 8px 20px rgba(0,0,0,.04)}
    #inquiryForm .form-label{display:block;font-weight:700;color:#2f3b2f;margin-bottom:.35rem}
    #inquiryForm .form-control{width:100%;padding:12px 14px;border:1px solid #e3e6e3;border-radius:10px;background:#fff;color:#333;transition:border-color .2s ease,box-shadow .2s ease,background .2s ease}
    #inquiryForm .form-control:focus{outline:0;border-color:#43a047;box-shadow:0 0 0 3px rgba(67,160,71,.18)}
    #inquiryForm textarea.form-control{min-height:110px;resize:vertical}
    #inquiryForm .mb-3{margin-bottom:1rem}
    #inquiryForm .btn-success.w-100{background:linear-gradient(135deg,#2e7d32,#1b5e20);border:0;border-radius:12px;font-weight:800;letter-spacing:.2px;padding:.85rem 1rem;box-shadow:0 10px 20px rgba(46,125,50,.25);transition:transform .15s ease,box-shadow .15s ease;color:#fff;text-shadow:0 1px 0 rgba(0,0,0,.15)}
    #inquiryForm .btn-success.w-100:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(46,125,50,.32);color:#fff}
    #inquiryForm .btn-success.w-100:active{transform:none;box-shadow:0 8px 16px rgba(46,125,50,.22)}
    /* Modern primary action button inside modal */
    .modal-contact-btn {
        display:flex;align-items:center;justify-content:center;gap:0.6rem;
        padding:0.9rem 1.75rem;border:0;border-radius:12px;
        font-weight:700;letter-spacing:.2px;cursor:pointer;
        transition:transform .15s ease,box-shadow .15s ease,background .2s ease,filter .2s ease;
        outline:0;
    }
    .modal-email-btn{
        background:linear-gradient(135deg,#2e7d32 0%,#1b5e20 100%);color:#fff;
        box-shadow:0 10px 20px rgba(46,125,50,.25),inset 0 1px 0 rgba(255,255,255,.15);
    }
    .modal-email-btn:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(46,125,50,.28);filter:saturate(1.1)}
    .modal-email-btn:active{transform:translateY(0);box-shadow:0 8px 16px rgba(46,125,50,.22)}
    .modal-email-btn:focus-visible{box-shadow:0 0 0 3px rgba(46,125,50,.35),0 10px 20px rgba(46,125,50,.25)}
    .modal-email-btn i{font-size:1rem;transition:transform .2s ease,opacity .2s ease}
    .modal-email-btn:hover i{transform:translateX(2px)}
    
    /* Product cards styling */
</style>
@endpush

@section('content')
    <!-- Concrete & Mortar Hero -->
    <section class="page-hero hero-with-bg hero-concrete-mortar">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Concrete & Mortar Testing Equipment</h1>
            <p>Professional-grade equipment for concrete and mortar testing applications</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="blogs-section">
        <div class="container">
            <!-- Search Bar -->
            <div class="products-search">
                <input type="search" placeholder="Search products, services..." class="search-input" autocomplete="off">
                <button class="search-btn" type="button"><i class="fas fa-search"></i></button>
            </div>
            
            <p class="mb-4">We provide comprehensive concrete and mortar testing equipment and services to ensure quality and durability of construction materials. Our range includes equipment for testing various properties of concrete used in construction projects.</p>
                
            <!-- Matest Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="brand-logo me-3">
                </div>
                
                <div class="blogs-grid">
                    <!-- Product 1: C386M -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/c386-astuccio.jpg') }}" alt="C386M Digital concrete test hammer with microprocessor" class="product-img">
                            <span class="product-code-badge">C386M</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Testing</span>
                                <span class="blog-standard">ASTM C805, EN 12504-2</span>
                            </div>
                            <h3 class="blog-title">Digital Concrete Test Hammer with Microprocessor</h3>
                            <p>This digital concrete test hammer can assess concrete strength and detect potential structural issues early on.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/C386M.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openC386MModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Product 2: C093-05 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/F34A423B90EF6F2F48E0B84F8D9D5733.jpg') }}" alt="Concrete Pipe Testing Machine" class="product-img">
                            <span class="product-code-badge">C093-05</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Testing</span>
                                <span class="blog-standard">EN 1916, ASTM C301, C497</span>
                            </div>
                            <h3 class="blog-title">Concrete Pipe Testing Machine</h3>
                            <p>Designed for testing concrete sewer and drain pipes used in drainage works and water supply systems.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/C093-05.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openC09305Modal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Product 3: C089-21N -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/c089-02n-1.jpg') }}" alt="Compression Testing Machine" class="product-img">
                            <span class="product-code-badge">C089-21N</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Compression</span>
                                <span class="blog-standard">ASTM C39, AASHTO T22</span>
                            </div>
                            <h3 class="blog-title">Compression Testing Machine (High end)</h3>
                            <p>2000 kN motorized machine with touch-screen control for testing blocks, cubes, and cylinders.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/C089-21N.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openC08921NModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- NL Scientific Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}" alt="NL Scientific" class="brand-logo me-3">
                </div>
                
                <div class="blogs-grid">
                    <!-- Product 1: NL 4000 X / 016U -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/nl-4000-032.jpg') }}" alt="NL 4000 X/016U Automatic Compression Machine" class="product-img">
                            <span class="product-code-badge">NL 4000 X/016U</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Compression</span>
                                <span class="blog-standard">EN 12390-3, ASTM C39</span>
                            </div>
                            <h3 class="blog-title">Automatic Compression Machine 2000kN</h3>
                            <p>Used to determine the compressive strength of concrete with automatic control and touch screen display.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL 4000 X _ 016U.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openNL4000Modal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Product 2: NL 4021 X/004 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/NL-4021-X-002.jpg') }}" alt="NL 4021 X/004 Digital Concrete Test Hammer" class="product-img">
                            <span class="product-code-badge">NL 4021 X/004</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Testing</span>
                                <span class="blog-standard">ASTM C805, EN 12504-2</span>
                            </div>
                            <h3 class="blog-title">Digital Concrete Test Hammer</h3>
                            <p>Used to determine concrete compressive strength with fully aluminium construction and high quality mechanism.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL 4021 X _ 004.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openNL4021Modal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Product 3: NL4023X / 002 & 003 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/nl4023x002003-01.jpg') }}" alt="Air Entrainment Meter" class="product-img">
                            <span class="product-code-badge">NL4023X</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Testing</span>
                                <span class="blog-standard">EN 12350-7, ASTM C231</span>
                            </div>
                            <h3 class="blog-title">Air Entrainment Meter</h3>
                            <p>Used for determining the air content in fresh concrete with manual and electric options.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL4023X _ 002 & 003.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openNL4023Modal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Capstone Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/capstone-logo-2.png') }}" alt="Capstone" class="brand-logo me-3">
                </div>
                
                <div class="blogs-grid">
                    <!-- Product 1: CAPSTONE S-350 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/TC_S350.png') }}" alt="CAPSTONE S-350" class="product-img">
                            <span class="product-code-badge">CAPSTONE S-350</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Capping</span>
                                <span class="blog-standard">Most Popular Concrete Capping Product</span>
                            </div>
                            <h3 class="blog-title">CAPSTONE S-350</h3>
                            <p>S-350 is the most popular concrete capping products of Capstone Series. S-350 provides the best balance of working ability and strength performance.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/CAPSTONE S-350.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openS350Modal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Product 2: CAPSTONE S-560 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/S-560.png') }}" alt="CAPSTONE S-560" class="product-img">
                            <span class="product-code-badge">CAPSTONE S-560</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Capping</span>
                                <span class="blog-standard">Extremely High Strength Gypsum</span>
                            </div>
                            <h3 class="blog-title">CAPSTONE S-560</h3>
                            <p>Extremely high strength gypsum for critical construction projects such as high-speed rail, highway and bridge construction.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/CAPSTONE S-560.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openS560Modal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                    
                    <!-- Product 3: CAPSTONE S-630 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/S-630.png') }}" alt="CAPSTONE S-630" class="product-img">
                            <span class="product-code-badge">CAPSTONE S-630</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Capping</span>
                                <span class="blog-standard">Newest Product with Unbeatable Strength</span>
                            </div>
                            <h3 class="blog-title">CAPSTONE S-630</h3>
                            <p>Newest product with unbeatable 9000psi strength showing the highest technique of capping gypsum worldwide.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/CAPSTONE S-630.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openS630Modal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>            <!-- EHWA Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/ehwa-logo.png') }}" alt="EHWA" class="brand-logo me-3">
                </div>
                
                <div class="blogs-grid">
                    <!-- EHWA Core Bit -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/ehwa-core-bits.png') }}" alt="EHWA Core Bits for Drilling" class="product-img">
                            <span class="product-code-badge">EHWA-CB-001</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Drilling</span>
                                <span class="blog-standard">Diamond Core Drilling Technology</span>
                            </div>
                            <h3 class="blog-title">Core Bits for Drilling</h3>
                            <p>High-performance diamond core drilling bits designed for precision drilling in concrete, masonry, and other construction materials.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/EHWA-CB-001.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openEHWACoreModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- TBT Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/tbt-logo.png') }}" alt="TBT" class="brand-logo me-3">
                </div>
                
                <div class="blogs-grid">
                    <!-- TBT CTM-2000N Compression Testing Machine -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/TBTCTM-2000N-300x300.jpg') }}" alt="TBT CTM-2000N Compression Testing Machine" class="product-img">
                            <span class="product-code-badge">CTM-2000N</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Testing Equipment</span>
                                <span class="blog-standard">ASTM C39, AASHTO T22</span>
                            </div>
                            <h3 class="blog-title">CTM-2000N Compression Testing Machine</h3>
                            <p>High-precision compression testing machine for concrete cylinders, cubes, and blocks. Features digital display and high load capacity of 2000 kN.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/TBTCTM-2000N.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openTBTCompressionModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            <!-- CTA Section -->
            <div class="more-products-cta">
                <div class="cta-card">
                    <div class="cta-text">
                        <h3>Need help finding the right equipment?</h3>
                        <p>Contact our product specialists for personalized assistance with your testing requirements</p>
                    </div>
                    <div class="cta-actions">
                        <a href="javascript:void(0)" onclick="openInquiryModal('General Inquiry', 'Concrete & Mortar')" class="cta-btn">
                            <i class="fas fa-envelope"></i> Send an Inquiry
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Improved Product Modal (copied from aggregates) -->
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
                        <div class="modal-product-standard">
                            <strong>Standard:</strong> <span id="modalProductStandard"></span>
                        </div>
                        <div class="modal-product-description">
                            <strong>Description:</strong>
                            <p id="modalProductDescription"></p>
                        </div>
                        <div class="modal-manufacturer mt-3">
                            <strong>Manufacturer:</strong> <span id="modalProductManufacturer"></span>
                        </div>
                    </div>
                </div>
                
                <div class="modal-specs-section">
                    <h4 class="modal-specs-title">Technical Specifications</h4>
                    <div id="modalSpecsGrid" class="modal-specs-grid">
                        <!-- Specifications will be populated by JavaScript -->
                    </div>
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
<script>
// Product modal functions (copied from aggregates)
function openProductModal(product) {
        document.getElementById('modalProductImage').src = product.image;
        document.getElementById('modalProductImage').alt = product.code + ' ' + product.name;
        document.getElementById('modalProductCodeBadge').textContent = product.code;
        document.getElementById('modalProductName').textContent = product.name;
        document.getElementById('modalProductStandard').textContent = product.standard || '';
        document.getElementById('modalProductDescription').textContent = product.description || '';
        document.getElementById('modalProductManufacturer').textContent = product.manufacturer || 'Gemarc Enterprises Inc.';

        // Set inquiry product field
        document.getElementById('inquiryProduct').value = product.code + ' - ' + product.name;

        // Generate specs
        const specsGrid = document.getElementById('modalSpecsGrid');
        specsGrid.innerHTML = '';
        if (product.specs && product.specs.length > 0) {
                product.specs.forEach(spec => {
                        const specItem = document.createElement('div');
                        specItem.className = 'modal-spec-item';
                        specItem.innerHTML = `
                                <div class="modal-spec-label">${spec.label}</div>
                                <div class="modal-spec-value">${spec.value}</div>
                        `;
                        specsGrid.appendChild(specItem);
                });
        } else {
                specsGrid.innerHTML = '<p>No detailed specifications available. Please refer to the PDF documentation or contact us for more information.</p>';
        }

        const modal = document.getElementById('productModal');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
}

function closeProductModal() {
        const modal = document.getElementById('productModal');
        modal.classList.remove('active');
        document.body.style.overflow = '';
        const inquiry = document.getElementById('inquiryForm');
        if (inquiry) inquiry.style.display = 'none';
}

function showInquiryForm() {
        const form = document.getElementById('inquiryForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

document.getElementById('productModal').addEventListener('click', function(event) {
        if (event.target === this) closeProductModal();
});
document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') closeProductModal();
});

    // ------- Openers (Matest) -------
  function openC386MModal(){
        openProductModal({
            code:'C386M',
            name:'Digital Concrete Test Hammer with Microprocessor',
      description:'This digital concrete test hammer can assess concrete strength and detect potential structural issues early on.',
            standard: 'EN 12504-2, ASTM C805',
            image:'{{ asset('images/highlights/c386-astuccio.jpg') }}',
            manufacturer:'MATEST',
      specs: [
        {label: 'Power Source', value: '6 rechargeable AA NiMh batteries 2400 mA/h'},
        {label: 'Battery Life', value: '60 hours with automatic shutdown'},
        {label: 'Weight', value: '3 Kg'},
        {label: 'Impact Energy', value: '2.207 Joule (Nm)'},
        {label: 'Operating Temperature', value: '-10°C to +60°C'},
        {label: 'Dimensions with Case', value: '330 × 180 × 120 mm'},
        {label: 'Measuring Range', value: '10 – 120 N/mm² (MPa)'}
      ]
    });
  }
  function openC09305Modal(){
        openProductModal({
            code:'C093-05',
            name:'Concrete Pipe Testing Machine',
      description:'Designed for testing concrete sewer and drain pipes used in drainage works and water supply systems.',
            standard: 'EN 1916, ASTM C497',
            image:'{{ asset('images/highlights/F34A423B90EF6F2F48E0B84F8D9D5733.jpg') }}',
            manufacturer:'MATEST',
      specs: [
        {label: 'Pipe Max. Diameter (External)', value: '2600 mm'},
        {label: 'Pipe Max. Length', value: '2500 mm'},
        {label: 'Upper Crossbeam', value: '2500 mm long'},
        {label: 'Pipe Min. Diameter (External)', value: '450 mm'},
        {label: 'Lower Bearers', value: '2500 mm long'},
        {label: 'Frame Construction', value: 'Structural steel, bolted with high strength bolts; easily assembled/disassembled for delivery or site displacement'},
        {label: 'Upper Crossbeams', value: 'Two beams, raised/lowered by motor two-speed operated winch; locked in position by pins through columns'},
        {label: 'Upper Loading Beam', value: 'Floating on a seat'},
        {label: 'Lower Bearers Support', value: 'Supplied flat and "V" shaped as per EN 1916 specification'},
        {label: 'Power Supply (Winch)', value: '230/400V 3ph 50Hz 2000W'},
        {label: 'Frame Dimensions', value: '3700 x 2500 x 6900 mm approx.'},
        {label: 'Weight', value: '7000 Kg approx.'}
      ]
    });
  }
    function openC08921NModal(){
        openProductModal({
            code:'C089-21N',
            name:'Compression Testing Machine (High end)',
      description:'2000 kN motorized machine with touch-screen control for testing blocks, cubes, and cylinders.',
            standard: 'EN 12390-4, ASTM C39',
            image:'{{ asset('images/highlights/c089-02n-1.jpg') }}',
            manufacturer:'MATEST',
      specs: [
        {label: 'Max Vertical Daylight', value: '336 mm'},
        {label: 'Compression Platens', value: 'Ø 287 x 51 mm'},
        {label: 'Calibration Accuracy', value: 'Class 1'},
        {label: 'Horizontal Daylight Between Columns', value: '272 mm'},
        {label: 'Frame Design', value: 'High stiffness and heavy weight 4 columns frame (German-style)'},
        {label: 'Max Ram Travel', value: '55 mm approx.'},
        {label: 'Power Supply', value: '230V 1ph 50Hz 750W'},
        {label: 'Weight', value: '1050…1120 Kg'},
        {label: 'Dimensions', value: '500 x 500 x 1100 mm approx.'}
      ]
    });
  }

  // ------- Openers (NL) -------
  function openNL4000Modal(){
        openProductModal({
            code:'NL 4000 X/016U',
            name:'Automatic Compression Machine 2000kN',
      description:'Used to determine the compressive strength of concrete with automatic control and touch screen display.',
            standard: 'EN 12390-4, ASTM C39',
            image:'{{ asset('images/highlights/nl-4000-032.jpg') }}',
            manufacturer:'NL Scientific',
      specs: [
        {label: 'Max. Vertical Clearance', value: '425 mm'},
        {label: 'Capacity', value: '2000 kN'},
        {label: 'High Range Sensitivity', value: '1000 - 2000 x 1kN'},
        {label: 'Compression Platen Diameter', value: '295 mm'},
        {label: 'Max. Horizontal Clearance', value: '270 mm'},
        {label: 'Low Range Sensitivity', value: '0 - 999 x 0.1 kN'},
        {label: 'Units Selection', value: 'kN & MPa, kgf & kgf/cm²'},
        {label: 'Piston Ram Diameter', value: '250 mm'},
        {label: 'Piston Ram Travel', value: '50 mm'},
        {label: 'Column Diameter', value: 'Ø70 mm'},
        {label: 'Product Dimension', value: '970 (L) x 610 (W) x 1300 (H) mm'},
        {label: 'Energy Saving', value: 'Designed to consume less power during operation'},
        {label: 'Approx. Product Weight', value: '783 kg'},
        {label: 'Power', value: '220 V, 2.5 Amp, 50 / 60 Hz, 1 ph'},
        {label: 'Safety Features', value: 'Piston travel switch, fully covered safety enclosure'},
        {label: 'Dual Channels', value: 'Ready for compression & flexural testing'}
      ]
    });
  }
  function openNL4021Modal(){
        openProductModal({
            code:'NL 4021 X/004',
            name:'Digital Concrete Test Hammer',
      description:'Used to determine concrete compressive strength with fully aluminium construction and high quality mechanism.',
            standard: 'EN 12504-2, ASTM C805',
            image:'{{ asset('images/highlights/NL-4021-X-002.jpg') }}',
            manufacturer:'NL Scientific',
      specs: [
        {label: 'Impact Energy', value: '2.207 Nm'},
        {label: 'Spring Tension', value: '785±30 N/m'},
        {label: 'Stretch Tension Spring', value: '75±0.3 mm'},
        {label: 'Test Result Storage', value: '240 Group'},
        {label: 'Display Graphic', value: 'High-contrast Graphic Display 256x64 (pixel) - LED Blue Display'},
        {label: 'Measuring Range', value: '10 N/mm² to 70 N/mm²'},
        {label: 'Battery Lifetime Power', value: '3.7 V (lithium battery 1600 mAh)'},
        {label: 'Reading Unit', value: 'MPa, Psi & kgf/cm²'},
        {label: 'Casing Dimension', value: '320 (L) x 190 (W) x 90 (H) mm'},
        {label: 'Weight', value: '2 kg'}
      ]
    });
  }
  function openNL4023Modal(){
        openProductModal({
            code:'NL4023X / 002 & 003',
            name:'Air Entrainment Meter',
      description:'Used for determining the air content in fresh concrete with manual and electric options.',
            standard: 'EN 12350-7, ASTM C231',
            image:'{{ asset('images/highlights/nl4023x002003-01.jpg') }}',
            manufacturer:'NL Scientific',
      specs: [
        {label: 'Chamber Capacity', value: '8 Litres'},
        {label: 'Air Content Range', value: '0-10%'},
        {label: 'Pressure Gauge', value: 'High-accuracy pressure gauge for precise measurements'},
        {label: 'Operation Type', value: 'Manual operation (002) / Electrical operation (003)'},
        {label: 'Pressure Control', value: 'Hand pumping and pressure relief (002) / Electrical pumping (003)'},
        {label: 'Construction Material', value: 'High-grade aluminum construction'},
        {label: 'Seal System', value: 'Double sealing system to prevent air leakage'},
        {label: 'Compliance', value: 'Fully compliant with international standards'},
        {label: 'Portability', value: 'Portable design for field testing'},
        {label: 'Weight (Approximate)', value: 'NL4023X / 002: 15 kg, NL4023X / 003: 18 kg'}
      ]
    });
  }

  // ------- Openers (Capstone) -------
    function openS350Modal(){
        openProductModal({
            code:'CAPSTONE S-350',
            name:'Concrete Capping Material',
      description:'S-350 is the most popular concrete capping product of Capstone Series. S-350 provides the best balance of working ability and strength performance.',
            standard: 'Most Popular Concrete Capping Product',
            image:'{{ asset('images/highlights/TC_S350.png') }}',
            manufacturer:'CAPSTONE',
      specs: [
        {label: 'Working Time', value: 'Extended for ease of use'},
        {label: 'Compressive Strength', value: 'Medium-high'},
        {label: 'Application', value: 'Concrete cylinder and cube capping'},
        {label: 'Setting Time', value: 'Balanced for optimal workflow'},
        {label: 'Durability', value: 'High durability after curing'},
        {label: 'Finish', value: 'Smooth surface finish'}
      ]
    });
  }
  
    function openS560Modal(){
        openProductModal({
            code:'CAPSTONE S-560',
            name:'High Strength Gypsum',
      description:'S-560 is an extremely high strength gypsum capping compound, formulated for high-strength concrete testing and specialized applications.',
            standard: 'Extremely High Strength Gypsum',
            image:'{{ asset('images/highlights/S-560.png') }}',
            manufacturer:'CAPSTONE',
      specs: [
        {label: 'Compressive Strength', value: 'Extremely high'},
        {label: 'Application', value: 'High-strength concrete capping'},
        {label: 'Working Time', value: 'Optimized for professional use'},
        {label: 'Setting Properties', value: 'Quick setting time'},
        {label: 'Consistency', value: 'Uniform throughout entire cap'},
        {label: 'Surface Finish', value: 'Superior smooth finish'}
      ]
    });
  }
  
    function openS630Modal(){
        openProductModal({
            code:'CAPSTONE S-630',
            name:'Ultimate Strength Capping Material',
      description:'Newest product with unbeatable 9000psi strength showing the highest technique of capping gypsum worldwide.',
            standard: 'Newest Product with Unbeatable Strength',
            image:'{{ asset('images/highlights/S-630.png') }}',
            manufacturer:'CAPSTONE',
      specs: [
        {label: 'Strength', value: 'Unbeatable 9000psi strength'},
        {label: 'Technology', value: 'Highest technique of capping gypsum worldwide'},
        {label: 'Application', value: 'Ultra-high-strength concrete testing'},
        {label: 'Setting Time', value: 'Optimized for laboratory efficiency'},
        {label: 'Consistency', value: 'Superior batch-to-batch consistency'},
        {label: 'Research Use', value: 'Ideal for advanced research applications'}
      ]
    });
  }

  // ------- Openers (EHWA) -------
  function openEHWACoreModal(){
        openProductModal({
            code:'EHWA-CB-001',
            name:'Core Bits for Drilling',
      description:'High-performance diamond core drilling bits designed for precision drilling in concrete, masonry, and other construction materials.',
            standard: 'Diamond Core Drilling Technology',
            image:'{{ asset('images/highlights/ehwa-core-bits.png') }}',
            manufacturer:'EHWA',
      specs: [
        {label: 'Model Range', value: 'ZD-R10, ZD-R20, ZD-R30'},
        {label: 'Hard Materials Application', value: 'R10 (ZD-R10), R20 (ZD-R20), R30 (ZD-R30)'},
        {label: 'Machine Power', value: '2-2.5 kW (ZD-R10), 2.5-3.3 kW (ZD-R20), 3.5+ kW (ZD-R30)'},
        {label: 'Medium Materials Application', value: 'Optimized cutting segments for medium density materials'},
        {label: 'Soft Materials Application', value: 'Specialized design for soft material drilling'},
        {label: 'Core Bit Construction', value: 'Steel body with diamond-impregnated cutting segments'},
        {label: 'Power Range', value: '2.0 kW to 5+ kW machine compatibility'},
        {label: 'Diamond Technology', value: 'High-grade diamond cutting segments'},
        {label: 'Cutting Performance', value: 'Superior cutting speed and precision'},
        {label: 'Drilling Accuracy', value: 'Precise core sample extraction'}
      ]
    });
  }

  // ------- Openers (TBT) -------
  function openTBTCompressionModal(){
        openProductModal({
            code:'CTM-2000N',
            name:'Compression Testing Machine',
      description:'High-precision compression testing machine for concrete cylinders, cubes, and blocks. Features digital display and high load capacity of 2000 kN.',
            standard: 'ASTM C39, AASHTO T22',
            image:'{{ asset('images/highlights/TBTCTM-2000N-300x300.jpg') }}',
            manufacturer:'TBT',
      specs: [
        {label: 'Maximum Load Capacity', value: '2000 kN (200 tons)'},
        {label: 'Display Type', value: 'Digital display with direct pressure readings'},
        {label: 'Force Value Maintenance', value: 'Maximum force value retention capability'},
        {label: 'Power System', value: 'Electro-hydraulically powered'},
        {label: 'Data Storage', value: 'Data saved during power outages'},
        {label: 'Test Materials', value: 'Brick, cement mortar, concrete, building materials'},
        {label: 'Data Processing', value: 'Automatic test data processing'},
        {label: 'Control System', value: 'Microprocessor-controlled operation'},
        {label: 'Dimensions (approx)', value: '1200 × 800 × 2200 mm (L×W×H)'},
        {label: 'Report Generation', value: 'Integrated test report printing'},
        {label: 'Power Requirements', value: '380V/50Hz three-phase power supply'},
        {label: 'Weight', value: 'Approximately 1500 kg'}
      ]
    });
  }
</script>
@endpush
