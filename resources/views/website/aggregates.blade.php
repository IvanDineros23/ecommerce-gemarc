@extends('layouts.app')

@section('title', 'Aggregates Testing Equipment | Gemarc Enterprises Incorporated')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background override for Aggregates */
    .page-hero.hero-with-bg.hero-aggregates{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-aggregates .hero-bg{
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') !important;
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08); /* compensate blur crop */
    }
    .page-hero.hero-with-bg.hero-aggregates .hero-overlay{
        background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px);
    }
    /* Product cards with shadow on hover */
    .blogs-section .blog-post{box-shadow:0 4px 12px rgba(0,0,0,0.05);transition:all 0.3s ease;}
    .blogs-section .blog-post:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,0.1);}
    /* Product title styling */
    .blogs-section .blog-post .blog-content h3{font-weight:700!important;font-size:1.15rem!important;letter-spacing:-.3px!important;}
    /* If still gray, apply fallback background directly */
    .page-hero.hero-with-bg.hero-aggregates.no-image{background:linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),url('{{ asset('website/images/aggregates-banner.jpg') }}') center/cover no-repeat!important;}
    /* Ensure stacking context correct */
    .page-hero.hero-with-bg.hero-aggregates .hero-bg, .page-hero.hero-with-bg.hero-aggregates::after{will-change:transform;}
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
    /* Enhanced modal styling */
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
    .modal-spec-item {
        background:#f9f9f9;border-radius:6px;padding:0.75rem 1rem;
    }
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
    /* Inquiry form styles inside modal */
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
    @media (max-width: 768px) {
        .modal-product-info {grid-template-columns:1fr;}
        .modal-specs-grid {grid-template-columns:1fr;}
    }
</style>
@endpush

