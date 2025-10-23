@extends('layouts.ecommerce')

@section('content')
<div class="pt-10 pb-16 px-4 w-full max-w-6xl mx-auto">
  <h1 class="text-2xl font-bold text-green-800 mb-4 flex items-center gap-2">
    <svg class="w-7 h-7 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4-4.03 7-9 7-1.18 0-2.31-.13-3.36-.38-.37-.09-.77-.08-1.12.07l-2.13.85a1 1 0 01-1.32-1.32l.85-2.13c.15-.35.16-.75.07-1.12A7.96 7.96 0 013 12c0-4 4.03-7 9-7s9 3 9 7z" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    Chat Management
  </h1>

  <div id="chat-shell" class="bg-white rounded-xl shadow p-5 lg:p-6">
    <div class="flex gap-6">
      <!-- Left: Users + Search -->
      <aside class="w-64 lg:w-72 border-r pr-5 flex-shrink-0">
        <div class="font-semibold mb-2">Users</div>

        <div class="relative mb-3">
          <input id="user-search" type="text"
                 class="w-full border border-green-300 rounded px-3 py-2 text-sm focus:outline-none"
                 placeholder="Search users...">
          <button id="clear-user-search" type="button"
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-xs hidden">✕</button>
        </div>

        <ul id="user-list" class="space-y-2 overflow-y-auto pr-1 max-h-[60vh]"></ul>
      </aside>

      <!-- Right: Chat -->
      <section class="flex-1 min-w-[320px]">
        <div id="chat-header" class="font-semibold mb-2 text-green-700 text-lg"></div>

        <!-- SCROLLABLE MESSAGES PANE (fixed height) -->
        <div id="chat-messages"
             class="bg-gray-50 rounded p-3 mb-3 text-base border border-gray-200 overscroll-contain">
          <div class="text-center text-gray-400 mt-5">No messages yet.</div>
        </div>

        <form id="chat-form" class="flex gap-2" style="display:none;">
          <input type="text" id="chat-input" class="border border-green-300 rounded px-3 py-2 w-full focus:outline-none text-base" placeholder="Type your message...">
          <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800 font-semibold">Send</button>
        </form>

        <div id="chat-status" class="text-xs text-gray-400 mt-1"></div>
      </section>
    </div>
  </div>
