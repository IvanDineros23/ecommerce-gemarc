@extends('layouts.ecommerce')
@section('content')
<!-- Toast Notifications -->
<div x-data="toast()" 
    class="fixed top-4 right-4 z-[9999] flex flex-col items-end space-y-4"
    style="min-width: 300px; right: 1rem;"
    @notify.window="show($event.detail.message, $event.detail.type)">
    <template x-for="(toast, index) in toasts" :key="index">
        <div x-show="toast.visible"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transform ease-in duration-200 transition"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
            style="z-index: 9999;">
            <div class="p-4">
                <div class="flex items-center">
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
                        <template x-if="toast.type === 'info'">
                            <svg class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </template>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <p x-text="toast.message" class="text-sm text-gray-500"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="remove(index)" class="rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

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
function toast() {
    return {
        toasts: [],
        visible: true,
        show(message, type = 'info') {
            const id = Date.now();
            this.toasts.push({
                id,
                message,
                type,
                visible: true
            });
            setTimeout(() => {
                this.remove(this.toasts.findIndex(t => t.id === id));
            }, 5000);
        },
        remove(index) {
            this.toasts.splice(index, 1);
        }
    }
}

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
        currentPage: 0,
        itemsPerPage: 4,
        async load(){
            this.loading = true;
            try{
                let url = (window.location.origin || '') + '/api/faqs';
                let res = await fetch(url, { credentials: 'same-origin' });
                if(res.ok){ 
                    this.faqs = await res.json(); 
                    this.faqs.forEach(f=>f.open=false); 
                    this.error = null; 
                }
                else {
                    const txt = await res.text();
                    console.error('Failed loading /api/faqs', res.status, txt);
                    this.error = `Failed to load FAQs (status ${res.status}). Check console/network.`;
                }
            }catch(e){ 
                console.error(e); 
                this.error = 'Network error while loading FAQs (check console)'; 
            }
            this.loading = false;
        },
        toggle(i){ 
            this.faqs[i].open = !this.faqs[i].open 
        },
        getCurrentPageFaqs() {
            const start = this.currentPage * this.itemsPerPage;
            return this.faqs.slice(start, start + this.itemsPerPage);
        },
        getTotalPages() {
            return Math.ceil(this.faqs.length / this.itemsPerPage);
        },
        nextPage() {
            if (this.currentPage < this.getTotalPages() - 1) {
                this.currentPage++;
                // Close all open FAQs when changing pages
                this.faqs.forEach(f => f.open = false);
            }
        },
        prevPage() {
            if (this.currentPage > 0) {
                this.currentPage--;
                // Close all open FAQs when changing pages
                this.faqs.forEach(f => f.open = false);
            }
        },
        getGlobalIndex(localIndex) {
            return (this.currentPage * this.itemsPerPage) + localIndex;
        }
    }
}

