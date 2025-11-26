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

        init() {
            // lock/unlock body scroll pag open/close modal
            this.$watch('show', (value) => {
                document.body.classList.toggle('overflow-hidden', value);
            });
        },

        openModal(product) {
            this.modalProduct = {
                ...product,
                price: product.unit_price
            };
            this.show = true;
        },
        close() { this.show = false; }
    }
}

function toastNotification() {
    return {
        toasts: [],
        showToast(message, type = 'success') {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            setTimeout(() => this.removeToast(id), 3000);
        },
        removeToast(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }
}

// Function to show toast from forms
function showToast(message, type = 'success') {
    if (window.toastData) {
        window.toastData.showToast(message, type);
    }
}

// AJAX function to save product (now accepts event param)
async function saveProduct(productId, productName, e) {
    const target = e?.target;
    if (target) target.disabled = true;

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
            setTimeout(() => window.location.reload(), 1500);
        } else {
            showToast('Failed to save product. Please try again.', 'error');
            if (target) target.disabled = false;
        }
    } catch (error) {
        console.error('Save error:', error);
        showToast('Network error. Please check your connection.', 'error');
        if (target) target.disabled = false;
    }
}

// AJAX function to unsave product (now accepts event param)
async function unsaveProduct(savedItemId, productName, e) {
    const target = e?.target;
    if (target) target.disabled = true;

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
            setTimeout(() => window.location.reload(), 1500);
        } else {
            showToast('Failed to unsave product. Please try again.', 'error');
            if (target) target.disabled = false;
        }
    } catch (error) {
        console.error('Unsave error:', error);
        showToast('Network error. Please check your connection.', 'error');
        if (target) target.disabled = false;
    }
}
</script>
@endpush

