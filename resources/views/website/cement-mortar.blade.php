@extends('layouts.app')
@section('title', 'Cement & Mortar Testing Equipment | Gemarc Enterprises Incorporated')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background to match Aggregates */
    .page-hero.hero-with-bg.hero-aggregates{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-aggregates .hero-bg{
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}');
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08);
    }
    .page-hero.hero-with-bg.hero-aggregates .hero-overlay{background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px)}
    /* Cards + brand header */
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
    .blog-actions{display:flex;margin-top:1rem;gap:.5rem}
    .blog-actions .btn{flex:1;padding:8px 12px;font-size:.9rem;border-radius:6px;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .2s ease}
    .blog-actions .btn-pdf{background:#f5f5f5;color:#333}
    .blog-actions .btn-pdf:hover{background:#e0e0e0}
    .blog-actions .btn-details{background:#2e7d32;color:#fff}
    .blog-actions .btn-details:hover{background:#1b5e20}

    /* Modal + form (same styling as Aggregates) */
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
    .more-products-cta{margin:3rem 0}
    .cta-card{background:linear-gradient(135deg,#1b5e20,#43a047);color:#fff;border-radius:14px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 10px 30px rgba(27,94,32,.25)}
    .cta-text h3{margin:0 0 6px;font-size:1.4rem;font-weight:800}
    .cta-text p{margin:0;opacity:.9}
    .cta-actions .cta-btn{display:inline-flex;align-items:center;gap:10px;background:#fff;color:#1b5e20;padding:12px 18px;border-radius:10px;font-weight:700;text-decoration:none;transition:transform .15s ease,box-shadow .15s ease;box-shadow:0 6px 18px rgba(0,0,0,.15)}
    .cta-actions .cta-btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.2)}
    @media(max-width:768px){.modal-product-info{grid-template-columns:1fr}.modal-specs-grid{grid-template-columns:1fr}.cta-card{flex-direction:column;gap:14px;align-items:flex-start}}
</style>
@endpush

@section('content')

    <!-- Success Alert Notification (same as Aggregates) -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.600ms
             x-init="setTimeout(() => show = false, 3000)"
             style="position:fixed;top:32px;left:50%;transform:translateX(-50%);z-index:9999;"
             class="bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg font-semibold text-lg">
            {{ session('success') }}
        </div>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endif

    <!-- Cement & Mortar Hero -->
    <section class="page-hero hero-with-bg hero-aggregates">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Cement & Mortar Testing Equipment</h1>
            <p>Reliable tools for cement and mortar quality control</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="blogs-section">
        <div class="container">
            @include('components.searchbar')
            <p class="mb-4">We provide comprehensive cement and mortar testing equipment to ensure quality control in construction materials. Our equipment meets international standards for testing cement properties and mortar performance.</p>

            <!-- Matest Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="brand-logo me-3">
                </div>
                <div class="blogs-grid">
                    <!-- E070 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/E070.jpg') }}" alt="E070 Autoclave" class="product-img">
                            <span class="product-code-badge">E070</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Soundness</span><span class="blog-standard">ASTM C151, AASHTO T107</span></div>
                            <h3 class="blog-title">Autoclave</h3>
                            <p>High-pressure boiler with rack for 10 cement specimens and digital control panel.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/E070.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openE070Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                    <!-- E009-KIT -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/E009-KIT.jpg') }}" alt="E009-KIT Manual Blaine" class="product-img">
                            <span class="product-code-badge">E009-KIT</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Fineness</span><span class="blog-standard">EN 196-6, ASTM C204</span></div>
                            <h3 class="blog-title">Manual Blaine Air Permeability</h3>
                            <p>Determines fineness via specific surface area with glass U-tube manometer.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/E009-KIT.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openE009KITModal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                    <!-- E138 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/E138.jpg') }}" alt="E138 Curing Cabinet" class="product-img">
                            <span class="product-code-badge">E138</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Curing</span><span class="blog-standard">EN 196-1, ISO 679, ASTM C109/C511</span></div>
                            <h3 class="blog-title">Large Capacity Curing Cabinet</h3>
                            <p>Humidity and temperature controlled storage with digital thermostat and shelves.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/E138.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openE138Modal()"><i class="fas fa-eye"></i> View Details</button>
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
                    <!-- NL 3031 X / 006 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/nl3031x006-01.jpg') }}" alt="NL 3031 X / 006 Mortar Mixer" class="product-img">
                            <span class="product-code-badge">NL 3031 X/006</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Mixing</span><span class="blog-standard">EN 196-1, ASTM C305</span></div>
                            <h3 class="blog-title">Mortar Mixer (Automatic)</h3>
                            <p>Automatic mixer with planetary/beater speeds and 5L capacity.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL 3031 X _ 006.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openNL3031X006Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                    <!-- NL 3004 A / 001 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/nl3004a001-01.jpg') }}" alt="NL 3004 A / 001 Flow Cone" class="product-img">
                            <span class="product-code-badge">NL 3004 A/001</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Flow</span><span class="blog-standard">EN 445</span></div>
                            <h3 class="blog-title">Flow Cone Apparatus</h3>
                            <p>Determines flow properties of grouts, mortars and other fluid materials.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL 3004 A _ 001.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openNL3004A001Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                    <!-- NL 3012 X / 004 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/nl3012x004-01-01.jpg') }}" alt="NL 3012 X / 004 Vicat Apparatus" class="product-img">
                            <span class="product-code-badge">NL 3012 X/004</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Setting Time</span><span class="blog-standard">ASTM C187, C191; AASHTO T129, T131</span></div>
                            <h3 class="blog-title">Vicat Apparatus, Manual</h3>
                            <p>Determines consistency and setting time using standard plunger/needle.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/NL 3012 X _ 004.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openNL3012X004Modal()"><i class="fas fa-eye"></i> View Details</button>
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

    <!-- Unified Product Modal -->
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

                    <!-- MATCHED: real POST to inquiry.submit -->
                    <div id="inquiryForm" style="display:none;width:100%;max-width:600px;margin-top:20px;">
                        <form class="p-3 bg-light rounded" method="POST" action="{{ route('inquiry.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="inquiryName" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="inquiryName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="inquiryEmail" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="inquiryEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="inquiryProduct" class="form-label">Product</label>
                                <input type="text" class="form-control" id="inquiryProduct" name="product" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inquiryMessage" class="form-label">Message</label>
                                <textarea class="form-control" id="inquiryMessage" name="message" rows="4" required></textarea>
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
    // Modal logic (kept same as Aggregates)
    function openProductModal(product){
        document.getElementById('modalProductImage').src = product.image;
        document.getElementById('modalProductImage').alt = product.code + ' ' + product.name;
        document.getElementById('modalProductCodeBadge').textContent = product.code;
        document.getElementById('modalProductName').textContent = product.name;
        document.getElementById('modalProductStandard').textContent = product.standard || '';
        document.getElementById('modalProductDescription').textContent = product.description || '';
        document.getElementById('modalProductManufacturer').textContent = product.manufacturer || 'Gemarc Enterprises Inc.';

        // set inquiry product
        var inq = document.getElementById('inquiryProduct');
        if(inq) inq.value = product.code + ' - ' + product.name;

        // specs
        const grid = document.getElementById('modalSpecsGrid'); grid.innerHTML='';
        if(product.specs && product.specs.length){
            product.specs.forEach(s=>{
                const d=document.createElement('div');
                d.className='modal-spec-item';
                d.innerHTML=`<div class="modal-spec-label"><strong>${s.label}</strong></div><div class="modal-spec-value">${s.value}</div>`;
                grid.appendChild(d);
            });
        }else{
            grid.innerHTML='<p>No detailed specifications available. Please refer to the PDF or contact us.</p>';
        }

        document.getElementById('productModal').classList.add('active');
        document.body.style.overflow='hidden';
    }
    function closeProductModal(){
        document.getElementById('productModal').classList.remove('active');
        document.body.style.overflow='';
        document.getElementById('inquiryForm').style.display='none';
    }
    function showInquiryForm(){
        const f=document.getElementById('inquiryForm');
        f.style.display=(f.style.display==='none'||!f.style.display)?'block':'none';
    }
    document.getElementById('productModal').addEventListener('click',function(e){if(e.target===this) closeProductModal()});
    document.addEventListener('keydown',function(e){if(e.key==='Escape') closeProductModal()});

    // Product openers
    window.openE070Modal = function(){
        openProductModal({
            code:'E070', name:'Autoclave', standard:'ASTM C151, AASHTO T107',
            description:'High-pressure boiler with specimen rack and digital controls for soundness testing.',
            image:'{{ asset('images/highlights/E070.jpg') }}', manufacturer:'MATEST',
            specs:[
                {label:'Boiler',value:'Special alloy steel'},
                {label:'Capacity',value:'10 cement specimens'},
                {label:'Pressure Gauge',value:'0 - 600 psi with regulator'},
                {label:'Power Supply',value:'230V 1ph 50Hz 3500W'},
                {label:'Dimensions',value:'490x490x980 mm'},
                {label:'Weight',value:'150 kg approx.'}
            ]
        });
    }
    window.openE009KITModal = function(){
        openProductModal({
            code:'E009-KIT', name:'Manual Blaine Air Permeability', standard:'EN 196-6, ASTM C204',
            description:'Determines fineness of Portland cement; supplied with manometer, test cell, and accessories.',
            image:'{{ asset('images/highlights/E009-KIT.jpg') }}', manufacturer:'MATEST',
            specs:[
                {label:'Manometer',value:'Glass U-tube with valve'},
                {label:'Accessories',value:'Test cell, plunger, 1000 filter papers, manometric liquid'},
                {label:'Dimensions',value:'220x180x470 mm'},
                {label:'Weight',value:'12 kg approx.'}
            ]
        });
    }
    window.openE138Modal = function(){
        openProductModal({
            code:'E138', name:'Large Capacity Curing Cabinet', standard:'EN 196-1, ISO 679, ASTM C109/C511',
            description:'Controlled humidity and temperature cabinet with digital thermostat and four shelves.',
            image:'{{ asset('images/highlights/E138.jpg') }}', manufacturer:'MATEST',
            specs:[
                {label:'Humidity',value:'90% to saturation via nebulizers'},
                {label:'Temperature Range',value:'Ambient to +30°C'},
                {label:'Inside Dimensions',value:'1090x470x1200 mm'},
                {label:'Power Supply',value:'230 V 1ph 50/60 Hz 2000 W'}
            ]
        });
    }
    window.openNL3031X006Modal = function(){
        openProductModal({
            code:'NL 3031 X / 006', name:'Mortar Mixer (Automatic)', standard:'EN 196-1, ASTM C305',
            description:'Automatic mixer with planetary and beater speeds for standard mortar preparation.',
            image:'{{ asset('images/highlights/nl3031x006-01.jpg') }}', manufacturer:'NL Scientific',
            specs:[
                {label:'Capacity',value:'5 L'},
                {label:'Planetary Speeds',value:'62/125 rpm'},
                {label:'Beater Speeds',value:'140/285 rpm'},
                {label:'Power',value:'220 V, 0.5 Hp'}
            ]
        });
    }
    window.openNL3004A001Modal = function(){
        openProductModal({
            code:'NL 3004 A / 001', name:'Flow Cone Apparatus', standard:'EN 445',
            description:'Measures flow properties of grouts, mortars, and similar materials.',
            image:'{{ asset('images/highlights/nl3004a001-01.jpg') }}', manufacturer:'NL Scientific',
            specs:[
                {label:'Dimension',value:'240 (L) x 160 (W) x 610 (H) mm'},
                {label:'Approx. Weight',value:'7 kg'}
            ]
        });
    }
    window.openNL3012X004Modal = function(){
        openProductModal({
            code:'NL 3012 X / 004', name:'Vicat Apparatus, Manual', standard:'ASTM C187/C191; AASHTO T129/T131',
            description:'Determines setting time and consistency using standard needles/plungers.',
            image:'{{ asset('images/highlights/nl3012x004-01-01.jpg') }}', manufacturer:'NL Scientific',
            specs:[
                {label:'Dimension',value:'215(W)x160(L)x323(H) mm'},
                {label:'Approx. Weight',value:'4.0 kg'},
                {label:'Test Weight',value:'300 g'}
            ]
        });
    }
    </script>
@endsection