@section('content')

    <!-- Aggregates Hero -->
    <section class="page-hero hero-with-bg hero-aggregates">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Aggregates Testing Equipment</h1>
            <p>Precision tools for testing and quality assurance of construction aggregates</p>
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
            
            <p class="mb-4">We provide comprehensive aggregates testing equipment and services to ensure the quality and performance of construction materials. Our range includes equipment for testing various properties of aggregates used in construction and infrastructure projects.</p>
                
                <!-- Matest Products Section -->
                <div class="brand-section mt-5 mb-4">
                    <div class="brand-header d-flex align-items-center">
                        <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="brand-logo me-3">
                    </div>
                    
                    <div class="blogs-grid">
                        <!-- Product 1: A024N -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/A024N.jpg') }}" alt="A024N Ceramic Muffle Furnace" class="product-img">
                                <span class="product-code-badge">A024N</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Furnace</span>
                                    <span class="blog-standard">EN 196-2, EN 196-21, EN 459-2</span>
                                </div>
                                <h3 class="blog-title">Ceramic Muffle Furnace</h3>
                                <p>Used to determine the loss on ignition of cement and lime; chloride, carbon dioxide, alkali content of cement.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/A024N.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openA024NModal()">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Product 2: A075N -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/A075N.jpg') }}" alt="A075N Los Angeles Machine" class="product-img">
                                <span class="product-code-badge">A075N</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Abrasion</span>
                                    <span class="blog-standard">ASTM C131, EN 12697</span>
                                </div>
                                <h3 class="blog-title">Los Angeles Abrasion Machine</h3>
                                <p>Used to determine the resistance of aggregates to abrasion and impact wear through rotation in a steel drum with a steel charge.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/A075N.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openA075NModal()">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Product 3: A125N -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/A125N.jpg') }}" alt="A125N Digital Point Load Tester" class="product-img">
                                <span class="product-code-badge">A125N</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Rock Testing</span>
                                    <span class="blog-standard">ASTM D5731, ISRM</span>
                                </div>
                                <h3 class="blog-title">Digital Point Load Tester (Rock Strength Index)</h3>
                                <p>Used to determine the strength values of a rock specimen both in the field and in the laboratory.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/A125N.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openA125NModal()">
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
                        <!-- Product 1: NL 1002 X / 002 -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/nl1002x002-01.jpg') }}" alt="NL 1002 X / 002 Aggregate Impact Value Apparatus (AIV)" class="product-img">
                                <span class="product-code-badge">NL 1002 X/002</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Impact Testing</span>
                                    <span class="blog-standard">BS 812, NF P18-574</span>
                                </div>
                                <h3 class="blog-title">Aggregate Impact Value Apparatus (AIV)</h3>
                                <p>Measures the resistance of an aggregate to sudden impact or shock loading, which may vary from its resistance to gradually applied compressive loads.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/NL 1002 X _ 002.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openNL1002X002Modal()">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Product 2: NL 1015 X / 011 -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/NL-1015-X-011.jpg') }}" alt="NL 1015 X / 011 ECO-SMARTZ Multi Amplitude Triple Motion Sieves Shaker" class="product-img">
                                <span class="product-code-badge">NL 1015 X/011</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Sieve Analysis</span>
                                    <span class="blog-standard">EN 932-5, ISO 3310-1</span>
                                </div>
                                <h3 class="blog-title">Triple Motion Sieve Shaker</h3>
                                <p>Features triple motion functionality incorporating vertical, horizontal, and rotational motions for thorough and efficient sieving of aggregate materials.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/NL 1015 X _ 011.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openNL1015X011Modal()">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Product 3: NL 1003 X -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/NL-1003-X.jpg') }}" alt="NL 1003 X Bulk Density Measurement" class="product-img">
                                <span class="product-code-badge">NL 1003 X</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Density Testing</span>
                                    <span class="blog-standard">ASTM C29, BS EN 1097-3</span>
                                </div>
                                <h3 class="blog-title">Bulk Density Measure</h3>
                                <p>Steel constructed with handles for capacity 1 litre and above. Used to determine the loose bulk density and void content of aggregates.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/NL 1003 X.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openNL1003XModal()">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                
                <!-- LabTech BioMedic Products Section -->
                <div class="brand-section mt-5 mb-4">
                    <div class="brand-header d-flex align-items-center">
                        <img src="{{ asset('images/highlights/partnership/labtech_logo.jpg') }}" alt="LabTech BioMedic" class="brand-logo me-3">
                    </div>
                    
                    <div class="blogs-grid">
                        <!-- Product 1: LDO-060E -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/LDO-060E.jpg') }}" alt="LDO-060E Universal Drying Oven" class="product-img">
                                <span class="product-code-badge">LDO-060E</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Laboratory</span>
                                    <span class="blog-standard">Advanced Temperature Control</span>
                                </div>
                                <h3 class="blog-title">Natural Convection Oven</h3>
                                <p>Stainless Steel chamber for excellent corrosion resistance and easy cleaning. Features natural convection of heated air without a separate fan.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/LDO-060E.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openLDO060EModal()">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Product 2: LBD-2045D -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/LBD-2045-D.jpg') }}" alt="LBD-2045D Hotplate & Stirrer" class="product-img">
                                <span class="product-code-badge">LBD-2045D</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Laboratory</span>
                                    <span class="blog-standard">High Density Ceramic Coating</span>
                                </div>
                                <h3 class="blog-title">Hotplate & Stirrer</h3>
                                <p>High density ceramic coated stainless steel top plate for excellent chemical resistance and durability. Features excellent heat transfer capabilities.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/LBD-2045D.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openLBD2045DModal()">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </article>
                        
                        <!-- Product 3: LWB-111D -->
                        <article class="blog-post">
                            <div class="blog-image">
                                <img src="{{ asset('images/highlights/LWB-111D.jpg') }}" alt="LWB-111D Digital Water Bath" class="product-img">
                                <span class="product-code-badge">LWB-111D</span>
                            </div>
                            <div class="blog-content p-3">
                                <div class="blog-meta">
                                    <span class="blog-category">Laboratory</span>
                                    <span class="blog-standard">Stainless Steel Construction</span>
                                </div>
                                <h3 class="blog-title">Digital Water Bath</h3>
                                <p>Seamless stainless-steel bath for excellent corrosion resistance and easy cleaning. Features temperature auto tuning for precise control.</p>
                                <div class="blog-actions">
                                    <a href="{{ asset('downloadable content/LWB-111D.pdf') }}" class="btn btn-pdf" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF Specs
                                    </a>
                                    <button class="btn btn-details" onclick="openLWB111DModal()">
                                        <i class="fas fa-eye"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <!-- More Products Section (Modern CTA) -->
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
        </div>
    </section>

    <!-- Improved Product Modal -->
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

    <script>
    // Simple expand/collapse for product specs (unique to this page)
    function toggleProductSpecs(specsId) {
        var specsDiv = document.getElementById(specsId);
        if (!specsDiv) return;
        var btn = specsDiv.previousElementSibling;
        if (!btn) return;
        if (specsDiv.style.display === 'none' || specsDiv.style.display === '') {
            specsDiv.style.display = 'block';
            btn.innerHTML = '<i class="fas fa-chevron-up"></i> Hide Specifications';
            btn.classList.add('expanded');
        } else {
            specsDiv.style.display = 'none';
            btn.innerHTML = '<i class="fas fa-chevron-down"></i> View Specifications';
            btn.classList.remove('expanded');
        }
    }
    </script>

    <!-- Only one Product Modal is needed -->
    <!-- The duplicate modal fragment was removed to prevent DOM issues -->

    <script src="{{ asset('website/script.js') }}"></script>
    <script src="{{ asset('js/aggregates.js') }}"></script>
    <script>
    // Keep only small page-specific overrides here if needed
    window.openA024NModal = function() {
        openProductModal({
            code: 'A024N',
            name: 'Ceramic Muffle Furnace',
            standard: 'EN 196-2, EN 196-21, EN 459-2',
            description: 'Used to determine the loss on ignition of cement and lime; chloride, carbon dioxide, alkali content of cement.',
            image: '{{ asset("images/highlights/A024N.jpg") }}',
            manufacturer: 'MATEST',
            manufacturerUrl: 'https://www.matest.com/',
            pdf: 'downloadable content/A024N.pdf',
            specs: [
                {label: 'Temperature Range', value: 'Up to 1100°C'},
                {label: 'Chamber Size', value: '300 x 200 x 100 mm'},
                {label: 'Heating Elements', value: 'Silicon Carbide'},
                {label: 'Controller', value: 'Digital PID controller'},
                {label: 'Accuracy', value: '±2°C'},
                {label: 'Power Supply', value: '230V, 50/60Hz'},
                {label: 'Power', value: '3.5 kW'},
                {label: 'Safety Features', value: 'Over-temp protection, door safety switch'}
            ]
        });
    }

    window.openA075NModal = function() {
        openProductModal({
            code: 'A075N',
            name: 'LOS ANGELES ABRASION MACHINE',
            standard: 'ASTM C131, EN 12697-17, EN 12697-43, NF P18-573, AASHTO T96, CNR N. 34',
            description: 'Used to determine the resistance of aggregates to abrasion.',
            image: '{{ asset("images/highlights/A075N.jpg") }}',
            manufacturer: 'MATEST',
            manufacturerUrl: 'https://www.matest.com/',
            pdf: 'downloadable content/A075N.pdf',
            specs: [
                {label: 'Cylinder Dimensions', value: '711 mm (ID) x 508 mm (Length)'},
                {label: 'Rotation Speed', value: '31-33 rpm'},
                {label: 'Material', value: 'Heavy steel construction'},
                {label: 'Drive', value: 'Gear motor with speed reducer'},
                {label: 'Counter', value: 'Automatic digital counter, presettable'},
                {label: 'Filling Opening', value: 'Counterbalanced, push-button positioning'},
                {label: 'Control Panel', value: 'Wall fixed or bench placed'},
                {label: 'Power Supply', value: '230V 50Hz 1ph 750W'},
                {label: 'Dimensions', value: '1000x800x1000 mm'},
                {label: 'Weight', value: '370 kg approx.'}
            ]
        });
    }

    window.openA125NModal = function() {
        openProductModal({
            code: 'A125N',
            name: 'Digital Point Load Tester 56 KN (ROCK STRENGTH INDEX)',
            standard: 'ASTM D5731, ISRM',
            description: 'Used to determine the strength values of a rock specimen both in the field and in the laboratory.',
            image: '{{ asset("images/highlights/A125N.jpg") }}',
            manufacturer: 'MATEST',
            manufacturerUrl: 'https://www.matest.com/',
            pdf: 'downloadable content/A125N.pdf',
            specs: [
                {label: 'Load Cell', value: 'High precision electric'},
                {label: 'Capacity', value: '56 kN (100 kN mod. A126)'},
                {label: 'Max Core Specimen', value: '4" (101.6 mm)'},
                {label: 'Distance Reading', value: 'Graduated scale'},
                {label: 'Display Unit', value: 'Digital, 0-56 kN, 65,000 divisions, 0.001 kN resolution'},
                {label: 'Linearity', value: '0.05%'},
                {label: 'Hysteresis', value: '0.03%'},
                {label: 'Repeatability', value: '0.02%'},
                {label: 'Supplied With', value: 'Wooden carrying case, goggles, accessories'},
                {label: 'Dimensions', value: '370x520x720 mm'},
                {label: 'Weight', value: '28 kg approx.'}
            ]
        });
    }

    window.openNL1002X002Modal = function() {
    openProductModal({
        code: 'NL 1002 X / 002',
        name: 'Aggregate Impact Value Apparatus (AIV)',
        standard: 'BS 812, NF P18-574',
        description: 'Used to determine the aggregate impact value by measuring the resistance of an aggregate to sudden impact or shock loading, which may vary from its resistance to gradually applied compressive loads on construction materials such as crushed stones and gravel. It is determined by subjecting a sample of aggregate to a standard amount of impact, usually in a testing machine, and then measuring the percentage of fines produced.',
        image: '{{ asset("images/highlights/nl1002x002-01.jpg") }}',
        manufacturer: 'NL Scientific',
        manufacturerUrl: 'https://nl-test.com/',
        pdf: 'downloadable content/NL 1002 X _ 002.pdf',
        specs: [
            {label: 'Dimensions', value: '470 (L) x 330 (W) x 850 (H)'},
            {label: 'Weight', value: '48 kg'}
        ]
    });
}


    window.openNL1015X011Modal = function() {
        openProductModal({
            code: 'NL 1015 X / 011',
            name: 'Sieve Shaker, Triple Motion (From 200 up to 450 mm Dia.)',
            standard: 'EN 932-5, ISO 3310-1, ASTM C136',
            description: 'Triple motion functionality incorporating vertical, horizontal, and rotational motions for thorough and efficient sieving. Features variable speed control, digital timer, and can accommodate sieves from 200mm to 450mm diameter.',
            image: '{{ asset("images/highlights/NL-1015-X-011.jpg") }}',
            manufacturer: 'NL Scientific',
            manufacturerUrl: 'https://nl-test.com/',
            pdf: 'downloadable content/NL 1015 X _ 011.pdf',
            specs: [
                {label: 'Model Number', value: 'NL 1015 X / 009A'},
                {label: 'Accommodates', value: '11 nos 200mm/8" Dia. Full Height Sieves plus lid and receiver, 9 nos 300mm/12" Dia. Full Height Sieves plus lid and receiver, 7 nos. 450mm Dia. Full Height Sieves plus lid and pan'},
                {label: 'Timer', value: '1 - 60 min'},
                {label: 'Dimensions (mm)', value: '585 (L) x 460 (W) x 1250 (H)'},
                {label: 'Weight', value: '105 kg approx.'},
                {label: 'Power', value: '220V, 1ph, 1/2 Hp, 50/60 Hz, 375W'},
                {label: 'Motion Types', value: 'Vertical, Horizontal, and Rotational'},
                {label: 'Speed Control', value: 'Variable speed control'},
                {label: 'Features', value: 'Digital timer, Low noise pollution, Quick clamping & release mechanism'},
                {label: 'Construction', value: 'Durable materials for continuous laboratory use'},
                {label: 'Included Parts', value: 'Clamping Knobs (Pair), Clamping Beam, Threaded Column Set, Manual Instruction'},
                {label: 'Optional Accessories', value: 'Noise Reduction Cabinet (NL 1015 X / SPC)'}
            ]
        });
    }

    window.openNL1003XModal = function() {
        openProductModal({
            code: 'NL 1003 X',
            name: 'Bulk Density Measure',
            standard: 'ASTM C29, BS EN 1097-3',
            description: 'Steel constructed with handles for capacity 1 litre and above. Used to determine the loose bulk density and void of aggregate. Available in multiple capacities for different testing requirements.',
            image: '{{ asset("images/highlights/NL-1003-X.jpg") }}',
            manufacturer: 'NL Scientific',
            manufacturerUrl: 'https://nl-test.com/',
            pdf: 'downloadable content/NL 1003 X.pdf',
            specs: [
                {label: 'Construction', value: 'Steel with handles'},
                {label: 'Application', value: 'Determination of loose bulk density and void of aggregate'},
                {label: 'BS EN 1097-3 Models', value: '1L (NL 1003 X / 001), 5L (NL 1003 X / 002), 10L (NL 1003 X / 003), 20L (NL 1003 X / 004)'},
                {label: 'ASTM C29 Models', value: '14L (NL 1003 X / 005), 28L (NL 1003 X / 007), 2.8L (NL 1003 X / 010), 9.3L (NL 1003 X / 011)'},
                {label: 'Additional Accessories', value: 'Straight Edge 300x30x3mm (NL 5001 X / 001 - A 023), Glass Plate 300x300x8mm (NL 7030 G / 002)'},
                {label: 'Capacity Range', value: '1 litre to 28 litres'},
                {label: 'Standards Compliance', value: 'ASTM C29 and BS EN 1097-3'},
                {label: 'Material', value: 'Durable steel construction'},
                {label: 'Handle Design', value: 'Ergonomic handles for easy handling'},
                {label: 'Applications', value: 'Construction materials testing, aggregate quality control, concrete mix design'}
            ]
        });
    }

    window.openLDO060EModal = function() {
        openProductModal({
            code: 'LDO-060E',
            name: 'Natural Convection Oven',
            standard: 'Advanced Temperature Control & Natural Convection',
            description: 'Stainless Steel chamber for excellent corrosion resistance and easy cleaning. Insulation and sealing structure with silicone packing enable excellent temp. uniformity. Natural convection of heated air w/o a separate fan. Temp. auto - tuning function available.',
            image: '{{ asset("images/highlights/LDO-060E.jpg") }}',
            manufacturer: 'LabTech BioMedic',
            manufacturerUrl: 'https://www.labtech.co.kr/',
            pdf: 'downloadable content/LDO-060E.pdf',
            specs: [
                {label: 'Chamber Material', value: 'Stainless steel for excellent corrosion resistance and easy cleaning'},
                {label: 'Insulation', value: 'Sealing structure with silicone packing for excellent temperature uniformity'},
                {label: 'Air Circulation', value: 'Natural convection of heated air without a separate fan'},
                {label: 'Ventilation', value: 'A vent port is installed on the top for emitting gas'},
                {label: 'Shelves', value: 'Stainless steel wire shelves are included as standard'},
                {label: 'Controller', value: 'Microprocessor PID digital controller provides excellent precise control'},
                {label: 'Auto-Tuning', value: 'Temperature auto-tuning function available'},
                {label: 'Timer Options', value: 'Timer 99hr. 59min. available (Timer end alarm available)'},
                {label: 'Temperature Alarms', value: 'High/Low temperature alarm'},
                {label: 'Memory Function', value: 'Setting value is preserved even when the power supply is cut'},
                {label: 'Capacity Options', value: 'LDO-030E: 35ℓ, LDO-060E: 64ℓ, LDO-100E: 100ℓ, LDO-150E: 150ℓ'},
                {label: 'Temperature Range', value: 'Ambient +5°C to 250°C Max.'},
                {label: 'Temperature Accuracy', value: '±1.0°C'},
                {label: 'Temperature Uniformity', value: '±5.0°C at 120°C'},
                {label: 'Display', value: 'LED 4 Digit display'},
                {label: 'Interior Material', value: 'Stainless steel polished'},
                {label: 'Exterior Material', value: 'Epoxy powder coated steel'},
                {label: 'Insulation', value: 'Glass wool'},
                {label: 'Shelves', value: '2 EA'},
                {label: 'Safety Features', value: 'Over temperature protection, Electric leakage circuit breaker'},
                {label: 'Electric Supply', value: '110 V, 60 Hz or 220 V, 50 or 60 Hz, 1 Phase'}
            ]
        });
    }
    window.openLBD2045DModal = function() {
        openProductModal({
            code: 'LBD-2045D',
            name: 'Hotplate & Stirrer',
            standard: 'High Density Ceramic Coating & Temperature Control',
            description: 'High density ceramic coated stainless steel top plate for excellent chemical resistance. High class powder coated aluminium casting body for excellent heat and corrosion resistance. A heater that is durable and excellent in heat transfer is equipped.',
            image: '{{ asset("images/highlights/LBD-2045-D.jpg") }}',
            manufacturer: 'LabTech BioMedic',
            specs: [
                {label: 'Top Plate', value: 'High density ceramic coated stainless steel for excellent chemical resistance'},
                {label: 'Body', value: 'High class powder coated aluminium casting body for excellent heat and corrosion resistance'},
                {label: 'Heater', value: 'Durable heater with excellent heat transfer'},
                {label: 'Temperature Range', value: 'Room temperature to 380°C'},
                {label: 'Stirring Speed', value: '60-1500 rpm'},
                {label: 'Top Plate Size', value: '180 x 180 mm'},
                {label: 'Heating Power', value: '600W'},
                {label: 'Power Supply', value: '220V, 50/60Hz'}
            ]
        });
    }

    window.openLWB111DModal = function() {
        openProductModal({
            code: 'LWB-111D',
            name: 'Digital Water Bath',
            standard: 'Stainless Steel Construction & Auto Tuning',
            description: 'Durable to use in many fields for general purpose. Seamless stainless-steel bath for excellent corrosion resistance and easy cleaning. Heater cover is provided to protect the heater and sensor from unexpected damage. Temperature auto tuning function available.',
            image: '{{ asset("images/highlights/LWB-111D.jpg") }}',
            manufacturer: 'LabTech BioMedic',
            specs: [
                {label: 'Bath Construction', value: 'Seamless stainless steel'},
                {label: 'Design', value: 'Compact design for versatile use'},
                {label: 'Protection', value: 'Heater cover protects heater and sensor'},
                {label: 'Controller', value: 'Digital PID controller with LED display'},
                {label: 'Auto-Tuning', value: 'Temperature auto-tuning function'},
                {label: 'Timer', value: '99 hr. 59 min. / Continuous with end alarm'},
                {label: 'Temperature Range', value: 'Ambient + 5°C to 99°C'},
                {label: 'Material Interior', value: 'Seamless stainless steel (STS304)'},
                {label: 'Safety Features', value: 'Over temperature protection, Earth leakage circuit breaker'},
                {label: 'Power Supply', value: '220 V 50/60 Hz, 1 Phase'}
            ]
        });
    }
