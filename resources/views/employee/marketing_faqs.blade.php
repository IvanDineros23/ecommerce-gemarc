@extends('layouts.ecommerce')
@section('content')
<div class="w-full mx-auto px-6 sm:px-8 lg:px-10">
    <div class="p-6 w-full">
    <h2 class="text-2xl font-bold mb-4">Marketing - FAQs</h2>

    @if(session('success'))
        <div class="mb-3 text-green-700">{{ session('success') }}</div>
    @endif

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
                if(res.ok){ const d = await res.json(); if(d.success){
                        window.dispatchEvent(new CustomEvent('faq-created', { detail: d.faq }));
                        this.question = '';
                        this.answer = '';
                        return;
                    } }
                const txt = await res.text(); console.error('Create FAQ failed', res.status, txt); alert('Failed creating FAQ');
            }catch(e){ console.error(e); alert('Error') }
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
                        return;
                    }
                }
                const txt = await res.text();
                console.error('Update FAQ failed', res.status, txt);
                alert('Failed updating FAQ');
            }catch(e){ console.error(e); alert('Error updating FAQ') }
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
                    return;
                }
                const txt = await res.text();
                console.error('Delete FAQ failed', res.status, txt);
                alert('Failed deleting FAQ');
            }catch(e){ console.error(e); alert('Error deleting FAQ') }
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
