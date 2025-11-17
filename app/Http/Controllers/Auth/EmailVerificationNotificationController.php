<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        try {
            $request->user()->sendEmailVerificationNotification();
        } catch (\Throwable $e) {
            // Log the transport/notification failure but do not throw a 500 to the user.
            \Log::error('Failed to send email verification: ' . $e->getMessage());
            return back()->with('status', 'verification-link-failed');
        }

        return back()->with('status', 'verification-link-sent');
    }
}
