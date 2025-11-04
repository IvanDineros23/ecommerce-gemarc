@extends('layouts.ecommerce')
@section('content')
<!-- Toast Notification Component -->
<div x-data="toast()"
     x-on:notify.window="show($event.detail.message, $event.detail.type)"
     class="fixed top-4 right-4 z-[9999] flex flex-col items-end space-y-4"
     style="min-width: 300px; right: 1rem;">
    <template x-for="(toast, index) in toasts" :key="index">
        <div x-show="toast.visible"
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-x-full opacity-0"
             x-transition:enter-end="translate-x-0 opacity-100"
             x-transition:leave="transform ease-in duration-200 transition"
             x-transition:leave-start="translate-x-0 opacity-100"
             x-transition:leave-end="translate-x-full opacity-0"
             class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <template x-if="toast.type === 'success'">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </template>
                        <template x-if="toast.type === 'error'">
                            <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </template>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <p x-text="toast.message" class="text-sm text-gray-500"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="remove(index)" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<div class="w-full mx-auto px-6 sm:px-8 lg:px-10">
    <div class="p-6 w-full">
    <h2 class="text-2xl font-bold mb-4">Marketing - Polls</h2>

    @if(session('success'))
        <div class="mb-3 text-green-700">{{ session('success') }}</div>
    @endif

    <div class="mb-6 w-full" x-data="newPoll()">
        <form @submit.prevent="submit()">
            @csrf
            <div class="mb-2">
                <label class="block text-sm font-medium">Question</label>
                <input x-model="question" class="w-full border rounded px-2 py-1" required />
            </div>
            <div class="mb-2">
                <label class="block text-sm font-medium">Options (comma separated)</label>
                <textarea x-model="optionsText" class="w-full border rounded px-2 py-1" placeholder="Option 1, Option 2, Option 3"></textarea>
                <p class="text-xs text-gray-500 mt-1">After creating, add or remove options as needed.</p>
            </div>
            <div>
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded">Create Poll</button>
            </div>
        </form>
    </div>

    <div class="w-full" x-data="polls()">
        <h3 class="font-semibold mb-2">Existing Polls</h3>
        <div class="space-y-4">
            <template x-for="p in polls" :key="p.id">
                <div class="bg-white border rounded p-4 shadow-sm w-full max-w-none">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="font-semibold text-lg text-gray-800" x-text="p.question"></div>
                        </div>
                        <div class="ml-4">
                            <button @click="removePoll(p.id)" class="text-xs text-red-600 px-2 py-1 border rounded">Delete poll</button>
                        </div>
                    </div>
                    <div class="text-sm text-gray-700 mt-3">
                        <ul class="space-y-2">
                            <template x-for="(opt, idx) in p.options" :key="opt.id">
                                <li class="flex items-center justify-between py-1 border-b last:border-b-0">
                                    <div class="flex items-center gap-3">
                                        <button x-show="!reordering[p.id]" @click="editOption(p.id, opt)" class="text-xs text-blue-700 underline">Edit</button>
                                        <div x-text="opt.text" class="text-gray-800"></div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="text-xs text-gray-500" x-text="(opt.votes_count || opt.votes || 0) + ' votes'"></div>
                                        <div class="flex items-center gap-1">
                                            <button x-show="reordering[p.id]" @click.prevent="moveOptionUp(p.id, idx)" type="button" class="text-xs px-2 py-0.5 border rounded">▲</button>
                                            <button x-show="reordering[p.id]" @click.prevent="moveOptionDown(p.id, idx)" type="button" class="text-xs px-2 py-0.5 border rounded">▼</button>
                                            <button x-show="!reordering[p.id]" @click="openDelete(p.id, opt)" type="button" class="text-xs text-red-600 px-2 py-0.5 border rounded">Delete</button>
                                            <button x-show="reordering[p.id]" @click.prevent="openDelete(p.id, opt)" type="button" class="text-xs text-red-600 px-2 py-0.5 border rounded">Delete</button>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>
                    <div class="mt-3 flex items-center gap-3 w-full">
                        <input x-model="newOptionText[p.id]" placeholder="New option" class="border px-2 py-1 text-sm flex-1" />
                        <button @click="addOption(p.id)" type="button" class="text-xs text-blue-700 px-2">Add option</button>
                        <template x-if="!reordering[p.id]">
                            <button @click="toggleReorder(p.id)" type="button" class="text-xs text-gray-600 px-2">Reorder</button>
                        </template>
                        <template x-if="reordering[p.id]">
                            <div class="flex items-center gap-2">
                                <button @click="saveOrder(p.id)" type="button" class="text-xs text-white bg-green-600 px-2 py-1 rounded">Save order</button>
                                <button @click="cancelReorder(p.id)" type="button" class="text-xs px-2 py-1 border rounded">Cancel</button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <!-- Edit Option Modal -->
        <div x-show="editing.show" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div x-transition class="bg-white rounded p-6 w-full max-w-md" role="dialog" aria-modal="true">
                <h3 class="text-lg font-semibold mb-3">Edit option</h3>
                <div class="mb-3">
                    <input x-model="editing.text" class="w-full border rounded px-2 py-1" />
                </div>
                <div class="flex justify-end gap-2">
                    <button @click="closeEdit()" class="px-3 py-1 border rounded">Cancel</button>
                    <button @click="saveEdit()" class="px-3 py-1 bg-green-700 text-white rounded">Save</button>
                </div>
            </div>
        </div>

        <!-- Delete Option Modal -->
        <div x-show="deleting.show" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div x-transition class="bg-white rounded p-6 w-full max-w-md" role="dialog" aria-modal="true">
                <h3 class="text-lg font-semibold mb-3">Delete option</h3>
                <p class="text-sm text-gray-700 mb-4">Are you sure you want to delete <strong x-text="deleting.text"></strong>?</p>
                <div class="flex justify-end gap-2">
                    <button @click="closeDelete()" class="px-3 py-1 border rounded">Cancel</button>
                    <button @click="confirmDelete()" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                </div>
            </div>
        </div>

        <!-- Delete Poll Modal -->
        <div x-show="deletingPoll.show" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div x-transition class="bg-white rounded p-6 w-full max-w-md" role="dialog" aria-modal="true">
                <h3 class="text-lg font-semibold mb-3">Delete poll</h3>
                <p class="text-sm text-gray-700 mb-4">Are you sure you want to delete this poll?</p>
                <div class="flex justify-end gap-2">
                    <button @click="closeDeletePoll()" class="px-3 py-1 border rounded">Cancel</button>
                    <button @click="confirmDeletePoll()" class="px-3 py-1 bg-red-600 text-white rounded">Delete poll</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function toast() {
    return {
        toasts: [],
        show(message, type = 'success') {
            this.toasts.push({
                message,
                type,
                visible: true
            });
            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.message !== message);
            }, 3000);
        },
        remove(index) {
            this.toasts.splice(index, 1);
        }
    };
}

