@extends('layouts.ecommerce')
@section('content')
<div class="py-8 w-full">
    <!-- Search Bar -->
    <!-- Removed duplicate search bar -->
    <div class="flex flex-col items-center justify-center mb-8 w-full">
        <form x-data="searchBar()" @submit.prevent="onSearch" class="w-full flex flex-col items-center">
            <div class="relative w-full flex items-center">
                <input type="text" x-model="query" @focus="showSuggestions = true" @input="onInput" @keydown.escape="showSuggestions = false" placeholder="Search products, orders, etc..." class="w-full border border-green-300 rounded px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-orange-400 text-lg" autocomplete="off" style="position:relative;">
                <button type="button" x-show="query.length" @click="clearQuery" class="absolute right-28 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none bg-transparent p-2" style="z-index:2;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                <button type="submit" class="ml-2 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded transition">Search</button>
                <div x-show="showSuggestions && (suggestions.length || recent.length)" @mousedown.away="showSuggestions = false" class="absolute left-0 top-full mt-1 w-full bg-white border border-gray-200 rounded shadow z-20" style="max-width:600px;">
                    <template x-if="recent.length">
                        <div class="px-4 py-2 text-xs text-gray-500 border-b">Recent Searches</div>
                    </template>
                    <template x-for="item in recent" :key="item">
                        <div @click="selectSuggestion(item)" class="px-4 py-2 cursor-pointer hover:bg-orange-50">@{{ item }}</div>
                    </template>
                    <template x-if="suggestions.length">
                        <div class="px-4 py-2 text-xs text-gray-500 border-b">Product Suggestions</div>
                    </template>
                    <template x-for="item in suggestions" :key="item">
                        <div @click="selectSuggestion(item)" class="px-4 py-2 cursor-pointer hover:bg-orange-50" x-text="item"></div>
                    </template>
                </div>
            </div>
        </form>
        <div class="mt-6 text-center">
            <h1 class="text-3xl font-bold text-green-800 mb-2">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-700">Browse and request products from <span class="text-orange-600 font-semibold">Gemarc Enterprises Inc.</span></p>
        </div>
        <a href="{{ route('shop.index') }}" class="mt-4 bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded shadow transition">Shop All Products</a>
    </div>
<style>
    .relative.w-full.flex.items-center {
        max-width: 600px;
    }
    .relative.w-full.flex.items-center input {
        padding-right: 2.5rem;
    }
    .relative.w-full.flex.items-center .clear-btn {
        right: 2.5rem;
        top: 50%;
        transform: translateY(-50%);
        position: absolute;
        z-index: 2;
    }
    .relative.w-full.flex.items-center .absolute.left-0.top-full.mt-1.w-full.bg-white {
        max-width: 600px;
        left: 0;
        right: 0;
    }
    @media (max-width: 700px) {
        .relative.w-full.flex.items-center {
            max-width: 100%;
        }
        .relative.w-full.flex.items-center .absolute.left-0.top-full.mt-1.w-full.bg-white {
            max-width: 100%;
        }
    }
</style>
@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function searchBar() {
    return {
        query: '',
        showSuggestions: false,
        recent: JSON.parse(localStorage.getItem('recentSearches') || '[]'),
        suggestions: [],
        allProducts: [
            @foreach(\App\Models\Product::where('is_active', true)->pluck('name') as $p)
                @json($p),
            @endforeach
        ],
        onInput() {
            this.suggestions = this.allProducts.filter(p => p.toLowerCase().includes(this.query.toLowerCase()) && this.query.length > 0).slice(0, 5);
        },
        onSearch() {
            if (this.query.trim()) {
                this.recent = [this.query, ...this.recent.filter(q => q !== this.query)].slice(0, 5);
                localStorage.setItem('recentSearches', JSON.stringify(this.recent));
                // Optionally redirect or trigger search
                window.location.href = '/shop?search=' + encodeURIComponent(this.query);
            }
        },
        selectSuggestion(item) {
            this.query = item;
            this.showSuggestions = false;
            this.onSearch();
        },
        clearQuery() {
            this.query = '';
            this.suggestions = [];
        }
    }
}
</script>
<script>
function faqList(){
    return {
        faqs: [],
        loading: false,
        error: null,
        async load(){
            this.loading = true;
            try{
                let url = (window.location.origin || '') + '/api/faqs';
                let res = await fetch(url, { credentials: 'same-origin' });
                if(res.ok){ this.faqs = await res.json(); this.faqs.forEach(f=>f.open=false); this.error = null; }
                else {
                    const txt = await res.text();
                    console.error('Failed loading /api/faqs', res.status, txt);
                    this.error = `Failed to load FAQs (status ${res.status}). Check console/network.`;
                }
            }catch(e){ console.error(e); this.error = 'Network error while loading FAQs (check console)'; }
            this.loading = false;
        },
        toggle(i){ this.faqs[i].open = !this.faqs[i].open }
    }
}

