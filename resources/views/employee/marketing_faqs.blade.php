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
    <h2 class="text-2xl font-bold mb-4">Marketing - FAQs</h2>

    <div class="mb-6 w-full" x-data="faqForm()">
        <form @submit.prevent="submit()">
            @csrf
            <div class="mb-2">
                <label class="block text-sm font-medium">Question</label>
                <input x-model="question" class="w-full border rounded px-2 py-1" required />
            </div>
            <div class="mb-2">
                <label class="block text-sm font-medium">Answer</label>
                <textarea x-model="answer" class="w-full border rounded px-2 py-1" required></textarea>
            </div>
            <div>
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded">Create FAQ</button>
            </div>
        </form>
    </div>

    <div x-data="faqs()" class="w-full">
        <h3 class="font-semibold mb-2">Existing FAQs</h3>
        <div class="space-y-3">
            <template x-if="faqs.length === 0">
                <div class="text-sm text-gray-500">No FAQs found. Create one using the form above.</div>
            </template>
            <template x-for="(f, idx) in faqs" :key="f.id">
                <div class="border rounded p-3 w-full max-w-none">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="font-semibold" x-text="f.question"></div>
                            <div class="text-sm text-gray-700 mt-1" x-html="f.answer"></div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <button @click="openEditModal(f, idx)" class="text-xs text-blue-700 underline">Edit</button>
                            <button @click="openDeleteModal(f, idx)" class="text-xs bg-red-600 text-white px-2 py-1 rounded text-xs">Delete</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Edit Modal -->
                <div id="faq-edit-modal" x-show="editing.show" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div x-transition.origin-top.duration.200ms class="bg-white rounded p-6 w-full max-w-2xl" @keydown.window.escape="closeEdit()" role="dialog" aria-modal="true">
                <h3 class="text-lg font-semibold mb-3">Edit FAQ</h3>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Question</label>
                    <input x-model="editing.question" class="w-full border rounded px-2 py-1" />
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Answer</label>
                    <textarea x-model="editing.answer" class="w-full border rounded px-2 py-1" rows="6"></textarea>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <button @click="closeEdit()" class="px-3 py-1 border rounded">Cancel</button>
                    <button @click="saveEdit()" class="px-3 py-1 bg-green-700 text-white rounded">Save</button>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="faq-delete-modal" x-show="deleting.show" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div x-transition.origin-top.duration.200ms class="bg-white rounded p-6 w-full max-w-md" @keydown.window.escape="closeDelete()" role="dialog" aria-modal="true">
                <h3 class="text-lg font-semibold mb-3">Confirm Delete</h3>
                <div class="mb-4 text-sm text-gray-700">Are you sure you want to delete the following FAQ?</div>
                <div class="mb-4 p-3 bg-gray-50 rounded">
                    <div class="font-semibold mb-1" x-text="deleting.question"></div>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <button @click="closeDelete()" class="px-3 py-1 border rounded">Cancel</button>
                    <button @click="confirmDelete()" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
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
    }
}

// Provide global factory functions so x-data="faqForm()" and x-data="faqs()" work regardless of Alpine init ordering
window.faqForm = function(){
    return {
        question: '',
        answer: '',
        async submit(){
            try{
                const res = await fetch('{{ route('employee.marketing.faqs.store') }}', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN':'{{ csrf_token() }}', 'Accept':'application/json' },
                    body: JSON.stringify({ question: this.question, answer: this.answer })
                });
                if(res.ok){ 
                    const d = await res.json(); 
                    if(d.success){
                        window.dispatchEvent(new CustomEvent('faq-created', { detail: d.faq }));
                        window.dispatchEvent(new CustomEvent('notify', { 
                            detail: { message: 'FAQ created successfully', type: 'success' }
                        }));
                        this.question = '';
                        this.answer = '';
                        return;
                    } 
                }
                console.error('Create FAQ failed');
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Failed to create FAQ', type: 'error' }
                }));
            }catch(e){ 
                console.error(e); 
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Error creating FAQ', type: 'error' }
                }));
            }
        }
    };
};