<br>
  <script>
  let selectedUserId = null;
  let selectedUserName = '';
  let allUsers = [];
  let userSearchValue = '';

  function renderUserList(filter = '') {
    const list = document.getElementById('user-list');
    const term = (filter||'').trim().toLowerCase();
    const items = (allUsers||[])
      .filter(u => !term || (u.name||'').toLowerCase().includes(term))
      .map(u => {
        const showNew = u.unread_count > 0;
        return `
          <li class="flex items-center gap-2 ${showNew ? 'bg-yellow-100 animate-pulse' : ''} rounded">
            <button onclick='selectUser(${u.id}, ${JSON.stringify(u.name)})'
                    class="flex-1 text-left px-2 py-1 rounded hover:bg-green-100 ${selectedUserId==u.id?'bg-green-200':''}">
              ${u.name}
              ${showNew ? `<span class="ml-2 inline-block bg-yellow-400 text-sm text-black rounded-full px-3 py-1 font-bold">${u.unread_count} new</span>` : ''}
            </button>
            <button onclick='deleteUserChat(${u.id})' title="Delete/Archive" class="text-red-600 hover:text-red-800 px-2 py-1 rounded">&#128465;</button>
          </li>`;
      }).join('');
    list.innerHTML = items || `<li class="text-sm text-gray-400 px-2 py-1">No users found</li>`;
    document.getElementById('clear-user-search').classList.toggle('hidden', !term);
  }

  function fetchUserList() {
    fetch("{{ url('/chat/users') }}", { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(users => { allUsers = users || []; renderUserList(userSearchValue); });
  }

  function fetchChat() {
    if (!selectedUserId) return;
    fetch(`{{ url('/chat/fetch') }}?with_user_id=${selectedUserId}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(r => r.json())
    .then(msgs => {
      const html = msgs.map(m => {
        const isMine = m.sender_id == {{ auth()->id() }};
        const wrap = isMine ? 'flex justify-end mb-2' : 'flex justify-start mb-2';
        const bubble = isMine
          ? 'max-w-[60%] bg-green-600 text-white px-3 py-2 rounded-2xl rounded-br-sm shadow'
          : 'max-w-[60%] bg-white text-gray-800 px-3 py-2 rounded-2xl rounded-bl-sm shadow border';
        const name = isMine ? 'You' : selectedUserName;
        const time = new Date(m.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        return `
          <div class="${wrap}">
            <div class="chat-bubble ${bubble}">
              <div class="font-semibold mb-1">${name}</div>
              <div>${m.message}</div>
              <div class="text-right text-gray-400 text-xs mt-1">${time}</div>
            </div>
          </div>`;
      }).join('');
      const box = document.getElementById('chat-messages');
      box.innerHTML = html || '<div class="text-center text-gray-400 mt-5">No messages yet.</div>';
      // always scroll to bottom
      box.scrollTop = box.scrollHeight;
    });
  }

  function selectUser(id, name) {
    selectedUserId = id;
    selectedUserName = name;
    document.getElementById('chat-header').innerText = 'Chat with ' + name;
    document.getElementById('chat-form').style.display = '';
    fetchChat();
    fetchUserList();
  }

  // Search
  (function initSearch() {
    const input = document.getElementById('user-search');
    const clearBtn = document.getElementById('clear-user-search');
    let t;
    input.addEventListener('input', e => {
      userSearchValue = e.target.value;
      clearTimeout(t);
      t = setTimeout(() => renderUserList(userSearchValue), 120);
    });
    clearBtn.addEventListener('click', () => {
      userSearchValue = '';
      input.value = '';
      renderUserList('');
    });
  })();

  fetchUserList();
  setInterval(fetchUserList, 5000);

  function deleteUserChat(userId) {
    if (!confirm('Are you sure you want to delete/archive this chat?')) return;
    fetch("{{ url('/chat/clear') }}", {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify({ to_user_id: userId })
    })
    .then(r => r.json())
    .then(res => {
      if (res.success) {
        if (selectedUserId == userId) {
          document.getElementById('chat-messages').innerHTML = '';
          document.getElementById('chat-header').innerText = '';
          document.getElementById('chat-form').style.display = 'none';
          selectedUserId = null;
        }
        fetchUserList();
      }
    });
  }

  document.getElementById('chat-form').onsubmit = function(e) {
    e.preventDefault();
    const msg = document.getElementById('chat-input').value;
    if (!msg.trim() || !selectedUserId) return;
    fetch("{{ url('/chat/send') }}", {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify({ message: msg, to_user_id: selectedUserId })
    })
    .then(r => r.json())
    .then(() => {
      document.getElementById('chat-input').value = '';
      fetchChat();
    });
  };
  </script>
</div>

@push('styles')
<style>
  /* FORCE the messages pane to be scrollable and NOT grow the whole page */
  #chat-messages{
    /* choose one line-height depending on your taste */
    height: clamp(280px, 45vh, 520px) !important;   /* << key line */
    overflow-y: auto !important;
    overscroll-behavior: contain; /* prevent scroll chaining */
    scroll-behavior: smooth;
  }

  #chat-messages::-webkit-scrollbar { width: 8px; }
  #chat-messages::-webkit-scrollbar-thumb { background: #28a745; border-radius: 10px; }
  #chat-messages::-webkit-scrollbar-thumb:hover { background: #218838; }

  .chat-bubble {
    word-break: break-word;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    animation: fadeIn .3s ease-in-out;
  }
  @keyframes fadeIn { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }
</style>
@endpush
@endsection