function newPoll(){
    return {
        question: '',
        optionsText: '',
        submit(){
            // send options as an array split by comma
            const opts = String(this.optionsText || '').split(',').map(s=>s.trim()).filter(Boolean);
            const payload = { question: this.question, options: opts };
            fetch('{{ route('employee.marketing.polls.store') }}', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify(payload)
            }).then(async r=>{
                // try to parse json response
                try{ 
                    const data = await r.json(); 
                    if(data && data.success){ 
                        // Show success toast notification
                        window.dispatchEvent(new CustomEvent('notify', { 
                            detail: { 
                                message: 'Poll created successfully!', 
                                type: 'success' 
                            } 
                        }));
                    } 
                }catch(e){}

                // refresh polls list via API and broadcast
                try{
                    const res = await fetch('/api/polls', { credentials: 'same-origin' });
                    if(res.ok){ 
                        const polls = await res.json(); 
                        window.dispatchEvent(new CustomEvent('polls-updated', { detail: polls }));
                    }
                }catch(e){ 
                    console.error('Failed to refresh polls after create', e);
                }

                // clear form
                this.question = '';
                this.optionsText = '';
                
                // Refresh the page after a short delay to show updated list
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            }).catch(e=>{ 
                console.error(e); 
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Error creating poll', type: 'error' } 
                }));
            })
        }
    }
}

