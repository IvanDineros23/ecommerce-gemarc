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


        // Always use the employee's department as context for both user and employee
        if (($user->isEmployee() || $user->isUser()) && $withUserId) {
            // Find the employee (if current user is employee, use self; if user, use withUserId)
            $employee = $user->isEmployee() ? $user : \App\Models\User::find($withUserId);
            $context = $employee && $employee->department ? $employee->department : 'undefined';

            // Mark messages as read if employee is viewing
            if ($user->isEmployee()) {
                DB::table('chat_messages')
                    ->where('sender_id', $withUserId)
                    ->where('receiver_id', $user->id)
                    ->where('context', $context)
                    ->whereNull('read_at')
                    ->update(['read_at' => now()]);
            }

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
            if ($user->isEmployee() && $senderId === $receiverId) {
            return response()->json(['success' => false, 'error' => 'Cannot send message to self'], 403);
        }
            // Derive context on the server:
            if ($user->isEmployee()) {
                $context = $user->department ?? 'undefined';
            } else {
                $receiver = \App\Models\User::findOrFail($receiverId);
                $context = $receiver->department ?? 'undefined';
            }
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
            $me = $user;
            $employeeId = $me->id;
            $context     = $me->department ?? 'undefined';

            // Threads per OTHER user, scoped by context (department)
            $threads = DB::table('chat_messages')
                ->where('context', $context)
                ->where(function($q) use ($employeeId) {
                    $q->where('sender_id', $employeeId)
                      ->orWhere('receiver_id', $employeeId);
                })
                ->selectRaw('CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END AS user_id', [$employeeId])
                ->selectRaw('MAX(created_at) AS last_message_at')
                // only messages the user sent to the employee WITHIN THIS CONTEXT
                ->selectRaw('SUM(CASE WHEN receiver_id = ? AND sender_id <> ? THEN 1 ELSE 0 END) AS total_incoming', [$employeeId, $employeeId])
                ->selectRaw('SUM(CASE WHEN receiver_id = ? AND sender_id <> ? AND read_at IS NULL THEN 1 ELSE 0 END) AS unread_count', [$employeeId, $employeeId])
                ->groupBy('user_id')
                ->orderByDesc('last_message_at')
                ->get();

            // Only show threads na may talagang ipinadalang message ang user
            $userIds = $threads->where('total_incoming', '>', 0)->pluck('user_id')->all();

            if (empty($userIds)) return response()->json([]);

            $users = DB::table('users')->whereIn('id', $userIds)->get()->keyBy('id');

            $out = $threads->filter(fn($t) => $t->total_incoming > 0)->map(function($t) use ($users) {
                $u = $users[$t->user_id] ?? null;
                return [
                    'id'             => (int) $t->user_id,
                    'name'           => $u ? $u->name : ('User #'.$t->user_id),
                    'email'          => $u->email ?? null,
                    'last_message_at'=> $t->last_message_at,
                    'unread_count'   => (int) $t->unread_count,
                ];
            })->values();

            return response()->json($out);
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
