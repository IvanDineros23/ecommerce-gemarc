@extends('layouts.admin')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-bold mb-6">Audit Trail</h1>
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
    <div class="mt-4" id="audit-pagination"></div>
    <script>
    const tbody = document.getElementById('audit-tbody');
    const search = document.getElementById('audit-search');
    const action = document.getElementById('audit-action');
    let timer;
    function fetchAuditLogs(page = 1) {
        const params = new URLSearchParams();
        if (search.value) params.append('search', search.value);
        if (action.value) params.append('action', action.value);
        params.append('page', page);
        fetch('/admin/audit/filter?' + params.toString())
            .then(r => r.json())
            .then(data => {
                tbody.innerHTML = '';
                if (!data.logs.length) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-6">No audit logs found.</td></tr>';
                } else {
                    data.logs.forEach(log => {
                        tbody.innerHTML += `<tr class=\"border-b hover:bg-gray-50\">
                            <td class=\"py-2 px-3\">${log.created_at}</td>
                            <td class=\"py-2 px-3\">${log.user} <br><span class='text-xs text-gray-500'>ID: ${log.user_id ?? ''}</span></td>
                            <td class=\"py-2 px-3\">${log.role}</td>
                            <td class=\"py-2 px-3\">${log.action}</td>
                            <td class=\"py-2 px-3\">${log.details ?? 'No details'}</td>
                        </tr>`;
                    });
                }
                // Pagination
                let pag = '';
                if (data.last_page > 1) {
                    pag += '<div class="flex gap-2 justify-center mt-4">';
                    for (let i = 1; i <= data.last_page; i++) {
                        pag += `<button class="px-3 py-1 rounded ${i === data.current_page ? 'bg-green-700 text-white' : 'bg-gray-200'}" onclick="fetchAuditLogs(${i})">${i}</button>`;
                    }
                    pag += '</div>';
                }
                document.getElementById('audit-pagination').innerHTML = pag;
            });
    }
    search.addEventListener('input', function() {
        clearTimeout(timer);
        timer = setTimeout(fetchAuditLogs, 300);
    });
    action.addEventListener('change', fetchAuditLogs);
    document.getElementById('audit-pagination').innerHTML = '';
    fetchAuditLogs();
    </script>
</div>
@endsection
