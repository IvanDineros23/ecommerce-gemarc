<?php

namespace App\Http\Controllers;

use App\Helpers\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function fetch(Request $request)
    {
        $user = Auth::user();
        $withUserId = $request->input('with_user_id');

        // If not an AJAX request, show 404
        if (!$request->ajax() && !$request->wantsJson()) {
            abort(404);
        }


        // If employee, fetch messages with selected user and department context
        if ($user->isEmployee() && $withUserId) {
            $context = $user->department ?? 'undefined';
            DB::table('chat_messages')
                ->where('sender_id', $withUserId)
                ->where('receiver_id', $user->id)
                ->where('context', $context)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            $messages = DB::table('chat_messages')
                ->where(function($q) use ($user, $withUserId) {
                    $q->where(function($q2) use ($user, $withUserId) {
                        $q2->where('sender_id', $user->id)->where('receiver_id', $withUserId);
                    })->orWhere(function($q2) use ($user, $withUserId) {
                        $q2->where('sender_id', $withUserId)->where('receiver_id', $user->id);
                    });
                })
                ->where('context', $context)
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();
            return response()->json($messages->reverse()->values());
        }

        // If user, fetch messages with selected employee and department context
        if ($user->isUser() && $withUserId) {
            $context = $request->input('context');
            $messages = DB::table('chat_messages')
                ->where(function($q) use ($user, $withUserId) {
                    $q->where(function($q2) use ($user, $withUserId) {
                        $q2->where('sender_id', $user->id)->where('receiver_id', $withUserId);
                    })->orWhere(function($q2) use ($user, $withUserId) {
                        $q2->where('sender_id', $withUserId)->where('receiver_id', $user->id);
                    });
                })
                ->where('context', $context)
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();
            return response()->json($messages->reverse()->values());
        }

        // If admin, fetch all messages
        if ($user->isAdmin()) {
            $messages = DB::table('chat_messages')
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get();
            return response()->json($messages->reverse()->values());
        }
        return response()->json([]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'to_user_id' => 'required|integer|exists:users,id',
        ]);
        $senderId = Auth::id();
        $receiverId = $request->to_user_id;
        $user = Auth::user();
        // Prevent employee from sending message to self
        if ($user->isEmployee() && $senderId == $receiverId) {
            return response()->json(['success' => false, 'error' => 'Cannot send message to self'], 403);
        }
        $context = $request->input('context');
        $msg = DB::table('chat_messages')->insertGetId([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'context' => $context,
            'created_at' => now(),
        ]);
        // Log to audit trail
        $sender = \App\Models\User::find($senderId);
        $receiver = \App\Models\User::find($receiverId);
        $details = "Chat message from '" . ($sender ? $sender->name : $senderId) . "' (ID: $senderId, Role: " . ($sender ? $sender->role : '-') . ") to '" . ($receiver ? $receiver->name : $receiverId) . "' (ID: $receiverId, Role: " . ($receiver ? $receiver->role : '-') . "): '" . $request->message . "'";
        AuditLogger::log('chat_message', 'chat', $msg, null, null, $details);

        // Push employee notification for new chat message (only if user is sender)
        if ($sender && $sender->isUser()) {
            \App\Helpers\EmployeeNotification::push('chat', [
                'user' => $sender->name,
                'user_id' => $sender->id,
                'receiver_id' => $receiverId,
                'message' => $request->message,
                'created_at' => now(),
            ]);
        }
        return response()->json(['success' => true]);
    }

    // For employee: get list of users with active chats
    public function userList()
    {
        $user = Auth::user();
        // If employee, show users who chatted with them
        if ($user->isEmployee()) {
            $employeeId = $user->id;
            $users = DB::table('chat_messages')
                ->select('users.id', 'users.name', 'users.email',
                    DB::raw('MAX(chat_messages.created_at) as last_message_at'),
                    DB::raw('SUM(CASE WHEN chat_messages.receiver_id = '.$employeeId.' AND chat_messages.sender_id = users.id AND chat_messages.read_at IS NULL THEN 1 ELSE 0 END) as unread_count')
                )
                ->join('users', 'users.id', '=', 'chat_messages.sender_id')
                ->where(function($q) use ($employeeId) {
                    $q->where('chat_messages.receiver_id', $employeeId)
                      ->orWhere('chat_messages.sender_id', $employeeId);
                })
                ->where('users.id', '!=', $employeeId)
                ->groupBy('users.id', 'users.name', 'users.email')
                ->orderByDesc('last_message_at')
                ->get();
            return response()->json($users);
        }
        // If user, show employees grouped by department
        if ($user->isUser()) {
            $departments = [
                'marketing' => 'Marketing',
                'purchasing' => 'Purchasing',
                'accounting' => 'Accounting',
                'technical' => 'Technical',
            ];
            $employees = DB::table('users')
                ->select('id', 'name', 'email', 'department', 'role')
                ->whereIn('role', ['employee', 'admin'])
                ->get();
            $grouped = [];
            foreach ($departments as $key => $label) {
                $grouped[$key] = [
                    'label' => $label,
                    'employees' => []
                ];
            }
            $grouped['undefined'] = [
                'label' => 'IT',
                'employees' => []
            ];
            foreach ($employees as $emp) {
                // Place admin in IT (undefined) department
                $dept = ($emp->role === 'admin') ? 'undefined' : ($emp->department ?? 'undefined');
                if (!isset($grouped[$dept])) {
                    $dept = 'undefined';
                }
                $lastMsg = DB::table('chat_messages')
                    ->where(function($q) use ($user, $emp) {
                        $q->where('sender_id', $user->id)->where('receiver_id', $emp->id)
                          ->orWhere('sender_id', $emp->id)->where('receiver_id', $user->id);
                    })
                    ->orderByDesc('created_at')
                    ->first();
                $unread = DB::table('chat_messages')
                    ->where('sender_id', $emp->id)
                    ->where('receiver_id', $user->id)
                    ->whereNull('read_at')
                    ->count();
                $grouped[$dept]['employees'][] = [
                    'id' => $emp->id,
                    'name' => $emp->name . ($emp->role === 'admin' ? ' (Admin)' : ''),
                    'email' => $emp->email,
                    'last_message_at' => $lastMsg ? $lastMsg->created_at : null,
                    'unread_count' => $unread,
                ];
            }
            return response()->json($grouped);
        }
        // Default: return empty
        return response()->json([]);
    }

    // Clear chat between user and employee
    public function clear(Request $request)
    {
        $user = Auth::user();
        $toUserId = $request->input('to_user_id');
        if (!$toUserId) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
        }
        // Allow both user and employee to clear chat with each other
        DB::table('chat_messages')
            ->where(function($q) use ($user, $toUserId) {
                $q->where(function($q2) use ($user, $toUserId) {
                    $q2->where('sender_id', $user->id)->where('receiver_id', $toUserId);
                })->orWhere(function($q2) use ($user, $toUserId) {
                    $q2->where('sender_id', $toUserId)->where('receiver_id', $user->id);
                });
            })
            ->delete();
        return response()->json(['success' => true]);
    }
}
