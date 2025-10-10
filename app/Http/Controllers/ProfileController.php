<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Helpers\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $userName = Auth::user()->name;
            
            try {
                // Log viewing of profile page for audit trail
                \App\Helpers\AuditLogger::log(
                    'view_profile', 
                    'user', 
                    $userId, 
                    null, 
                    null, 
                    "User '{$userName}' viewed their profile page."
                );
            } catch (\Exception $e) {
                Log::error('Error logging profile view: ' . $e->getMessage());
            }
        }
        
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if (!Auth::check()) {
            return Redirect::route('login');
        }
        
        $user = $request->user();
        $userId = Auth::id();
        
        // Store current data before changes
        $beforeData = [
            'name' => $user->name,
            'email' => $user->email,
            'contact_no' => $user->contact_no ?? null,
            'address' => $user->address ?? null,
            'profile_image' => $user->profile_image ?? null
        ];
        
        $validated = $request->validated();
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profileImage = $user->profile_image ?? null;
            
            // Delete old image if exists
            if ($profileImage) {
                try {
                    Storage::disk('public')->delete($profileImage);
                } catch (\Exception $e) {
                    Log::error('Failed to delete old profile image: ' . $e->getMessage());
                }
            }
            
            // Store new image
            try {
                $imagePath = $request->file('profile_image')->store('profile-images', 'public');
                $validated['profile_image'] = $imagePath;
            } catch (\Exception $e) {
                Log::error('Failed to store profile image: ' . $e->getMessage());
            }
        }
        
        // Update user with validated data
        foreach ($validated as $key => $value) {
            $user->{$key} = $value;
        }

        // Check if email was changed
        if ($user->email !== $beforeData['email']) {
            $user->email_verified_at = null;
        }

        // Save the user
        $user->save();
        
        // Log the profile update to audit logs
        $afterData = [
            'name' => $user->name,
            'email' => $user->email,
            'contact_no' => $user->contact_no ?? null,
            'address' => $user->address ?? null,
            'profile_image' => $user->profile_image ?? null
        ];
        
        $changedFields = array_keys(array_diff_assoc($afterData, $beforeData));
        
        if (!empty($changedFields)) {
            $details = "User '{$user->name}' updated their profile. Changed fields: " . implode(', ', $changedFields);
            try {
                \App\Helpers\AuditLogger::log('profile_update', 'user', $userId, $beforeData, $afterData, $details);
            } catch (\Exception $e) {
                Log::error('Failed to log profile update: ' . $e->getMessage());
            }
        }

        return Redirect::route('profile.edit')->with('success', 'Your profile has been updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();
        $userId = $user->id;
        
        try {
            // Log the action first in case deletion fails
            AuditLogger::log('user_deleted', 'User deleted their account', $userId);
            
            // Use DB facade for deletion as a fallback
            DB::table('users')->where('id', $userId)->delete();
            // If using soft deletes:
            // \DB::table('users')->where('id', $userId)->update(['deleted_at' => now()]);

            Auth::logout();
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return Redirect::to('/');
        } catch (\Exception $e) {
            Log::error('Failed to delete user account: ' . $e->getMessage());
            return Redirect::back()->with('status', 'error')->with('message', 'Failed to delete account. Please try again later.');
        }
    }
}
