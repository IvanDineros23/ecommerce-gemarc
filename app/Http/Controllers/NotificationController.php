<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    // Clear notifications for the current user (employee)
    public function clear(Request $request)
    {
        $user = Auth::user();
        // You may use cache, session, or DB for notifications. Here, we assume cache key per user.
        Cache::forget('employee_notifications_' . $user->id);
        return response()->json(['success' => true]);
    }
}
