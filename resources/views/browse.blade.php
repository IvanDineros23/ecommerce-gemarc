<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Browse Products | Gemarc Enterprises Inc.</title>
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
        .product-card{border:0;border-radius:18px;overflow:hidden;box-shadow:0 8px 28px rgba(0,0,0,.06);transition:transform .18s, box-shadow .18s;background:#fff}
        .product-card:hover{transform:translateY(-4px);box-shadow:0 14px 36px rgba(0,0,0,.10)}
        .product-img{height:220px;object-fit:contain;background:#fff}
        .text-muted-2{color:var(--muted)}
    </style>
</head>
<body>
    <!-- NAV -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc" style="height:44px;" class="me-2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="nav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link fw-bold active" href="{{ route('browse') }}">Browse</a></li>
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

    <!-- BROWSE PRODUCTS -->
    <section class="py-5">
        <div class="container">
            <!-- Search Bar -->
            <div class="mb-4 d-flex justify-content-center">
                <div class="input-group" style="max-width: 730px; width:100%;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput" class="form-control form-control-lg border-start-0" placeholder="Search products..." autocomplete="off" style="border-radius: 0 999px 999px 0;" />
                </div>
            </div>
            <div class="row g-4" id="productGrid">
                @forelse($products as $product)
                    <div class="col-6 col-md-4 col-lg-3 product-item" data-name="{{ strtolower($product->name) }}" data-desc="{{ strtolower($product->description) }}">
                        <div class="card product-card h-100">
                            <img class="product-img" src="{{ $product->firstImagePath() ? asset('storage/'.$product->firstImagePath()) : asset('images/gemarclogo.png') }}" alt="{{ $product->name }}">
                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                                <div class="text-muted-2 small mb-2">{{ Str::limit($product->description, 80) }}</div>
                                <div class="mt-auto d-grid gap-2">
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

    <!-- FOOTER -->
    <footer class="bg-white py-4 mt-5">
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Instant search filter for products
    document.getElementById('searchInput').addEventListener('input', function() {
        const q = this.value.trim().toLowerCase();
        const items = document.querySelectorAll('.product-item');
        let anyVisible = false;
        items.forEach(function(item) {
            const name = item.getAttribute('data-name');
            const desc = item.getAttribute('data-desc');
            if (name.includes(q) || desc.includes(q)) {
                item.style.display = '';
                anyVisible = true;
            } else {
                item.style.display = 'none';
            }
        });
        // Optionally, show a message if nothing matches
        const emptyMsg = document.getElementById('noResultsMsg');
        if (!anyVisible) {
            if (!emptyMsg) {
                const msg = document.createElement('div');
                msg.id = 'noResultsMsg';
                msg.className = 'col-12';
                msg.innerHTML = '<div class="alert alert-light border">No products found.</div>';
                document.getElementById('productGrid').appendChild(msg);
            }
        } else {
            if (emptyMsg) emptyMsg.remove();
        }
    });
    </script>
</body>
</html>
