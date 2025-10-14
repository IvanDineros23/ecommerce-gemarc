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
@endsection
