@section('title', 'All Products | Gemarc Enterprises Inc.')
@extends('layouts.ecommerce')

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>[x-cloak]{display:none!important}</style>
<script>
function productModal() {
    return {
        show: false,
        modalProduct: { name: '', price: 0, description: '', image: '' },
        openModal(product) {
            this.modalProduct = {
                ...product,
                price: product.unit_price
            };
            this.show = true;
        },
        close(){ this.show = false; }
    }
}

function toastNotification() {
    return {
        toasts: [],
        showToast(message, type = 'success') {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            setTimeout(() => {
                this.removeToast(id);
            }, 3000);
        },
        removeToast(id) {
            this.toasts = this.toasts.filter(toast => toast.id !== id);
        }
    }
}

// Function to show toast from forms
function showToast(message, type = 'success') {
    if (window.toastData) {
        window.toastData.showToast(message, type);
    }
}

// AJAX function to save product
async function saveProduct(productId, productName) {
    // Prevent multiple clicks
    event.target.disabled = true;
    
    try {
        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        const response = await fetch('{{ route("saved.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        });

        if (response.ok) {
            showToast(`"${productName}" has been saved to your list!`, 'success');
            // Reload page to update button state
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showToast('Failed to save product. Please try again.', 'error');
            event.target.disabled = false;
        }
    } catch (error) {
        showToast('Network error. Please check your connection.', 'error');
        console.error('Save error:', error);
        event.target.disabled = false;
    }
}

// AJAX function to unsave product
async function unsaveProduct(savedItemId, productName) {
    // Prevent multiple clicks
    event.target.disabled = true;
    
    try {
        const formData = new FormData();
        formData.append('_method', 'DELETE');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        const response = await fetch(`/saved/${savedItemId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        });

        if (response.ok || response.status === 302) {
            showToast(`"${productName}" has been removed from your saved list!`, 'success');
            // Reload page to update button state
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showToast('Failed to unsave product. Please try again.', 'error');
            event.target.disabled = false;
        }
    } catch (error) {
        showToast('Network error. Please check your connection.', 'error');
        console.error('Unsave error:', error);
        event.target.disabled = false;
    }
}
</script>
@endpush

@section('content')
<!-- Toast Notification Container -->
<div x-data="toastNotification()" x-init="window.toastData = $data" class="fixed top-20 right-4 z-[9999] space-y-2 w-80" x-cloak>
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="true" 
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-x-full opacity-0"
             x-transition:enter-end="translate-x-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0 opacity-100"
             x-transition:leave-end="translate-x-full opacity-0"
             class="w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg x-show="toast.type === 'success'" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="toast.type === 'error'" class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900" x-text="toast.message"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="removeToast(toast.id)" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8">
        <h1 class="text-3xl font-bold text-green-800 mb-2">Shop All Products</h1>
        <p class="text-gray-700 mb-4">Browse all products offered by <span class="text-orange-600 font-semibold">Gemarc Enterprises Inc.</span></p>
        <div x-data="{ search: '{{ addslashes($q ?? '') }}' }" class="w-full max-w-xl flex gap-2 justify-center">
            <form class="flex gap-2 w-full" method="GET" action="{{ route('shop.index') }}" @submit.prevent="window.location='{{ route('shop.index') }}'+(search ? ('?q='+encodeURIComponent(search)) : '')">
                <input type="text" name="q" x-model="search" class="border border-green-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-orange-400" placeholder="Search products...">
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">Search</button>
                <template x-if="search">
                    <button type="button" @click="search=''; window.location='{{ route('shop.index') }}'" class="bg-gray-200 text-gray-700 px-3 py-2 rounded hover:bg-gray-300 font-semibold">Clear</button>
                </template>
            </form>
        </div>
    </div>

    <div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                @php
                    $img = $product->firstImagePath();
                    $imgUrl = $img ? asset('storage/' . $img) : '/images/gemarclogo.png';
                @endphp
                <div
                    class="bg-white rounded-xl shadow flex flex-col h-full min-h-[370px]">

                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center rounded-t-xl overflow-hidden">
                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="max-h-36 object-contain">
                    </div>
                    <div class="p-4 flex flex-col flex-1 w-full">
                        <div class="font-bold text-green-800 text-lg mb-1 line-clamp-1">{{ $product->name }}</div>
                        <div class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $product->description }}</div>
                        <div class="mt-auto flex gap-2 justify-center">
                            <div class="flex gap-2">
                                @auth
                                    @php
                                        $alreadySaved = false;
                                        $user = auth()->user();
                                        if ($user) {
                                            $savedListIds = \App\Models\SavedList::where('user_id', $user->id)->pluck('id');
                                            $alreadySaved = \App\Models\SavedListItem::whereIn('saved_list_id', $savedListIds)->where('product_id', $product->id)->exists();
                                        }
                                    @endphp
                                    @if(!$alreadySaved)
                                        <button onclick="saveProduct({{ $product->id }}, '{{ $product->name }}')" 
                                                class="bg-blue-500 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-blue-600" title="Save Product">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-7 7 7V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" /></svg>
                                            Save
                                        </button>
                                    @else
                                        @php
                                            $savedItemId = null;
                                            if ($user) {
                                                $savedItem = \App\Models\SavedListItem::whereIn('saved_list_id', $savedListIds)
                                                    ->where('product_id', $product->id)
                                                    ->first();
                                                $savedItemId = $savedItem ? $savedItem->id : null;
                                            }
                                        @endphp
                                        @if($savedItemId)
                                            <button onclick="unsaveProduct({{ $savedItemId }}, '{{ $product->name }}')" 
                                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm font-semibold hover:bg-blue-200" title="Unsave Product">
                                                Unsave
                                            </button>
                                        @else
                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm font-semibold" title="Already Saved">Saved</span>
                                        @endif
                                    @endif
                                @endauth
                                @if($product->stock > 0)
                                    <form method="POST" action="{{ route('cart.add') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-green-700">Add to Cart</button>
                                    </form>
                                @else
                                    <span class="bg-gray-400 text-white px-3 py-1 rounded text-sm font-semibold cursor-not-allowed">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 py-12">No products found.</div>
            @endforelse
        </div>

        <div x-cloak x-show="show" x-transition
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
            <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
                <button @click="close()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
                <div class="flex flex-col items-center">
                    <img :src="modalProduct.image" alt="" class="mb-4 rounded max-h-48 object-contain bg-gray-100 w-full">
                    <div class="font-bold text-green-800 text-2xl mb-2" x-text="modalProduct.name"></div>
                    <div class="text-orange-600 font-bold text-xl mb-2"
                         x-text="'₱' + Number(modalProduct.price).toLocaleString(undefined, {minimumFractionDigits:2})"></div>
                    <div class="text-gray-700 mb-4 text-center" x-text="modalProduct.description"></div>
                    <div class="flex gap-2">
                        <template x-if="modalProduct.stock > 0">
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" :value="modalProduct.id">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded font-semibold hover:bg-green-700">Add to Cart</button>
                            </form>
                        </template>
                        <template x-if="modalProduct.stock == 0">
                            <button class="bg-gray-400 text-white px-4 py-2 rounded font-semibold cursor-not-allowed" disabled>Out of Stock</button>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-8 text-sm text-gray-500 text-center">
        <span class="text-green-800 font-semibold">Gemarc Enterprises Inc.</span> is an authorized distributor of select partner brands. All products are curated for quality and reliability.
    </div>
</div>
@endsection
