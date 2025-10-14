<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }
    $sort = $request->input('sort', 'desc');
    $query->orderBy('id', $sort === 'asc' ? 'asc' : 'desc');
        $users = $query->get();
        if ($request->ajax() || $request->input('ajax')) {
            return response()->json($users);
        }
        return view('admin.user-management', compact('users'));
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.view', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $before = $user->only(['name', 'email', 'role']);
        $user->update($request->only(['name', 'email', 'role']));
        $after = $user->only(['name', 'email', 'role']);
        $changes = [];
        foreach ($before as $key => $value) {
            if ($after[$key] != $value) {
                $changes[] = "$key: '$value' → '{$after[$key]}'";
            }
        }
        // Handle password reset
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            $changes[] = "password: [FORCED RESET]";
        }
        $changeDetails = $changes ? ('Changes: ' . implode(', ', $changes)) : 'No changes.';

        // Force logout if role changed
        if (isset($before['role']) && $before['role'] !== $after['role']) {
            // Remove all sessions for this user
            \DB::table('sessions')->where('user_id', $user->id)->delete();
        }
        \App\Helpers\AuditLogger::log(
            'edit_user',
            'user',
            $user->id,
            $before,
            $after,
            'Admin edited user: ' . $user->name . ' (ID: ' . $user->id . '). ' . $changeDetails
        );
        return redirect()->route('admin.user_management')->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
    $user = User::findOrFail($id);
    $user->forceDelete();
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('admin.user_management')->with('success', 'User deleted successfully.');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();
        // Audit log for user creation
        \App\Helpers\AuditLogger::log(
            'create_user',
            'user',
            $user->id,
            [],
            $user->only(['name', 'email', 'role']),
            'Admin created user: ' . $user->name . ' (ID: ' . $user->id . ')'
        );
        return response()->json(['success' => true, 'user' => $user, 'message' => 'User created successfully!']);
    }
}
