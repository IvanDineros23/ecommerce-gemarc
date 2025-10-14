@extends('layouts.admin')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">User Management</h1>
        <button id="add-user-btn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Add User</button>
    </div>
    {{-- Filters --}}
    <form id="user-search-form" class="flex items-center gap-4 mb-4" onsubmit="return false;">
        <input type="text" id="user-search" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="border px-3 py-2 rounded w-64">
        <select id="user-sort" name="sort" class="border px-3 py-2 rounded">
            <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>ID Descending</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>ID Ascending</option>
        </select>
        <button id="user-filter-btn" type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Filter</button>
    </form>
    {{-- Table --}}
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
                        <button type="button" class="border border-red-600 text-red-600 px-3 py-1 rounded hover:bg-red-50 transition delete-user-btn" data-user-id="{{ $user->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Add User Modal --}}
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
        </div>
    </div>
    <!-- Toasts (global, outside modal) -->
    <div id="add-user-toast" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50 hidden">User added successfully!</div>
    <div id="delete-user-toast" class="fixed top-6 right-6 bg-red-600 text-white px-6 py-3 rounded shadow-lg z-50 hidden">User deleted successfully!</div>
    @if(session('success'))
        <div id="toast-success" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50 animate-fade-in">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => document.getElementById('toast-success').style.display = 'none', 1500);
        </script>
    @endif
</div>
<script>
(function () {
    // Helpers
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

    // Elements
    const addBtn     = document.getElementById('add-user-btn');
    const modal      = document.getElementById('add-user-modal');
    const cancelBtn  = document.getElementById('cancel-add-user');
    const form       = document.getElementById('add-user-form');
    const loading    = document.getElementById('add-user-loading');
    const toastAdd   = document.getElementById('add-user-toast');
    const toastDel   = document.getElementById('delete-user-toast');

    const searchIn   = document.getElementById('user-search');
    const sortSel    = document.getElementById('user-sort');
    const filterBtn  = document.getElementById('user-filter-btn');
    const tbody      = document.getElementById('user-table-body');

    // Open/close modal
    addBtn.onclick    = () => modal.classList.remove('hidden');
    cancelBtn.onclick = () => modal.classList.add('hidden');

    // Toggle password visibility
    (function () {
        const input = document.getElementById('add-user-password');
        const btn   = document.getElementById('toggle-add-user-password');
        const icon  = document.getElementById('add-user-eye-icon');
        let visible = false;
        btn.addEventListener('click', () => {
            visible = !visible;
            input.type = visible ? 'text' : 'password';
            icon.innerHTML = visible
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.978 9.978 0 012.042-3.362m1.528-1.68A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.978 9.978 0 01-4.422 5.568M15 12a3 3 0 11-6 0 3 3 0 016 0z" />'
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268-2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
        });
    })();

    // Loader toggle + disable inputs
    function setSubmitting(isSubmitting) {
        loading.classList.toggle('hidden', !isSubmitting);
        form.querySelectorAll('input, select, button').forEach(el => el.disabled = isSubmitting);
    }

    // Add user (AJAX)
    form.onsubmit = async function (e) {
        e.preventDefault();

        const payload = {
            name:     form.name.value.trim(),
            email:    form.email.value.trim(),
            role:     form.role.value,
            password: form.password.value
        };

        setSubmitting(true);

        try {
            const res  = await fetch('/admin/user-management/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(payload)
            });

            const text = await res.text();
            let data; try { data = JSON.parse(text); } catch { data = null; }

            if (res.status === 422 && data?.errors) {
                const msg = Object.values(data.errors).flat().join('\n');
                alert('Validation error:\n' + msg);
                return;
            }
            if (res.status === 419) {
                alert('Session expired. Please reload the page and try again.');
                return;
            }
            if (!res.ok) {
                throw new Error((data && (data.message || data.error)) || `Request failed (${res.status})`);
            }

            // Success (controller returns { success: true })
            if (data?.success) {
                modal.classList.add('hidden');
                form.reset();
                await fetchUsers();
                toastAdd.innerText = data.message || 'User added successfully!';
                toastAdd.classList.remove('hidden');
                setTimeout(() => toastAdd.classList.add('hidden'), 1500);
            } else {
                // fallback if response is HTML redirect
                modal.classList.add('hidden');
                form.reset();
                await fetchUsers();
            }
        } catch (err) {
            alert('Error: ' + err.message);
            console.error(err);
        } finally {
            setSubmitting(false);
        }
    };

    // Fetch users for filtering / after add / after delete
    async function fetchUsers() {
        const search = searchIn.value;
        const sort   = sortSel.value;

        const res  = await fetch(`?search=${encodeURIComponent(search)}&sort=${encodeURIComponent(sort)}&ajax=1`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await res.json();

        tbody.innerHTML = '';

        if (!data.length) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-6">No users found.</td></tr>';
            return;
        }

        data.forEach(user => {
            const row = document.createElement('tr');
            row.className = 'border-b hover:bg-gray-50';
            row.innerHTML = `
                <td class="py-2 px-3">${user.id}</td>
                <td class="py-2 px-3">${user.name}</td>
                <td class="py-2 px-3">${user.email}</td>
                <td class="py-2 px-3">${user.role}</td>
                <td class="py-2 px-3">${user.created_at}</td>
                <td class="py-2 px-3 flex gap-2">
                    <a href="/admin/user-management/${user.id}/view"
                       class="border border-blue-600 text-blue-600 px-3 py-1 rounded hover:bg-blue-50 transition">View</a>
                    <a href="/admin/user-management/${user.id}/edit"
                       class="border border-yellow-500 text-yellow-700 px-3 py-1 rounded hover:bg-yellow-50 transition">Edit</a>
                    <button type="button"
                            class="border border-red-600 text-red-600 px-3 py-1 rounded hover:bg-red-50 transition delete-user-btn"
                            data-user-id="${user.id}">Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });

        bindDeleteButtons(); // re-bind after re-render
    }

    // Bind delete buttons (AJAX)
    function bindDeleteButtons() {
        document.querySelectorAll('.delete-user-btn').forEach(btn => {
            btn.onclick = async () => {
                if (!confirm('Delete this user?')) return;
                const id = btn.getAttribute('data-user-id');

                const res  = await fetch(`/admin/user-management/${id}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await res.json().catch(() => ({}));

                if (res.ok && (data.success || data.status === 'success')) {
                    toastDel.innerText = 'User deleted successfully!';
                    toastDel.classList.remove('hidden');
                    setTimeout(() => toastDel.classList.add('hidden'), 1500);
                    fetchUsers();
                } else {
                    alert((data && (data.message || data.error)) || 'Failed to delete user.');
                }
            };
        });
    }

    // Initial binds
    searchIn.addEventListener('input', fetchUsers);
    sortSel.addEventListener('change', fetchUsers);
    filterBtn.addEventListener('click', fetchUsers);
    bindDeleteButtons();
})();
</script>
<style>
.loader { border-top-color: transparent; animation: spin 1s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
</style>
@endsection
