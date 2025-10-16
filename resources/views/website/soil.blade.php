@extends('layouts.app')

@section('title', 'Soil Testing Equipment | Gemarc Enterprises Incorporated')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background override for Soil */
    .page-hero.hero-with-bg.hero-soil{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-soil .hero-bg{
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') !important;
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08);
    }
    .page-hero.hero-with-bg.hero-soil .hero-overlay{background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px)}
    .blogs-section .blog-post{box-shadow:0 4px 12px rgba(0,0,0,0.05);transition:all .3s ease}
    .blogs-section .blog-post:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,0.1)}
    .blog-image{position:relative;height:220px;overflow:hidden;cursor:pointer}
    .blog-image img{width:100%;height:100%;object-fit:cover;transition:none;filter:none!important}
    .blog-post:hover .blog-image img{transform:none}
    .product-code-badge{position:absolute;top:10px;right:10px;background:rgba(46,125,50,.85);color:#fff;padding:4px 8px;border-radius:4px;font-size:.85rem;font-weight:600}
    .brand-header{margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #e0e0e0}
    .brand-logo{height:64px;width:auto;object-fit:contain}
    .blog-title{cursor:pointer}
    /* Modal styles (reuse from Aggregates) */
    .modal-overlay{position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,.7);backdrop-filter:blur(5px);display:flex;align-items:center;justify-content:center;z-index:9999;opacity:0;visibility:hidden;transition:all .3s ease}
    .modal-overlay.active{opacity:1;visibility:visible}
    .modal-content{background:#fff;border-radius:12px;width:90%;max-width:900px;max-height:90vh;overflow:hidden;box-shadow:0 25px 50px -12px rgba(0,0,0,.25);transform:scale(.95);opacity:0;transition:all .3s ease}
    .modal-overlay.active .modal-content{transform:scale(1);opacity:1}
    .modal-header{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.5rem;border-bottom:1px solid #e0e0e0}
    .modal-title{margin:0;font-size:1.5rem;color:#2e7d32;font-weight:700}
    .modal-close{background:none;border:0;font-size:1.75rem;color:#666;cursor:pointer}
    .modal-body{padding:1.5rem;overflow-y:auto;max-height:calc(90vh - 70px)}
    .modal-product-info{display:grid;grid-template-columns:1fr 1.5fr;gap:2rem}
    .modal-product-image{background:#f5f5f5;border-radius:8px;padding:1rem;display:flex;align-items:center;justify-content:center}
    .modal-product-img{max-width:100%;max-height:300px;object-fit:contain}
    .modal-product-name{font-size:1.5rem;color:#1b5e20;font-weight:700;margin:.5rem 0 1rem}
    .modal-specs-title{font-size:1.25rem;color:#2e7d32;font-weight:600;padding-bottom:.5rem;border-bottom:1px solid #e0e0e0;margin-bottom:1rem}
    .modal-specs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem}
    .modal-spec-item{background:#f9f9f9;border-radius:6px;padding:.75rem 1rem}
    @media(max-width:768px){.modal-product-info{grid-template-columns:1fr}.modal-specs-grid{grid-template-columns:1fr}}
    /* Blog actions button styles (match Aggregates) */
    .blog-actions{display:flex;margin-top:1rem;gap:.5rem}
    .blog-actions .btn{flex:1;padding:8px 12px;font-size:.9rem;border-radius:6px;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .2s ease;border:none;cursor:pointer;text-decoration:none}
    .blog-actions .btn-pdf{background:#f5f5f5;color:#333}
    .blog-actions .btn-pdf:hover{background:#e0e0e0}
    .blog-actions .btn-details{background:#2e7d32;color:#fff}
    .blog-actions .btn-details:hover{background:#1b5e20}
    /* Modern CTA Styles (copied from Aggregates) */
    .more-products-cta{margin:3rem 0}
    .cta-card{
        background:linear-gradient(135deg,#1b5e20,#43a047);
        color:#fff;border-radius:14px;padding:24px 28px;
        display:flex;align-items:center;justify-content:space-between;
        box-shadow:0 10px 30px rgba(27,94,32,.25)
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
</style>
@endpush

@section('content')

    <!-- Soil Hero (Aggregates-style) -->
    <section class="page-hero hero-with-bg hero-soil">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Soil Testing Equipment</h1>
            <p>Geotechnical tools for reliable soil analysis and foundation design</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="blogs-section">
        <div class="container">
       <!-- Search Bar -->
            @include('components.searchbar')

            <p class="mb-4">We provide comprehensive soil testing equipment for geotechnical investigation, foundation design, and construction projects. Our equipment meets international standards for soil analysis and testing procedures.</p>

            <!-- Matest Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="brand-logo me-3">
                </div>

                <div class="blogs-grid">
                    <!-- Product 1: S172-01N -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openS172Modal()">
                            <img src="{{ asset('images/highlights/S172-01.jpg') }}" alt="S172-01N Motorized liquid limit device, NF" class="product-img">
                            <span class="product-code-badge">S172-01N</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Atterberg Limits</span>
                                <span class="blog-standard">ASTM D4318, AASHTO T89</span>
                            </div>
                            <h3 class="blog-title" onclick="openS172Modal()">Motorized liquid limit device, NF</h3>
                            <p>This model is motor operated at 120 drops/min speed to ensure better uniformity and accuracy. Bakelite base and chrome cup.</p>
                            <div class="blog-actions">
                                @php $pdfS172 = public_path('downloadable content/S172-01N.pdf'); @endphp
                                @if (file_exists($pdfS172))
                                <a href="{{ asset('downloadable content/S172-01N.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openS172Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- Product 2: S165-02 -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openS165Modal()">
                            <img src="{{ asset('images/highlights/S165-02-KIT.jpg') }}" alt="S165-02 Semiautomatic cone digital penetrometer" class="product-img">
                            <span class="product-code-badge">S165-02</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Penetrometer</span>
                                <span class="blog-standard">Programmable timer</span>
                            </div>
                            <h3 class="blog-title" onclick="openS165Modal()">Semiautomatic cone digital penetrometer</h3>
                            <p>Structured as mod. S165-01 but equipped with magnetic controller and programmable timer for automatic cone release during 5-second test.</p>
                            <div class="blog-actions">
                                @php $pdfS165 = public_path('downloadable content/S165-02.pdf'); @endphp
                                @if (file_exists($pdfS165))
                                <a href="{{ asset('downloadable content/S165-02.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openS165Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- Product 3: S276-01M -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openS276Modal()">
                            <img src="{{ asset('images/highlights/S276-01-150x150.jpg') }}" alt="S276-01M Auto ShearLab" class="product-img">
                            <span class="product-code-badge">S276-01M</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Shear Testing</span>
                                <span class="blog-standard">Direct/Residual</span>
                            </div>
                            <h3 class="blog-title" onclick="openS276Modal()">Auto ShearLab - Direct and Residual Shear Testing Machine</h3>
                            <p>Automatic shearbox testing machine for soil specimens. Performs consolidation and shearing stages in strain or stress control.</p>
                            <div class="blog-actions">
                                @php $pdfS276 = public_path('downloadable content/S276-01M.pdf'); @endphp
                                @if (file_exists($pdfS276))
                                <a href="{{ asset('downloadable content/S276-01M.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openS276Modal()"><i class="fas fa-eye"></i> View Details</button>
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
                    <!-- NL 5002 X / 010 -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openProductModal({
                                    code:'NL 5002 X / 010',
                                    name:'Eco Smartz Advanced CBR Loading Tester 50kN',
                                    standard:'EN 13286-47, BS 1377:4, ASTM D1883, AASHTO T 193',
                                    description:'New bench-mounting CBR machine with DC motorized drive system for reliable, high-accuracy results. Rapid platen adjustment and low noise.',
                                    image:'{{ asset('images/highlights/NL-5002-X-010-150x150.png') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Capacity',value:'50 kN'},{label:'Speed',value:'1 mm/min (BS), 1.27 mm/min (ASTM)'}]
                                })">
                            <img src="{{ asset('images/highlights/NL-5002-X-010-150x150.png') }}" alt="NL 5002 X / 010 Eco Smartz Advanced CBR Loading Tester 50kN" onerror="this.onerror=null;this.src='{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}'">
                            <span class="product-code-badge">NL 5002 X / 010</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">CBR Testing</span>
                                <span class="blog-standard">EN 13286-47, BS 1377:4, ASTM D1883, AASHTO T 193</span>
                            </div>
                            <h3 class="blog-title" onclick="openProductModal({
                                    code:'NL 5002 X / 010',
                                    name:'Eco Smartz Advanced CBR Loading Tester 50kN',
                                    standard:'EN 13286-47, BS 1377:4, ASTM D1883, AASHTO T 193',
                                    description:'New bench-mounting CBR machine with DC motorized drive system for reliable, high-accuracy results. Rapid platen adjustment and low noise.',
                                    image:'{{ asset('images/highlights/NL-5002-X-010-150x150.png') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Capacity',value:'50 kN'},{label:'Speed',value:'1 mm/min (BS), 1.27 mm/min (ASTM)'}]
                                })">Eco Smartz Advanced CBR Loading Tester 50kN</h3>
                            <p>Bench-mounting CBR machine using DC motorized drive for more reliable and accurate results. Compact, energy-saving, low vibration.</p>
                            <div class="blog-actions">
                                @php $pdfNL5002 = public_path('downloadable content/NL 5002 X _ 010.pdf'); @endphp
                                @if (file_exists($pdfNL5002))
                                <a href="{{ asset('downloadable content/NL 5002 X _ 010.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openProductModal({
                                    code:'NL 5002 X / 010',
                                    name:'Eco Smartz Advanced CBR Loading Tester 50kN',
                                    standard:'EN 13286-47, BS 1377:4, ASTM D1883, AASHTO T 193',
                                    description:'New bench-mounting CBR machine with DC motorized drive system for reliable, high-accuracy results. Rapid platen adjustment and low noise.',
                                    image:'{{ asset('images/highlights/NL-5002-X-010-150x150.png') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Capacity',value:'50 kN'},{label:'Speed',value:'1 mm/min (BS), 1.27 mm/min (ASTM)'}]
                                })"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- NL 5032 X / 001 -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openProductModal({
                                    code:'NL 5032 X / 001',
                                    name:'Electrical Density Gauge (EDG)',
                                    standard:'ASTM D7698, D1556, D2167, D6938, and more',
                                    description:'Portable, battery-powered EDG for in-situ density and moisture of compacted soils without nuclear regulations.',
                                    image:'{{ asset('images/highlights/NL-5032-X-001-150x150.png') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Power',value:'Li-Ion battery'},{label:'Operating Temp',value:'0–50°C'}]
                                })">
                            <img src="{{ asset('images/highlights/NL-5032-X-001-150x150.png') }}" alt="NL 5032 X / 001 Electrical Density Gauge (EDG)" onerror="this.onerror=null;this.src='{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}'">
                            <span class="product-code-badge">NL 5032 X / 001</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Field Density</span>
                                <span class="blog-standard">ASTM D7698 and related</span>
                            </div>
                            <h3 class="blog-title" onclick="openProductModal({
                                    code:'NL 5032 X / 001',
                                    name:'Electrical Density Gauge (EDG)',
                                    standard:'ASTM D7698, D1556, D2167, D6938, and more',
                                    description:'Portable, battery-powered EDG for in-situ density and moisture of compacted soils without nuclear regulations.',
                                    image:'{{ asset('images/highlights/NL-5032-X-001-150x150.png') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Power',value:'Li-Ion battery'},{label:'Operating Temp',value:'0–50°C'}]
                                })">Electrical Density Gauge (EDG)</h3>
                            <p>Portable, nuclear-free device for determining moisture and density of compacted soils directly in place. USB/Bluetooth data transfer.</p>
                            <div class="blog-actions">
                                @php $pdfNL5032 = public_path('downloadable content/NL 5032 X _ 001.pdf'); @endphp
                                @if (file_exists($pdfNL5032))
                                <a href="{{ asset('downloadable content/NL 5032 X _ 001.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openProductModal({
                                    code:'NL 5032 X / 001',
                                    name:'Electrical Density Gauge (EDG)',
                                    standard:'ASTM D7698, D1556, D2167, D6938, and more',
                                    description:'Portable, battery-powered EDG for in-situ density and moisture of compacted soils without nuclear regulations.',
                                    image:'{{ asset('images/highlights/NL-5032-X-001-150x150.png') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Power',value:'Li-Ion battery'},{label:'Operating Temp',value:'0–50°C'}]
                                })"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- NL 5025 X / SAS -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openProductModal({
                                    code:'NL 5025 X / SAS',
                                    name:'Automatic CBR or MOD Soil Compactor',
                                    standard:'SANS 3001-GR31:2010',
                                    description:'Automatic compaction hammer with rotation for uniform blows and robust steel frame.',
                                    image:'{{ asset('images/highlights/NL-5025X-150x150.jpg') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Blow Rate',value:'50–60 blows/min'},{label:'Drop Height',value:'305/460 mm'}]
                                })">
                            <img src="{{ asset('images/highlights/NL-5025X-150x150.jpg') }}" alt="NL 5025 X / SAS Automatic CBR or MOD Soil Compactor" onerror="this.onerror=null;this.src='{{ asset('images/highlights/partnership/NL-Scientific_logo.png') }}'">
                            <span class="product-code-badge">NL 5025 X / SAS</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Compaction</span>
                                <span class="blog-standard">SANS 3001-GR31:2010</span>
                            </div>
                            <h3 class="blog-title" onclick="openProductModal({
                                    code:'NL 5025 X / SAS',
                                    name:'Automatic CBR or MOD Soil Compactor',
                                    standard:'SANS 3001-GR31:2010',
                                    description:'Automatic compaction hammer with rotation for uniform blows and robust steel frame.',
                                    image:'{{ asset('images/highlights/NL-5025X-150x150.jpg') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Blow Rate',value:'50–60 blows/min'},{label:'Drop Height',value:'305/460 mm'}]
                                })">Automatic CBR or MOD Soil Compactor</h3>
                            <p>Provides uniform compaction effort to ensure repeatable results with adjustable rammer weight and drop height.</p>
                            <div class="blog-actions">
                                @php $pdfNL5025 = public_path('downloadable content/NL 5025 X _ SAS.pdf'); @endphp
                                @if (file_exists($pdfNL5025))
                                <a href="{{ asset('downloadable content/NL 5025 X _ SAS.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openProductModal({
                                    code:'NL 5025 X / SAS',
                                    name:'Automatic CBR or MOD Soil Compactor',
                                    standard:'SANS 3001-GR31:2010',
                                    description:'Automatic compaction hammer with rotation for uniform blows and robust steel frame.',
                                    image:'{{ asset('images/highlights/NL-5025X-150x150.jpg') }}',
                                    manufacturer:'NL Scientific',
                                    specs:[{label:'Blow Rate',value:'50–60 blows/min'},{label:'Drop Height',value:'305/460 mm'}]
                                })"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Dual Manufacturing Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}" alt="Dual Manufacturing" class="brand-logo me-3">
                </div>

                <div class="blogs-grid">
                    <!-- Polycarbonate Sieve Kits -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openPSKModal()">
                            <img src="{{ asset('images/highlights/0003510_polycarbonate-sieve-kits.jpeg') }}" alt="Polycarbonate Sieve Kits" onerror="this.onerror=null;this.src='{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}'">
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Sieving</span>
                                <span class="blog-standard">U.S. Sieve Sizes</span>
                            </div>
                            <h3 class="blog-title" onclick="openPSKModal()">Polycarbonate Sieve Kits</h3>
                            <p>Accurate mechanical sieve kit for grain size analysis with 20 stainless steel screens and five 2" acrylic cylinders.</p>
                            <div class="blog-actions">
                                @php $pdfPSK = public_path('downloadable content/PSK-001.pdf'); @endphp
                                @if (file_exists($pdfPSK))
                                <a href="{{ asset('downloadable content/PSK-001.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openPSKModal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- Metric Frame Sieves -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openMFSModal()">
                            <img src="{{ asset('images/highlights/USA-Standard-Sieves-150x150.jpeg') }}" alt="Metric Frame Sieves" onerror="this.onerror=null;this.src='{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}'">
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Sieving</span>
                                <span class="blog-standard">ISO 3310-1</span>
                            </div>
                            <h3 class="blog-title" onclick="openMFSModal()">Metric Frame Sieves</h3>
                            <p>Conforms to ISO 3310-1. Available in full and half height with stainless steel mesh.</p>
                            <div class="blog-actions">
                                @php $pdfMFS = public_path('downloadable content/MFS-001.pdf'); @endphp
                                @if (file_exists($pdfMFS))
                                <a href="{{ asset('downloadable content/MFS-001.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openMFSModal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- Market Grade Sieves -->
                    <article class="blog-post">
                        <div class="blog-image" onclick="openMGSModal()">
                            <img src="{{ asset('images/highlights/0003520_market-grade-sieves_420.jpeg') }}" alt="Market Grade Sieves" onerror="this.onerror=null;this.src='{{ asset('images/highlights/partnership/dualmfg-logo.jpg') }}'">
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Sieving</span>
                                <span class="blog-standard">Market Grade</span>
                            </div>
                            <h3 class="blog-title" onclick="openMGSModal()">Market Grade Sieves</h3>
                            <p>Reliable sieves for particle size analysis across industries; wide range of mesh sizes available.</p>
                            <div class="blog-actions">
                                @php $pdfMGS = public_path('downloadable content/Market Grade Sieves.pdf'); @endphp
                                @if (file_exists($pdfMGS))
                                <a href="{{ asset('downloadable content/Market Grade Sieves.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openMGSModal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- More Products Section (Modern CTA) - copied from Aggregates -->
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

    <!-- Modal (shared IDs for global script compatibility) -->
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
                            <strong>Product Code:</strong> <span id="modalProductCode"></span>
                            <span id="modalProductCodeSub" style="display:none;"></span>
                            <span id="modalProductCodeBadge" class="product-code-badge" style="position:static;display:inline-block;margin-left:10px;"></span>
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
                            <div class="mb-3"><label for="inquiryName" class="form-label">Your Name</label><input type="text" class="form-control" id="inquiryName" required></div>
                            <div class="mb-3"><label for="inquiryEmail" class="form-label">Email Address</label><input type="email" class="form-control" id="inquiryEmail" required></div>
                            <div class="mb-3"><label for="inquiryProduct" class="form-label">Product</label><input type="text" class="form-control" id="inquiryProduct" readonly></div>
                            <div class="mb-3"><label for="inquiryMessage" class="form-label">Message</label><textarea class="form-control" id="inquiryMessage" rows="4" required></textarea></div>
                            <button type="submit" class="btn btn-success w-100">Submit Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('website/script.js') }}?v={{ filemtime(public_path('website/script.js')) }}"></script>
