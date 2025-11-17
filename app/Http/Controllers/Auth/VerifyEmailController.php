<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // If the user is authenticated, prefer that user. Otherwise find the
        // user ID from the route and validate the email hash manually.
        $user = $request->user();

        if (! $user) {
            $id = $request->route('id');
            $hash = $request->route('hash');

            $user = User::findOrFail($id);

            // Validate the signed hash matches the expected email hash
            if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
                abort(403);
            }
        }

        // If already verified, ensure user is logged in and redirect.
        if ($user->hasVerifiedEmail()) {
            if (! Auth::check()) {
                Auth::loginUsingId($user->getKey());
            }

            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        // Mark verified and fire event. Log the user in if not already.
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        if (! Auth::check()) {
            Auth::loginUsingId($user->getKey());
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