// Provide a global factory so x-data="polls()" is available regardless of Alpine init timing
window.polls = function(){
    return {
    polls: @json($polls),
    newOptionText: {},
    reordering: {},
    reorderUrlTemplate: '{{ route('employee.marketing.polls.options.reorder', ['poll' => '__POLL__']) }}',
    // modal state
    editing: { show: false, pollId: null, id: null, text: '' },
    deleting: { show: false, pollId: null, id: null, text: '' },
    deletingPoll: { show: false, id: null },
        init(){
            // debug: log polls when initialized
            try{ console.debug('polls.init: server polls count', Array.isArray(this.polls) ? this.polls.length : typeof this.polls); }catch(e){}
            try{
                if(Array.isArray(this.polls) && this.polls.length){
                    this.polls.forEach(p=>{ this.newOptionText[p.id] = ''; this.reordering[p.id] = false; })
                } else {
                    // fallback: fetch from API if server-side injection is empty
                    (async ()=>{
                        try{
                            const res = await fetch('/api/polls', { credentials: 'same-origin' });
                            if(res.ok){
                                const data = await res.json();
                                if(Array.isArray(data) && data.length){
                                    this.polls = data;
                                    this.polls.forEach(p=>{ this.newOptionText[p.id] = '' });
                                }
                            } else {
                                console.warn('Fallback fetch /api/polls returned', res.status);
                            }
                                    }catch(err){ console.error('Failed to fetch polls fallback', err) }
                    })();
                }
            }catch(e){ console.error('polls.init error', e) }

                // Listen for external updates (create poll flow)
                window.addEventListener('polls-updated', (e)=>{ if(e && e.detail){ this.polls = e.detail; this.polls.forEach(p=>{ this.newOptionText[p.id] = '' }); } });
        },
        toggleReorder(pollId){ this.reordering[pollId] = !this.reordering[pollId]; },
        cancelReorder(pollId){ this.reordering[pollId] = false; },
        moveOptionUp(pollId, idx){
            const poll = this.polls.find(p=> p.id == pollId);
            if(!poll) return;
            if(idx <= 0) return;
            const arr = poll.options;
            const tmp = arr[idx-1]; arr[idx-1] = arr[idx]; arr[idx] = tmp;
        },
        moveOptionDown(pollId, idx){
            const poll = this.polls.find(p=> p.id == pollId);
            if(!poll) return;
            const arr = poll.options;
            if(idx >= arr.length - 1) return;
            const tmp = arr[idx+1]; arr[idx+1] = arr[idx]; arr[idx] = tmp;
        },
        async saveOrder(pollId){
            try{
                const poll = this.polls.find(p=> p.id == pollId);
                if(!poll) return alert('Poll not found');
                const order = (poll.options || []).map(o=> o.id);
                const url = this.reorderUrlTemplate.replace('__POLL__', pollId);
                const res = await fetch(url, { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept':'application/json' }, body: JSON.stringify({ order }) });
                if(res.ok){
                    // try to use returned updated options if present
                    try{ const d = await res.json(); if(d && d.success && d.options){ poll.options = d.options; } }
                    catch(e){}
                    this.reordering[pollId] = false;
                    return;
                }
                alert('Failed saving order');
            }catch(e){ console.error(e); alert('Error saving order') }
        },
        addOption(pollId){
            const text = (this.newOptionText[pollId] || '').trim();
            if(!text) return alert('Enter option');
            fetch('/employee/marketing/polls/'+pollId+'/options', { method:'POST', credentials:'same-origin', headers:{ 'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json' }, body: JSON.stringify({ text }) })
                    .then(r=>r.json()).then(d=>{ if(d && d.success){
                            // insert returned option into local poll list if present
                            const opt = d.option || d;
                            const poll = this.polls.find(x=>x.id == pollId);
                            if(poll){ poll.options = poll.options || []; poll.options.push(opt); this.newOptionText[pollId] = ''; }
                        } else { alert('Failed adding option') } }).catch(e=>{ console.error(e); alert('Error adding option') });
        },

        // Poll delete flow (modal)
        openDeletePoll(id){ this.deletingPoll = { show: true, id }; },
        closeDeletePoll(){ this.deletingPoll = { show: false, id: null }; },
        async confirmDeletePoll(){
            try {
                if (!this.deletingPoll || !this.deletingPoll.id) {
                    console.error('No poll selected for deletion');
                    return;
                }

                const id = this.deletingPoll.id;
                const res = await fetch('/employee/marketing/polls/' + id, { 
                    method: 'DELETE', 
                    credentials: 'same-origin', 
                    headers: { 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    } 
                });

                let data;
                try {
                    data = await res.json();
                } catch (e) {
                    console.error('Failed to parse response:', e);
                    data = { success: false, message: 'Invalid server response' };
                }
                
                if(res.ok){
                    // remove poll from list
                    this.polls = this.polls.filter(x => x.id != id);
                    this.closeDeletePoll();
                    
                    // Show success toast
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { 
                            message: 'Poll deleted successfully', 
                            type: 'success' 
                        } 
                    }));
                    
                    // Reload page to refresh everything
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    return;
                }
                
                // Show error toast
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { 
                        message: data.message || 'Failed to delete poll. Please try again.', 
                        type: 'error' 
                    } 
                }));
            } catch(e) { 
                console.error('Error during poll deletion:', e);
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { 
                        message: 'Network error while deleting poll. Please try again.', 
                        type: 'error' 
                    } 
                }));
            } finally {
                // Make sure modal is closed even if there's an error
                this.closeDeletePoll();
            }
        },

        removePoll(id){ this.openDeletePoll(id); },

        // Edit option uses modal
        editOption(pollId, opt){ this.editing = { show: true, pollId: pollId, id: opt.id, text: opt.text }; },
        closeEdit(){ this.editing = { show: false, pollId: null, id: null, text: '' }; },
        async saveEdit(){
            try{
                const p = this.editing;
                if(!p || !p.id) return;
                const res = await fetch('/employee/marketing/polls/' + p.pollId + '/options/' + p.id, { method: 'PUT', credentials: 'same-origin', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }, body: JSON.stringify({ text: p.text }) });
                const d = await res.json();
                if(d && d.success){ location.reload(); return; }
                alert('Failed updating option');
            }catch(e){ console.error(e); alert('Error updating option') }
        },

        // Delete option modal flow
        openDelete(pollId, opt){ this.deleting = { show: true, pollId: pollId, id: opt.id, text: opt.text }; },
        closeDelete(){ this.deleting = { show: false, pollId: null, id: null, text: '' }; },
        async confirmDelete(){
            try{
                const d = this.deleting;
                if(!d || !d.id) return;
                const res = await fetch('/employee/marketing/polls/' + d.pollId + '/options/' + d.id, { method: 'DELETE', credentials: 'same-origin', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' } });
                if(res.ok){
                    // remove option from local poll
                    const poll = this.polls.find(x=> x.id == d.pollId);
                    if(poll){ poll.options = (poll.options || []).filter(o=> o.id != d.id); }
                    this.closeDelete();
                    return;
                }
                alert('Failed deleting option');
            }catch(e){ console.error(e); alert('Error deleting option') }
        },

        reorder(pollId){ alert('Reorder UI not implemented in this quick flow; this placeholder will be upgraded on request.') }
    };
};

// Also register with Alpine for the standard path (fallback)
document.addEventListener('alpine:init', ()=>{
    Alpine.data('polls', ()=> window.polls());
});
</script>
@endpush
