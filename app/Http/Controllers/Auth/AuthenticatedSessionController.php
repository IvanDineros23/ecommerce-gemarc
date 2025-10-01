<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use App\Helpers\AuditLogger;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        // Audit log: user login
        if ($user) {
            $role = method_exists($user, 'isAdmin') && $user->isAdmin() ? 'admin' : (method_exists($user, 'isEmployee') && $user->isEmployee() ? 'employee' : 'user');
            $details = "User '{$user->name}' (ID: {$user->id}, Role: {$role}) logged in.";
            AuditLogger::log(
                'login',
                $role,
                null,
                [
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ],
                null,
                $details
            );
        }
        if ($user) {
            if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            } elseif (method_exists($user, 'isEmployee') && $user->isEmployee()) {
                // Always redirect to employee dashboard, not intended
                return redirect(route('employee.dashboard', absolute: false));
            } elseif (method_exists($user, 'isUser') && $user->isUser()) {
                return redirect()->intended(route('dashboard', absolute: false));
            }
        }
        // fallback
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        // Audit log: user logout
        if ($user) {
            $role = method_exists($user, 'isAdmin') && $user->isAdmin() ? 'admin' : (method_exists($user, 'isEmployee') && $user->isEmployee() ? 'employee' : 'user');
            $details = "User '{$user->name}' (ID: {$user->id}, Role: {$role}) logged out.";
            AuditLogger::log(
                'logout',
                $role,
                null,
                [
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ],
                null,
                $details
            );
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