<script>
// Matest modal open helpers
function openS172Modal(){
    openProductModal({
        code: 'S172-01N',
        name: 'Motorized liquid limit device, NF',
        standard: 'ASTM D4318 | AASHTO T89 | UNI 10014; comparable: BS 1377-2 | UNE 7377',
        description: 'Motor operated at 120 drops/min to ensure uniformity and accuracy. Bakelite base and chrome cup.',
        image: '{{ asset('images/highlights/S172-01.jpg') }}',
        manufacturer: 'MATEST',
        specs: [
            {label:'Operation Type', value:'Motor operated'},
            {label:'Drop Rate', value:'120 drops/min'},
            {label:'Base Material', value:'Bakelite'},
            {label:'Cup Material', value:'Chrome'}
        ]
    });
}

function openS165Modal(){
    openProductModal({
        code: 'S165-02',
        name: 'Semiautomatic cone digital penetrometer',
        standard: 'Programmable timer; magnetic controller',
        description: 'Equipped with magnetic controller device and programmable timer that releases the plunger head for free fall during the 5-second test.',
        image: '{{ asset('images/highlights/S165-02-KIT.jpg') }}',
        manufacturer: 'MATEST',
        specs: [
            {label:'Control', value:'Electronic digital programmable timer'},
            {label:'Operation', value:'Semiautomatic'}
        ]
    });
}

