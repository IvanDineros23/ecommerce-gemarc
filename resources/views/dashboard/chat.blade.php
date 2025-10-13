@extends('layouts.ecommerce')

@section('title', 'Chat with Employee | Gemarc Enterprises Inc.')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <h2 class="text-center text-success fw-bold mb-4">
                <i class="fas fa-comments me-2"></i> Chat with Employee
            </h2>
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex">
                        <!-- User List -->
                        <div class="border-end pe-4" style="min-width:220px;">
                            <div class="fw-semibold mb-2">Users</div>
                            <ul id="user-list" class="list-unstyled mb-0"></ul>
                        </div>
                        <!-- Chat Box -->
                        <div class="flex-grow-1 ps-4">
                            <div id="chat-header" class="fw-semibold mb-2 text-success fs-5"></div>
                            <div id="chat-messages" class="p-3 mb-3" style="height: 400px; overflow-y: auto; background-color: #f8f9fa; border-radius: 8px; border: 1px solid #eee;"></div>
                            <form id="chat-form" class="d-flex gap-2 mb-2" style="display:none;">
                                <input type="text" id="chat-input" class="form-control" placeholder="Type your message..." autocomplete="off">
                                <button type="submit" class="btn btn-success px-4">Send</button>
                            </form>
                            <button id="clear-chat" class="btn btn-warning">Clear Chat</button>
                            <div id="chat-status" class="text-muted small mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
    let selectedUserId = null;
    let selectedUserName = '';

    function fetchUserList() {
        fetch("{{ url('/chat/users') }}", {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(r => r.json())
            .then(users => {
                let html = users.map(u => `
                    <li class='mb-2'>
                        <button onclick='selectUser(${u.id}, "${u.name}")' class='btn btn-outline-success w-100 text-start ${selectedUserId==u.id?'active':''}'>
                            ${u.name}
                            ${u.unread_count > 0 ? `<span class='badge bg-warning ms-2'>${u.unread_count} new</span>` : ''}
                        </button>
                    </li>
                `).join('');
                document.getElementById('user-list').innerHTML = html;
            });
    }
    function fetchChat() {
        if (!selectedUserId) {
            document.getElementById('chat-header').innerText = '';
            document.getElementById('chat-messages').innerHTML = '<div class="text-center text-muted mt-5">Select a user to view messages.</div>';
            document.getElementById('chat-form').style.display = 'none';
            return;
        }
        fetch(`{{ url('/chat/fetch') }}?with_user_id=${selectedUserId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(r => r.json())
            .then(msgs => {
                let html = msgs.map(m => {
                    const isUser = m.sender_id == {{ auth()->id() }};
                    const alignClass = isUser ? 'justify-content-end' : 'justify-content-start';
                    const bubbleClass = isUser ? 'bg-success text-white' : 'bg-light text-dark';
                    const name = isUser ? 'You' : selectedUserName;
                    const time = new Date(m.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    return `
                        <div class="d-flex ${alignClass} mb-2">
                            <div class="chat-bubble ${bubbleClass} px-3 py-2 rounded-3" style="max-width: 70%;">
                                <div class="fw-semibold mb-1">${name}</div>
                                <div>${m.message}</div>
                                <div class="text-end text-muted small mt-1">${time}</div>
                            </div>
                        </div>
                    `;
                }).join('');
                document.getElementById('chat-messages').innerHTML = html || '<div class="text-center text-muted mt-5">No messages yet.</div>';
                let box = document.getElementById('chat-messages');
                box.scrollTop = box.scrollHeight;
            });
    }
    function selectUser(id, name) {
        selectedUserId = id;
        selectedUserName = name;
        document.getElementById('chat-header').innerText = 'Chat with ' + name;
        document.getElementById('chat-form').style.display = '';
        fetchChat(); // Only fetch once
        fetchUserList();
    }
    fetchUserList();
    setInterval(fetchUserList, 5000);
    document.getElementById('chat-form').onsubmit = function(e) {
        e.preventDefault();
        let msg = document.getElementById('chat-input').value;
        if (!msg.trim() || !selectedUserId) return;
        fetch("{{ url('/chat/send') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: msg, to_user_id: selectedUserId })
        }).then(r => r.json()).then(() => {
            document.getElementById('chat-input').value = '';
            fetchChat(); // Fetch again after sending
        });
    };
    document.getElementById('clear-chat').onclick = function() {
        if (!selectedUserId) return;
        if(confirm('Clear all chat messages?')) {
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Clearing...';
            fetch("{{ url('/chat/clear') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ to_user_id: selectedUserId })
            }).then(r => r.json()).then(() => {
                this.disabled = false;
                this.innerHTML = 'Clear Chat';
                fetchChat();
                fetchUserList();
            });
        }
    };
    </script>
</div>

@push('styles')
<style>
    #chat-messages::-webkit-scrollbar {
        width: 8px;
    }
    #chat-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    #chat-messages::-webkit-scrollbar-thumb {
        background: #28a745;
        border-radius: 10px;
    }
    #chat-messages::-webkit-scrollbar-thumb:hover {
        background: #218838;
    }
    .chat-bubble {
        word-break: break-word;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        animation: fadeIn 0.3s ease-in-out;
    }
    .justify-content-end .chat-bubble {
        margin-left: auto;
    }
    .justify-content-start .chat-bubble {
        margin-right: auto;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@endsection
