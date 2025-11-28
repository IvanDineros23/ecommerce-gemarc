<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Gemarc Enterprises Inc</title>
    <link rel="icon" type="image/png" href="{{ asset('images/gemarclogo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome-industrial.css') }}">
</head>
<body>
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center p-0">
        <div class="row w-100 g-0" style="min-height: 100vh;">
            <div class="col-md-7 d-none d-md-block industrial-bg"></div>
            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center" style="background:#181b1f;">
                <div class="login-industrial w-100" style="background:#fff; color:#222; max-width:520px;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc" class="logo">
                    </div>
                    <h2 class="fw-bold mb-3 text-center" style="color:#222;">Welcome to GEMARC Purchasing Hub</h2>
                    <div class="d-grid gap-2 mb-2">
                        <a href="{{ route('login') }}" class="btn btn-industrial">Sign in</a>
                        <a href="{{ route('register') }}" class="btn btn-success" style="background:#28a745; color:#fff; border:none;">Create account</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-2" style="border-color:#6c757d; color:#6c757d;">Go to Website</a>
                    </div>
                    <div class="text-muted small mt-4 text-center">&copy; {{ date('Y') }} Gemarc Enterprises Inc. All rights reserved.</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