function openS276Modal(){
    openProductModal({
        code: 'S276-01M',
        name: 'Auto ShearLab - Direct and Residual Shear Testing Machine',
        standard: 'Direct and Residual Shear Testing',
        description: 'Automatic shearbox testing machine. Performs consolidation and shearing stages in strain or stress control.',
        image: '{{ asset('images/highlights/S276-01-150x150.jpg') }}',
        manufacturer: 'MATEST',
        specs: [
            {label:'Testing Modes', value:'Strain and stress controlled'},
            {label:'Application', value:'Shear tests on soil specimens'}
        ]
    });
}

    // Dual Manufacturing modal helpers
    function openPSKModal(){
        openProductModal({
            code:'PSK-001',
            name:'Polycarbonate Sieve Kits',
            standard:'U.S. Standard Sieve Sizes',
            description:'Mechanical sieve kit for grain size analysis with volumetric indicators on the shaker frame.',
            image:'{{ asset('images/highlights/0003510_polycarbonate-sieve-kits.jpeg') }}',
            manufacturer:'Dual Manufacturing Co, Inc',
            specs:[
                {label:'Kit Contents', value:'20 stainless steel screens'},
                {label:'Containers', value:'Five 2\" acrylic cylinders'}
            ]
        });
    }
    function openMFSModal(){
        openProductModal({
            code:'MFS-001',
            name:'Metric Frame Sieves',
            standard:'ISO 3310-1 specification',
            description:'Precision sieves in metric sizes with stainless steel mesh for particle size analysis.',
            image:'{{ asset('images/highlights/USA-Standard-Sieves-150x150.jpeg') }}',
            manufacturer:'Dual Manufacturing Co, Inc',
            specs:[
                {label:'Heights', value:'Full and half height'},
                {label:'Mesh', value:'Stainless steel'}
            ]
        });
    }
    function openMGSModal(){
        openProductModal({
            code:'MGS',
            name:'Market Grade Sieves',
            standard:'Market Grade',
            description:'Market grade sieves for consistent, repeatable particle size measurements.',
            image:'{{ asset('images/highlights/0003520_market-grade-sieves_420.jpeg') }}',
            manufacturer:'Dual Manufacturing Co, Inc',
            specs:[
                {label:'Use', value:'Particle size analysis'},
                {label:'Mesh Range', value:'Wide range available'}
            ]
        });
    }