function reminders(){
    return {
        tips: [
            { id: 'equipment', title: 'Equipment Calibration', text: 'Regular calibration of testing equipment is essential for accurate results. Schedule calibration services at least once every 6 months.', dismissed: false },
            { id: 'quotation', title: 'Product Quotation Guide', text: 'For faster quotation: Include model number, quantity, delivery timeline, and any special requirements.', dismissed: false },
            { id: 'bulk', title: 'Bulk Order Benefits', text: 'Get special pricing for orders above ₱500,000 with priority handling and dedicated support.', dismissed: false },
            { id: 'support', title: 'Technical Support Hours', text: 'Our support team is available Mon-Fri 8AM-5PM and Sat 8AM-12PM. For urgent needs call +63 909 087 9416.', dismissed: false },
            { id: 'chat', title: 'Live Chat Support', text: 'Need immediate assistance? Use our live chat feature during business hours to connect with our team.', dismissed: false },
            { id: 'shipping', title: 'Shipping Information', text: 'Orders over ₱100,000 qualify for free shipping within Metro Manila. Contact us for nationwide delivery rates.', dismissed: false },
            { id: 'warranty', title: 'Warranty Coverage', text: 'All our equipment comes with standard warranty. Extended coverage available for bulk purchases.', dismissed: false },
            { id: 'training', title: 'Product Training', text: 'Schedule a product training session with our technical team to maximize your equipment usage.', dismissed: false },
            { id: 'maintenance', title: 'Maintenance Tips', text: 'Regular maintenance extends equipment life. Check our guides for best practices and schedules.', dismissed: false },
            { id: 'documentation', title: 'Required Documents', text: 'Prepare business registration and tax documents to expedite your account setup.', dismissed: false },
            { id: 'feedback', title: 'Share Your Feedback', text: 'Your opinion matters! Help us improve by participating in our customer satisfaction surveys.', dismissed: false },
            { id: 'updates', title: 'Stay Updated', text: 'Check our website regularly for new products, special offers, and industry updates.', dismissed: false }
        ],
        currentPage: 0,
        itemsPerPage: 2,
        get hasVisibleTips() {
            return this.tips.some(t => !t.dismissed);
        },
        getVisibleTips() {
            return this.tips.filter(t => !t.dismissed);
        },
        getTotalPages() {
            return Math.ceil(this.getVisibleTips().length / this.itemsPerPage);
        },
        getCurrentPageTips() {
            const visibleTips = this.getVisibleTips();
            const start = this.currentPage * this.itemsPerPage;
            return visibleTips.slice(start, start + this.itemsPerPage);
        },
        init() {
            this.tips.forEach(t => {
                const dismissed = localStorage.getItem('tip_'+t.id+'_dismissed') === '1';
                const remindAt = localStorage.getItem('tip_'+t.id+'_remind_at');
                t.dismissed = dismissed && (!remindAt || parseInt(remindAt) > Date.now());
            });
            this.currentPage = 0;
        },
        nextTip() {
            if (this.currentPage < this.getTotalPages() - 1) {
                this.currentPage++;
            } else {
                this.currentPage = 0;
            }
        },
        prevTip() {
            if (this.currentPage > 0) {
                this.currentPage--;
            } else {
                this.currentPage = this.getTotalPages() - 1;
            }
        },
        dismiss(id) { 
            const t = this.tips.find(x => x.id === id); 
            if (t) { 
                t.dismissed = true; 
                localStorage.setItem('tip_'+id+'_dismissed', '1');
                this.currentTipIndex = this.tips.findIndex(t => !t.dismissed);
            } 
        },
        remindLater(id) { 
            const key = 'tip_'+id+'_remind_at'; 
            localStorage.setItem(key, Date.now() + 7*24*60*60*1000); 
            this.dismiss(id);
        }
    }
}

