@extends('layouts.admin')

@section('content')
<div class="p-8 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">View User</h1>
    <div class="bg-white rounded shadow p-6">
        <div class="mb-4"><strong>ID:</strong> {{ $user->id }}</div>
        <div class="mb-4"><strong>Name:</strong> {{ $user->name }}</div>
        <div class="mb-4"><strong>Email:</strong> {{ $user->email }}</div>
        <div class="mb-4"><strong>Role:</strong> {{ $user->role }}</div>
        <div class="mb-4"><strong>Created At:</strong> {{ $user->created_at }}</div>
    <a href="{{ route('admin.user_management.edit', $user->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded">Edit</a>
    <a href="{{ route('admin.user_management') }}" class="ml-2 text-blue-600 hover:underline">Back to list</a>
    </div>
</div>
@endsection
