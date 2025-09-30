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

  <!-- Theme styles -->
  <style>
    :root{
      --gem-green:#198754; /* bootstrap success base */
      --gem-green-600:#157347;
      --gem-amber:#ffb703;
      --gem-orange:#f97316;
      --ink:#1f2937;
      --muted:#6b7280;
      --card:#ffffffaa;
    }
    html,body{background:#fff;color:var(--ink);scroll-behavior:smooth}
    .navbar{
      backdrop-filter:saturate(120%) blur(6px);
      box-shadow:0 2px 12px rgba(0,0,0,.06);
    }
    .navbar .nav-link{font-weight:600}
    .btn-pill{
      border-radius:999px;
      padding:.55rem 1.1rem;
      font-weight:700;
      transition:transform .12s ease, box-shadow .12s ease;
    }
    .btn-pill:active{transform:translateY(1px)}
    .btn-gem{background:var(--gem-green);border-color:var(--gem-green);color:#fff}
    .btn-gem:hover{background:var(--gem-green-600);border-color:var(--gem-green-600)}
    .btn-amber{background:var(--gem-amber);border-color:var(--gem-amber);color:#1a1a1a}
    .btn-amber:hover{filter:brightness(.95)}

    /* HERO */
    .hero{
      position:relative;
      min-height:680px;
      display:grid;
      place-items:center;
      background:linear-gradient(100deg, var(--gem-green) 0%, #2ea36d 35%, var(--gem-orange) 100%);
      color:#fff;
      overflow:hidden;
    }
    .hero:before{
      content:"";
      position:absolute; inset:auto -20% -35% -20%;
      height:55%;
      background:#fff; opacity:.06; filter:blur(60px);
      border-radius:50%;
    }
    .hero-card{
      background:rgba(255,255,255,.08);
      border:1px solid rgba(255,255,255,.2);
      backdrop-filter:blur(10px);
      border-radius:18px;
      box-shadow:0 20px 50px rgba(0,0,0,.18);
    }
    .section-title{
      font-weight:800; letter-spacing:.3px;
    }

    /* PRODUCT CARD */
    .product-card{
      border:0;
      border-radius:18px;
      overflow:hidden;
      box-shadow:0 8px 28px rgba(0,0,0,.06);
      transition:transform .18s ease, box-shadow .18s ease;
      background:#fff;
    }
    .product-card:hover{
      transform:translateY(-4px);
      box-shadow:0 14px 36px rgba(0,0,0,.10);
    }
    .product-img{
      height:220px; object-fit:contain; background:#fff;
    }

    /* CAROUSEL CONTROLS */
    .carousel-control-next, .carousel-control-prev{width:56px}
    .c-dot{
      background:#fff; color:var(--gem-green);
      width:52px; height:52px; border-radius:50%;
      display:grid; place-items:center;
      border:3px solid #fff; box-shadow:0 10px 24px rgba(0,0,0,.15);
      transition:transform .18s ease, box-shadow .18s ease;
    }
    .carousel-control-next:hover .c-dot,
    .carousel-control-prev:hover .c-dot{transform:scale(1.06)}
    .carousel-indicators [data-bs-target]{background:#fff; opacity:.35}
    .carousel-indicators .active{opacity:1}

    /* TESTIMONIAL */
    .testimonial{
      background:#f7f8fb;
      border-radius:16px;
      box-shadow:0 6px 18px rgba(0,0,0,.06);
    }

    /* FOOTER */
    footer{border-top:1px solid #eee}
    .text-muted-2{color:var(--muted)}
  </style>
</head>
<body>

  <!-- NAV -->
  <nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="/">
        <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc" height="28" />
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="#browse">Browse</a></li>
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
          <div class="p-4 p-md-5 hero-card">
            <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc" class="mb-4" style="height:74px">
            <h1 class="display-5 fw-bold mb-3">Welcome to <span style="color:var(--gem-amber)">GEMARC Ecommerce</span></h1>
            <p class="lead mb-4">Your trusted supplier for industrial and commercial needs. Order products, request quotes, and track shipments— all in one place.</p>
            <div class="d-flex flex-wrap gap-2">
              <a href="#featured" class="btn btn-pill btn-amber"><i class="bi bi-cart3"></i> Shop Now</a>
              <a href="{{ route('register') }}" class="btn btn-pill btn-outline-light"><i class="bi bi-person-plus"></i> Create Account</a>
            </div>
          </div>
        </div>

        <div class="col-lg-6" id="featured">
          <h3 class="section-title text-white mb-3">Featured Products</h3>

          <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel">
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
                      <a href="{{ route('products.show', $product) }}" class="btn btn-pill btn-gem">View Details</a>
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
              <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev" style="top:50%; left:-32px; width:48px; height:48px; background:#218838; border-radius:50%; border:none; box-shadow:0 2px 8px rgba(33,136,56,0.15);">
                <i class="bi bi-chevron-left fs-4 text-white"></i>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next" style="top:50%; right:-32px; width:48px; height:48px; background:#218838; border-radius:50%; border:none; box-shadow:0 2px 8px rgba(33,136,56,0.15);">
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
  <a href="{{ route('shop.index') }}" class="btn btn-link fw-semibold">See all <i class="bi bi-arrow-right"></i></a>
      </div>

      <div class="row g-4">
        @forelse(($latestProducts ?? ($products ?? [])) as $product)
          <div class="col-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
              <img class="product-img" src="{{ $product->firstImagePath() ? asset('storage/'.$product->firstImagePath()) : asset('images/gemarclogo.png') }}" alt="{{ $product->name }}">
              <div class="card-body d-flex flex-column">
                <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                @if(isset($product->price))
                  <div class="text-muted-2 small mb-2">₱{{ number_format($product->price, 2) }}</div>
                @endif
                <div class="mt-auto d-grid gap-2">
                  <a href="{{ route('products.show', $product) }}" class="btn btn-pill btn-outline-secondary">Details</a>
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
            <div class="carousel-inner p-4 p-md-5">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
              <span class="c-dot"><i class="bi bi-chevron-left fs-5"></i></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
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
  <footer class="bg-white py-4">
    <div class="container">
      <div class="row gy-4">
        <div class="col-md-6">
          <h5>Gemarc Enterprises Inc</h5>
          <p class="mb-0 text-muted-2">Your trusted supplier for industrial and commercial needs.</p>
        </div>
        <div class="col-md-3">
          <h6>Quick Links</h6>
          <ul class="list-unstyled">
            <li><a class="text-decoration-none" href="/">Home</a></li>
            <li><a class="text-decoration-none" href="{{ route('login') }}">Login</a></li>
            <li><a class="text-decoration-none" href="{{ route('register') }}">Sign Up</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Contact</h6>
          <ul class="list-unstyled">
            <li class="text-muted-2">Email: info@gemarc.com.ph</li>
            <li class="text-muted-2">Phone: (02) 1234-5678</li>
            <li class="mt-2">
              <a href="#" class="me-2"><i class="bi bi-facebook"></i></a>
              <a href="#" class="me-2"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-instagram"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="text-center mt-3 text-muted-2">&copy; {{ date('Y') }} Gemarc Enterprises Inc. All rights reserved.</div>
    </div>
  </footer>

  <!-- Optional Auth Modal (kept for future use) -->
  <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="authModalLabel">Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs mb-3" id="authTab" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#login">Login</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#register">Create Account</button></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="login"> <!-- login form here --> </div>
            <div class="tab-pane fade" id="register"> <!-- register form here --> </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
