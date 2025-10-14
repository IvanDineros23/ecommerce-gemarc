@extends('layouts.admin')

@section('content')
<div class="p-8 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>
    <form action="{{ route('admin.user_management.edit', $user->id) }}" method="POST" class="bg-white rounded shadow p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="border px-3 py-2 rounded w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="border px-3 py-2 rounded w-full" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Role</label>
            <select name="role" class="border px-3 py-2 rounded w-full" required>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="accounting" {{ $user->role == 'accounting' ? 'selected' : '' }}>Accounting</option>
                <option value="purchasing" {{ $user->role == 'purchasing' ? 'selected' : '' }}>Purchasing</option>
                <option value="marketing" {{ $user->role == 'marketing' ? 'selected' : '' }}>Marketing</option>
                <option value="technical" {{ $user->role == 'technical' ? 'selected' : '' }}>Technical</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Force Password Reset</label>
            <div class="relative">
                <input type="password" name="password" id="force-password" class="border px-3 py-2 rounded w-full pr-10" placeholder="Enter new password to force reset">
                <span id="toggle-password" class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </span>
            </div>
            <small class="text-gray-500">Leave blank to keep current password.</small>
        </div>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Save</button>
    <a href="{{ route('admin.user_management') }}" class="ml-2 text-blue-600 hover:underline">Cancel</a>
    </form>
</div>

@if(session('success'))
    <div id="toast-success" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade-in">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('toast-success').style.display = 'none';
            window.location.href = '{{ route('admin.user_management') }}';
        }, 1500);
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var passwordInput = document.getElementById('force-password');
        var toggle = document.getElementById('toggle-password');
        var eyeIcon = document.getElementById('eye-icon');
        var visible = false;
        toggle.addEventListener('click', function() {
            visible = !visible;
            passwordInput.type = visible ? 'text' : 'password';
            eyeIcon.innerHTML = visible
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.978 9.978 0 012.042-3.362m1.528-1.68A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.978 9.978 0 01-4.422 5.568M15 12a3 3 0 11-6 0 3 3 0 016 0z" />' // eye-off
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />'; // eye
        });
    });
</script>
@endsection
