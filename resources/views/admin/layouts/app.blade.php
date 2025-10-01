<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { background: #f7f9fb; }
        .sidebar {
            min-height: 100vh;
            background: #0a1931;
            color: #fff;
            padding: 2rem 1rem 1rem 1.5rem;
        }
        .sidebar h2 { font-size: 1.7rem; font-weight: 800; margin-bottom: 2rem; }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin-bottom: 1.55rem;
            font-size: 1.08rem;
            letter-spacing: 0.01em;
            padding: 0.1rem 0.2rem;
            transition: background 0.12s;
            border-radius: 6px;
        }
        .sidebar a.active, .sidebar a:hover {
            color: #ffb703;
            font-weight: 700;
            background: rgba(255,183,3,0.08);
        }
        .sidebar .nav-link { padding: 0; }
    </style>
    @stack('head')
</head>
<body>
<div class="d-flex">
    <nav class="sidebar">
    <h2>Admin Panel</h2>
    <a href="{{ route('admin.dashboard') }}" class="@if(request()->routeIs('admin.dashboard')) active @endif">Dashboard</a>
    <a href="{{ route('admin.orders') }}" class="@if(request()->routeIs('admin.orders')) active @endif">All Orders</a>
    <a href="{{ route('admin.quotes') }}" class="@if(request()->routeIs('admin.quotes')) active @endif">Quotes Management</a>
    <a href="{{ route('admin.uploads') }}" class="@if(request()->routeIs('admin.uploads')) active @endif">Bulk Uploads</a>
    <a href="{{ route('admin.approvals') }}" class="@if(request()->routeIs('admin.approvals')) active @endif">Order Approvals</a>
    <a href="{{ route('admin.export') }}" class="@if(request()->routeIs('admin.export')) active @endif">Export Orders</a>
    <a href="{{ route('admin.products') }}" class="@if(request()->routeIs('admin.products')) active @endif">Manage Products</a>
    <a href="{{ route('admin.stock') }}" class="@if(request()->routeIs('admin.stock')) active @endif">Stock & Lead Time</a>
    <a href="{{ route('admin.pricing') }}" class="@if(request()->routeIs('admin.pricing')) active @endif">Pricing Tiers</a>
    <a href="{{ route('admin.documents') }}" class="@if(request()->routeIs('admin.documents')) active @endif">Documents</a>
    <a href="{{ route('admin.brands') }}" class="@if(request()->routeIs('admin.brands')) active @endif">Brands & Standards</a>
    <a href="{{ route('admin.users') }}" class="@if(request()->routeIs('admin.users')) active @endif">User Management</a>
    <a href="{{ route('admin.business') }}" class="@if(request()->routeIs('admin.business')) active @endif">Business Info</a>
    </nav>
    <main class="flex-grow-1">
        @yield('content')
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
