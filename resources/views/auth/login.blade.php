<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gemarc Enterprises Inc | Ecommerce</title>
    <link rel="icon" type="image/png" href="{{ asset('images/gemarclogo.png') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login-industrial.css') }}">
    <style>
      .industrial-bg-centered {
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        background: url('/images/stockroom industrial.png') center center no-repeat;
        background-size: cover;
        filter: blur(2px) brightness(0.5);
        z-index: 0;
      }
      .centered-content {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
      }
    </style>
</head>
<body style="background:#181b1f;">
    <div class="industrial-bg-centered"></div>
    <div class="centered-content">
      <div class="login-industrial w-100" style="max-width:410px;">
        <div class="text-center mb-4">
          <img src="{{ asset('images/gemarclogo.png') }}" alt="Gemarc" class="logo">
        </div>
        <h2 class="fw-bold mb-1">Sign in</h2>
        <p class="text-muted mb-4">Access orders, quotes, and shipment tracking.</p>
        <form method="POST" action="{{ route('login') }}" novalidate>
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror" placeholder="name@company.com">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center">
              <label for="password" class="form-label mb-0">Password</label>
              @if (Route::has('password.request'))
                <a class="forgot-link small" href="{{ route('password.request') }}">Forgot?</a>
              @endif
            </div>
            <div class="input-group">
              <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" onkeyup="checkCapsLock(event)" onkeydown="checkCapsLock(event)">
              <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1" style="border:1px solid #ced4da; background: #fff;" onclick="togglePasswordVisibility('password', this)">
                <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'/></svg>
              </button>
            </div>
            <div id="caps-lock-alert" class="alert alert-warning py-2 px-3 mt-2 mb-0 small d-none" role="alert" style="font-size:0.95em;">
              <strong>Caps Lock is ON.</strong> Passwords are case-sensitive.
            </div>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          <button class="btn btn-industrial w-100 mb-3" type="submit">Sign in</button>
        </form>
        @if (Route::has('register'))
          <p class="mb-0 text-center small text-muted">
            New to GEMARC? <a href="{{ route('register') }}" class="create-link">Create account</a>
          </p>
        @endif
        
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function togglePasswordVisibility(inputId, btn) {
      const input = document.getElementById(inputId);
      if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = `<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.042-3.292m3.1-2.6A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.197M15 12a3 3 0 11-6 0 3 3 0 016 0z' /><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 3l18 18' /></svg>`;
      } else {
        input.type = 'password';
        btn.innerHTML = `<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'/></svg>`;
      }
    }
      function checkCapsLock(e) {
        var caps = e.getModifierState && e.getModifierState('CapsLock');
        var alert = document.getElementById('caps-lock-alert');
        if (caps) {
          alert.classList.remove('d-none');
        } else {
          alert.classList.add('d-none');
        }
      }
    </script>
</body>
</html>
