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
            <input type="text" name="role" value="{{ $user->role }}" class="border px-3 py-2 rounded w-full" required>
        </div>
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Save</button>
    <a href="{{ route('admin.user_management') }}" class="ml-2 text-blue-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
