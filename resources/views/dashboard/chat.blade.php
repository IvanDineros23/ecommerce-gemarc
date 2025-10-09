@extends('layouts.ecommerce')

@section('title', 'Chat with Employee | Gemarc Enterprises Inc.')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h2 class="text-center text-success fw-bold mb-4">
                <i class="fas fa-comments me-2"></i> Chat with Employee
            </h2>
            
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="position-relative">
                        <div id="chat-messages" class="p-4 mb-0" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;"></div>
                        <div id="chat-placeholder" class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted fs-5 px-4 text-center" style="background:rgba(255,255,255,0.9); z-index:2; transition: opacity 0.5s;">
                            <div class="fw-bold text-success mb-2 fs-4">Welcome to Gemarc Enterprises Inc.</div>
                            <div>What would you like to inquire about?<br>Want to get a quote quickly?</div>
                        </div>
                    </div>
                    
                    <div class="border-top p-3">
                        <form id="chat-form" class="d-flex gap-2 mb-2">
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
    <script>
    // Placeholder fade logic
    function updateChatPlaceholder() {
        const chatBox = document.getElementById('chat-messages');
        const placeholder = document.getElementById('chat-placeholder');
        const input = document.getElementById('chat-input');
        // Hide placeholder if there are messages or if user is typing
        let hasMessages = chatBox && chatBox.innerText.trim().length > 0;
        let isTyping = input && input.value.trim().length > 0;
        if (hasMessages || isTyping) {
            placeholder.style.opacity = 0;
            placeholder.style.pointerEvents = 'none';
        } else {
            placeholder.style.opacity = 1;
            placeholder.style.pointerEvents = 'none';
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        updateChatPlaceholder();
        document.getElementById('chat-input').addEventListener('input', updateChatPlaceholder);
    });
    // Get the first employee's user ID for demo (server-side rendered)
    const EMPLOYEE_ID = @php
        $emp = \App\Models\User::where('role','employee')->first();
        echo $emp ? $emp->id : 1;
    @endphp;
    function fetchChat() {
        fetch("{{ url('/chat/fetch') }}", {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(r => r.json())
            .then(msgs => {
                let html = '';
                msgs.forEach(m => {
                    const isUser = m.sender_id == {{ auth()->id() }};
                    const alignClass = isUser ? 'text-end' : '';
                    const bubbleClass = isUser ? 'bg-primary text-white' : 'bg-light';
                    const msgTime = new Date(m.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    
                    html += `
                        <div class="mb-3 ${alignClass}">
                            <div class="d-inline-block ${bubbleClass} rounded-3 px-3 py-2" style="max-width: 80%;">
                                ${m.message}
                                <div class="text-${isUser ? 'light' : 'muted'} small mt-1">${msgTime}</div>
                            </div>
                        </div>
                    `;
                });
                
                document.getElementById('chat-messages').innerHTML = html;
                let box = document.getElementById('chat-messages');
                box.scrollTop = box.scrollHeight;
                updateChatPlaceholder();
            });
    }
    fetchChat();
    setInterval(fetchChat, 3000);
    
    // Show typing indicator
    function showTypingIndicator() {
        const status = document.getElementById('chat-status');
        status.textContent = 'Employee is typing...';
        setTimeout(() => { status.textContent = ''; }, 2000);
    }
    
    // Occasionally show typing for demo purposes
    setInterval(() => {
        if (Math.random() > 0.7) showTypingIndicator();
    }, 10000);
    
    document.getElementById('chat-form').onsubmit = function(e) {
        e.preventDefault();
        let msg = document.getElementById('chat-input').value;
        if (!msg.trim()) return;
        
        // Disable input while sending
        const input = document.getElementById('chat-input');
        const sendBtn = this.querySelector('button[type="submit"]');
        input.disabled = true;
        sendBtn.disabled = true;
        
        fetch("{{ url('/chat/send') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: msg, to_user_id: EMPLOYEE_ID })
        }).then(r => r.json()).then(() => {
            input.value = '';
            input.disabled = false;
            sendBtn.disabled = false;
            input.focus();
            fetchChat();
        }).catch(err => {
            console.error(err);
            input.disabled = false;
            sendBtn.disabled = false;
        });
    };
    
    document.getElementById('clear-chat').onclick = function() {
        if(confirm('Clear all chat messages?')) {
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Clearing...';
            
            fetch("{{ url('/chat/clear') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ to_user_id: EMPLOYEE_ID })
            }).then(r => r.json()).then(() => {
                this.disabled = false;
                this.innerHTML = 'Clear Chat';
                fetchChat();
            }).catch(err => {
                console.error(err);
                this.disabled = false;
                this.innerHTML = 'Clear Chat';
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
    
    .chat-bubble-in {
        animation: fadeIn 0.3s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@endsection
