<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/gemarclogo.png') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard | Gemarc Enterprises Inc.')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="min-h-screen">
              {{-- Header area (optional) --}}
              @if (isset($header))
                  <header class="border-bottom bg-white">
                      <div class="container py-3">
                          {{ $header }}
                      </div>
                  </header>
              @elseif (View::hasSection('header'))
                  <header class="border-bottom bg-white">
                      <div class="container py-3">
                          @yield('header')
                      </div>
                  </header>
              @endif

              {{-- Page content --}}
              <div class="w-full py-4">
                @if (isset($slot))
                    {{ $slot }}              {{-- component mode: <x-app-layout> --}}
                @else
                    @yield('content')        {{-- classic mode: @extends + @section --}}
                @endif
              </div>
            </main>
        </div>

<!-- Footer Styles -->
<style>
    .footer {
        background: #f8f9fa;
        padding: 32px 0 0 0;
        margin-top: 32px;
        font-family: 'Inter', Arial, sans-serif;
        box-shadow: 0 -2px 8px rgba(0,0,0,0.04);
    }
    .footer .container {
        width: 100%;
        margin: 0;
        padding: 0;
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

</body>
@stack('scripts')
</html>
