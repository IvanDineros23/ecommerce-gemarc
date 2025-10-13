@extends('layouts.app')

@section('title', 'Pavetest Equipment | Gemarc Enterprises Incorporated')

@push('styles')
<link href="{{ asset('css/blogs.css') }}?v={{ filemtime(public_path('css/blogs.css')) }}" rel="stylesheet">
<style>
    /* Hero background (Aggregates-style) */
    .page-hero.hero-with-bg.hero-pavetest{background:none!important;overflow:hidden}
    .page-hero.hero-with-bg.hero-pavetest .hero-bg{
        background-image:url('{{ asset('images/highlights/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') !important;
        background-position:center;background-size:cover;background-repeat:no-repeat;
        filter:blur(5px);transform:scale(1.08);
    }
    .page-hero.hero-with-bg.hero-pavetest .hero-overlay{background:rgba(0,0,0,.45);backdrop-filter:blur(1.5px)}
    /* Cards and actions */
    .blogs-section .blog-post{box-shadow:0 4px 12px rgba(0,0,0,0.05);transition:all .3s ease}
    .blogs-section .blog-post:hover{transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,0.1)}
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
    /* Brand */
    .brand-header{margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #e0e0e0}
    .brand-logo{height:64px;max-height:64px;width:auto;object-fit:contain}
    .brand-title{display:none!important}
    /* CTA (same as Aggregates) */
    .more-products-cta{margin:3rem 0}
    .cta-card{background:linear-gradient(135deg,#1b5e20,#43a047);color:#fff;border-radius:14px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 10px 30px rgba(27,94,32,.25)}
    .cta-text h3{margin:0 0 6px;font-size:1.4rem;font-weight:800;letter-spacing:-.2px}
    .cta-text p{margin:0;opacity:.9}
    .cta-actions .cta-btn{display:inline-flex;align-items:center;gap:10px;background:#ffffff;color:#1b5e20;padding:12px 18px;border-radius:10px;font-weight:700;text-decoration:none;transition:transform .15s ease,box-shadow .15s ease;box-shadow:0 6px 18px rgba(0,0,0,.15)}
    .cta-actions .cta-btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.2)}
    @media (max-width:768px){.cta-card{flex-direction:column;align-items:flex-start;gap:14px}}
    /* Modal (shared style) */
    .modal-overlay{position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,.7);backdrop-filter:blur(5px);display:flex;align-items:center;justify-content:center;z-index:9999;opacity:0;visibility:hidden;transition:all .3s ease}
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
    .modal-product-code{font-size:.9rem;color:#666;margin-bottom:.5rem}
    .modal-product-name{font-size:1.5rem;color:#1b5e20;font-weight:700;margin:.5rem 0 1rem}
    .modal-specs-title{font-size:1.25rem;color:#2e7d32;font-weight:600;padding-bottom:.5rem;border-bottom:1px solid #e0e0e0;margin-bottom:1rem}
    .modal-specs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem}
    .modal-spec-item{background:#f9f9f9;border-radius:6px;padding:.75rem 1rem}
    .modal-contact-btn{display:flex;align-items:center;justify-content:center;gap:.6rem;padding:.9rem 1.75rem;border:0;border-radius:12px;font-weight:700;letter-spacing:.2px;cursor:pointer;transition:transform .15s ease,box-shadow .15s ease,background .2s ease,filter .2s ease;outline:0}
    .modal-email-btn{background:linear-gradient(135deg,#2e7d32,#1b5e20);color:#fff;box-shadow:0 10px 20px rgba(46,125,50,.25),inset 0 1px 0 rgba(255,255,255,.15)}
</style>
@endpush

@section('content')

    <!-- Pavetest Hero -->
    <section class="page-hero hero-with-bg hero-pavetest">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Pavetest Equipment</h1>
            <p>Pavement and road surface testing systems for accurate, repeatable results</p>
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

            <p class="mb-4">We offer a full range of pavement testing equipment designed for accurate analysis of road surfaces, ensuring that your pavement construction projects meet the highest standards. Our machines provide precise measurements for load testing, surface roughness, and core sampling, helping you assess the quality and durability of your pavement.</p>

            <!-- Matest Products Section -->
            <div class="brand-section mt-5 mb-4">
                <div class="brand-header d-flex align-items-center">
                    <img src="{{ asset('images/highlights/partnership/logo-matest.png') }}" alt="Matest" class="brand-logo me-3">
                </div>

                <div class="blogs-grid">
                    <!-- B210 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/b210_72dpi.jpg') }}" alt="B210 Pavement Deflectometer" class="product-img">
                            <span class="product-code-badge">B210</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Deflection</span><span class="blog-standard">Precision Sensors</span></div>
                            <h3 class="blog-title">Pavement Deflectometer</h3>
                            <p>Designed for accurate measurement of pavement deflection under load with robust construction and advanced sensors.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/B210.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openB210Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- B220-01-KIT -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/dts16-altaluce-03702jpeg_72.jpg') }}" alt="B220-01-KIT Servo-pneumatic Dynamic Testing System - DTS-16 Manual" class="product-img">
                            <span class="product-code-badge">B220-01-KIT</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Dynamic</span><span class="blog-standard">Up to 70 Hz</span></div>
                            <h3 class="blog-title">Servo-pneumatic Dynamic Testing System - DTS-16 Manual</h3>
                            <p>Servo-pneumatically controlled testing with accurate loading wave shapes up to 70 Hz; suitable for asphalt, soil, and UGM.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/B220-01-KIT.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openB22001KITModal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>

                    <!-- B265 -->
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="{{ asset('images/highlights/b265.jpg') }}" alt="B265 SmartPulse | Electro-Mechanical Dynamic Testing System" class="product-img">
                            <span class="product-code-badge">B265</span>
                        </div>
                        <div class="blog-content p-3">
                            <div class="blog-meta"><span class="blog-category">Dynamic</span><span class="blog-standard">Up to 100 Hz</span></div>
                            <h3 class="blog-title">SmartPulse | Electro-Mechanical Dynamic Testing System</h3>
                            <p>Electro-mechanical actuator for static/dynamic loading with integrated climatic chamber and advanced data acquisition.</p>
                            <div class="blog-actions">
                                <a href="{{ asset('downloadable content/B265.pdf') }}" class="btn btn-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF Specs</a>
                                <button class="btn btn-details" onclick="openB265Modal()"><i class="fas fa-eye"></i> View Details</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Unified CTA -->
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

    <!-- Product Modal -->
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

                <div class="modal-contact-section" style="margin-top:1rem">
                    <button type="button" class="modal-contact-btn modal-email-btn" onclick="showInquiryForm()">
                        <i class="fas fa-envelope"></i> Send Inquiry
                    </button>
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
<script src="{{ asset('website/script.js') }}"></script>
<script>
function openProductModal(product){
    document.getElementById('modalProductImage').src = product.image;
    document.getElementById('modalProductImage').alt = product.code + ' ' + product.name;
    document.getElementById('modalProductCodeBadge').textContent = product.code;
    document.getElementById('modalProductName').textContent = product.name;
    document.getElementById('modalProductStandard').textContent = product.standard || '';
    document.getElementById('modalProductDescription').textContent = product.description || '';
    document.getElementById('modalProductManufacturer').textContent = product.manufacturer || 'Gemarc Enterprises Inc.';
    document.getElementById('inquiryProduct').value = product.code + ' - ' + product.name;
    const grid = document.getElementById('modalSpecsGrid');
    grid.innerHTML = '';
    if(product.specs && product.specs.length){
        product.specs.forEach(s=>{const d=document.createElement('div');d.className='modal-spec-item';d.innerHTML='<div class="modal-spec-label">'+s.label+'</div><div class="modal-spec-value">'+s.value+'</div>';grid.appendChild(d);});
    }else{grid.innerHTML='<p>No detailed specifications available. Please refer to the PDF documentation or contact us for more information.</p>';}
    document.getElementById('productModal').classList.add('active');
    document.body.style.overflow='hidden';
}
function closeProductModal(){document.getElementById('productModal').classList.remove('active');document.body.style.overflow='';const f=document.getElementById('inquiryForm');if(f)f.style.display='none';}
function showInquiryForm(){const f=document.getElementById('inquiryForm');f.style.display = f.style.display==='none' ? 'block' : 'none';}
document.getElementById('productModal').addEventListener('click',function(e){if(e.target===this){closeProductModal();}});
document.addEventListener('keydown',function(e){if(e.key==='Escape'){closeProductModal();}});
var _inq=document.querySelector('#inquiryForm form');if(_inq){_inq.addEventListener('submit',function(e){e.preventDefault();alert('Thank you for your inquiry. Our team will contact you shortly.');document.getElementById('inquiryForm').style.display='none';});}

// Page-specific openers
window.openB210Modal=function(){openProductModal({
    code:'B210', name:'Pavement Deflectometer',
    standard:'High-precision deflection measurements',
    description:'Designed for accurate measurement of pavement deflection under load with robust construction and advanced sensors.',
    image:'{{ asset('images/highlights/b210_72dpi.jpg') }}',
    manufacturer:'MATEST', manufacturerUrl:'https://www.matest.com/en/',
    pdf:'downloadable content/B210.pdf',
    specs:[
        {label:'Space Between Columns',value:'380 mm'},
        {label:'Vertical Space',value:'778 mm'},
        {label:'Actuator Stroke',value:'50 mm'},
        {label:'Frequency',value:'Up to 100 Hz'},
        {label:'Static Load',value:'12 kN'},
        {label:'Dynamic Load',value:'18 kN'}
    ]
});};

window.openB22001KITModal=function(){openProductModal({
    code:'B220-01-KIT', name:'Servo-pneumatic Dynamic Testing System - DTS-16 Manual',
    standard:'Servo-pneumatic control up to 70 Hz',
    description:'Digital servo-pneumatic control for accurate loading wave shapes up to 70 Hz; tension/compression dynamic loading suitable for asphalt, soil and UGM.',
    image:'{{ asset('images/highlights/dts16-altaluce-03702jpeg_72.jpg') }}',
    manufacturer:'MATEST', manufacturerUrl:'https://www.matest.com/en/',
    pdf:'downloadable content/B220-01-KIT.pdf',
    specs:[
        {label:'Servo Actuator Capacity',value:'±16 kN'},
        {label:'Frequency',value:'Up to 70 Hz'},
        {label:'Stroke',value:'30 mm'},
        {label:'Pressure',value:'800–900 kPa'}
    ]
});};

window.openB265Modal=function(){openProductModal({
    code:'B265', name:'SmartPulse | Electro-Mechanical Dynamic Testing System',
    standard:'Electro-mechanical dynamic testing up to 100 Hz',
    description:'Static/dynamic waveform loading with integrated climatic chamber and 16-channel data acquisition.',
    image:'{{ asset('images/highlights/b265.jpg') }}',
    manufacturer:'MATEST', manufacturerUrl:'https://www.matest.com/en/',
    pdf:'downloadable content/B265.pdf',
    specs:[
        {label:'Actuator Stroke',value:'50 mm'},
        {label:'Frequency',value:'Up to 100 Hz'},
        {label:'Temperature Range',value:'2°C to 60°C (thermoelectric), -10°C to +60°C (refrigeration)'}
    ]
});};
</script>
@endpush