window.faqs = function(){
    return {
        faqs: @json($faqs),
        init(){
            try{
                window.addEventListener('faq-created', (e)=>{ if(e && e.detail){ this.faqs.unshift(e.detail); } });
            }catch(e){ console.error('faq init listener error', e) }
            if(!this.faqs || this.faqs.length === 0){
                (async ()=>{
                    try{
                        const res = await fetch('/api/faqs', { credentials: 'same-origin' });
                        if(res.ok){
                            const data = await res.json();
                            if(Array.isArray(data) && data.length) this.faqs = data;
                        } else {
                            console.warn('Fallback fetch /api/faqs returned', res.status);
                        }
                    }catch(err){ console.error('Failed to fetch faqs fallback', err) }
                })();
            }
        },
        editing: { show: false, id: null, question: '', answer: '', index: null },
        deleting: { show: false, id: null, question: '', index: null },

        openEditModal(f, idx){
            this.editing = { show: true, id: f.id, question: f.question, answer: f.answer, index: idx };
            setTimeout(()=>{
                const el = document.querySelector('#faq-edit-modal');
                if(el){ const input = el.querySelector('input, textarea, button'); if(input) input.focus(); this.trapFocus('#faq-edit-modal'); }
            }, 0);
        },
        closeEdit(){ this.releaseFocus(); this.editing.show = false; },
        async saveEdit(){
            try{
                const id = this.editing.id;
                const payload = { question: this.editing.question, answer: this.editing.answer };
                const res = await fetch('/employee/marketing/faqs/'+id, {
                    method: 'PUT',
                    credentials: 'same-origin',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    body: JSON.stringify(payload)
                });
                if(res.ok){
                    const d = await res.json();
                    if(d.success){
                        this.faqs[this.editing.index] = d.faq;
                        this.closeEdit();
                        window.dispatchEvent(new CustomEvent('notify', { 
                            detail: { message: 'FAQ updated successfully', type: 'success' }
                        }));
                        return;
                    }
                }
                console.error('Update FAQ failed');
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Failed to update FAQ', type: 'error' }
                }));
            }catch(e){ 
                console.error(e); 
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Error updating FAQ', type: 'error' }
                }));
            }
        },

        openDeleteModal(f, idx){
            this.deleting = { show: true, id: f.id, question: f.question, index: idx };
            setTimeout(()=>{
                const el = document.querySelector('#faq-delete-modal');
                if(el){ const btn = el.querySelector('button'); if(btn) btn.focus(); this.trapFocus('#faq-delete-modal'); }
            },0);
        },
        closeDelete(){ this.releaseFocus(); this.deleting.show = false; },
        async confirmDelete(){
            try{
                const id = this.deleting.id;
                const res = await fetch('/employee/marketing/faqs/'+id, {
                    method: 'DELETE',
                    credentials: 'same-origin',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                });
                if(res.ok){
                    this.faqs.splice(this.deleting.index, 1);
                    this.closeDelete();
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { message: 'FAQ deleted successfully', type: 'success' }
                    }));
                    return;
                }
                console.error('Delete FAQ failed');
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Failed to delete FAQ', type: 'error' }
                }));
            }catch(e){ 
                console.error(e); 
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Error deleting FAQ', type: 'error' }
                }));
            }
        },

        trapFocus(selector){
            try{
                const container = document.querySelector(selector);
                if(!container) return;
                this._previouslyFocused = document.activeElement;
                const focusable = container.querySelectorAll('a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])');
                if(!focusable.length) return;
                this._focusable = Array.from(focusable);
                this._firstFocusable = this._focusable[0];
                this._lastFocusable = this._focusable[this._focusable.length -1];
                this._focusHandler = (e)=>{
                    if(e.key === 'Tab'){
                        if(e.shiftKey){
                            if(document.activeElement === this._firstFocusable){ e.preventDefault(); this._lastFocusable.focus(); }
                        } else {
                            if(document.activeElement === this._lastFocusable){ e.preventDefault(); this._firstFocusable.focus(); }
                        }
                    } else if(e.key === 'Escape'){
                        if(this.editing.show) this.closeEdit();
                        if(this.deleting.show) this.closeDelete();
                    }
                };
                document.addEventListener('keydown', this._focusHandler);
            }catch(e){ console.error(e) }
        },
        releaseFocus(){
            try{
                if(this._focusHandler) document.removeEventListener('keydown', this._focusHandler);
                if(this._previouslyFocused) try{ this._previouslyFocused.focus(); } catch(e){}
                this._focusHandler = null; this._focusable = null; this._previouslyFocused = null;
            }catch(e){ console.error(e) }
        }
    };
};
</script>
@endpush
