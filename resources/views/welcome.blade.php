<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gemarc Enterprises Inc | Ecommerce</title>
  <link rel="icon" type="image/png" href="{{ asset('images/gemarclogo.png') }}" />

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

  <style>
    :root{
      --gem-green:#198754; --gem-green-600:#157347;
      --gem-amber:#ffb703; --gem-orange:#f97316;
      --ink:#1f2937; --muted:#6b7280;
    }
    html,body{background:#fff;color:var(--ink);scroll-behavior:smooth}
    .btn-pill{border-radius:999px;padding:.55rem 1.1rem;font-weight:700;transition:transform .12s,box-shadow .12s}
    .btn-pill:active{transform:translateY(1px)}
    .btn-gem{background:var(--gem-green);border-color:var(--gem-green);color:#fff}
    .btn-gem:hover{background:var(--gem-green-600);border-color:var(--gem-green-600)}
    .btn-amber{background:var(--gem-amber);border-color:var(--gem-amber);color:#1a1a1a}
    .btn-amber:hover{filter:brightness(.95)}

    .hero {
      position:relative;min-height:680px;display:grid;place-items:center;
      background: url('{{ asset('images/360_F_1589025175_1DxdWO4V6n1gbYRWoVjD0eef0QEi9yq4.jpg') }}') center center/cover no-repeat;
      color:#fff;overflow:hidden;
    }
    .hero:before {
      content:"";position:absolute;inset:0;z-index:1;
      width:100%;height:100%;
      background:rgba(20,20,20,0.82); /* darker overlay for more contrast */
      opacity:0.82;
    }
    .hero .container, .hero .row, .hero .col-lg-6 {
      position:relative;z-index:2;
    }
    .hero-content {
      padding-top: 60px;
      padding-bottom: 60px;
      text-align: left;
      color: #fff;
      text-shadow: 0 4px 32px rgba(0,0,0,0.55), 0 2px 8px rgba(0,0,0,0.32);
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .hero-content .hero-logo {
      display: block;
      margin: 0 auto 2.2rem auto;
      height: 110px;
      max-width: 320px;
      filter: drop-shadow(0 6px 32px rgba(0,0,0,0.25)) brightness(1.15) contrast(1.15) saturate(1.2);
      background: rgba(255,255,255,0.18);
      border-radius: 18px;
      padding: 10px 24px 10px 24px;
    }
    .hero-content h1 {
      font-size: 3.8rem;
      font-weight: 900;
      line-height: 1.08;
      margin-bottom: 1.2rem;
      text-align: center;
      letter-spacing: -1px;
      color: #fff;
      text-shadow: 0 6px 32px rgba(0,0,0,0.55), 0 2px 8px rgba(0,0,0,0.32);
    }
    .hero-content h1 span {
      color: #ffb703;
      text-shadow: 0 2px 12px rgba(0,0,0,0.18);
    }
    .hero-content p {
      font-size: 1.45rem;
      margin-bottom: 2.2rem;
      font-weight: 400;
      text-align: center;
      color: #e6e6e6;
      text-shadow: 0 2px 8px rgba(0,0,0,0.32);
    }
    .hero-content .btn {
      font-size: 1.18rem;
      font-weight: 700;
      padding: 0.8rem 2.3rem;
      border-radius: 999px;
      margin-right: 1rem;
      margin-bottom: 0.5rem;
      box-shadow: 0 2px 16px rgba(0,0,0,0.18);
      border: none;
      transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    }
    .hero-content .btn-amber {
      background: linear-gradient(90deg, #ffb703 0%, #f97316 100%);
      color: #222;
      border: none;
    }
    .hero-content .btn-amber:hover, .hero-content .btn-amber:focus {
      background: linear-gradient(90deg, #f97316 0%, #ffb703 100%);
      color: #fff;
      box-shadow: 0 4px 24px rgba(255,183,3,0.18);
    }
    .hero-content .btn-outline-light {
      background: rgba(255,255,255,0.12);
      color: #fff;
      border: 2px solid #fff;
    }
    .hero-content .btn-outline-light:hover, .hero-content .btn-outline-light:focus {
      background: #fff;
      color: #222;
      border: 2px solid #ffb703;
      box-shadow: 0 4px 24px rgba(255,255,255,0.18);
    }
    @media (min-width: 992px){ .hero-card{ margin-left:-32px; } }
    .section-title{font-weight:800;letter-spacing:.3px}

    .product-card{border:0;border-radius:18px;overflow:hidden;box-shadow:0 8px 28px rgba(0,0,0,.06);
      transition:transform .18s, box-shadow .18s;background:#fff}
    .product-card:hover{transform:translateY(-4px);box-shadow:0 14px 36px rgba(0,0,0,.10)}
    .product-img{height:220px;object-fit:contain;background:#fff}

    .carousel-control-next,.carousel-control-prev{width:56px}
    .c-dot{background:#fff;color:var(--gem-green);width:52px;height:52px;border-radius:50%;display:grid;place-items:center;
      border:3px solid #fff;box-shadow:0 10px 24px rgba(0,0,0,.15);transition:transform .18s, box-shadow .18s}
    .carousel-control-next:hover .c-dot,.carousel-control-prev:hover .c-dot{transform:scale(1.06)}
    .carousel-indicators [data-bs-target]{background:#fff;opacity:.35}
    .carousel-indicators .active{opacity:1}

    .testimonial{background:#f7f8fb;border-radius:16px;box-shadow:0 6px 18px rgba(0,0,0,.06)}
    footer{border-top:1px solid #eee}
    .text-muted-2{color:var(--muted)}
  </style>
</head>
<body>

  <!-- NAV -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc Logo" style="height: 48px; width: auto; margin-right: 10px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('browse') }}">Browse</a></li>
          <li class="nav-item d-none d-lg-block ms-2">
            <a class="btn btn-pill btn-amber" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Sign Up</a>
          </li>
          <li class="nav-item d-none d-lg-block">
            <a class="btn btn-pill btn-gem ms-2" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="container py-5">
      <div class="row align-items-center g-5">
        <div class="col-lg-6">
          <div class="hero-content">
            <h1>Welcome to <span style="color:var(--gem-amber)">GEMARC Ecommerce</span></h1>
            <p>Your trusted supplier for industrial and commercial needs. Order products, request quotes, and track shipments— all in one place.</p>
            <div class="d-flex flex-wrap justify-content-center gap-2">
              <a href="#featured" class="btn btn-amber"><i class="bi bi-cart3"></i> Shop Now</a>
              <a href="{{ route('register') }}" class="btn btn-outline-light"><i class="bi bi-person-plus"></i> Create Account</a>
            </div>
          </div>
        </div>

        <div class="col-lg-6" id="featured">
          <h3 class="section-title text-white mb-3" style="margin-left:48px;">Featured Products</h3>

          <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel" style="margin-left:48px;">
            <div class="carousel-inner">
              @forelse(($featuredProducts ?? []) as $i => $product)
                <div class="carousel-item @if($i===0) active @endif">
                  <div class="card product-card">
                    <img class="product-img" src="{{ $product->firstImagePath() ? asset('storage/'.$product->firstImagePath()) : asset('images/gemarclogo.png') }}" alt="{{ $product->name }}">
                    <div class="card-body text-center">
                      <h5 class="fw-bold mb-1">{{ $product->name }}</h5>
                      @if(!empty($product->short_description))
                        <p class="text-muted-2 small mb-3">{{ Str::limit($product->short_description, 80) }}</p>
                      @endif
                    </div>
                  </div>
                </div>
              @empty
                <div class="carousel-item active">
                  <div class="card product-card">
                    <img class="product-img" src="{{ asset('images/gemarclogo.png') }}" alt="Placeholder">
                    <div class="card-body text-center">
                      <h5 class="fw-bold mb-1">No featured products yet</h5>
                      <p class="text-muted-2 small mb-3">Add some in your admin panel to showcase here.</p>
                    </div>
                  </div>
                </div>
              @endforelse
            </div>

            @if(($featuredProducts ?? [])->count() > 1)
              <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev"
                style="position:absolute;top:50%;left:-56px;transform:translateY(-50%);width:48px;height:48px;background:#218838;border-radius:50%;border:none;box-shadow:0 2px 8px rgba(33,136,56,0.15);z-index:2;">
                <i class="bi bi-chevron-left fs-4 text-white"></i>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next"
                style="position:absolute;top:50%;right:-56px;transform:translateY(-50%);width:48px;height:48px;background:#218838;border-radius:50%;border:none;box-shadow:0 2px 8px rgba(33,136,56,0.15);z-index:2;">
                <i class="bi bi-chevron-right fs-4 text-white"></i>
                <span class="visually-hidden">Next</span>
              </button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BROWSE PRODUCTS -->
  <section id="browse" class="py-5">
    <div class="container">
      <div class="d-flex align-items-end justify-content-between mb-3">
        <h3 class="section-title mb-0">Browse Products</h3>
        <a href="{{ route('browse') }}" class="btn btn-link fw-semibold">See all <i class="bi bi-arrow-right"></i></a>
      </div>

      <div class="row g-4">
        @forelse(($products ?? ($latestProducts ?? [])) as $product)
          @php
            $img = $product->firstImagePath() ? asset('storage/'.$product->firstImagePath()) : asset('images/gemarclogo.png');
            $name = e($product->name);
            $desc = e($product->description ?? '');
          @endphp
          <div class="col-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
              <img class="product-img" src="{{ $img }}" alt="{{ $name }}">
              <div class="card-body d-flex flex-column">
                <h6 class="fw-bold mb-1">{{ $name }}</h6>
                <div class="mt-auto d-grid gap-2">
                  <!-- QUICK VIEW button -->
                  <button
                    type="button"
                    class="btn btn-pill btn-outline-secondary btn-quick-view"
                    data-bs-toggle="modal"
                    data-bs-target="#productQuickView"
                    data-name="{{ $name }}"
                    data-desc="{{ $desc }}"
                    data-img="{{ $img }}"
                  >Details</button>

                  <a href="{{ route('login') }}" class="btn btn-pill btn-gem">Add to Quote</a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12"><div class="alert alert-light border">No products to display yet.</div></div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="py-5 bg-white">
    <div class="container">
      <h3 class="section-title text-center mb-4">What Our Customers Say</h3>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div id="testimonialCarousel" class="carousel slide testimonial" data-bs-ride="carousel">
            <div class="carousel-inner p-4 p-md-5 position-relative">
              <div class="carousel-item active">
                <figure class="mb-0">
                  <blockquote class="blockquote fs-5">“Super fast delivery and genuine products! Highly recommended.”</blockquote>
                  <figcaption class="blockquote-footer mt-2">Juan D., Makati</figcaption>
                </figure>
              </div>
              <div class="carousel-item">
                <figure class="mb-0">
                  <blockquote class="blockquote fs-5">“Customer support is top-notch. Will order again!”</blockquote>
                  <figcaption class="blockquote-footer mt-2">Maria S., Quezon City</figcaption>
                </figure>
              </div>
              <div class="carousel-item">
                <figure class="mb-0">
                  <blockquote class="blockquote fs-5">“Best supplier for our industrial needs. Trusted for years.”</blockquote>
                  <figcaption class="blockquote-footer mt-2">Ramon P., Laguna</figcaption>
                </figure>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="position:absolute;top:50%;left:-60px;transform:translateY(-50%);z-index:2;">
              <span class="c-dot"><i class="bi bi-chevron-left fs-5"></i></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" style="position:absolute;top:50%;right:-60px;transform:translateY(-50%);z-index:2;">
              <span class="c-dot"><i class="bi bi-chevron-right fs-5"></i></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- NEWSLETTER -->
  <section class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7">
          <div class="p-4 p-md-5 border rounded-4 shadow-sm">
            <h4 class="fw-bold mb-3 text-center">Get Exclusive Offers</h4>
            <form method="POST" action="{{ route('newsletter.subscribe') }}" class="row g-2">
              @csrf
              <div class="col-12 col-md">
                <input type="email" class="form-control form-control-lg" name="email" placeholder="Enter your email" required />
              </div>
              <div class="col-12 col-md-auto d-grid">
                <button class="btn btn-lg btn-pill btn-gem" type="submit">Subscribe</button>
              </div>
            </form>
            <p class="small text-center text-muted mt-2 mb-0">We respect your privacy. Unsubscribe anytime.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <!-- Footer Styles -->
  <style>
  .footer {
    background: #f8f9fa;
    padding: 32px 0 0 0;
    margin-top: 32px;
    font-family: 'Inter', Arial, sans-serif;
    box-shadow: 0 -2px 8px rgba(0,0,0,0.04);
    width: 100%;
    position: static;
    margin-left: 0;
    margin-right: 0;
  }
  .footer .container {
    width: 100%;
    max-width: 100%;
    margin: 0;
    padding: 0;
  }
  .footer-content {
    width: 100%;
    margin: 0;
    padding: 0 0 24px 0;
    box-sizing: border-box;
  }
    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 24px;
        width: 100%;
    }
    .footer-section {
        flex: 1 1 0;
        min-width: 220px;
        background: transparent;
        border-radius: 0;
        box-shadow: none;
        padding: 0 20px 0 32px;
        margin-bottom: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .footer-section h4 {
        color: #198754;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        background: none;
    }
    .footer-section h4 i {
        color: #ff8800;
        font-size: 1.2rem;
    }
    .footer-section p {
        color: #333;
        font-size: 1rem;
        margin: 0;
        line-height: 1.5;
    }
    .footer-bottom {
        text-align: center;
        padding: 18px 0 8px 0;
        color: #fff;
        background: linear-gradient(90deg, #198754 60%, #ff8800 100%);
        border-radius: 0 0 12px 12px;
        font-size: 1rem;
        font-weight: 500;
        margin-top: 0;
    }
    @media (max-width: 900px) {
        .footer-content {
            flex-direction: column;
            gap: 18px;
        }
        .footer-section {
            min-width: 0;
            padding: 0 12px;
        }
    }
  </style>
  <!-- Footer -->
  <footer class="footer">
      <div class="container">
          <div class="footer-content">
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

  <!-- QUICK VIEW MODAL (Bootstrap) -->
  <div class="modal fade" id="productQuickView" tabindex="-1" aria-labelledby="productQuickViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productQuickViewLabel">Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-4 align-items-start">
            <div class="col-md-5">
              <img id="qvImage" src="" alt="" class="img-fluid rounded border" style="background:#fafafa;object-fit:contain;max-height:320px;width:100%">
            </div>
            <div class="col-md-7">
              <h4 id="qvName" class="mb-2"></h4>
              <p id="qvDesc" class="text-muted"></p>
              <div class="d-flex gap-2 mt-3">
                <a href="{{ route('login') }}" class="btn btn-pill btn-gem"><i class="bi bi-box-arrow-in-right"></i> Login to Quote</a>
                <a href="{{ route('register') }}" class="btn btn-pill btn-outline-secondary">Create Account</a>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <small class="text-muted">Tip: Create an account to request quotes faster.</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Fill and show Quick View modal
    document.addEventListener('click', function(e){
      const btn = e.target.closest('.btn-quick-view');
      if(!btn) return;

      // Read product data from data-* attributes
      const name = btn.getAttribute('data-name') || 'Product';
      const desc = btn.getAttribute('data-desc') || '';
      const img  = btn.getAttribute('data-img')  || '{{ asset('images/gemarclogo.png') }}';

      // Populate modal
      document.getElementById('qvName').textContent = name;
      document.getElementById('qvDesc').textContent = desc;
      document.getElementById('qvImage').setAttribute('src', img);
      document.getElementById('productQuickViewLabel').textContent = name;
      // (Bootstrap handles showing because the button already has data-bs-toggle="modal")
    });
  </script>
</body>
</html>
