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
        Cache::forget('employee_notifications_' . $user->id);
        return response()->json(['success' => true]);
    }

    // Fetch notification and chat unread counts for navbar badge
    public function fetch(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'notif_count' => 0,
                'chat_unread' => 0,
            ]);
        }

        if ($user->isEmployee()) {
            // Employee notification count
            $notifs = \App\Helpers\EmployeeNotification::all($user->id);
            $notif_count = is_array($notifs) ? count($notifs) : 0;
            // Chat unread count (messages sent to employee, not read)
            $chat_unread = \App\Models\ChatMessage::where('receiver_id', $user->id)
                ->whereNull('read_at')
                ->count();
        } else {
            // User notification count (implement as needed, here just example)
            $notif_count = \App\Models\Order::where('user_id', $user->id)
                ->where('status', '!=', 'delivered')
                ->count();
            // Chat unread count (messages sent to user, not read)
            $chat_unread = \App\Models\ChatMessage::where('receiver_id', $user->id)
                ->whereNull('read_at')
                ->count();
        }

        return response()->json([
            'success' => true,
            'notif_count' => $notif_count,
            'chat_unread' => $chat_unread,
        ]);
    }
}
