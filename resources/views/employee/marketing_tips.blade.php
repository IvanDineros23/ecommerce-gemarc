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
    <h2 class="text-2xl font-bold mb-4">Marketing - Tips & Reminders</h2>

    <div class="mb-6 w-full" x-data="tipForm()">
        <form @submit.prevent="submit()">
            @csrf
            <div class="mb-2">
                <label class="block text-sm font-medium">Title</label>
                <input x-model="title" class="w-full border rounded px-2 py-1" required />
            </div>
            <div class="mb-2">
                <label class="block text-sm font-medium">Content</label>
                <textarea x-model="content" class="w-full border rounded px-2 py-1" rows="4" required></textarea>
            </div>
            <div class="mb-2">
                <label class="flex items-center">
                    <input type="checkbox" x-model="is_active" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Active</span>
                </label>
            </div>
            <div>
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded">Create Tip</button>
            </div>
        </form>
    </div>

    <div x-data="tips()" class="w-full">
        <h3 class="font-semibold mb-2">Existing Tips & Reminders</h3>
        <div class="space-y-3">
            @if($tips->isEmpty())
                <div class="text-sm text-gray-500">No tips found. Create one using the form above.</div>
            @else
                @foreach($tips as $index => $tip)
                <div class="border rounded p-3 w-full max-w-none">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="font-semibold">{{ $tip->title }}</div>
                            <div class="text-sm text-gray-700 mt-1">{!! $tip->content !!}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                Status: <span class="{{ $tip->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $tip->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <button @click="openEditModal(@json($tip), {{ $index }})" class="text-xs text-blue-700 underline">Edit</button>
                            <button @click="openDeleteModal(@json($tip), {{ $index }})" class="text-xs bg-red-600 text-white px-2 py-1 rounded text-xs">Delete</button>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $tips->links() }}
                </div>
            @endif
        </div>

        <!-- Edit Modal -->
        <div id="tip-edit-modal" x-show="editing.show" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div x-transition.origin-top.duration.200ms class="bg-white rounded p-6 w-full max-w-2xl" @keydown.window.escape="closeEdit()" role="dialog" aria-modal="true">
                <h3 class="text-lg font-semibold mb-3">Edit Tip</h3>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input x-model="editing.title" class="w-full border rounded px-2 py-1" />
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-1">Content</label>
                    <textarea x-model="editing.content" class="w-full border rounded px-2 py-1" rows="6"></textarea>
                </div>
                <div class="mb-3">
                    <label class="flex items-center">
                        <input type="checkbox" x-model="editing.is_active" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">Active</span>
                    </label>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <button @click="closeEdit()" class="px-3 py-1 border rounded">Cancel</button>
                    <button @click="saveEdit()" class="px-3 py-1 bg-green-700 text-white rounded">Save</button>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="tip-delete-modal" x-show="deleting.show" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div x-transition.origin-top.duration.200ms class="bg-white rounded p-6 w-full max-w-md" @keydown.window.escape="closeDelete()" role="dialog" aria-modal="true">
                <h3 class="text-lg font-semibold mb-3">Confirm Delete</h3>
                <div class="mb-4 text-sm text-gray-700">Are you sure you want to delete the following tip?</div>
                <div class="mb-4 p-3 bg-gray-50 rounded">
                    <div class="font-semibold mb-1" x-text="deleting.title"></div>
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

window.tipForm = function(){
    return {
        title: '',
        content: '',
        is_active: true,
        async submit(){
            try{
                const res = await fetch('{{ route('employee.marketing.tips.store') }}', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ 
                        title: this.title, 
                        content: this.content,
                        is_active: this.is_active 
                    })
                });
                if(res.ok){ 
                    const d = await res.json(); 
                    if(d.success){
                        window.dispatchEvent(new CustomEvent('tip-created', { detail: d.tip }));
                        window.dispatchEvent(new CustomEvent('notify', { 
                            detail: { message: 'Tip created successfully', type: 'success' }
                        }));
                        this.title = '';
                        this.content = '';
                        this.is_active = true;
                        return;
                    } 
                }
                console.error('Create tip failed');
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Failed to create tip', type: 'error' }
                }));
            } catch(e){ 
                console.error(e); 
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Error creating tip', type: 'error' }
                }));
            }
        }
    };
};

window.tips = function(){
    return {
        init(){
            try{
                window.addEventListener('tip-created', (e)=>{ 
                    if(e && e.detail){ 
                        // Refresh the page to show updated list with pagination
                        window.location.reload();
                    } 
                });
            }catch(e){ console.error('tip init listener error', e) }
        },
        editing: { show: false, id: null, title: '', content: '', is_active: true, index: null },
        deleting: { show: false, id: null, title: '', index: null },

        openEditModal(tip, idx){
            this.editing = { 
                show: true, 
                id: tip.id, 
                title: tip.title, 
                content: tip.content,
                is_active: tip.is_active, 
                index: idx 
            };
        },
        closeEdit(){ 
            this.editing.show = false; 
        },
        async saveEdit(){
            try{
                const id = this.editing.id;
                const payload = { 
                    title: this.editing.title, 
                    content: this.editing.content,
                    is_active: this.editing.is_active 
                };
                const res = await fetch('/employee/marketing/tips/'+id, {
                    method: 'PUT',
                    credentials: 'same-origin',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json' 
                    },
                    body: JSON.stringify(payload)
                });
                if(res.ok){
                    const d = await res.json();
                    if(d.success){
                        this.closeEdit();
                        window.dispatchEvent(new CustomEvent('notify', { 
                            detail: { message: 'Tip updated successfully', type: 'success' }
                        }));
                        // Reload to update pagination
                        window.location.reload();
                        return;
                    }
                }
                console.error('Update tip failed');
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Failed to update tip', type: 'error' }
                }));
            }catch(e){ 
                console.error(e); 
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Error updating tip', type: 'error' }
                }));
            }
        },

        openDeleteModal(tip, idx){
            this.deleting = { 
                show: true, 
                id: tip.id, 
                title: tip.title, 
                index: idx 
            };
        },
        closeDelete(){ 
            this.deleting.show = false; 
        },
        async confirmDelete(){
            try{
                const id = this.deleting.id;
                const res = await fetch('/employee/marketing/tips/'+id, {
                    method: 'DELETE',
                    credentials: 'same-origin',
                    headers: { 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json' 
                    }
                });
                if(res.ok){
                    this.closeDelete();
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { message: 'Tip deleted successfully', type: 'success' }
                    }));
                    // Reload to update pagination
                    window.location.reload();
                    return;
                }
                console.error('Delete tip failed');
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Failed to delete tip', type: 'error' }
                }));
            }catch(e){ 
                console.error(e); 
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { message: 'Error deleting tip', type: 'error' }
                }));
            }
        }
    };
};
</script>
@endpush