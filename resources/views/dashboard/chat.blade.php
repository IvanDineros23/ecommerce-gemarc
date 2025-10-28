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
            <!-- LEFT: users -->
            <div class="border-end pe-4" style="min-width:240px;">
              <div class="fw-semibold mb-2">Users</div>
              <div id="dept-wrap" class="mb-3">
                <label for="department-select" class="fw-semibold d-block mb-1">Department:</label>
                <select id="department-select" class="form-select">
                  <!-- options injected by JS -->
                </select>
              </div>
              <div id="user-list">
                <div class="text-muted small">Loading employees…</div>
              </div>
            </div>

            <!-- RIGHT: chat -->
            <div class="flex-grow-1 ps-4">
              <div id="chat-header" class="fw-semibold mb-2 text-success fs-5"></div>
              <div id="chat-messages" class="p-3 mb-3" style="height: 400px; overflow-y: auto; background:#f8f9fa; border-radius:8px; border:1px solid #eee;"></div>

              <form id="chat-form" class="d-flex gap-2 mb-2" style="display:none;">
                <input type="text" id="chat-input" class="form-control" placeholder="Type your message…" autocomplete="off">
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

@push('styles')
<style>
#chat-messages::-webkit-scrollbar{ width:8px }
#chat-messages::-webkit-scrollbar-thumb{ background:#28a745; border-radius:10px }
.chat-bubble{ word-break: break-word; box-shadow:0 2px 8px rgba(0,0,0,.06); animation:fadeIn .3s ease-in-out }
.justify-content-end .chat-bubble{ margin-left:auto }
.justify-content-start .chat-bubble{ margin-right:auto }
@keyframes fadeIn{ from{opacity:0; transform:translateY(10px)} to{opacity:1; transform:translateY(0)} }
</style>
@endpush

@php $me = auth()->id(); @endphp
<script>
(() => {
  const me = {{ (int) $me }};
  let selectedUserId = null;
  let selectedUserName = '';
  let departmentFilter = 'marketing'; // default bucket

  function guardAndParse(res){
    if(!res || typeof res !== 'object' || Array.isArray(res) || res.message){
      const err = JSON.stringify(res);
      document.getElementById('user-list').innerHTML =
        `<div class="text-danger small">Can’t load employees. ${err ? 'Response: ' + err : ''}</div>`;
      // also clear department select to avoid “File/Line/Trace” scenario
      document.getElementById('department-select').innerHTML = '';
      return null;
    }
    return res;
  }

  function titleize(s){
    if(!s) return 'Unknown';
    return s.charAt(0).toUpperCase() + s.slice(1);
  }

  function renderDepartmentOptions(groups){
    const sel = document.getElementById('department-select');
    const keys = Object.keys(groups);
    // keep current if still exists, else default to first/marketing
    if(!departmentFilter || !groups[departmentFilter]) {
      departmentFilter = groups['marketing'] ? 'marketing' : keys[0];
    }
    sel.innerHTML = keys.map(k => {
      const label = groups[k]?.label || titleize(k);
      return `<option value="${k}" ${k===departmentFilter?'selected':''}>${label}</option>`;
    }).join('');
  }

  function renderUserList(groups){
    renderDepartmentOptions(groups);

    const users = groups[departmentFilter]?.employees || [];
    const wrap = document.getElementById('user-list');

    if(!users.length){
      wrap.innerHTML = `<div class="text-muted">No employees in this department.</div>`;
      return;
    }

    wrap.innerHTML = '<ul class="list-unstyled mb-0">' + users.map(u => `
      <li class="mb-2">
        <button type="button"
          class="btn btn-outline-success w-100 text-start ${selectedUserId==u.id?'active':''}"
          onclick='window.__selectUser(${u.id}, ${JSON.stringify(u.name)})'>
          ${u.name}
          ${u.unread_count>0 ? `<span class="badge bg-warning ms-2">${u.unread_count} new</span>` : ''}
        </button>
      </li>
    `).join('') + '</ul>';
  }

  function fetchUsers(){
    fetch(`{{ url('/chat/users') }}`, { headers:{'X-Requested-With':'XMLHttpRequest'} })
      .then(r => r.json())
      .then(data => {
        const groups = guardAndParse(data);
        if(!groups) return;
        renderUserList(groups);
      })
      .catch(err => {
        document.getElementById('user-list').innerHTML =
          `<div class="text-danger small">Can’t load employees. ${err}</div>`;
      });
  }

  function fetchChat(){
    if(!selectedUserId){
      document.getElementById('chat-header').innerText = '';
      document.getElementById('chat-messages').innerHTML =
        '<div class="text-center text-muted mt-5">Select a user to view messages.</div>';
      document.getElementById('chat-form').style.display = 'none';
      return;
    }

    fetch(`{{ url('/chat/fetch') }}?with_user_id=${selectedUserId}`, { headers:{'X-Requested-With':'XMLHttpRequest'} })
      .then(r => r.json())
      .then(msgs => {
        const html = msgs.map(m => {
          const isMe = m.sender_id == me;
          const align = isMe ? 'justify-content-end' : 'justify-content-start';
          const bubble = isMe ? 'bg-success text-white' : 'bg-light text-dark';
          const name = isMe ? 'You' : selectedUserName;
          const time = new Date(m.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
          return `
            <div class="d-flex ${align} mb-2">
              <div class="chat-bubble ${bubble} px-3 py-2 rounded-3" style="max-width:70%;">
                <div class="fw-semibold mb-1">${name}</div>
                <div>${m.message}</div>
                <div class="text-end text-muted small mt-1">${time}</div>
              </div>
            </div>`;
        }).join('');

        const box = document.getElementById('chat-messages');
        box.innerHTML = html || '<div class="text-center text-muted mt-5">No messages yet.</div>';
        box.scrollTop = box.scrollHeight;
      });
  }

  window.__selectUser = (id, name) => {
    selectedUserId = id;
    selectedUserName = name;
    document.getElementById('chat-header').innerText = 'Chat with ' + name;
    document.getElementById('chat-form').style.display = '';
    fetchChat();
    fetchUsers(); // refresh unread badges
  };

  document.getElementById('department-select').addEventListener('change', (e) => {
    departmentFilter = e.target.value;
    fetchUsers();
  });

  document.getElementById('chat-form').addEventListener('submit', function(e){
    e.preventDefault();
    const input = document.getElementById('chat-input');
    const msg = input.value.trim();
    if(!msg || !selectedUserId) return;

    fetch(`{{ url('/chat/send') }}`, {
      method:'POST',
      headers:{
        'Content-Type':'application/json',
        'X-CSRF-TOKEN':'{{ csrf_token() }}'
      },
      body: JSON.stringify({ to_user_id: selectedUserId, message: msg })
    }).then(() => {
      input.value = '';
      fetchChat();
      fetchUsers();
    });
  });

  document.getElementById('clear-chat').addEventListener('click', function(){
    if(!selectedUserId) return;
    if(!confirm('Clear all chat messages?')) return;

    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Clearing…';

    fetch(`{{ url('/chat/clear') }}`, {
      method: 'POST',
      headers:{
        'Content-Type':'application/json',
        'X-CSRF-TOKEN':'{{ csrf_token() }}'
      },
      body: JSON.stringify({ to_user_id: selectedUserId })
    }).then(() => {
      btn.disabled = false;
      btn.innerHTML = 'Clear Chat';
      fetchChat();
      fetchUsers();
    });
  });

  // initial load + refresh
  fetchUsers();
  setInterval(fetchUsers, 5000);
})();
</script>
@endsection
