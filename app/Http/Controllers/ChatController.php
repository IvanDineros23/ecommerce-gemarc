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
        'accounting'  => 'Accounting',
        'technical'   => 'Technical',
        'purchasing'  => 'Purchasing',
    ];

    public function users(Request $request)
    {
        // Pre-seed fixed groups so the dropdown is stable
        $groups = [];
        foreach (self::DEPARTMENTS as $key => $label) {
            $groups[$key] = ['label' => $label, 'employees' => []];
        }

        $allowed = array_keys(self::DEPARTMENTS);

        // Include both employees AND admins; limit to the 5 depts
        $employees = User::query()
            ->whereIn('role', ['employee', 'admin'])
            ->where(function ($q) use ($allowed) {
                $q->whereIn('department', $allowed)
                  // allow null/empty dept so we can default admins to IT
                  ->orWhereNull('department')
                  ->orWhere('department', '');
            })
            ->where('id', '<>', Auth::id()) // don't list yourself
            ->select('id', 'name', 'department', 'role')
            ->orderBy('name')
            ->get();

        foreach ($employees as $emp) {
            // If an admin has no dept, default to IT
            $deptKey = strtolower($emp->department ?: ($emp->role === 'admin' ? 'it' : ''));

            // Safety: skip anything outside the 5
            if (!array_key_exists($deptKey, self::DEPARTMENTS)) {
                continue;
            }

            $unread = ChatMessage::where('sender_id', $emp->id)
                ->where('receiver_id', Auth::id())
                ->whereNull('read_at')
                ->count();

            $groups[$deptKey]['employees'][] = [
                'id'           => $emp->id,
                'name'         => $emp->name,
                'unread_count' => $unread,
            ];
        }

        return response()->json($groups);
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
