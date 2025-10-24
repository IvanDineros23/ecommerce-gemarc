<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    // Real-time notification and chat badge feed
    public function feed(Request $request)
    {
        $user = Auth::user();
        $notifs = \App\Helpers\EmployeeNotification::all($user->id);
        $lastSeen = Cache::get('chat_last_seen_' . $user->id, now()->subYear());
        $chatUnread = \DB::table('chat_messages')
            ->where('receiver_id', $user->id)
            ->where('created_at', '>', $lastSeen)
            ->count();
        $sorted = collect($notifs)->sortByDesc(function ($n) {
            return \Carbon\Carbon::parse($n['created_at'] ?? now());
        })->values()->take(20)->all();
        return response()->json([
            'success' => true,
            'notifications' => $sorted,
            'notif_count'   => count($notifs),
            'chat_unread'   => $chatUnread,
        ]);
    }

    // Mark all chat messages as seen for badge clearing
    public function markChatSeen(Request $request)
    {
        $user = Auth::user();
        Cache::put('chat_last_seen_' . $user->id, now(), now()->addDays(7));
        return response()->json(['success' => true]);
    }
    // Fetch notifications for real-time updates
    public function fetch(Request $request)
    {
        $user = auth()->user();
        $notifs = \App\Helpers\EmployeeNotification::all(); // Optionally filter by user
        return response()->json(['notifications' => $notifs]);
    }

    // Example: Add notification and broadcast event
    public function add(Request $request)
    {
        $notif = [
            'type' => $request->input('type', 'chat'),
            'data' => $request->input('data', []),
            'created_at' => now()->toDateTimeString(),
        ];
        // Save notification logic here (e.g., DB, cache, etc.)
        // ...existing code...
        event(new \App\Events\EmployeeNotificationEvent($notif));
        return response()->json(['success' => true, 'notification' => $notif]);
    }
    // Clear notifications for the current user (employee)
    public function clear(Request $request)
    {
        $user = Auth::user();
        // You may use cache, session, or DB for notifications. Here, we assume cache key per user.
    \App\Helpers\EmployeeNotification::clear($user->id);
        return response()->json(['success' => true]);
    }
}
