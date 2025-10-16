@extends('admin.layouts.app')

@section('content')
<div class="flex flex-col gap-6">
    <h1 class="text-2xl font-bold mb-4">Chats</h1>
    <div class="bg-white rounded shadow p-6">
        <div class="flex gap-8">
            <!-- User List -->
            <div class="w-80 border-r pr-6">
                <div class="font-semibold mb-2">Users/Employees</div>
                <ul id="admin-chat-user-list" class="space-y-2"></ul>
            </div>
            <!-- Chat Box -->
            <div class="flex-1 min-w-[400px]">
                <div class="flex items-center gap-4 mb-2">
                    <div id="admin-chat-header" class="font-semibold text-green-700 text-lg flex-1"></div>
                    <select id="admin-chat-context" class="border rounded px-2 py-1">
                        <option value="marketing">Marketing</option>
                        <option value="purchasing">Purchasing</option>
                        <option value="accounting">Accounting</option>
                        <option value="technical">Technical</option>
                        <option value="it">IT</option>
                    </select>
                </div>
                <div id="admin-chat-messages" class="h-80 overflow-y-auto bg-gray-50 rounded p-3 mb-3 text-base border border-gray-200"></div>
                <form id="admin-chat-form" class="flex gap-2" style="display:none;">
                    <input type="text" id="admin-chat-input" class="border border-green-300 rounded px-3 py-2 w-full focus:outline-none text-base" placeholder="Type your message...">
                    <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800 font-semibold">Send</button>
                </form>
                <div id="admin-chat-status" class="text-xs text-gray-400 mt-1"></div>
            </div>
        </div>
    </div>
</div>
<script>
let selectedUserId = null;
let selectedUserName = '';
function fetchAdminUserList() {
    fetch("/admin/chat/users", { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(users => {
            let html = users.map(u => `
                <li>
                    <button onclick='selectAdminUser(${u.id}, "${u.name}")' class='w-full text-left px-2 py-1 rounded hover:bg-green-100 ${selectedUserId==u.id?'bg-green-200':''}'>
                        ${u.name}
                    </button>
                </li>
            `).join('');
            document.getElementById('admin-chat-user-list').innerHTML = html;
        });
}
function fetchAdminChat() {
    if (!selectedUserId) return;
    const context = document.getElementById('admin-chat-context').value;
    fetch(`/admin/chat/fetch?with_user_id=${selectedUserId}&context=${context}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(msgs => {
            let html = msgs.map(m => {
                const isAdmin = m.sender_id == {{ auth()->id() }};
                const alignClass = isAdmin ? 'justify-end' : 'justify-start';
                const bubbleClass = isAdmin ? 'bg-green-700 text-white' : 'bg-gray-200 text-gray-900';
                const name = isAdmin ? 'You' : selectedUserName;
                const time = new Date(m.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                return `
                    <div class="flex ${alignClass} mb-2">
                        <div class="chat-bubble ${bubbleClass} px-3 py-2 rounded-3 max-w-[70%]">
                            <div class="font-semibold mb-1">${name}</div>
                            <div>${m.message}</div>
                            <div class="text-right text-xs text-gray-500 mt-1">${time}</div>
                        </div>
                    </div>
                `;
            }).join('');
            document.getElementById('admin-chat-messages').innerHTML = html || '<div class="text-center text-muted mt-5">No messages yet.</div>';
            let box = document.getElementById('admin-chat-messages');
            box.scrollTop = box.scrollHeight;
        });
}
function selectAdminUser(id, name) {
    selectedUserId = id;
    selectedUserName = name;
    document.getElementById('admin-chat-header').innerText = 'Chat with ' + name;
    document.getElementById('admin-chat-form').style.display = '';
    fetchAdminChat();
    fetchAdminUserList();
}
document.getElementById('admin-chat-form').onsubmit = function(e) {
    e.preventDefault();
    let msg = document.getElementById('admin-chat-input').value;
    const context = document.getElementById('admin-chat-context').value;
    if (!msg.trim() || !selectedUserId) return;
    fetch("/admin/chat/send", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: msg, to_user_id: selectedUserId, context })
    }).then(r => r.json()).then(() => {
        document.getElementById('admin-chat-input').value = '';
        fetchAdminChat();
    });
};
document.getElementById('admin-chat-context').onchange = function() {
    fetchAdminChat();
};
fetchAdminUserList();
setInterval(fetchAdminUserList, 5000);
</script>
@endsection