function reminders(){
    return {
        tips: [
            { id: 'cart', title: "Don't forget your cart", text: 'You have items in your cart — check them before they run out of stock.', dismissed: false },
            { id: 'profile', title: 'Update your profile', text: 'Add company and billing details to speed up checkout for future orders.', dismissed: false },
            { id: 'reorder', title: 'Reorder often-used items', text: 'Use Saved Lists to quickly create repeat orders for frequently purchased products.', dismissed: false },
        ],
        init(){
            this.tips.forEach(t => { t.dismissed = localStorage.getItem('tip_'+t.id+'_dismissed') === '1' });
        },
        dismiss(id){ const t = this.tips.find(x=>x.id===id); if(t){ t.dismissed = true; localStorage.setItem('tip_'+id+'_dismissed','1') } },
        remindLater(id){ /* simple implementation: just hide for now and set a short timer */ const key = 'tip_'+id+'_remind_at'; localStorage.setItem(key, Date.now()+7*24*60*60*1000); this.dismiss(id) }
    }
}

function polls(){
    return {
        polls: [],
        idx: 0,
        selected: null,
        voted: false,
        loading: false,
        get current(){ return this.polls[this.idx] || { question: '', options: [] } },
        get currentTotal(){ return this.current.options ? this.current.options.reduce((a,o)=>a+(o.votes||0),0) : 0 },
        async init(){ await this.load(); this.voted = false; },
        async load(){
            this.loading = true;
            try{
                const res = await fetch('/api/polls');
                if(res.ok){
                    const data = await res.json();
                    // normalize
                    this.polls = data.map(p => ({ id: p.id, question: p.question, options: p.options.map(o => ({ id: o.id, text: o.text, votes: o.votes_count })) }));
                    this.idx = 0;
                }
            }catch(e){ console.error(e) }
            this.loading = false;
        },
        next(){ if(this.idx < this.polls.length-1) this.idx++; else this.idx = 0; this.selected = null; this.voted = false },
        async submit(){
            if(!this.selected) return alert('Please select an option');
            try{
                const res = await fetch('/polls/'+this.current.id+'/vote', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ option_id: this.selected })
                });
                if(res.ok){
                    // refresh polls to get latest counts
                    await this.load();
                    this.voted = true;
                } else {
                    const data = await res.json();
                    alert(data.message || 'Failed to submit vote');
                }
            }catch(e){ console.error(e); alert('Error voting'); }
        }
    }
}
</script>
@endpush
    <!-- Centered Request a Quote and Recent Orders section -->
    <div class="flex flex-col items-center justify-center w-full mb-8">
        <div class="flex flex-col md:flex-row gap-6 w-full justify-center">
            <!-- Create/Request Quote -->
            <div class="bg-white rounded-xl shadow p-4 flex flex-col flex-1 min-w-[260px] max-w-[350px] items-center">
                <div class="text-lg font-bold text-green-800 mb-2 flex items-center gap-2">📝 Request a Quote</div>
                <a href="{{ route('quotes.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded font-semibold w-max">Create Quote</a>
            </div>
            <!-- Recent Orders -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col flex-1 min-w-[260px] max-w-[350px] items-center">
                <div class="text-lg font-bold text-green-800 mb-2">Your Recent Orders</div>
                <ul class="divide-y w-full">
                    @forelse ($recentOrders as $o)
                        <li class="flex items-center justify-between py-4">
                            <div>
                                <div class="font-semibold">#{{ $o->id }} · {{ $o->created_at->format('Y-m-d') }}</div>
                                <div class="text-xs text-gray-500">{{ ucfirst($o->status) }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold text-gray-800">₱{{ number_format($o->total_amount,2) }}</div>
                                <a href="{{ route('orders.show',$o) }}" class="text-green-700 hover:underline text-xs ml-2">View</a>
                            </div>
                        </li>
                    @empty
                        <li class="py-4 text-gray-400">No orders yet.</li>
                    @endforelse
                </ul>
            </div>
            <!-- Company Brochure -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col flex-1 min-w-[260px] max-w-[350px] items-center">
                <div class="text-lg font-bold text-green-800 mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Download our company brochure here
                </div>
                <a href="/GEMARC%202026%20brochurePDF.pdf" class="text-orange-600 hover:underline font-semibold" target="_blank">Gemarc Enterprises Incorporated Company Brochure (PDF)</a>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-lg font-bold text-orange-600 mb-2">Recommended for You</div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-full">
            @forelse ($recommendedProducts as $product)
                <div class="bg-gray-50 rounded-xl shadow flex flex-col items-center p-2 min-h-[120px]">
                    @php $img = $product->firstImagePath(); @endphp
                    @if($img)
                        <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" class="mb-1 rounded max-h-20 object-contain">
                    @else
                        <img src="/images/gemarclogo.png" alt="No Image" class="mb-1 rounded max-h-20 object-contain">
                    @endif
                    <div class="font-semibold text-green-900 text-xs text-center line-clamp-2">{{ $product->name }}</div>
                    <div class="text-orange-600 font-bold text-xs">₱{{ number_format($product->unit_price,2) }}</div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 py-8">No recommended products.</div>
            @endforelse
        </div>
    </div>

    <!-- Interactive homepage additions: FAQ, Tips/Reminders, Poll -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- FAQ (loaded from server) -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-lg font-bold text-green-800 mb-4">Frequently Asked Questions</div>
            <div x-data="faqList()" x-init="load()" class="space-y-2">
                <template x-if="loading">
                    <div class="text-sm text-gray-500">Loading...</div>
                </template>
                <template x-for="(item, idx) in faqs" :key="item.id">
                    <div class="border rounded p-3">
                        <button @click="toggle(idx)" class="w-full text-left flex items-start justify-between gap-4">
                            <div>
                                <div class="font-semibold text-gray-800" x-text="item.question"></div>
                            </div>
                            <svg :class="item.open ? 'transform rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="item.open" x-transition class="mt-2 text-sm text-gray-600" x-html="item.answer"></div>
                    </div>
                </template>
                <template x-if="!loading && faqs.length === 0">
                    <div class="text-gray-400">No FAQs available at the moment.</div>
                </template>
                <template x-if="error">
                    <div class="text-sm text-red-600"> <span x-text="error"></span> <button @click="load()" class="ml-2 text-xs underline">Retry</button></div>
                </template>
            </div>
        </div>

        <!-- Tips / Reminders (realistic, persisted locally) -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-3">
                <div class="text-lg font-bold text-green-800">Tips & Reminders</div>
                <button @click="$dispatch('close-tips')" class="text-xs text-gray-400 hover:text-gray-600">Dismiss</button>
            </div>
            <div x-data="reminders()" x-init="init()">
                <template x-for="tip in tips" :key="tip.id">
                    <div x-show="!tip.dismissed" class="flex items-start gap-3 py-2 border-b last:border-b-0">
                        <div class="w-8 h-8 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center font-semibold">!</div>
                        <div class="flex-1">
                            <div class="text-sm text-gray-700 font-medium" x-text="tip.title"></div>
                            <div class="text-sm text-gray-600 mt-1" x-text="tip.text"></div>
                            <div class="mt-2">
                                <button @click="dismiss(tip.id)" class="text-xs text-green-700 hover:underline">Got it</button>
                                <button @click="remindLater(tip.id)" class="ml-3 text-xs text-gray-500 hover:underline">Remind me later</button>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="text-xs text-gray-400 mt-3">Tips are stored locally. Clear browser storage or account data to restore.</div>
            </div>
        </div>

        <!-- Interactive Poll / Survey (server-backed; multiple polls + navigation) -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-lg font-bold text-green-800">Quick Poll</div>
                <div class="text-sm text-gray-500">Participate & help us improve</div>
            </div>
            <div x-data="polls()" x-init="init()">
                <template x-if="loading">
                    <div class="text-sm text-gray-500">Loading polls...</div>
                </template>

                <template x-if="!loading && polls.length">
                    <div class="text-sm text-gray-700 mb-3 font-medium" x-text="current.question"></div>

                    <template x-if="!voted">
                        <div>
                            <template x-for="(opt, idx) in current.options" :key="opt.id">
                                <label class="flex items-center gap-3 mb-2 cursor-pointer">
                                    <input type="radio" :value="opt.id" x-model="selected" class="form-radio text-orange-500" />
                                    <span class="text-sm text-gray-700" x-text="opt.text"></span>
                                </label>
                            </template>
                            <div class="mt-3 flex items-center gap-2">
                                <button @click="submit()" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">Vote</button>
                                <button @click="next()" class="text-sm text-gray-500 underline">Next poll</button>
                            </div>
                        </div>
                    </template>

                    <template x-if="voted">
                        <div class="space-y-2">
                            <div class="text-xs text-gray-500">Results (total: <span x-text="currentTotal"></span>)</div>
                            <template x-for="opt in current.options" :key="opt.id">
                                <div>
                                    <div class="flex items-center justify-between text-sm mb-1">
                                        <div x-text="opt.text"></div>
                                        <div class="text-xs text-gray-600" x-text="opt.votes + ' votes'"></div>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded h-3">
                                        <div class="bg-orange-500 h-3 rounded" :style="'width: ' + (currentTotal ? (opt.votes/currentTotal*100) : 0) + '%' "></div>
                                    </div>
                                </div>
                            </template>
                            <div class="mt-2">
                                <button @click="next()" class="text-sm text-green-700 hover:underline">Next poll</button>
                            </div>
                        </div>
                    </template>
                </template>

                <template x-if="!loading && polls.length === 0">
                    <div class="text-gray-400">No polls available right now.</div>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection
