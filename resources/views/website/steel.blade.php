@extends('layouts.app')

@section('title', 'Steel Testing Equipment | Gemarc Enterprises Incorporated')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background override for Steel */
    .page-hero.hero-with-bg.hero-steel{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-steel .hero-bg{
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') !important;
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08);
    }
    .page-hero.hero-with-bg.hero-steel .hero-overlay{background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px)}
    .blogs-section .blog-post{box-shadow:0 4px 12px rgba(0,0,0,0.05);transition:all .3s ease}
    .blogs-section .blog-post:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,.1)}
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
    /* Modern CTA Styles (copied from Aggregates) */
    .more-products-cta{margin:3rem 0}
    .cta-card{background:linear-gradient(135deg,#1b5e20,#43a047);color:#fff;border-radius:14px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 10px 30px rgba(27,94,32,.25)}
    .cta-text h3{margin:0 0 6px;font-size:1.4rem;font-weight:800;letter-spacing:-.2px}
    .cta-text p{margin:0;opacity:.9}
    .cta-actions .cta-btn{display:inline-flex;align-items:center;gap:10px;background:#ffffff;color:#1b5e20;padding:12px 18px;border-radius:10px;font-weight:700;text-decoration:none;transition:transform .15s ease,box-shadow .15s ease;box-shadow:0 6px 18px rgba(0,0,0,.15)}
    .cta-actions .cta-btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.2)}
    @media (max-width:768px){.cta-card{flex-direction:column;align-items:flex-start;gap:14px}}
    /* Modal styling (same pattern as aggregates) */
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
    .modal-product-code{font-size:.9rem;color:#666;margin-bottom:.5rem}
    .modal-product-name{font-size:1.5rem;color:#1b5e20;font-weight:700;margin:.5rem 0 1rem}
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
    /* === Added to fully mirror Drilling page button behavior === */
    .modal-email-btn:focus-visible{box-shadow:0 0 0 3px rgba(46,125,50,.35),0 10px 20px rgba(46,125,50,.25)}
    .modal-email-btn i{font-size:1rem;transition:transform .2s ease,opacity .2s ease}
    .modal-email-btn:hover i{transform:translateX(2px)}

    /* === Added Inquiry form styles to match Drilling page === */
    #inquiryForm form{background:#f7faf8;border:1px solid #e6efe8;border-radius:14px;padding:16px 18px;box-shadow:0 8px 20px rgba(0,0,0,.04)}
    #inquiryForm .form-label{display:block;font-weight:700;color:#2f3b2f;margin-bottom:.35rem}
    #inquiryForm .form-control{width:100%;padding:12px 14px;border:1px solid #e3e6e3;border-radius:10px;background:#fff;color:#333;transition:border-color .2s ease,box-shadow .2s ease,background .2s ease}
    #inquiryForm .form-control:focus{outline:0;border-color:#43a047;box-shadow:0 0 0 3px rgba(67,160,71,.18)}
    #inquiryForm textarea.form-control{min-height:110px;resize:vertical}
    #inquiryForm .mb-3{margin-bottom:1rem}
    #inquiryForm .btn-success.w-100{background:linear-gradient(135deg,#2e7d32,#1b5e20);color:#fff;border:0;border-radius:12px;font-weight:800;letter-spacing:.2px;padding:.85rem 1rem;box-shadow:0 10px 20px rgba(46,125,50,.25);transition:transform .15s ease,box-shadow .15s ease}
    #inquiryForm .btn-success.w-100:hover{transform:translateY(-1px);box-shadow:0 14px 28px rgba(46,125,50,.32);color:#fff}
    #inquiryForm .btn-success.w-100:active{transform:none;box-shadow:0 8px 16px rgba(46,125,50,.22)}

    @media (max-width:768px){.modal-product-info{grid-template-columns:1fr}.modal-specs-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

    <!-- Steel Hero -->
    <section class="page-hero hero-with-bg hero-steel">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Steel Testing Equipment</h1>
            <p>Reliable machines and instruments for steel quality control and standards compliance</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="blogs-section">
        <div class="container">
         <!-- Search Bar -->
            @include('components.searchbar')

            <p class="mb-4">We provide comprehensive steel testing equipment for quality control and material characterization in construction and manufacturing industries. Our equipment meets international standards for steel testing and analysis.</p>

            <!-- GOTECH Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/logo_en.png') }}" alt="GOTECH" class="brand-logo me-3">
                </div>

                <div class="blogs-grid">
                    <!-- Product: AI-7000-LAU -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/UN-7001-LAS.jpg') }}" alt="AI-7000-LAU Universal Testing Machine" class="product-img">
                            <span class="product-code-badge">AI-7000-LAU</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Universal Testing</span>
                                <span class="blog-standard">EN 10002, EN 10080, EN ISO 6892-1, ASTM A370</span>
                            </div>
                            <h3 class="blog-title">Servo Control System Universal Testing Machine</h3>
                            <p>Advanced servo control system with high-rigidity frame for tensile, compression, and bending tests on various materials.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/AI-7000-LAU.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openAI7000LAUModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- TBT Nanjing Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/tbt-Nanjing_logo.jpg') }}" alt="TBT Nanjing" class="brand-logo me-3">
                </div>

                <div class="blogs-grid">
                    <!-- Product: WA-100C/300C/600C/1000C -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/TBTUTM-1000A.jpg') }}" alt="WA Series Universal Testing Machine" class="product-img">
                            <span class="product-code-badge">WA-100C/300C/600C/1000C</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta">
                                <span class="blog-category">Hydraulic UTM</span>
                                <span class="blog-standard">EN 10002, EN ISO 6892-1, ASTM A370</span>
                            </div>
                            <h3 class="blog-title">Universal Testing Machine with PC & Servo Control</h3>
                            <p>Hydraulic loading with electronic force measurement for tensile, compression, and bending tests; data logging and overload protection.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/WA-100C_WA-300C_WA-600C_WA-1000C.pdf') }}" class="btn btn-pdf" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF Specs
                                </a>
                                <button class="btn btn-details" onclick="openWASeriesModal()">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- More Products CTA -->
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
<script src="{{ asset('js/aggregates.js') }}"></script>
<script>
// Product modal functions (shared)
function openProductModal(product) {
    document.getElementById('modalProductImage').src = product.image;
    document.getElementById('modalProductImage').alt = product.code + ' ' + product.name;
    document.getElementById('modalProductCodeBadge').textContent = product.code;
    document.getElementById('modalProductName').textContent = product.name;
    document.getElementById('modalProductStandard').textContent = product.standard;
    document.getElementById('modalProductDescription').textContent = product.description;
    document.getElementById('modalProductManufacturer').textContent = product.manufacturer || 'Gemarc Enterprises Inc.';
    document.getElementById('inquiryProduct').value = product.code + ' - ' + product.name;
    const specsGrid = document.getElementById('modalSpecsGrid');
    specsGrid.innerHTML = '';
    if (product.specs && product.specs.length) {
        product.specs.forEach(spec => {
            const el = document.createElement('div');
            el.className = 'modal-spec-item';
            el.innerHTML = '<div class="modal-spec-label">'+spec.label+'</div><div class="modal-spec-value">'+spec.value+'</div>';
            specsGrid.appendChild(el);
        });
    } else {
        specsGrid.innerHTML = '<p>No detailed specifications available. Please refer to the PDF documentation or contact us for more information.</p>';
    }
    const modal = document.getElementById('productModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeProductModal(){
    const modal = document.getElementById('productModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
    const form = document.getElementById('inquiryForm');
    if (form) form.style.display = 'none';
}
function showInquiryForm(){
    const form = document.getElementById('inquiryForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
document.getElementById('productModal').addEventListener('click', function(e){ if(e.target === this){ closeProductModal(); }});
document.addEventListener('keydown', function(e){ if(e.key === 'Escape'){ closeProductModal(); }});
var _inquiryForm = document.querySelector('#inquiryForm form');
if (_inquiryForm) {
    _inquiryForm.addEventListener('submit', function(e){
        e.preventDefault();
        alert('Thank you for your inquiry. Our team will contact you shortly.');
        document.getElementById('inquiryForm').style.display = 'none';
    });
}

// Page-specific openers
window.openAI7000LAUModal = function(){
    openProductModal({
        code: 'AI-7000-LAU',
        name: 'Servo Control System Universal Testing Machine',
        standard: 'EN 10002, EN 10080, EN 15630-1, EN 15630-3 | EN ISO 6892-1, 7500-1 | ASTM A370, ASTM E8',
        description: 'Featuring an advanced servo control system and high-capacity measurement capability, the AI-7000-LAU is a heavy-duty universal testing machine designed for various materials testing.',
        image: '{{ asset('images/highlights/UN-7001-LAS.jpg') }}',
        manufacturer: 'GOTECH',
        manufacturerUrl: 'https://www.gotech.biz/',
        pdf: 'downloadable content/AI-7000-LAU.pdf',
        specs: [
            {label: 'Model Variants', value: 'AI-7000-LAU5: 50kN | AI-7000-LAU10: 100kN | AI-7000-LAU20: 200kN | AI-7000-LAU30: 300kN | AI-7000-LAU50: 500kN'},
            {label: 'Units (Switchable)', value: 'kgf, lbf, N, kN, kPa, MPa'},
            {label: 'Load Resolution', value: '1/500,000'},
            {label: 'Load Accuracy', value: '±0.5%'},
            {label: 'Stroke (excl. grips)', value: '1050 mm'},
            {label: 'Effective Width', value: '570 mm'},
            {label: 'Test Speed', value: '0.0001–500 mm/min selectable'},
            {label: 'Speed Accuracy', value: '±0.5%'},
            {label: 'Stroke Resolution', value: '0.00003 mm'},
            {label: 'Acquisition Frequency', value: '200–500 Hz'},
            {label: 'Motor', value: 'AC servo motor'}
        ]
    });
}

window.openWASeriesModal = function(){
    openProductModal({
        code: 'WA-100C/300C/600C/1000C',
        name: 'Universal Testing Machine with PC & Servo Control',
        standard: 'EN 10002, EN ISO 6892-1, ASTM A370',
        description: 'Hydraulic loading with electronic force measurement for tensile, compression, and bending tests. Data can be saved/printed; overload protection.',
        image: '{{ asset('images/highlights/TBTUTM-1000A.jpg') }}',
        manufacturer: 'TBT Nanjing',
        manufacturerUrl: 'https://www.tbt-scietech.com/',
        pdf: 'downloadable content/WA-100C_WA-300C_WA-600C_WA-1000C.pdf',
        specs: [
            {label: 'Models', value: 'WA-100C, WA-300C, WA-600C, WA-1000C'},
            {label: 'Loading System', value: 'Hydraulic with electronic force measurement'},
            {label: 'Display', value: 'Load/test curves on PC'},
            {label: 'Protection', value: 'Overload protection'}
        ]
    });
}
</script>
@endpush
