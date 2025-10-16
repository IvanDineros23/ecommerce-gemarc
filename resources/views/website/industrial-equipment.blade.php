@extends('layouts.app')

@section('title', 'Industrial Equipment | Gemarc Enterprises Inc.')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background override for Industrial (match Aggregates style) */
    .page-hero.hero-with-bg.hero-industrial{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-industrial .hero-bg{
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') !important;
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08);
    }
    .page-hero.hero-with-bg.hero-industrial .hero-overlay{background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px)}
    .page-hero.hero-with-bg.hero-industrial.no-image{background:linear-gradient(rgba(0,0,0,.55),rgba(0,0,0,.55)),url('{{ asset('images/highlights/DTIWEB_Masthead.jpg') }}') center/cover no-repeat!important;}
    .page-hero.hero-with-bg.hero-industrial .hero-bg, .page-hero.hero-with-bg.hero-industrial::after{will-change:transform}
    /* Product cards + actions same as aggregates */
    .blogs-section .blog-post{box-shadow:0 4px 12px rgba(0,0,0,0.05);transition:all .3s ease}
    .blogs-section .blog-post:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,0.1)}
    .blogs-section .blog-post .blog-content h3{font-weight:700!important;font-size:1.15rem!important;letter-spacing:-.3px!important}
    .blog-image{position:relative;height:220px;overflow:hidden}
    .blog-image img{width:100%;height:100%;object-fit:cover;transition:all .5s ease}
    .blog-post:hover .blog-image img{transform:scale(1.05)}
    .product-code-badge{position:absolute;top:10px;right:10px;background:rgba(46,125,50,.85);color:#fff;padding:4px 8px;border-radius:4px;font-size:.85rem;font-weight:600}
    .blog-meta{display:flex;flex-wrap:wrap;align-items:center;margin-bottom:.5rem}
    .blog-category{display:inline-block;padding:3px 10px;background:#e8f5e9;color:#2e7d32;border-radius:4px;font-size:.8rem;font-weight:500}
    .blog-standard{margin-left:auto;font-size:.8rem;color:#666}
    .blog-actions{display:flex;margin-top:1rem;gap:.5rem}
    .blog-actions .btn{flex:1;padding:8px 12px;font-size:.9rem;border-radius:6px;display:flex;align-items:center;justify-content:center;gap:6px;transition:all .2s ease}
    .blog-actions .btn-pdf{background:#f5f5f5;color:#333}
    .blog-actions .btn-pdf:hover{background:#e0e0e0}
    .blog-actions .btn-details{background:#2e7d32;color:#fff}
    .blog-actions .btn-details:hover{background:#1b5e20}
    .brand-header{margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #e0e0e0}
    .brand-logo{height:64px;max-height:64px;width:auto;object-fit:contain}
    .brand-title{display:none!important}
    /* CTA styles (Aggregates) */
    .more-products-cta{margin:3rem 0}
    .cta-card{background:linear-gradient(135deg,#1b5e20,#43a047);color:#fff;border-radius:14px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 10px 30px rgba(27,94,32,.25)}
    .cta-text h3{margin:0 0 6px;font-size:1.4rem;font-weight:800;letter-spacing:-.2px}
    .cta-text p{margin:0;opacity:.9}
    .cta-actions .cta-btn{display:inline-flex;align-items:center;gap:10px;background:#ffffff;color:#1b5e20;padding:12px 18px;border-radius:10px;font-weight:700;text-decoration:none;transition:transform .15s ease,box-shadow .15s ease;box-shadow:0 6px 18px rgba(0,0,0,.15)}
    .cta-actions .cta-btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.2)}
    @media (max-width:768px){.cta-card{flex-direction:column;align-items:flex-start;gap:14px}}
    /* Modal quick styles (IDs align with website/script.js) */
    .modal-overlay{position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,.7);backdrop-filter:blur(5px);display:flex;align-items:center;justify-content:center;z-index:9999;opacity:0;visibility:hidden;transition:all .3s ease}
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
    .modal-specs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem}
    .modal-spec-item{background:#f9f9f9;border-radius:6px;padding:.75rem 1rem}
    .modal-spec-label{font-weight:600;margin-right:.35rem}
    .modal-contact-btn{display:flex;align-items:center;justify-content:center;gap:.6rem;padding:.9rem 1.75rem;border:0;border-radius:12px;font-weight:700;letter-spacing:.2px;cursor:pointer;transition:transform .15s ease,box-shadow .15s ease,background .2s ease,filter .2s ease;outline:0}
    .modal-email-btn{background:linear-gradient(135deg,#2e7d32 0%,#1b5e20 100%);color:#fff;box-shadow:0 10px 20px rgba(46,125,50,.25),inset 0 1px 0 rgba(255,255,255,.15)}
    .modal-email-btn:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(46,125,50,.28);filter:saturate(1.1)}
    @media (max-width:768px){.modal-product-info{grid-template-columns:1fr}.modal-specs-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

    <!-- Industrial Hero (Aggregates-style) -->
    <section class="page-hero hero-with-bg hero-industrial">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Industrial Equipment</h1>
            <p>Reliable equipment for manufacturing, packaging, and quality testing applications</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="blogs-section">
        <div class="container">
         <!-- Search Bar -->
            @include('components.searchbar')

            <p class="mb-4">We provide comprehensive industrial equipment solutions for construction, manufacturing, and testing applications. Our range includes high-quality equipment designed for demanding industrial environments.</p>

            <!-- GOTECH Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/logo_en.png') }}" alt="GOTECH" class="brand-logo me-3">
                </div>

                <div class="blogs-grid">
                    <!-- GT-7010-D2ELP -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/GT-7010-D2EP.jpg') }}" alt="GT-7010-D2ELP Micro-Computer Tensile Strength Tester" class="product-img">
                            <span class="product-code-badge">GT-7010-D2ELP</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Tensile</span>
                                <span class="blog-standard">Micro-computer Control</span>
                            </div>
                            <h3 class="blog-title">Micro-Computer Tensile Strength Tester</h3>
                            <p>The GT-7010-D2ELP is a single column, floor-type tensile strength tester with high precision control and versatile testing capabilities.</p>
                            <div class="blog-actions">
                                @php $pdf7010 = public_path('downloadable content/GT-7010-D2ELP.pdf'); @endphp
                                @if (file_exists($pdf7010))
                                <a href="{{ asset('downloadable content/GT-7010-D2ELP.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openProductModal({
                                    code:'GT-7010-D2ELP',
                                    name:'Micro-Computer Tensile Strength Tester',
                                    standard:'Various Industrial Testing Standards',
                                    description:'The GT-7010-D2ELP is a single column and floor type tensile strength tester. Equipped with high precision micro-computer control system, extensometer, and printer, it fulfills the testing needs for various strength tests. This machine is capable of performing a variety of tests including tension, compression, bending, tearing, peeling, shearing, and bonding across diverse industries, such as rubber, plastics, footwear, leather, cables, and packaging, with a focus on mid to low range test loads.',
                                    image:'{{ asset('images/highlights/GT-7010-D2EP.jpg') }}',
                                    manufacturer:'GOTECH',
                                    specs:[
                                        {label:'Capacity (optional)',value:'100, 200, 500 N; 1, 2, 5 kN'},
                                        {label:'Unit',value:'kgf, gf, tonf, lbf, N, kN'},
                                        {label:'Load resolution',value:'1/50,000 (U26)'},
                                        {label:'Load accuracy',value:'±0.5%'},
                                        {label:'Stroke (excluding grips)',value:'1000 mm'},
                                        {label:'Speed control method',value:'Closed-loop speed control'},
                                        {label:'Test speed',value:'5 to 500 mm/min (adjustable)'},
                                        {label:'Stroke resolution',value:'Stroke: 0.00125 mm / extensometer: 0.025 mm'},
                                        {label:'Sample rate',value:'16 times/sec'},
                                        {label:'Indicator',value:'Printable, display elongation value, test values, max. value & break values'},
                                        {label:'Motor',value:'AC servo motor'},
                                        {label:'Dimensions (W×D×H)',value:'55×35×182 cm'},
                                        {label:'Weight (approx.)',value:'115 kg (excluding control cabinet and grips)'},
                                        {label:'Power',value:'1∮, 220V, 5A, 50Hz/60Hz (or specify)'}
                                    ]
                                })"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- GT-7013-MPA -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/GT-7013-MP.jpg') }}" alt="GT-7013-MPA Digital Type Bursting Strength Tester" class="product-img">
                            <span class="product-code-badge">GT-7013-MPA</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Bursting</span>
                                <span class="blog-standard">ISO 2758, ASTM D3786</span>
                            </div>
                            <h3 class="blog-title">Digital Type Bursting Strength Tester</h3>
                            <p>Ideal for assessing bursting strength of paper, fabrics, and leather with automatic and manual modes.</p>
                            <div class="blog-actions">
                                @php $pdf7013 = public_path('downloadable content/GT-7013-MPA.pdf'); @endphp
                                @if (file_exists($pdf7013))
                                <a href="{{ asset('downloadable content/GT-7013-MPA.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openProductModal({
                                    code:'GT-7013-MPA',
                                    name:'Digital Type Bursting Strength Tester',
                                    standard:'GB/T 1539, ISO 2758, GB/T 454, TAPPI T403, ASTM D3786',
                                    description:'The GT-7013-MPA is an ideal solution for assessing the bursting strength of materials such as paper, fabrics, and leather. Operators can easily switch between automatic and manual modes. In automatic mode, the tester detects the specimen after placement, runs the test, calculates the results, and saves the data, ensuring a seamless and efficient testing process from start to finish. Features automatic rubber diaphragm pressure compensation and infrared sensor specimen detection.',
                                    image:'{{ asset('images/highlights/GT-7013-MP.jpg') }}',
                                    manufacturer:'GOTECH',
                                    specs:[
                                        {label:'Models Available',value:'High pressure, Low pressure, High pressure with low flow rate'},
                                        {label:'Conformance',value:'GB/T 1539, ISO 2758, GB/T 454, TAPPI T403, ASTM D3786, ASTM D3786M-18'},
                                        {label:'Feature',value:'Automatic rubber diaphragm pressure compensation'},
                                        {label:'Specimen detection',value:'Infrared sensor'},
                                        {label:'Interface',value:'Touchscreen+PLC'},
                                        {label:'Sensor',value:'Pressure transducer'},
                                        {label:'Capacity (High pressure)',value:'100 kg/c㎡'},
                                        {label:'Capacity (Low pressure)',value:'16 kg/c㎡'},
                                        {label:'Pumping rate (High pressure)',value:'170±15 mL/min'},
                                        {label:'Pumping rate (Low pressure)',value:'95±5 mL/min'},
                                        {label:'Inner dia. upper clamp',value:'31.5±0.1 mm / 30.5 mm / 31±0.75 mm'},
                                        {label:'Inner dia. lower clamp',value:'31.5±0.1 mm / 33.1±0.1 mm / 31±0.75 mm'},
                                        {label:'Clamp type',value:'Pneumatic clamp'},
                                        {label:'Specimen clamping pressure',value:'Dial pressure gauge: 0 to 50 kg/c㎡'},
                                        {label:'Air pressure source',value:'Must be greater than 6 kg/c㎡'},
                                        {label:'Power',value:'1∮, AC 220V, 50/60Hz, 3A (or specify)'}
                                    ]
                                })"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- GT-7001-DSU -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/GT-7001-DSU.jpg') }}" alt="GT-7001-DSU Servo Control Container Compression Tester" class="product-img">
                            <span class="product-code-badge">GT-7001-DSU</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Compression</span>
                                <span class="blog-standard">High Precision Servo</span>
                            </div>
                            <h3 class="blog-title">Servo Control Container Compression Tester</h3>
                            <p>Designed to assess the compressive strength of cardboard boxes and containers with precision servo control.</p>
                            <div class="blog-actions">
                                @php $pdf7001 = public_path('downloadable content/GT-7001-DSU.pdf'); @endphp
                                @if (file_exists($pdf7001))
                                <a href="{{ asset('downloadable content/GT-7001-DSU.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                @endif
                                <button class="btn btn-details" onclick="openProductModal({
                                    code:'GT-7001-DSU',
                                    name:'Servo Control Container Compression Tester',
                                    standard:'International Container Testing Standards',
                                    description:'The GT-7001-DSU is specifically designed to assess the compressive strength of cardboard boxes and containers. The specimen, placed between two parallel plates, is compressed under a constant force. The test load and displacement are recorded upon specimen failure or when a predetermined load or stroke is reached. This testing equipment uses dynamic pressure-holding technology to simulate stacking conditions during transportation and storage.',
                                    image:'{{ asset('images/highlights/GT-7001-DSU.jpg') }}',
                                    manufacturer:'GOTECH',
                                    specs:[
                                        {label:'Capacity',value:'20, 50, 100 kN'},
                                        {label:'Unit',value:'Kgf, lbf, N, kN, kPa, Mpa'},
                                        {label:'Load resolution',value:'1/500,000'},
                                        {label:'Load accuracy',value:'±0.5%'},
                                        {label:'Test space (L ×W ×H)',value:'1200 × 1200 × 1000mm (or specify)'},
                                        {label:'Display',value:'U70 materials testing software'},
                                        {label:'Compression speed',value:'0.001 to 200mm/min (adjustable)'},
                                        {label:'Speed accuracy',value:'±0.5%'},
                                        {label:'Motor',value:'AC servo motor'},
                                        {label:'Dimensions - Main unit (D×W×H)',value:'196×120×199 cm'},
                                        {label:'Dimensions - Computer/Desk (D×W×H)',value:'109× 65 × 116 cm'},
                                        {label:'Weight - Main unit (approx.)',value:'1240kg'},
                                        {label:'Weight - Computer/Desk (approx.)',value:'60kg'},
                                        {label:'Power',value:'3∮, AC220V, 50/60HZ, 15A / 3∮, AC 380V, 50/60HZ, 12A (or specify)'}
                                    ]
                                })"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Unified CTA (same as Aggregates) -->
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

    <!-- Product Modal (IDs must match website/script.js) -->
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
                        </div>
                        <h3 class="modal-product-name" id="modalProductName"></h3>
                        <div class="modal-product-standard">
                            <strong>Standard:</strong> <span id="modalProductStandard"></span>
                        </div>
                        <div class="modal-product-description">
                            <strong>Description:</strong>
                            <p id="modalProductDescription"></p>
                        </div>
                    </div>
                </div>

                <div class="modal-specs-section">
                    <h4 class="modal-specs-title">Technical Specifications</h4>
                    <div id="modalSpecsGrid" class="modal-specs-grid"></div>
                </div>

                <br>
                <!-- GEMARC Inline Inquiry (drop-in) -->
                <div class="gem-inquiry" data-emails="sales@gemarcph.com,technical@gemarcph.com">
                    <button type="button" class="modal-contact-btn modal-email-btn js-show-inquiry is-full">
                        <i class="fas fa-envelope"></i> Send Inquiry
                    </button>
                    <div class="inquiry-email-panel js-inquiry-panel" hidden></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('website/script.js') }}?v={{ filemtime(public_path('website/script.js')) }}"></script>
@endpush

