<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard | Gemarc Enterprises Inc.')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/gemarclogo.png') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @stack('styles')
    
    <style>
    /* Ecommerce Navbar Styles */
    .ecommerce-navbar {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        min-height: 70px;
    }
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        font-size: 1.25rem;
        color: #fff !important;
        text-decoration: none;
    }
    .navbar-brand img {
        height: 40px;
        width: auto;
    }
    .navbar-nav .nav-link {
        color: #e2e8f0 !important;
        font-weight: 500;
        padding: 0.75rem 1rem !important;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        margin: 0 0.25rem;
    }
    .navbar-nav .nav-link:hover {
        color: #fff !important;
        background: rgba(255,255,255,0.1);
        transform: translateY(-1px);
    }
    .navbar-nav .nav-link.active {
        color: #fff !important;
        background: rgba(34,197,94,0.2);
        border: 1px solid rgba(34,197,94,0.3);
    }
    .dropdown-menu {
        background: #1e293b;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 0.75rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }
    .dropdown-item {
        color: #e2e8f0;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }
    .dropdown-item:hover {
        background: rgba(34,197,94,0.2);
        color: #fff;
    }
    .cart-badge {
        background: #ef4444;
        color: white;
        border-radius: 50%;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        position: absolute;
        top: -8px;
        right: -8px;
        min-width: 20px;
        text-align: center;
    }
    .nav-user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #e2e8f0;
        font-weight: 500;
    }
    .nav-user-avatar {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
    }
    </style>
</head>
<body>
    @php
        // Compute cart item count once for the navbar
        $cartCount = 0;
        if(auth()->check()){
            $activeCart = \App\Models\Cart::where('user_id', auth()->id())
                ->whereNull('checked_out_at')
                ->latest()
                ->first();
            if($activeCart){
                $cartCount = (int) $activeCart->items()->sum('qty');
            }
        }
    @endphp
    <!-- Ecommerce Navigation -->
    <nav class="navbar navbar-expand-lg ecommerce-navbar">
        <div class="container-fluid px-4">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc">
                <span>GEMARC Ecommerce</span>
            </a>

            <!-- Toggle Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}" href="{{ route('shop.index') }}">
                            <i class="fas fa-shopping-bag me-1"></i> Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart me-1"></i> 
                            Cart
                            @if($cartCount > 0)
                                <span class="cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                            <i class="fas fa-box me-1"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('quotes.*') ? 'active' : '' }}" href="{{ route('quotes.create') }}">
                            <i class="fas fa-file-invoice me-1"></i> Quotes
                        </a>
                    </li>
                </ul>

                <!-- Quick Icons + User Menu -->
                <ul class="navbar-nav align-items-center gap-2">
                    <!-- Cart Icon -->
                    <li class="nav-item position-relative me-2">
                        <a class="nav-link" href="{{ route('cart.index') }}" title="Cart">
                            <i class="fas fa-shopping-cart"></i>
                            @if($cartCount > 0)
                                <span class="cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Chat Icon -->
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('chat.page') }}" title="Chat">
                            <i class="fas fa-comment-dots"></i>
                        </a>
                    </li>
                    
                    <!-- User Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-user-info" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="nav-user-avatar">
                                {{ strtoupper(substr(auth()->user()->name ?? 'User', 0, 1)) }}
                            </div>
                            <span>{{ auth()->user()->name ?? 'User' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i> Profile
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('settings') }}">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('saved.index') }}">
                                <i class="fas fa-heart me-2"></i> Saved Items
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>