</script>
@endpush

@push('scripts')
<script src="{{ asset('website/script.js') }}?v={{ filemtime(public_path('website/script.js')) }}"></script>
// Soil product modal open helpers

        code: 'S172-01N',
        name: 'Motorized liquid limit device, NF',
        standard: 'ASTM D4318 | AASHTO T89 | UNI 10014; comparable: BS 1377-2 | UNE 7377',
        description: 'Motor operated at 120 drops/min to ensure uniformity and accuracy. Bakelite base and chrome cup.',
        image: '{{ asset('images/highlights/S172-01.jpg') }}',
        manufacturer: 'MATEST',
        specs: [
            {label:'Operation Type', value:'Motor operated'},
            {label:'Drop Rate', value:'120 drops/min'},
            {label:'Base Material', value:'Bakelite'},
            {label:'Cup Material', value:'Chrome'}
        ]
    });
};

window.openS165Modal = function(){
    openProductModal({
        code: 'S165-02',
        name: 'Semiautomatic cone digital penetrometer',
        standard: 'Programmable timer; magnetic controller',
        description: 'Equipped with magnetic controller device and programmable timer that releases the plunger head for free fall during the 5-second test.',
        image: '{{ asset('images/highlights/S165-02-KIT.jpg') }}',
        manufacturer: 'MATEST',
        specs: [
            {label:'Control', value:'Electronic digital programmable timer'},
            {label:'Operation', value:'Semiautomatic'}
        ]
    });
};

