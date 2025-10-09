<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Log viewing of profile page for audit trail
        \App\Helpers\AuditLogger::log(
            'view_profile', 
            'user', 
            $request->user()->id, 
            null, 
            null, 
            "User '{$request->user()->name}' (ID: {$request->user()->id}) viewed their profile page."
        );
        
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $beforeData = [
            'name' => $user->name,
            'email' => $user->email,
            'contact_no' => $user->contact_no,
            'address' => $user->address,
            'profile_image' => $user->profile_image
        ];
        
        $validated = $request->validated();
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_image);
            }
            
            // Store new image
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            $validated['profile_image'] = $imagePath;
        }
        
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        
        // Log the profile update to audit logs
        $afterData = [
            'name' => $user->name,
            'email' => $user->email,
            'contact_no' => $user->contact_no,
            'address' => $user->address,
            'profile_image' => $user->profile_image
        ];
        
        $changedFields = array_keys(array_diff_assoc($afterData, $beforeData));
        
        if (!empty($changedFields)) {
            $details = "User '{$user->name}' (ID: {$user->id}) updated their profile. Changed fields: " . implode(', ', $changedFields);
            \App\Helpers\AuditLogger::log('profile_update', 'user', $user->id, $beforeData, $afterData, $details);
        }

        return Redirect::route('profile.edit')->with('success', 'Your profile has been updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