function polls(){
    return {
        polls: [],
        idx: 0,
        selected: null,
        voted: false,
        loading: false,
        get current(){ 
            const poll = this.polls[this.idx];
            if (poll) {
                console.log('Current poll:', poll);
                console.log('Poll options:', poll.options);
            }
            return poll || { question: '', options: [] };
        },
        get currentTotal(){ 
            const options = this.current?.options || [];
            return options.reduce((a,o) => a + (o.votes || 0), 0);
        },
        async init(){ 
            console.log('Initializing polls...'); 
            this.loading = true;
            await this.load(); 
            this.voted = false; 
            this.loading = false;
        },
        async load(){
            try{
                const res = await fetch('/api/polls');
                if(res.ok){
                    const data = await res.json();
                    console.log('Raw API response:', data);
                    
                    if (data && Array.isArray(data) && data.length > 0) {
                        this.polls = data.map(p => ({
                            id: p.id,
                            question: p.question,
                            options: (p.options || []).map(o => ({
                                id: o.id,
                                text: o.text,
                                votes: parseInt(o.votes_count || 0)
                            }))
                        }));
                        
                        console.log('Processed polls:', this.polls);
                        if (this.polls.length > 0) {
                            console.log('First poll options:', this.polls[0].options);
                        }
                    } else {
                        console.error('No valid poll data received');
                        this.polls = [];
                    }
                    this.idx = 0;
                } else {
                    console.error('Failed to fetch polls:', res.status);
                }
            } catch(e){ 
                console.error('Error loading polls:', e);
            }
        },
        next(){ if(this.idx < this.polls.length-1) this.idx++; else this.idx = 0; this.selected = null; this.voted = false },
        async submit(){
            if(!this.selected) return alert('Please select an option');
            try{
                const res = await fetch('/polls/'+this.current.id+'/vote', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ option_id: this.selected })
                });
                
                const data = await res.json();
                
                if(res.ok){
                    // refresh polls to get latest counts
                    await this.load();
                    this.voted = true;
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { 
                            message: 'Your vote has been recorded!', 
                            type: 'success' 
                        } 
                    }));
                } else {
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { 
                            message: data.message || 'Failed to submit vote', 
                            type: 'error' 
                        } 
                    }));
                }
            }catch(e){ 
                console.error('Error submitting vote:', e); 
                window.dispatchEvent(new CustomEvent('notify', { 
                    detail: { 
                        message: 'Error voting. Please try again.', 
                        type: 'error' 
                    } 
                }));
            }
        }
    }
}
</script>
@endpush
    <!-- Centered Request a Quote and Recent Orders section -->
    <div class="flex flex-col items-center justify-center w-full mb-8">
        <div class="flex flex-col md:flex-row gap-6 w-full justify-center">
            <!-- Create/Request Quote -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col flex-1 min-w-[260px] max-w-[350px] items-center justify-between">
                <div class="text-center mb-4">
                    <div class="text-xl font-bold text-green-800 mb-3 flex items-center justify-center gap-2">📝 Request a Quote</div>
                    <p class="text-base text-gray-600 mb-4">Get customized pricing for bulk orders and special requirements</p>
                    <div class="bg-orange-50 rounded-lg p-4 mb-4">
                        <div class="text-sm text-orange-700 font-semibold mb-2">Quick Benefits:</div>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Competitive bulk pricing</li>
                            <li>• Custom product configurations</li>
                            <li>• Fast response time</li>
                        </ul>
                    </div>
                </div>
                <a href="{{ route('quotes.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold w-full text-center transition-colors text-base">Create Quote</a>
            </div>
            <!-- Recent Orders -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col flex-1 min-w-[260px] max-w-[350px] items-center" x-data="recentOrdersCarousel()">
                <div class="text-lg font-bold text-green-800 mb-2 flex items-center justify-between w-full">
                    <span>Your Recent Orders</span>
                    @if($recentOrders->count() > 3)
                    <div class="flex gap-1">
                        <button @click="previousPage()" :disabled="currentPage === 0" 
                                class="w-6 h-6 rounded-full bg-gray-100 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center transition-colors">
                            <i class="fas fa-chevron-left text-xs text-gray-600"></i>
                        </button>
                        <button @click="nextPage()" :disabled="currentPage >= Math.ceil(totalOrders / 3) - 1" 
                                class="w-6 h-6 rounded-full bg-gray-100 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center transition-colors">
                            <i class="fas fa-chevron-right text-xs text-gray-600"></i>
                        </button>
                    </div>
                    @endif
                </div>
                <ul class="divide-y w-full">
                    @forelse ($recentOrders as $index => $o)
                        <li x-show="isVisible({{ $index }})" class="flex items-center justify-between py-4">
                            <div>
                                <div class="font-semibold">#{{ $o->id }} · {{ $o->created_at->format('Y-m-d') }}</div>
                                <div class="text-xs text-gray-500">{{ ucfirst($o->status) }}</div>
                            </div>
                            <div class="text-right">
                                <span class="text-gray-400 text-xs">View (popup only)</span>
                            </div>
                        </li>
                    @empty
                        <li class="py-4 text-gray-400">No orders yet.</li>
                    @endforelse
                </ul>
                
                @if($recentOrders->count() > 3)
                <div class="mt-3 text-center">
                    <span class="text-xs text-gray-500">
                        <span x-text="currentPage + 1"></span>/<span x-text="Math.ceil(totalOrders / 3)"></span>
                    </span>
                </div>
                @endif
            </div>
            <!-- Company Brochure -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col flex-1 min-w-[260px] max-w-[350px] items-center justify-between">
                <div class="text-center mb-4">
                    <div class="text-xl font-bold text-green-800 mb-3 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Company Resources
                    </div>
                    <p class="text-base text-gray-600 mb-4">Download our latest company information and product catalogs</p>
                    <div class="bg-green-50 rounded-lg p-4 mb-4">
                        <div class="text-sm text-green-700 font-semibold mb-2">What's Inside:</div>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Complete product catalog</li>
                            <li>• Company certifications</li>
                            <li>• Contact information</li>
                        </ul>
                    </div>
                </div>
                <a href="/GEMARC%202026%20brochurePDF.pdf" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold w-full text-center transition-colors text-base" target="_blank">Download Brochure</a>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <div class="text-2xl font-bold text-orange-600 mb-6">Recommended for You</div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 w-full">
            @forelse ($recommendedProducts as $product)
                <div class="bg-gray-50 rounded-xl shadow hover:shadow-lg transition-shadow duration-200 overflow-hidden flex flex-col" style="height: 280px;">
                    @php $img = $product->firstImagePath(); @endphp
                    <div class="relative w-full bg-white border-b" style="height: 160px;">
                        <div class="absolute inset-0 p-4 flex items-center justify-center">
                            @if($img)
                                <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" 
                                     style="max-width: 120px; max-height: 120px; width: 100%; height: 100%; object-fit: contain;">
                            @else
                                <img src="/images/gemarclogo.png" alt="No Image" 
                                     style="max-width: 120px; max-height: 120px; width: 100%; height: 100%; object-fit: contain;">
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col flex-grow p-3 justify-between">
                        <h3 class="font-semibold text-green-900 text-sm text-center line-clamp-2 mb-2">{{ $product->name }}</h3>
                        <a href="{{ route('shop.index') }}" 
                           class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2.5 rounded-lg transition-colors duration-200 text-center font-medium">
                            View in Shop
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 py-8">No recommended products.</div>
            @endforelse
        </div>
    </div>

    <!-- Interactive homepage additions: FAQ, Tips/Reminders, Poll -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- FAQ (loaded from server) -->
        <div class="bg-white rounded-xl shadow p-6 flex flex-col min-h-[400px]" x-data="faqList()" x-init="load()">
            <div class="flex items-center justify-between mb-4">
                <div class="text-lg font-bold text-green-800">Frequently Asked Questions</div>
                <div class="flex items-center gap-2">
                    <button @click="prevPage()" :disabled="currentPage === 0" 
                            class="text-green-600 hover:text-green-800 disabled:text-gray-300 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="nextPage()" :disabled="currentPage >= getTotalPages() - 1" 
                            class="text-green-600 hover:text-green-800 disabled:text-gray-300 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="space-y-2 flex-1">
                <template x-if="loading">
                    <div class="text-sm text-gray-500 flex items-center justify-center h-32">Loading...</div>
                </template>
                <template x-for="(item, idx) in getCurrentPageFaqs()" :key="item.id">
                    <div class="border rounded p-3">
                        <button @click="toggle(getGlobalIndex(idx))" class="w-full text-left flex items-start justify-between gap-4">
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
                    <div class="text-gray-400 flex items-center justify-center h-32">No FAQs available at the moment.</div>
                </template>
                <template x-if="error">
                    <div class="text-sm text-red-600 flex items-center justify-center h-32"> <span x-text="error"></span> <button @click="load()" class="ml-2 text-xs underline">Retry</button></div>
                </template>
                
                <!-- Pagination info -->
                <template x-if="!loading && faqs.length > 0">
                    <div class="text-xs text-gray-400 text-center mt-auto pt-4">
                        Page <span x-text="currentPage + 1"></span>/<span x-text="getTotalPages()"></span>
                    </div>
                </template>
            </div>
        </div>

        <!-- Tips / Reminders (realistic, persisted locally) -->
        <div class="bg-white rounded-xl shadow p-6 flex flex-col min-h-[400px]" x-data="reminders()" x-init="init()">
            <div class="flex items-center justify-between mb-3">
                <div class="text-lg font-bold text-green-800">Tips & Reminders</div>
                <div class="flex items-center gap-2">
                    <button @click="prevTip()" class="text-green-600 hover:text-green-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="nextTip()" class="text-green-600 hover:text-green-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="flex-1 flex flex-col">
                <template x-if="!hasVisibleTips">
                    <div class="text-center text-gray-500 py-4 flex-1 flex items-center justify-center">No active tips at the moment.</div>
                </template>

                <div x-show="hasVisibleTips" 
                     class="grid grid-cols-1 gap-4 flex-1"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <template x-for="(tip, index) in getCurrentPageTips()" :key="tip.id">
                        <div class="flex items-start gap-3 py-2 border-b last:border-b-0">
                            <div class="w-8 h-8 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center font-semibold">!</div>
                            <div class="flex-1">
                                <div class="text-sm text-gray-700 font-medium" x-text="tip.title"></div>
                                <div class="text-sm text-gray-600 mt-1" x-text="tip.text"></div>
                                <div class="mt-2 flex items-center justify-between">
                                    <div>
                                        <button @click="dismiss(tip.id)" class="text-xs text-green-700 hover:underline">Got it</button>
                                        <button @click="remindLater(tip.id)" class="ml-3 text-xs text-gray-500 hover:underline">Remind me later</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="text-xs text-gray-400 text-center mt-auto">
                        Page <span x-text="currentPage + 1"></span>/<span x-text="getTotalPages()"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Poll / Survey (server-backed; multiple polls + navigation) -->
        <div class="bg-white rounded-xl shadow p-6 flex flex-col min-h-[400px]">
            <div class="flex items-center justify-between mb-4">
                <div class="text-lg font-bold text-green-800">Quick Poll</div>
                <div class="text-sm text-gray-500">Participate & help us improve</div>
            </div>
            <div x-data="polls()" x-init="init()" class="flex-1 flex flex-col">
                <template x-if="loading">
                    <div class="text-sm text-gray-500 flex items-center justify-center flex-1">Loading polls...</div>
                </template>

                <template x-if="!loading && polls.length">
                    <div class="flex-1 flex flex-col">
                        <div class="text-sm text-gray-700 mb-3 font-medium" x-text="current.question"></div>

                        <template x-if="!voted">
                            <div class="flex-1 flex flex-col">
                                <div class="space-y-2 flex-1">
                                    <template x-for="opt in current.options" :key="opt.id">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" 
                                                :id="'opt-'+opt.id" 
                                                name="poll-option" 
                                                :value="opt.id" 
                                                x-model="selected" 
                                                class="form-radio text-orange-500" />
                                            <label :for="'opt-'+opt.id" 
                                                class="text-sm text-gray-700 cursor-pointer"
                                                x-text="opt.text"></label>
                                        </div>
                                    </template>
                                </div>
                                <div class="mt-3 flex items-center gap-2">
                                    <button @click="submit()" 
                                        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">Vote</button>
                                    <button @click="next()" 
                                        class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Next poll</button>
                                </div>
                            </div>
                        </template>

                        <template x-if="voted">
                            <div class="space-y-2 flex-1">
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
                                <div class="mt-auto pt-4">
                                    <button @click="next()" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Next poll</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-if="!loading && polls.length === 0">
                    <div class="text-gray-400 flex items-center justify-center flex-1">No polls available right now.</div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
  function recentOrdersCarousel() {
    return {
      currentPage: 0,
      totalOrders: {{ $recentOrders->count() }},
      ordersPerPage: 3,
      
      isVisible(index) {
        const startIndex = this.currentPage * this.ordersPerPage;
        const endIndex = startIndex + this.ordersPerPage;
        return index >= startIndex && index < endIndex;
      },
      
      nextPage() {
        const maxPage = Math.ceil(this.totalOrders / this.ordersPerPage) - 1;
        if (this.currentPage < maxPage) {
          this.currentPage++;
        }
      },
      
      previousPage() {
        if (this.currentPage > 0) {
          this.currentPage--;
        }
      }
    }
  }
</script>
@endsection
