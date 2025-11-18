<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordChangedNotification;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        \Log::info('Password update request received', $request->all());

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $request->user();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Send password changed notification email
        Mail::to($user->email)->send(new PasswordChangedNotification($user));

        // Debug: Always flash a test status
        // Redirect with a query parameter fallback so AJAX polling cannot
        // accidentally consume the flash data before the settings page loads.
        return redirect()->route('settings', ['password_updated' => 1])->with('status', 'password-updated');
    }
}
