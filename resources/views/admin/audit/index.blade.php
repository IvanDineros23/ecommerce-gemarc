@extends('layouts.admin')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-bold mb-6">Audit Trail</h1>

    {{-- Filters --}}
    <div class="flex items-center gap-4 mb-4">
        <input type="text" id="audit-search" placeholder="Search logs..." class="border px-3 py-2 rounded w-64">
        <select id="audit-action" class="border px-3 py-2 rounded">
            <option value="">All Actions</option>
            <option value="login">Login</option>
            <option value="logout">Logout</option>
            <option value="chat_message">Chat Message</option>
            <option value="create">Create</option>
            <option value="update">Update</option>
            <option value="delete">Delete</option>
        </select>
    </div>

    {{-- Primary actions --}}
    <div class="flex gap-2 mb-4">
        <a href="{{ route('admin.audit.printAll') }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Print All Logs</a>
        <a href="{{ route('admin.audit.saveAll') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Save All Logs</a>
        <button id="clear-audit-logs-btn" type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">Clear All Logs</button>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm" id="audit-table">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-3">Timestamp</th>
                    <th class="py-2 px-3">User</th>
                    <th class="py-2 px-3">Role</th>
                    <th class="py-2 px-3">Action</th>
                    <th class="py-2 px-3">Details</th>
                </tr>
            </thead>
            <tbody id="audit-tbody">
                @foreach($logs as $log)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-3">{{ $log->created_at }}</td>
                        <td class="py-2 px-3">
                            @if($log->actor)
                                {{ $log->actor->name }} <br>
                                <span class="text-xs text-gray-500">ID: {{ $log->actor->id }}</span>
                            @else
                                <span class="text-xs text-gray-400">N/A</span>
                            @endif
                        </td>
                        <td class="py-2 px-3">{{ $log->actor ? $log->actor->role : 'N/A' }}</td>
                        <td class="py-2 px-3">{{ $log->action }}</td>
                        <td class="py-2 px-3">{{ $log->details ?? 'No details' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Laravel fallback pagination (server-rendered) --}}
    <div class="mt-4">
        {{ $logs->links() }}
    </div>

    {{-- Client pagination container (used when filtering via AJAX) --}}
    <div id="audit-pagination" class="mt-4 flex gap-2 justify-center"></div>

    {{-- Clear Logs Modal --}}
    <div id="clearLogsModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h2 class="text-lg font-bold mb-4">Are you sure you want to clear all audit logs?</h2>
            <div class="flex justify-end gap-2">
                <button id="cancelClearLogs" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                <button id="confirmClearLogs" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Yes, Clear All</button>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    <div id="toastAlert" class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded shadow-lg z-50 hidden">
        Audit logs cleared successfully!
    </div>
</div>

{{-- Page Script --}}
<script>
(function() {
    const tbody   = document.getElementById('audit-tbody');
    const search  = document.getElementById('audit-search');
    const action  = document.getElementById('audit-action');
    const clearBtn= document.getElementById('clear-audit-logs-btn');
    const modal   = document.getElementById('clearLogsModal');
    const confirmBtn = document.getElementById('confirmClearLogs');
    const cancelBtn  = document.getElementById('cancelClearLogs');
    const toast   = document.getElementById('toastAlert');
    const pagWrap = document.getElementById('audit-pagination');
    const CSRF    = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

    let debounceTimer;

    function showToast(msg, ok = true) {
        toast.textContent = msg;
        toast.classList.remove('hidden');
        toast.classList.toggle('bg-green-600', ok);
        toast.classList.toggle('bg-red-600', !ok);
        setTimeout(() => toast.classList.add('hidden'), 2500);
    }

    // --- Clear All Logs ---
    clearBtn?.addEventListener('click', () => modal.classList.remove('hidden'));
    cancelBtn?.addEventListener('click', () => modal.classList.add('hidden'));
    confirmBtn?.addEventListener('click', async () => {
        confirmBtn.disabled = true;
        try {
            const res = await fetch('/admin/audit/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await res.json();
            modal.classList.add('hidden');
            confirmBtn.disabled = false;

            if (data.success) {
                showToast('Audit logs cleared successfully!');
                fetchAuditLogs(1); // refresh table
            } else {
                showToast('Failed to clear audit logs.', false);
            }
        } catch (e) {
            confirmBtn.disabled = false;
            modal.classList.add('hidden');
            showToast('Error clearing audit logs.', false);
        }
    });

    // --- Fetch + render logs (AJAX) ---
    async function fetchAuditLogs(page = 1) {
        const params = new URLSearchParams();
        const q = search.value.trim();
        const a = action.value;

        if (q) params.append('search', q);
        if (a) params.append('action', a);
        params.append('page', page);

        try {
            const res  = await fetch('/admin/audit/filter?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();

            // Table rows
            tbody.innerHTML = '';
            if (!data.logs || !data.logs.length) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-6">No audit logs found.</td></tr>';
            } else {
                data.logs.forEach(log => {
                    const uid = (log.user_id ?? '') ? `<br><span class="text-xs text-gray-500">ID: ${log.user_id}</span>` : '';
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-3">${log.created_at}</td>
                            <td class="py-2 px-3">${log.user || 'N/A'} ${uid}</td>
                            <td class="py-2 px-3">${log.role || 'N/A'}</td>
                            <td class="py-2 px-3">${log.action || ''}</td>
                            <td class="py-2 px-3">${log.details ?? 'No details'}</td>
                        </tr>
                    `);
                });
            }

            // Client pagination buttons
            pagWrap.innerHTML = '';
            if (data.last_page && data.last_page > 1) {
                for (let i = 1; i <= data.last_page; i++) {
                    const btn = document.createElement('button');
                    btn.className = `px-3 py-1 rounded ${i === data.current_page ? 'bg-green-700 text-white' : 'bg-gray-200'}`;
                    btn.textContent = i;
                    btn.addEventListener('click', () => fetchAuditLogs(i));
                    pagWrap.appendChild(btn);
                }
            }
        } catch (e) {
            console.error(e);
            showToast('Failed to load logs.', false);
        }
    }

    // Debounced search
    search.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => fetchAuditLogs(1), 300);
    });

    // Action filter
    action.addEventListener('change', () => fetchAuditLogs(1));

    // Initial load (keeps server-rendered page, but replaces with filtered when user types/changes)
    // If you want to always use AJAX, uncomment:
    // fetchAuditLogs(1);
})();
</script>
@endsection
