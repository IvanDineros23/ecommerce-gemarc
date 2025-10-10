@extends('layouts.app')
@section('title', 'Asphalt & Bitumen | Gemarc Enterprises Incorporated')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background for Asphalt */
    .page-hero.hero-with-bg.hero-asphalt{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-asphalt .hero-bg{
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}');
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08);
    }
    .page-hero.hero-with-bg.hero-asphalt .hero-overlay{background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px)}
    /* Brand header + logos */
    .brand-header{margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #e0e0e0}
    .brand-logo{height:64px;max-height:64px;width:auto;object-fit:contain}
    .brand-title{display:none!important}
    /* Product cards hover (reuse blogs style subtle tweak) */
    .blogs-section .blog-post{box-shadow:0 4px 12px rgba(0,0,0,.05);transition:all .3s ease}
    .blogs-section .blog-post:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,.1)}
    .blog-image{position:relative;height:220px;overflow:hidden}
    .blog-image img{width:100%;height:100%;object-fit:cover;transition:all .5s ease}
    .blog-post:hover .blog-image img{transform:scale(1.05)}
    .product-code-badge{position:absolute;top:10px;right:10px;background:rgba(46,125,50,.85);color:#fff;padding:4px 8px;border-radius:4px;font-size:.85rem;font-weight:600}
    /* Button styles (match aggregates) */
    .blog-actions{display:flex;margin-top:1rem;gap:.5rem}
    .blog-actions .btn{flex:1;padding:8px 12px;font-size:.9rem;border-radius:6px;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .2s ease}
    .blog-actions .btn-pdf{background:#f5f5f5;color:#333}
    .blog-actions .btn-pdf:hover{background:#e0e0e0}
    .blog-actions .btn-details{background:#2e7d32;color:#fff}
    .blog-actions .btn-details:hover{background:#1b5e20}
    /* Modal styles match Aggregates */
    .modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.7);backdrop-filter:blur(5px);display:flex;align-items:center;justify-content:center;z-index:9999;opacity:0;visibility:hidden;transition:all .3s ease}
    .modal-overlay.active{opacity:1;visibility:visible}
    .modal-content{background:#fff;border-radius:12px;width:90%;max-width:900px;max-height:90vh;overflow:hidden;box-shadow:0 25px 50px -12px rgba(0,0,0,.25);transform:scale(.95);opacity:0;transition:all .3s ease}
    .modal-overlay.active .modal-content{transform:scale(1);opacity:1}
    .modal-header{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.5rem;border-bottom:1px solid #e0e0e0}
    .modal-title{margin:0;font-size:1.5rem;color:#2e7d32;font-weight:700}
    .modal-close{background:none;border:none;font-size:1.75rem;color:#666;cursor:pointer}
    .modal-body{padding:1.5rem;overflow-y:auto;max-height:calc(90vh - 70px)}
    .modal-product-info{display:grid;grid-template-columns:1fr 1.5fr;gap:2rem}
    .modal-product-image{background:#f5f5f5;border-radius:8px;padding:1rem;display:flex;align-items:center;justify-content:center}
    .modal-product-img{max-width:100%;max-height:300px;object-fit:contain}
    .modal-product-name{font-size:1.5rem;color:#1b5e20;font-weight:700;margin:.5rem 0 1rem}
    .modal-specs-section{margin-top:2rem}
    .modal-specs-title{font-size:1.25rem;color:#2e7d32;font-weight:600;padding-bottom:.5rem;border-bottom:1px solid #e0e0e0;margin-bottom:1rem}
    .modal-specs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem}
    .modal-spec-item{background:#f9f9f9;border-radius:6px;padding:.75rem 1rem}
    .modal-contact-section{margin-top:2rem;padding-top:1rem;border-top:1px solid #e0e0e0;display:flex;flex-direction:column;align-items:center}
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
    .modal-contact-btn{display:flex;align-items:center;justify-content:center;gap:.6rem;padding:.9rem 1.75rem;border:0;border-radius:12px;font-weight:700;letter-spacing:.2px;cursor:pointer;transition:transform .15s ease,box-shadow .15s ease,background .2s ease,filter .2s ease;outline:0}
    .modal-email-btn{background:linear-gradient(135deg,#2e7d32 0%,#1b5e20 100%);color:#fff;box-shadow:0 10px 20px rgba(46,125,50,.25),inset 0 1px 0 rgba(255,255,255,.15)}
    .modal-email-btn:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(46,125,50,.28);filter:saturate(1.1)}
    .modal-email-btn:active{transform:translateY(0);box-shadow:0 8px 16px rgba(46,125,50,.22)}
    .modal-email-btn:focus-visible{box-shadow:0 0 0 3px rgba(46,125,50,.35),0 10px 20px rgba(46,125,50,.25)}
    .modal-email-btn i{font-size:1rem;transition:transform .2s ease,opacity .2s ease}
    .modal-email-btn:hover i{transform:translateX(2px)}
    @media(max-width:768px){.modal-product-info{grid-template-columns:1fr}.modal-specs-grid{grid-template-columns:1fr}}
    /* Modern CTA */
    .more-products-cta{margin:3rem 0}
    .cta-card{background:linear-gradient(135deg,#1b5e20,#43a047);color:#fff;border-radius:14px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 10px 30px rgba(27,94,32,.25)}
    .cta-text h3{margin:0 0 6px;font-size:1.4rem;font-weight:800}
    .cta-text p{margin:0;opacity:.9}
    .cta-actions .cta-btn{display:inline-flex;align-items:center;gap:10px;background:#fff;color:#1b5e20;padding:12px 18px;border-radius:10px;font-weight:700;text-decoration:none}
    @media(max-width:768px){.cta-card{flex-direction:column;gap:14px;align-items:flex-start}}
</style>
@endpush

@section('content')

    <!-- Hero (match aggregates style) -->
    <section class="page-hero hero-with-bg hero-asphalt">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Asphalt & Bitumen Testing Equipment</h1>
            <p>Reliable tools for road construction materials and bituminous mix testing</p>
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

            <p class="mb-4">We provide comprehensive asphalt and bitumen testing equipment to ensure the quality and performance of road construction materials. Our equipment meets international standards for testing bituminous materials and asphalt mixtures.</p>

            <!-- Matest Products -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="brand-logo me-3">
                </div>
                <div class="blogs-grid">
                    <!-- B011 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/B011.jpg') }}" alt="B011 Centrifuge Extractor" class="product-img">
                            <span class="product-code-badge">B011</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Extraction</span><span class="blog-standard">ASTM D2172, AASHTO T164A, EN 12697-1</span></div>
                            <h3 class="blog-title">Centrifuge Extractor</h3>
                            <p>Determines bitumen percentage in bituminous mixtures with a precision rotor bowl.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/B011.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openB011Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                    <!-- B043 KIT -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/B043-KIT.jpg') }}" alt="B043 KIT Digital Marshall Tester" class="product-img">
                            <span class="product-code-badge">B043 KIT</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Marshall</span><span class="blog-standard">EN 12697-34, ASTM D6927</span></div>
                            <h3 class="blog-title">Digital Marshall Tester 50kN</h3>
                            <p>Measures stability and flow with high-precision load and displacement transducers.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/B043-KIT.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openB043KITModal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                    <!-- B055 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/B055.jpg') }}" alt="B055 Ductilometer with Cooling" class="product-img">
                            <span class="product-code-badge">B055</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Ductility</span><span class="blog-standard">EN 13398, ASTM D113</span></div>
                            <h3 class="blog-title">Ductilometer with Cooling</h3>
                            <p>Determines bituminous ductility with integrated refrigeration for precise control.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/B055.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openB055Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- NL Scientific Products -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}" alt="NL Scientific" class="brand-logo me-3">
                </div>
                <div class="blogs-grid">
                    <!-- NL 1012 X / 008 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/NL 1012 X 008.png') }}" alt="NL 1012 X / 008 Point Load Tester" class="product-img">
                            <span class="product-code-badge">NL 1012 X/008</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Rock Testing</span><span class="blog-standard">ASTM D5731</span></div>
                            <h3 class="blog-title">Point Load Tester, Digimatic</h3>
                            <p>Measures point load strength; rigid frame with hydraulic ram and hand pump.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL 1012 X _ 008.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openNL1012X008Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                    <!-- NL 2001 X / 005 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/NL-2001-X-005.png') }}" alt="NL 2001 X / 005 Digital Penetrometer" class="product-img">
                            <span class="product-code-badge">NL 2001 X/005</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Penetration</span><span class="blog-standard">EN 1426, ASTM D5</span></div>
                            <h3 class="blog-title">Digital Penetrometer</h3>
                            <p>Determines consistency via penetration depth under standard load with digital accuracy.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL 2001 X _ 005.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openNL2001X005Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                    <!-- NL 2007 X -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/NL-2007-X-002.png') }}" alt="NL 2007 X Vacuum Pyknometer" class="product-img">
                            <span class="product-code-badge">NL 2007 X</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Density</span><span class="blog-standard">EN 12697-5, ASTM D2041</span></div>
                            <h3 class="blog-title">Vacuum Pyknometer</h3>
                            <p>Determines theoretical maximum specific gravity of bituminous mixes.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL 2007 X.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openNL2007XModal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Modern CTA like aggregates -->
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

    <!-- Product Modal (same as aggregates) -->
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
                    <button type="button" class="modal-contact-btn modal-email-btn" onclick="showInquiryForm()"><i class="fas fa-envelope"></i> Send Inquiry</button>
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

    <script src="{{ asset('website/script.js') }}"></script>
    <script>
    // Shared modal logic (from aggregates)
    function openProductModal(product){
        document.getElementById('modalProductImage').src = product.image;
        document.getElementById('modalProductImage').alt = product.code + ' ' + product.name;
        document.getElementById('modalProductCodeBadge').textContent = product.code;
        document.getElementById('modalProductName').textContent = product.name;
        document.getElementById('modalProductStandard').textContent = product.standard || '';
        document.getElementById('modalProductDescription').textContent = product.description || '';
        document.getElementById('modalProductManufacturer').textContent = product.manufacturer || 'Gemarc Enterprises Inc.';
        // inquiry product
        var inq = document.getElementById('inquiryProduct'); if(inq) inq.value = product.code + ' - ' + product.name;
        // specs
        const specsGrid = document.getElementById('modalSpecsGrid'); specsGrid.innerHTML = '';
        if(product.specs && product.specs.length){
            product.specs.forEach(s=>{ const d=document.createElement('div'); d.className='modal-spec-item'; d.innerHTML = `<div class="modal-spec-label">${s.label}</div><div class="modal-spec-value">${s.value}</div>`; specsGrid.appendChild(d); });
        } else { specsGrid.innerHTML = '<p>No detailed specifications available. Please refer to the PDF documentation or contact us for more information.</p>'; }
        document.getElementById('productModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeProductModal(){document.getElementById('productModal').classList.remove('active');document.body.style.overflow='';document.getElementById('inquiryForm').style.display='none'}
    function showInquiryForm(){const f=document.getElementById('inquiryForm');f.style.display = (f.style.display==='none'||!f.style.display)?'block':'none'}
    document.getElementById('productModal').addEventListener('click',function(e){if(e.target===this) closeProductModal()});
    document.addEventListener('keydown',function(e){if(e.key==='Escape') closeProductModal()});
    (function(){var _f=document.querySelector('#inquiryForm form'); if(_f){_f.addEventListener('submit',function(e){e.preventDefault(); alert('Thank you for your inquiry. Our team will contact you shortly.'); document.getElementById('inquiryForm').style.display='none';});}})();

    // Product openers
    window.openB011Modal = function(){
        openProductModal({
            code:'B011', name:'Centrifuge Extractor', standard:'ASTM D2172, AASHTO T164A, EN 12697-1',
            description:'Determines bitumen percentage in bituminous mixtures with a precision rotor bowl in aluminium housing.',
            image:'{{ asset('images/highlights/B011.jpg') }}', manufacturer:'MATEST',
            specs:[
                {label:'Capacity',value:'ROTAREX 1500 / 3000 g'},
                {label:'Bowl Type',value:'Removable, precision machined aluminium rotor bowl'},
                {label:'Housing',value:'Cylindrical aluminium box'},
                {label:'Control Panel',value:'Electronic card fitted with AC drive'},
                {label:'Speed Range',value:'0 to 3600 rpm automatic rotation ramp'},
                {label:'Rotation Control',value:'Fast stop bowl rotation at end of test'},
                {label:'Display',value:'Digital display monitoring the frequency'},
                {label:'Power Supply',value:'230V 1ph 50-60Hz 600W'},
                {label:'Dimensions',value:'480x330x530 mm'},
                {label:'Weight',value:'50 kg approx.'}
            ]
        });
    }
    window.openB043KITModal = function(){
        openProductModal({
            code:'B043 KIT', name:'Digital Marshall Tester 50kN Capacity', standard:'EN 12697-34, 12697-23, 12697-12; ASTM D6927',
            description:'High-precision load cell and displacement transducer for Marshall stability and flow.',
            image:'{{ asset('images/highlights/B043-KIT.jpg') }}', manufacturer:'MATEST',
            specs:[
                {label:'Load Cell Capacity', value:'50 kN'},
                {label:'Flow Measurement', value:'Electronic displacement transducer 50 mm, ±0.1% linearity'},
                {label:'Display Unit', value:'Cyber-Plus Progress 8 channels digital display'},
                {label:'Power Supply', value:'230 V 1 ph 50 Hz 900 W'},
                {label:'Dimensions', value:'650x400x1100 mm'},
                {label:'Weight', value:'120 kg'}
            ]
        });
    }
    window.openB055Modal = function(){
        openProductModal({
            code:'B055', name:'Ductilometer with Cooling System', standard:'EN 13398, EN 13589; ASTM D113',
            description:'Determines bituminous ductility with integrated refrigeration (water temperature +5° to +25°C).',
            image:'{{ asset('images/highlights/B055.jpg') }}', manufacturer:'MATEST',
            specs:[
                {label:'Temperature Range', value:'+5° to +25°C'},
                {label:'Dimensions', value:'1880x360x680 mm'},
                {label:'Weight', value:'130 kg'}
            ]
        });
    }
    window.openNL1012X008Modal = function(){
        openProductModal({
            code:'NL 1012 X / 008', name:'Point Load Tester, Digimatic', standard:'ASTM D5731',
            description:'Rigid frame with hydraulic loading ram, hand-pump actuated; precise digimatic display.',
            image:'{{ asset('images/highlights/NL 1012 X 008.png') }}', manufacturer:'NL Scientific',
            specs:[
                {label:'Model Number', value:'NL 1012 X / 008'},
                {label:'Max. Capacity', value:'50 kN x 0.01 kN Sensitivity'},
                {label:'Max. Specimen Test', value:'90 mm Dia.'},
                {label:'Power', value:'1.8 Ah Rechargeable with AC 220 V'},
                {label:'Result Storage', value:'999 Test Results'},
                {label:'Accuracy & Repeatability', value:'≤1.0 % F.S'},
                {label:'Case Dimension (mm)', value:'280(L) x 220(W) x 680(H) mm'},
                {label:'Approx. Weight', value:'40 kg'}
            ]
        });
    }
    window.openNL2001X005Modal = function(){
        openProductModal({
            code:'NL 2001 X / 005', name:'Digital Penetrometer', standard:'EN 1426, ASTM D5, AASHTO T49',
            description:'Determines consistency by penetration under standard load with automated recording.',
            image:'{{ asset('images/highlights/NL-2001-X-005.png') }}', manufacturer:'NL Scientific',
            specs:[
                {label:'Model Number', value:'NL 2001 X / 005'},
                {label:'Penetration Depth & Displayed Unit', value:'40 x 0.01 mm'},
                {label:'Spindle Weight', value:'47.5 ± 0.05'},
                {label:'Product Dimension (mm)', value:'310 (L) x 210 (W) x 480 (H)'},
                {label:'Packing Dimension (mm)', value:'330 (L) x 230 (W) x 510 (H)'},
                {label:'Approx. Product Weight', value:'6.5 kg'},
                {label:'Approx. Packing Weight', value:'7.5 kg'},
                {label:'Power', value:'220 - 240 V, 1 ph, 50 / 60 Hz'}
            ]
        });
    }
    window.openNL2007XModal = function(){
        openProductModal({
            code:'NL 2007 X', name:'Vacuum Pyknometer', standard:'EN 12697-5, EN 13108, ASTM D2041',
            description:'Determines theoretical maximum specific gravity of uncompacted mixes.',
            image:'{{ asset('images/highlights/NL-2007-X-002.png') }}', manufacturer:'NL Scientific',
            specs:[
                {label:'Product Dimension', value:'400 (L) x 430 (W) x 700 (H) mm'},
                {label:'Approx. Weight', value:'42 kg'},
                {label:'Power', value:'220~240 V, 0.36 kW, 1 Ph, 50/60 Hz, 1.5 A, 0.48 Hp'},
                {label:'Application', value:'Determination of Maximum Density'},
                {label:'Usage', value:'Theoretical maximum specific gravity testing'},
                {label:'Calculations', value:'Percent air voids and bitumen absorption measurements'},
                {label:'Capacity Options', value:'Three different capacity pyknometers available'}
            ]
        });
    }
    </script>
@endsection