window.openS276Modal = function(){
    openProductModal({
        code: 'S276-01M',
        name: 'Auto ShearLab - Direct and Residual Shear Testing Machine',
        standard: 'Direct and Residual Shear Testing',
        description: 'Automatic shearbox testing machine. Performs consolidation and shearing stages in strain or stress control.',
        image: '{{ asset('images/highlights/S276-01-150x150.jpg') }}',
        manufacturer: 'MATEST',
        specs: [
            {label:'Testing Modes', value:'Strain and stress controlled'},
            {label:'Application', value:'Shear tests on soil specimens'}
        ]
    });
};

// Fallback modal controls if global ones aren't loaded
function closeProductModal(){
    const modal=document.getElementById('productModal');
    modal.classList.remove('active');
    document.body.style.overflow='';
    const form=document.getElementById('inquiryForm'); if(form) form.style.display='none';
}
function showInquiryForm(){
    const form=document.getElementById('inquiryForm');
    form.style.display = form.style.display==='none' ? 'block' : 'none';
}
document.getElementById('productModal').addEventListener('click',function(e){ if(e.target===this){ closeProductModal(); }});
document.addEventListener('keydown',function(e){ if(e.key==='Escape'){ closeProductModal(); }});
var _f=document.querySelector('#inquiryForm form'); if(_f){ _f.addEventListener('submit',function(e){ e.preventDefault(); alert('Thank you for your inquiry. Our team will contact you shortly.'); document.getElementById('inquiryForm').style.display='none'; }); }
</script>
@endpush