@endsection

@push('scripts')
<script>
// Product modal functions
function openProductModal(product) {
    // Set product details
    document.getElementById('modalProductImage').src = product.image;
    document.getElementById('modalProductImage').alt = product.code + ' ' + product.name;
    document.getElementById('modalProductCodeBadge').textContent = product.code;
    document.getElementById('modalProductName').textContent = product.name;
    document.getElementById('modalProductStandard').textContent = product.standard;
    document.getElementById('modalProductDescription').textContent = product.description;
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
    
    // Show modal with animation
    const modal = document.getElementById('productModal');
    modal.classList.add('active');
    
    // Prevent body scrolling
    document.body.style.overflow = 'hidden';
}

function closeProductModal() {
    const modal = document.getElementById('productModal');
    modal.classList.remove('active');
    
    // Re-enable body scrolling
    document.body.style.overflow = '';
    
    // Hide inquiry form
    document.getElementById('inquiryForm').style.display = 'none';
}

function showInquiryForm() {
    const form = document.getElementById('inquiryForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

// Close modal when clicking outside
document.getElementById('productModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeProductModal();
    }
});

// Close modal on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeProductModal();
    }
});

// Form submission handler
        // Defensive: bind submit handler only if form exists (aggregates.js already handles core modal)
        var _inquiryForm = document.querySelector('#inquiryForm form');
        if (_inquiryForm) {
            _inquiryForm.addEventListener('submit', function(e){
                e.preventDefault();
                alert('Thank you for your inquiry. Our team will contact you shortly.');
                document.getElementById('inquiryForm').style.display = 'none';
            });
        }
</script>
@endpush

