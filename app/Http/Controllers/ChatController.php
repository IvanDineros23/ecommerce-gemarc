<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /** Only these departments are allowed in the dropdown */
    private const DEPARTMENTS = [
        'it'          => 'IT',
        'marketing'   => 'Marketing',
        // 'accounting' removed
        // 'technical' removed
        // 'purchasing' removed
    ];

    public function users(Request $request)
    {
        // Pre-seed fixed groups so the dropdown is stable
        $groups = [];
        foreach (self::DEPARTMENTS as $key => $label) {
            $groups[$key] = ['label' => $label, 'employees' => []];
        }

        $allowed = array_keys(self::DEPARTMENTS);

        $currentUser = Auth::user();

        // If employee, show only users who have sent a message to them
        if ($currentUser->role === 'employee') {
            $senderIds = ChatMessage::where('receiver_id', $currentUser->id)
                ->distinct()->pluck('sender_id')->toArray();

            $employees = User::query()
                ->whereIn('id', $senderIds)
                ->where(function ($q) use ($allowed) {
                    $q->whereIn('department', $allowed)
                      ->orWhereNull('department')
                      ->orWhere('department', '');
                })
                ->select('id', 'name', 'department', 'role')
                ->orderBy('name')
                ->get();
        } else {
            // For user/admin, show all employees/admins
            $employees = User::query()
                ->whereIn('role', ['employee', 'admin'])
                ->where(function ($q) use ($allowed) {
                    $q->whereIn('department', $allowed)
                      ->orWhereNull('department')
                      ->orWhere('department', '');
                })
                ->where('id', '<>', $currentUser->id)
                ->select('id', 'name', 'department', 'role')
                ->orderBy('name')
                ->get();
        }

        // For employee, return a flat array of users who messaged them
        if ($currentUser->role === 'employee') {
            $users = [];
            foreach ($employees as $emp) {
                $unread = ChatMessage::where('sender_id', $emp->id)
                    ->where('receiver_id', $currentUser->id)
                    ->whereNull('read_at')
                    ->count();
                $users[] = [
                    'id'           => $emp->id,
                    'name'         => $emp->name,
                    'unread_count' => $unread,
                ];
            }
            return response()->json($users);
        } else {
            foreach ($employees as $emp) {
                $deptKey = strtolower($emp->department ?: ($emp->role === 'admin' ? 'it' : 'unknown'));
                if (!array_key_exists($deptKey, self::DEPARTMENTS)) {
                    if (!array_key_exists('unknown', $groups)) {
                        $groups['unknown'] = ['label' => 'Unknown', 'employees' => []];
                    }
                }
                $groupKey = array_key_exists($deptKey, $groups) ? $deptKey : 'unknown';
                $unread = ChatMessage::where('sender_id', $emp->id)
                    ->where('receiver_id', $currentUser->id)
                    ->whereNull('read_at')
                    ->count();
                $groups[$groupKey]['employees'][] = [
                    'id'           => $emp->id,
                    'name'         => $emp->name,
                    'unread_count' => $unread,
                ];
            }
            return response()->json($groups);
        }
    }

    public function fetch(Request $request)
    {
        $withUserId = (int) $request->query('with_user_id');

        $msgs = ChatMessage::where(function ($q) use ($withUserId) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $withUserId);
            })
            ->orWhere(function ($q) use ($withUserId) {
                $q->where('sender_id', $withUserId)
                  ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at')
            ->get();

        ChatMessage::where('sender_id', $withUserId)
            ->where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json($msgs);
    }

    public function send(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|integer|exists:users,id',
            'message'    => 'required|string|max:5000',
        ]);

        $msg = ChatMessage::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => (int) $request->input('to_user_id'),
            'message'     => $request->input('message'),
        ]);

        return response()->json(['ok' => true, 'id' => $msg->id]);
    }

    public function clear(Request $request)
    {
        $request->validate(['to_user_id' => 'required|integer|exists:users,id']);

        ChatMessage::where(function ($q) use ($request) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $request->to_user_id);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('sender_id', $request->to_user_id)
                  ->where('receiver_id', Auth::id());
            })
            ->delete();

        return response()->json(['ok' => true]);
    }
}
