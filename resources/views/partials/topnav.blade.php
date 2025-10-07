<nav class="nav">
    <ul class="nav-list">
        <li class="nav-item"><a href="/static" class="nav-link {{ request()->is('static') ? 'active' : '' }}">Home</a></li>
        <li class="nav-item"><a href="/static/about" class="nav-link {{ request()->is('static/about') ? 'active' : '' }}">About</a></li>
        <li class="nav-item"><a href="/static/products" class="nav-link {{ request()->is('static/products*') ? 'active' : '' }}">Products</a></li>
        <li class="nav-item"><a href="/static/services" class="nav-link {{ request()->is('static/services*') ? 'active' : '' }}">Services</a></li>
        <li class="nav-item"><a href="/static/contact" class="nav-link {{ request()->is('static/contact') ? 'active' : '' }}">Contact</a></li>
        <li class="nav-item"><a href="/static/careers" class="nav-link {{ request()->is('static/careers') ? 'active' : '' }}">Careers</a></li>
    </ul>
    <div class="mobile-menu-toggle">
        <i class="fas fa-bars"></i>
    </div>
</nav>