@extends('layouts.admin')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-bold mb-6">User Management</h1>
    <form id="user-search-form" class="flex items-center gap-4 mb-4" onsubmit="return false;">
        <input type="text" id="user-search" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="border px-3 py-2 rounded w-64">
        <select id="user-sort" name="sort" class="border px-3 py-2 rounded">
            <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>ID Descending</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>ID Ascending</option>
        </select>
        <button id="user-filter-btn" type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Filter</button>
    </form>
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-3">ID</th>
                    <th class="py-2 px-3">Name</th>
                    <th class="py-2 px-3">Email</th>
                    <th class="py-2 px-3">Role</th>
                    <th class="py-2 px-3">Created At</th>
                    <th class="py-2 px-3">Actions</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $user->id }}</td>
                    <td class="py-2 px-3">{{ $user->name }}</td>
                    <td class="py-2 px-3">{{ $user->email }}</td>
                    <td class="py-2 px-3">{{ $user->role }}</td>
                    <td class="py-2 px-3">{{ $user->created_at }}</td>
                    <td class="py-2 px-3 flex gap-2">
                        <a href="{{ route('admin.user_management.view', $user->id) }}" class="border border-blue-600 text-blue-600 px-3 py-1 rounded hover:bg-blue-50 transition">View</a>
                        <a href="{{ route('admin.user_management.edit', $user->id) }}" class="border border-yellow-500 text-yellow-700 px-3 py-1 rounded hover:bg-yellow-50 transition">Edit</a>
                        <form action="{{ route('admin.user_management.delete', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border border-red-600 text-red-600 px-3 py-1 rounded hover:bg-red-50 transition" onclick="return confirm('Delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
    function fetchUsers() {
        const search = document.getElementById('user-search').value;
        const sort = document.getElementById('user-sort').value;
        fetch(`?search=${encodeURIComponent(search)}&sort=${encodeURIComponent(sort)}&ajax=1`)
            .then(r => r.json())
            .then(data => {
                const tbody = document.getElementById('user-table-body');
                tbody.innerHTML = '';
                if (!data.length) {
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-6">No users found.</td></tr>';
                } else {
                    data.forEach(user => {
                        tbody.innerHTML += `<tr class=\"border-b hover:bg-gray-50\">\
                            <td class=\"py-2 px-3\">${user.id}</td>\
                            <td class=\"py-2 px-3\">${user.name}</td>\
                            <td class=\"py-2 px-3\">${user.email}</td>\
                            <td class=\"py-2 px-3\">${user.role}</td>\
                            <td class=\"py-2 px-3\">${user.created_at}</td>\
                            <td class=\"py-2 px-3 flex gap-2\">\
                                <a href='/admin/user-management/${user.id}/view' class='border border-blue-600 text-blue-600 px-3 py-1 rounded hover:bg-blue-50 transition'>View</a>\
                                <a href='/admin/user-management/${user.id}/edit' class='border border-yellow-500 text-yellow-700 px-3 py-1 rounded hover:bg-yellow-50 transition'>Edit</a>\
                                <form action='/admin/user-management/${user.id}/delete' method='POST' style='display:inline'>\
                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>\
                                    <input type='hidden' name='_method' value='DELETE'>\
                                    <button type='submit' class='border border-red-600 text-red-600 px-3 py-1 rounded hover:bg-red-50 transition' onclick='return confirm("Delete this user?")'>Delete</button>\
                                </form>\
                            </td>\
                        </tr>`;
                    });
                }
            });
    }
    document.getElementById('user-search').addEventListener('input', function() {
        fetchUsers();
    });
    document.getElementById('user-sort').addEventListener('change', function() {
        fetchUsers();
    });
    document.getElementById('user-filter-btn').addEventListener('click', function() {
        fetchUsers();
    });
    </script>
</div>
@endsection
