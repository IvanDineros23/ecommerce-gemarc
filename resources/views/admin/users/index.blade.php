@extends('layouts.admin')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">User Management</h1>
        <button id="add-user-btn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add User</button>
    </div>
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
                            <button type="button" class="border border-red-600 text-red-600 px-3 py-1 rounded hover:bg-red-50 transition delete-user-btn" data-user-id="{{ $user->id }}">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add User Modal -->
    <div id="add-user-modal" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded shadow-lg p-8 w-full max-w-md relative">
            <div id="add-user-loading" class="absolute inset-0 bg-white bg-opacity-70 flex items-center justify-center z-10 hidden">
                <div class="loader border-4 border-green-600 border-t-transparent rounded-full w-8 h-8 animate-spin"></div>
            </div>
            <h2 class="text-xl font-bold mb-4">Add New User</h2>
            <form id="add-user-form">
                <div class="mb-3">
                    <label class="block mb-1 font-semibold">Name</label>
                    <input type="text" name="name" class="border px-3 py-2 rounded w-full" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-semibold">Email</label>
                    <input type="email" name="email" class="border px-3 py-2 rounded w-full" required>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-semibold">Role</label>
                    <select name="role" class="border px-3 py-2 rounded w-full" required>
                        <option value="user">User</option>
                        <option value="employee">Employee</option>
                        <option value="admin">Admin</option>
                        <option value="accounting">Accounting</option>
                        <option value="purchasing">Purchasing</option>
                        <option value="marketing">Marketing</option>
                        <option value="technical">Technical</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 font-semibold">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="add-user-password" class="border px-3 py-2 rounded w-full pr-10" required>
                        <span id="toggle-add-user-password" class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500">
                            <svg id="add-user-eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="flex gap-2 justify-end">
                    <button type="button" id="cancel-add-user" class="px-4 py-2 rounded border">Cancel</button>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add</button>
                </div>
            </form>
            <div id="add-user-toast" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50 hidden">User added successfully!</div>
        </div>
    </div>

    @if(session('success'))
    <div id="toast-success" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade-in">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('toast-success').style.display = 'none';
        }, 1500);
    </script>
    @endif

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
    document.getElementById('add-user-btn').onclick = function() {
        document.getElementById('add-user-modal').classList.remove('hidden');
    };
    document.getElementById('cancel-add-user').onclick = function() {
        document.getElementById('add-user-modal').classList.add('hidden');
    };
    document.getElementById('add-user-form').onsubmit = function(e) {
        e.preventDefault();
        const form = e.target;
        const data = {
            name: form.name.value,
            email: form.email.value,
            role: form.role.value,
            password: form.password.value
        };
        document.getElementById('add-user-loading').classList.remove('hidden');
        fetch('/admin/user-management/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(async r => {
            let text = await r.text();
            try {
                return JSON.parse(text);
            } catch (err) {
                console.error('Response not JSON:', text);
                throw new Error('Server error: ' + text);
            }
        })
        .then(res => {
            document.getElementById('add-user-loading').classList.add('hidden');
            if (res.success) {
                document.getElementById('add-user-modal').classList.add('hidden');
                fetchUsers();
                var toast = document.getElementById('add-user-toast');
                toast.classList.remove('hidden');
                setTimeout(function() { toast.classList.add('hidden'); }, 1500);
            } else {
                alert(res.message || 'Failed to add user.');
            }
        })
        .catch(err => {
            document.getElementById('add-user-loading').classList.add('hidden');
            alert('Error: ' + err.message);
        });
    };
    // Delete user AJAX + toast
    setTimeout(function() {
        document.querySelectorAll('.delete-user-btn').forEach(function(btn) {
            btn.onclick = function() {
                if (!confirm('Delete this user?')) return;
                var userId = btn.getAttribute('data-user-id');
                fetch(`/admin/user-management/${userId}/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                }).then(r => r.json()).then(res => {
                    if (res.success || res.status === 'success') {
                        var toast = document.createElement('div');
                        toast.className = 'fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50';
                        toast.innerText = 'User deleted successfully!';
                        document.body.appendChild(toast);
                        setTimeout(function() { toast.remove(); }, 1500);
                        setTimeout(function() { window.location.href = '/admin/user-management'; }, 800);
                    } else {
                        alert(res.message || 'Failed to delete user.');
                    }
                });
            };
        });
    }, 500);
    document.addEventListener('DOMContentLoaded', function() {
        var addUserPasswordInput = document.getElementById('add-user-password');
        var addUserToggle = document.getElementById('toggle-add-user-password');
        var addUserEyeIcon = document.getElementById('add-user-eye-icon');
        var addUserVisible = false;
        addUserToggle.addEventListener('click', function() {
            addUserVisible = !addUserVisible;
            addUserPasswordInput.type = addUserVisible ? 'text' : 'password';
            addUserEyeIcon.innerHTML = addUserVisible
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.978 9.978 0 012.042-3.362m1.528-1.68A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.978 9.978 0 01-4.422 5.568M15 12a3 3 0 11-6 0 3 3 0 016 0z" />' // eye-off
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268-2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />'; // eye
        });
    });
    </script>
    <style>
    .loader {
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    </style>
</div>
@endsection
