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
    /* Ensure Alpine x-cloak elements are hidden until Alpine initializes */
    [x-cloak] { display: none !important; }

    /* Ecommerce Navbar Styles */
    .ecommerce-navbar {
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        min-height: 70px;
    }
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        font-size: 1.25rem;
        color: #222 !important;
        text-decoration: none;
    }
    .navbar-brand img { height: 40px; width: auto; }
    .navbar-nav .nav-link {
        color: #333 !important;
        font-weight: 500;
        padding: 0.75rem 1rem !important;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        margin: 0 0.25rem;
    }
    .navbar-nav .nav-link:hover {
        color: #16a34a !important;
        background: rgba(22,163,74,0.05);
        transform: translateY(-1px);
    }
    .navbar-nav .nav-link.active {
        color: #16a34a !important;
        background: rgba(34,197,94,0.1);
        border: 1px solid rgba(34,197,94,0.2);
    }
    .dropdown-menu {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 0.75rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .dropdown-item {
        color: #333;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }
    .dropdown-item:hover {
        background: rgba(34,197,94,0.1);
        color: #16a34a;
    }
    .cart-badge {
        background: #ef4444;
        color: white;
        border-radius: 50%;
        padding: 0.2rem 0.45rem;
        font-size: 0.7rem;
        font-weight: 600;
        position: absolute;
        top: -6px;
        right: -8px;
        min-width: 18px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        border: 1.5px solid white;
        animation: pulse 2s infinite;
    }
    .notification-badge { background: #f59e0b; }
    
    <script>
    function markAllAsRead() {
        // Remove unread indicators
        document.querySelectorAll('.unread-notification').forEach(item => {
            item.classList.remove('unread-notification');
        });
        
        // Hide notification badge
        const badge = document.querySelector('.notification-badge');
        if (badge) {
            badge.style.display = 'none';
        }
        
        // Optional: Send AJAX request to server to mark as read
        fetch('/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        }).catch(error => console.log('Mark as read failed:', error));
    }
    
    // Auto-hide notification badge after a while
    document.addEventListener('DOMContentLoaded', function() {
        const notificationDropdown = document.querySelector('.nav-item.dropdown .dropdown-menu');
        if (notificationDropdown) {
            notificationDropdown.addEventListener('show.bs.dropdown', function() {
                // Optionally mark as read when opened
                setTimeout(() => {
                    const badge = document.querySelector('.notification-badge');
                    if (badge && badge.style.display !== 'none') {
                        badge.style.opacity = '0.5';
                    }
                }, 2000);
            });
        }
    });
    </script>
    .chat-badge { background: #3b82f6; }
    @keyframes pulse {
        0% { transform: scale(1); box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        50% { transform: scale(1.05); box-shadow: 0 2px 8px rgba(239,68,68,0.5); }
        100% { transform: scale(1); box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
    }
    .nav-user-info { display:flex; align-items:center; gap:.75rem; color:#333; font-weight:500; }
    .nav-user-avatar{
        width:38px;height:38px;background:linear-gradient(135deg,#22c55e,#16a34a);
        border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;
        font-weight:600;font-size:.875rem;box-shadow:0 2px 8px rgba(0,0,0,0.1);border:2px solid #fff;
    }
    .navbar .nav-link i{ font-size:1.1rem; transition: transform .2s; }
    .navbar .nav-link:hover i{ transform: translateY(-2px); }
    .unread-notification{ background-color: rgba(34,197,94,0.04); position: relative; }
    .unread-indicator{ width:8px;height:8px;border-radius:50%;background:#16a34a; position:absolute; right:15px; top:15px; }
    .notification-icon{ width:36px;height:36px; display:flex; align-items:center; justify-content:center; }
    .notification-time{ color:#999; font-size:.75rem; display:block; margin-top:3px; }

    /* Layout bones so footer sits at bottom */
    html, body { height:100%; margin:0; }
    body { display:flex; flex-direction:column; min-height:100vh; }
    main { flex: 1 0 auto; min-height: 60vh; display:flex; flex-direction:column; }

    /* ===== FOOTER (copied/adapted from app.blade.php) ===== */
    .site-footer { background:#2E7D32; padding:0; width:100%; color:#fff; flex-shrink:0; margin-top:auto; }
    .site-footer__wrap { max-width:1400px; margin:0 auto; }
    .site-footer__grid {
        display:grid; grid-template-columns: 1.2fr 1fr 1.2fr; gap:0; background:#2E7D32;
    }
    .site-footer__item { padding:14px 14px 12px; border-right:1px solid rgba(255,255,255,0.1); }
    .site-footer__item:last-child { border-right:0; }
    .site-footer__title{
        display:flex; align-items:center; gap:8px; color:#fff; font-size:1rem; font-weight:700; margin:0 0 8px 0;
    }
    .site-footer__title i{ color:#FFA000; font-size:1.1rem; }
    .site-footer__text{ margin:0; color:rgba(255,255,255,0.9); line-height:1.5; font-size:.95rem; }
    .site-footer__bar{ text-align:center; padding:12px 0; color:#fff; background:#1B5E20; font-size:.95rem; font-weight:600; }

    @media (max-width: 900px) {
        .site-footer__grid { grid-template-columns:1fr; }
        .site-footer__item { border-right:0; border-bottom:1px solid rgba(255,255,255,0.1); text-align:center; }
        .site-footer__item:last-child { border-bottom:0; }
        .site-footer__title { justify-content:center; }
        .site-footer__text { text-align:center; }
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
            </a>

            <!-- Toggle Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @if(!(auth()->check() && auth()->user()->isEmployee()))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}" href="{{ route('shop.index') }}">
                            <i class="fas fa-shopping-bag me-1"></i> Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart me-1"></i> 
                            Cart
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
                    @endif
                </ul>

                <!-- Quick Icons + User Menu -->
                <ul class="navbar-nav align-items-center gap-2">
                    @if(!(auth()->check() && auth()->user()->isEmployee()))
                    <li class="nav-item position-relative me-2">
                        <a class="nav-link" href="{{ route('cart.index') }}" title="Cart">
                            <i class="fas fa-shopping-cart"></i>
                            @if($cartCount > 0)
                                <span class="cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>
                    @endif
                    
                    <!-- Notifications -->
                    <li class="nav-item dropdown position-relative me-2">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
                            <i class="fas fa-bell"></i>
                            @php
                                $user = auth()->user();
                                $unreadCount = 0;
                                if ($user) {
                                    // Get recent activities for notifications
                                    $recentOrders = \App\Models\Order::where('user_id', $user->id)->where('created_at', '>', now()->subDays(7))->count();
                                    $recentQuotes = \App\Models\Quote::where('user_id', $user->id)->where('created_at', '>', now()->subDays(7))->count();
                                    $unreadCount = $recentOrders + $recentQuotes;
                                }
                            @endphp
                            @if($unreadCount > 0)
                                <span class="notification-badge cart-badge">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0 overflow-hidden" style="width: 320px; max-height: 400px;">
                            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                                <h6 class="m-0 fw-bold">Notifications</h6>
                                <a href="#" class="text-decoration-none small" onclick="markAllAsRead()">Mark all as read</a>
                            </div>
                            <div class="notifications-list" style="max-height: 300px; overflow-y: auto;">
                                @auth
                                    @php
                                        // Get real notifications
                                        $userNotifications = collect();
                                        
                                        // Recent orders
                                        $recentOrders = \App\Models\Order::where('user_id', auth()->id())
                                            ->latest()
                                            ->limit(3)
                                            ->get();
                                        
                                        foreach($recentOrders as $order) {
                                            $userNotifications->push([
                                                'type' => 'order',
                                                'icon' => 'fas fa-shopping-cart',
                                                'color' => 'success',
                                                'title' => 'Order #' . $order->id . ' ' . ucfirst($order->status),
                                                'message' => 'Your order has been ' . $order->status,
                                                'time' => $order->created_at->diffForHumans(),
                                                'link' => route('orders.show', $order->id)
                                            ]);
                                        }
                                        
                                        // Recent quotes
                                        $recentQuotes = \App\Models\Quote::where('user_id', auth()->id())
                                            ->latest()
                                            ->limit(3)
                                            ->get();
                                        
                                        foreach($recentQuotes as $quote) {
                                            $userNotifications->push([
                                                'type' => 'quote',
                                                'icon' => 'fas fa-file-alt',
                                                'color' => 'primary',
                                                'title' => 'Quote #' . $quote->id . ' ' . ucfirst($quote->status),
                                                'message' => 'Your quote request is ' . $quote->status,
                                                'time' => $quote->created_at->diffForHumans(),
                                                'link' => '#'
                                            ]);
                                        }
                                        
                                        // Recent shipments
                                        $recentShipments = \App\Models\Shipment::where('user_id', auth()->id())
                                            ->latest()
                                            ->limit(2)
                                            ->get();
                                        
                                        foreach($recentShipments as $shipment) {
                                            $userNotifications->push([
                                                'type' => 'shipment',
                                                'icon' => 'fas fa-truck',
                                                'color' => 'warning',
                                                'title' => 'Shipment #' . $shipment->id . ' ' . ucfirst($shipment->status),
                                                'message' => 'Your package is ' . str_replace('_', ' ', $shipment->status),
                                                'time' => $shipment->created_at->diffForHumans(),
                                                'link' => '#'
                                            ]);
                                        }
                                        
                                        $userNotifications = $userNotifications->sortByDesc(function($notif) {
                                            return $notif['time'];
                                        })->take(8);
                                    @endphp
                                    
                                    @forelse($userNotifications as $notification)
                                        <a href="{{ $notification['link'] }}" class="dropdown-item p-3 border-bottom d-flex align-items-center unread-notification">
                                            <div class="notification-icon me-3 bg-{{ $notification['color'] }} bg-opacity-10 text-{{ $notification['color'] }} rounded-circle p-2">
                                                <i class="{{ $notification['icon'] }}"></i>
                                            </div>
                                            <div class="notification-content flex-grow-1">
                                                <p class="mb-1 text-dark fw-semibold">{{ $notification['title'] }}</p>
                                                <p class="small text-muted mb-0">{{ $notification['message'] }}</p>
                                                <span class="notification-time small">{{ $notification['time'] }}</span>
                                            </div>
                                            <div class="unread-indicator"></div>
                                        </a>
                                    @empty
                                        <div class="dropdown-item p-3 text-center text-muted">
                                            <i class="fas fa-bell-slash fa-2x mb-2 text-muted"></i>
                                            <p class="mb-0">No notifications yet</p>
                                            <small>We'll notify you about orders, quotes, and shipments</small>
                                        </div>
                                    @endforelse
                                @else
                                    <div class="dropdown-item p-3 text-center text-muted">
                                        <i class="fas fa-user-lock fa-2x mb-2 text-muted"></i>
                                        <p class="mb-0">Please log in</p>
                                        <small>Login to see your notifications</small>
                                    </div>
                                @endauth
                            </div>
                            @auth
                                <div class="text-center p-2 border-top">
                                    <a href="{{ route('dashboard') }}" class="text-decoration-none small">View all notifications</a>
                                </div>
                            @endauth
                        </div>
                    </li>

                    <!-- Chat -->
                    <li class="nav-item position-relative me-3">
                        @php $user = auth()->user(); @endphp
                        <a class="nav-link" href="{{ $user && $user->role === 'employee' ? route('employee.chat.page') : route('chat.page') }}" title="Chat">
                            <i class="fas fa-comment-dots"></i>
                            <span class="chat-badge cart-badge" style="display:none"></span>
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
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- ===== Footer (same structure as app.blade.php) ===== -->
    <footer class="site-footer">
        <div class="site-footer__wrap">
            <div class="site-footer__grid">
                <!-- Office Address -->
                <div class="site-footer__item">
                    <h4 class="site-footer__title"><i class="fas fa-map-marker-alt"></i> Office Address</h4>
                    <p class="site-footer__text">
                        No. 15 Chile St. Ph1 Greenheights Subdivision,<br>
                        Concepcion 1, Marikina City, Philippines 1807
                    </p>
                </div>

                <!-- Combined Contact Numbers -->
                <div class="site-footer__item">
                    <h4 class="site-footer__title"><i class="fas fa-phone"></i> Contact Numbers</h4>
                    <p class="site-footer__text" style="margin-bottom:6px;">
                        <strong>Telephone:</strong> (632)8-997-7959
                    </p>
                    <p class="site-footer__text">
                        <strong>Mobile Numbers:</strong><br>
                        +63 909 087 9416 <span style="color:#ffd580;font-size:.9em;">| Marketing Department</span><br>
                        +63 928 395 3532 <span style="color:#ffd580;font-size:.9em;">| Technical Department</span><br>
                        +63 918 905 8316
                    </p>
                </div>

                <!-- Email Addresses -->
                <div class="site-footer__item">
                    <h4 class="site-footer__title"><i class="fas fa-envelope"></i> Email Address</h4>
                    <p class="site-footer__text">
                        sales@gemarcph.com<br>
                        technical@gemarcph.com<br>
                        gemarcent.fo@gmail.com<br>
                        gemarc.fo@gemarcph.com
                    </p>
                </div>
            </div>
        </div>
        <div class="site-footer__bar">
            &copy; {{ date('Y') }} Gemarc Enterprises Incorporated. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')

@if(auth()->check() && auth()->user()->isEmployee())
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateBadges(notifCount, chatCount) {
        var notifBadge = document.querySelector('.notification-badge.cart-badge');
        var chatBadge = document.querySelector('.chat-badge.cart-badge');
        if (notifBadge) {
            notifBadge.style.display = notifCount > 0 ? 'inline-block' : 'none';
            notifBadge.textContent = notifCount > 0 ? notifCount : '';
        }
        if (chatBadge) {
            chatBadge.style.display = chatCount > 0 ? 'inline-block' : 'none';
            chatBadge.textContent = chatCount > 0 ? chatCount : '';
        }
    }

    async function pollBadges() {
        try {
            const res = await fetch('/notifications/fetch', { credentials: 'same-origin' });
            if (!res.ok) return;
            const data = await res.json();
            if (data.success) {
                updateBadges(data.notif_count, data.chat_unread);
            } else {
                updateBadges(0, 0);
            }
        } catch (e) {
            updateBadges(0, 0);
        }
    }
    pollBadges();
    setInterval(pollBadges, 5000);
});
</script>
@endif

@if(auth()->check() && auth()->user()->isUser())
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateBadges(notifCount, chatCount) {
        var notifBadge = document.querySelector('.notification-badge.cart-badge');
        var chatBadge = document.querySelector('.chat-badge.cart-badge');
        if (notifBadge) {
            notifBadge.style.display = notifCount > 0 ? 'inline-block' : 'none';
            notifBadge.textContent = notifCount > 0 ? notifCount : '';
        }
        if (chatBadge) {
            chatBadge.style.display = chatCount > 0 ? 'inline-block' : 'none';
            chatBadge.textContent = chatCount > 0 ? chatCount : '';
        }
    }

    async function pollBadges() {
        try {
            const res = await fetch('/notifications/fetch', { credentials: 'same-origin' });
            if (!res.ok) return;
            const data = await res.json();
            if (data.success) {
                updateBadges(data.notif_count, data.chat_unread);
            } else {
                updateBadges(0, 0);
            }
        } catch (e) {
            updateBadges(0, 0);
        }
    }
    pollBadges();
    setInterval(pollBadges, 5000);
});
</script>
@endif
</body>
</html>