@section('content')
<!-- Toast Notification Container -->
<div x-data="toastNotification()" x-init="window.toastData = $data"
     class="fixed top-20 right-4 z-[9999] space-y-2 w-80" x-cloak>
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
                        <svg x-show="toast.type === 'success'" class="h-6 w-6 text-green-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="toast.type === 'error'" class="h-6 w-6 text-red-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900" x-text="toast.message"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="removeToast(toast.id)"
                                class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<div class="py-8"
     x-data="productModal()"
     x-init="init()"
     x-cloak
     @keydown.window.escape="close()">

    <div class="flex flex-col items-center justify-center mb-8">
        <h1 class="text-3xl font-bold text-green-800 mb-2">Shop All Products</h1>
        <p class="text-gray-700 mb-4">
            Browse all products offered by
            <span class="text-orange-600 font-semibold">Gemarc Enterprises Inc.</span>
        </p>

        {{-- SEARCH + SUGGESTIONS --}}
        <div
            x-data="{
                search: '{{ addslashes($q ?? '') }}',
                suggestions: [],
                showSuggestions: false,
                async fetchSuggestions() {
                    if (this.search.trim().length < 1) {
                        this.suggestions = [];
                        this.showSuggestions = false;
                        return;
                    }
                    try {
                        const res = await fetch('{{ route('shop.suggest') }}?q=' + encodeURIComponent(this.search));
                        if (res.ok) {
                            this.suggestions = await res.json();
                            this.showSuggestions = this.suggestions.length > 0;
                        }
                    } catch (e) {
                        console.error(e);
                    }
                },
                selectSuggestion(s) {
                    this.search = s.name;
                    this.showSuggestions = false;
                    $nextTick(() => {
                        $el.querySelector('form').dispatchEvent(
                            new Event('submit', { bubbles: true, cancelable: true })
                        );
                    });
                }
            }"
            class="w-full max-w-xl flex flex-col gap-2 justify-center relative">

            <form class="flex gap-2 w-full"
                  method="GET"
                  action="{{ route('shop.index') }}"
                  @submit.prevent="window.location='{{ route('shop.index') }}'+(search ? ('?q='+encodeURIComponent(search)) : '')">
                <input type="text"
                       name="q"
                       x-model="search"
                       autocomplete="off"
                       @input.debounce.300ms="fetchSuggestions"
                       @focus="fetchSuggestions"
                       @blur="setTimeout(() => showSuggestions = false, 150)"
                       class="border border-green-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-orange-400"
                       placeholder="Search products...">
                <button type="submit"
                        class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 font-semibold">
                    Search
                </button>
                <template x-if="search">
                    <button type="button"
                            @click="search=''; window.location='{{ route('shop.index') }}'"
                            class="bg-gray-200 text-gray-700 px-3 py-2 rounded hover:bg-gray-300 font-semibold">
                        Clear
                    </button>
                </template>
            </form>

            {{-- Suggestions dropdown --}}
            <div x-show="showSuggestions"
                 x-transition
                 class="absolute left-0 top-full mt-1 w-full bg-white border border-gray-200 rounded shadow z-30"
                 @mousedown.prevent>
                <template x-for="s in suggestions" :key="s.id">
                    <div @click="selectSuggestion(s)"
                         class="px-4 py-2 cursor-pointer hover:bg-orange-50 text-sm text-gray-800">
                        <span x-text="s.name"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div>
        {{-- PRODUCT GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                @php
                    $img      = $product->firstImagePath();
                    $imgUrl   = $img ? asset('storage/' . $img) : '/images/gemarclogo.png';

                    $alreadySaved = false;
                    $savedItemId  = null;
                    $user         = auth()->user();

                    if ($user) {
                        $savedListIds = \App\Models\SavedList::where('user_id', $user->id)->pluck('id');
                        $alreadySaved = \App\Models\SavedListItem::whereIn('saved_list_id', $savedListIds)
                            ->where('product_id', $product->id)
                            ->exists();

                        if ($alreadySaved) {
                            $savedItem   = \App\Models\SavedListItem::whereIn('saved_list_id', $savedListIds)
                                ->where('product_id', $product->id)
                                ->first();
                            $savedItemId = $savedItem?->id;
                        }
                    }

                    $productData = [
                        'id'            => $product->id,
                        'name'          => $product->name,
                        'description'   => $product->description,
                        'unit_price'    => $product->unit_price,
                        'image'         => $imgUrl,
                        'stock'         => $product->stock,
                        'already_saved' => $alreadySaved,
                        'saved_item_id' => $savedItemId,
                    ];
                @endphp

                <div
                    class="bg-white rounded-xl shadow flex flex-col h-full min-h-[370px] cursor-pointer"
                    data-product='@json($productData)'
                    @click="openModal(JSON.parse($el.getAttribute('data-product')))">

                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center rounded-t-xl overflow-hidden">
                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="max-h-36 object-contain">
                    </div>

                    <div class="p-4 flex flex-col flex-1 w-full">
                        <div class="font-bold text-green-800 text-lg mb-1 line-clamp-1">
                            {{ $product->name }}
                        </div>
                        <div class="text-gray-600 text-sm mb-2 line-clamp-2">
                            {{ $product->description }}
                        </div>
                        <div class="text-xs text-gray-500 mb-2">
                            <span class="font-semibold">Stock:</span> {{ $product->stock ?? 0 }}
                        </div>

                        <div class="mt-auto flex gap-2 justify-center">
                            <div class="flex gap-2">
                                @auth
                                    @if(!$alreadySaved)
                                        <button
                                            @click.stop="saveProduct({{ $product->id }}, '{{ $product->name }}', $event)"
                                            class="bg-blue-500 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-blue-600"
                                            title="Save Product">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 mr-1"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 5v14l7-7 7 7V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                                            </svg>
                                            Save
                                        </button>
                                    @else
                                        @if($savedItemId)
                                            <button
                                                @click.stop="unsaveProduct({{ $savedItemId }}, '{{ $product->name }}', $event)"
                                                class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm font-semibold hover:bg-blue-200"
                                                title="Unsave Product">
                                                Unsave
                                            </button>
                                        @else
                                            <span
                                                class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm font-semibold"
                                                title="Already Saved">
                                                Saved
                                            </span>
                                        @endif
                                    @endif
                                @endauth

                                @if($product->stock > 0)
                                    <form method="POST" action="{{ route('cart.add') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button @click.stop type="submit"
                                                class="bg-green-600 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-green-700">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <span
                                        class="bg-gray-400 text-white px-3 py-1 rounded text-sm font-semibold cursor-not-allowed">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 py-12">
                    No products found.
                </div>
            @endforelse
        </div>

        {{-- MODAL --}}
        <div x-cloak
             x-show="show"
             x-transition.opacity.duration.250ms
             class="fixed inset-0 z-[9998] flex items-center justify-center bg-black/40 px-4"
             @click.self="close()">

            <!-- WHITE MODAL BOX -->
            <div
                x-show="show"
                x-transition:enter="transform ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transform ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="relative bg-white rounded-xl shadow-lg max-w-4xl w-full p-6 md:p-8">

                {{-- CLOSE BUTTON – upper right of the white modal --}}
                <button
                    @click.stop="close()"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl leading-none z-[10000]">
                    &times;
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-stretch">
                    {{-- LEFT: BIG IMAGE --}}
                    <div class="flex items-center justify-center">
                        <div class="w-full h-full bg-gray-100 rounded-lg flex items-center justify-center p-4">
                            <img :src="modalProduct.image" alt=""
                                 class="max-h-[430px] w-full object-contain rounded">
                        </div>
                    </div>

                    {{-- RIGHT: DETAILS --}}
                    <div class="flex flex-col h-full">
                        <div>
                            <h2 class="font-bold text-green-800 text-2xl md:text-3xl mb-3"
                                x-text="modalProduct.name"></h2>

                            {{-- WALANG PRICE SA MODAL --}}
                            <p class="text-gray-700 mb-6 text-sm md:text-base leading-relaxed"
                               x-text="modalProduct.description"></p>
                        </div>

                        <div class="flex flex-wrap items-center gap-4 mt-2 mb-2">
                            <div class="text-xs text-gray-500 mb-2">
                                <span class="font-semibold">Stock:</span>
                                <span x-text="modalProduct.stock ?? 0"></span>
                            </div>

                            {{-- SAVE / UNSAVE SA MODAL --}}
                            @auth
                                <template x-if="!modalProduct.already_saved">
                                    <button
                                        @click.stop="saveProduct(modalProduct.id, modalProduct.name, $event)"
                                        class="border border-blue-500 text-blue-600 bg-white px-5 py-2.5 rounded font-semibold text-sm md:text-base hover:bg-blue-50 focus:ring-2 focus:ring-blue-200 transition">
                                        Save
                                    </button>
                                </template>

                                <template x-if="modalProduct.already_saved">
                                    <template x-if="modalProduct.saved_item_id">
                                        <button
                                            @click.stop="unsaveProduct(modalProduct.saved_item_id, modalProduct.name, $event)"
                                            class="border border-blue-300 text-blue-700 bg-blue-50 px-5 py-2.5 rounded font-semibold text-sm md:text-base hover:bg-blue-100 focus:ring-2 focus:ring-blue-200 transition">
                                            Unsave
                                        </button>
                                    </template>
                                    <template x-if="!modalProduct.saved_item_id">
                                        <span
                                            class="border border-blue-200 text-blue-400 bg-blue-50 px-5 py-2.5 rounded font-semibold text-sm md:text-base cursor-not-allowed">
                                            Saved
                                        </span>
                                    </template>
                                </template>
                            @endauth

                            {{-- ADD TO CART / OUT OF STOCK --}}
                            <template x-if="modalProduct.stock > 0">
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" :value="modalProduct.id">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                            class="bg-green-600 text-white px-5 py-2.5 rounded font-semibold text-sm md:text-base hover:bg-green-700 focus:ring-2 focus:ring-green-200 transition">
                                        Add to Cart
                                    </button>
                                </form>
                            </template>

                            <template x-if="modalProduct.stock == 0">
                                <button
                                    class="bg-gray-400 text-white px-5 py-2.5 rounded font-semibold cursor-not-allowed text-sm md:text-base"
                                    disabled>
                                    Out of Stock
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Pagination --}}
    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>
    @endif

    <div class="mt-8 text-sm text-gray-500 text-center">
        <span class="text-green-800 font-semibold">Gemarc Enterprises Inc.</span>
        is an authorized distributor of select partner brands. All products are curated for quality and reliability.
    </div>
</div>
@endsection