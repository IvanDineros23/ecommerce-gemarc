@extends('layouts.app')
@section('title','Browse Products | Gemarc Enterprises Inc.')

@push('styles')
<style>
    .browse-wrapper{padding:2.5rem 0}
    .browse-search{max-width:600px;margin:0 auto 3rem;width:100%;padding:0 1rem;}
    .new-search-bar{
        position:relative;
        width:100%;
        max-width:500px;
        margin:0 auto;
    }
    .new-search-input{
        width:100%;
        padding:14px 50px 14px 20px;
        border:1px solid #ddd;
        border-radius:30px;
        font-size:16px;
        background:#fff;
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
        transition:border-color 0.2s ease;
        outline:none;
    }
    .new-search-input:focus{
        border-color:#28a745;
    }
    .new-search-input::placeholder{
        color:#999;
    }
    .search-icon{
        position:absolute;
        right:18px;
        top:50%;
        transform:translateY(-50%);
        color:#999;
        font-size:16px;
        pointer-events:none;
    }
    
    /* Product grid layout */
    #productGrid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.75rem;
    }
    @media (min-width: 640px) {
        #productGrid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width: 1024px) {
        #productGrid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    /* Product item container */
    .product-item {
        display: block;
        width: 100%;
        margin: 0;
        padding: 0;
    }
    
    /* Product card */
    .product-card {
        display: flex;
        flex-direction: column;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        overflow: visible;
        transition: all .3s ease;
        height: 100%;
        cursor: pointer;
        position: relative;
        min-height: 360px;
    }
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,0,0,.12);
    }
    /* Image container */
    .card-image-container {
        width: 100%;
        height: 200px;
        padding: 1.25rem;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #f0f4f8;
        position: relative;
        z-index: 1;
    }
    .card-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform .3s;
        position: relative;
        z-index: 2;
    }
    .product-card:hover .card-image {
        transform: scale(1.05);
    }
    
    /* Content container */
    .card-content {
        padding: 1.25rem;
        background: #fff;
        margin-top: auto;
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border-top: 1px solid #e5e7eb;
        z-index: 10;
           background: #fff !important;
           border: 2px solid #e5e7eb !important;
           box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .card-title {
           font-size: 1.15rem !important;
           font-weight: 700 !important;
           color: #17643b !important;
           background: #fff !important;
           text-align: center !important;
           margin: 0 !important;
           line-height: 1.4 !important;
           width: 100% !important;
           display: block !important;
           visibility: visible !important;
           opacity: 1 !important;
           position: relative !important;
           z-index: 11 !important;
           border: none !important;
           box-shadow: none !important;
    }
    /* Force visibility and prevent clipping */
    .card-title {
        opacity: 1 !important;
        background-color: white;
        z-index: 10;
        position: relative;
        word-break: break-word;
        overflow-wrap: break-word;
        padding: 0.5rem 0;
        display: block !important;
        visibility: visible !important;
        border-top: 1px solid #f0f4f8;
    }
    /* Clean up conflicts with global styles */
    .browse-wrapper .product-card::after,
    .browse-wrapper .product-card::before {
        display: none !important;
        content: none !important;
        opacity: 0 !important;
    }
</style>
@endpush

@section('content')
<section class="browse-wrapper">
    <div class="container mx-auto px-4">
        <div class="browse-search">
            <div style="max-width:760px;margin:0 auto 2.5rem;">
                @include('components.searchbar', ['mode' => 'browse'])
            </div>
        </div>
                                                <div id="productGrid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                                                    @forelse($products as $product)
                                                        @php($img = $product->firstImagePath())
                                                        @php($imgUrl = $img ? asset('storage/'.$img) : asset('images/gemarclogo.png'))
                                                        <div class="product-card" style="background: #fff; border-radius: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,.08); padding: 1.5rem; display: flex; flex-direction: column; align-items: center; justify-content: space-between; min-height: 360px; cursor:pointer;" onclick="openBrowseModal(this)" data-product="{{ json_encode(['id'=>$product->id,'name'=>$product->name,'description'=>$product->description,'image'=>$imgUrl,'stock'=>$product->stock]) }}" data-search-terms="{{ strtolower($product->name . ' ' . $product->description) }}">
                                                            <div style="flex: 1; display: flex; align-items: center; justify-content: center; width: 100%; margin-bottom: 1rem;">
                                                                <img src="{{ $imgUrl }}" alt="{{ $product->name }}" style="width: 100%; max-width: 280px; max-height: 220px; object-fit: contain;">
                                                            </div>
                                                            <div style="width: 100%; text-align: center; min-height: 60px; display: flex; align-items: center; justify-content: center;">
                                                                <span style="font-size: 1.15rem; font-weight: 700; color: #17643b; background: #fff; padding: 0.5rem; display: block; border-radius: 0.5rem; line-height: 1.3;">{{ $product->name }}</span>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-span-full"><div class="alert alert-light border">No products to display yet.</div></div>
                                                    @endforelse
                                                </div>
                                                <div id="noResults" style="display: none; text-align: center; padding: 2rem; color: #666; font-size: 1.1rem;">
                                                    No products found matching your search.
                                                </div>
        <!-- Modal -->
        <div id="browseModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50 p-4" style="opacity: 0; transition: opacity 0.3s ease;">
            <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full relative overflow-hidden" style="transform: scale(0.9) translateY(20px); transition: transform 0.3s ease, opacity 0.3s ease;">
                <button type="button" onclick="closeBrowseModal()" class="absolute top-4 right-4 text-3xl text-gray-400 hover:text-gray-600 transition-colors duration-200" aria-label="Close">&times;</button>
                <div class="grid md:grid-cols-2 gap-8 p-8">
                    <div class="flex flex-col items-center gap-4">
                        <img id="bmImage" src="" alt="Product" class="bg-gray-100 rounded-lg w-full max-h-[400px] object-contain p-4">
                    </div>
                    <div class="flex flex-col">
                        <h2 id="bmName" class="text-green-800 font-bold text-2xl mb-4"></h2>
                        <div id="bmDesc" class="text-base text-gray-700 leading-relaxed mb-6 max-h-72 overflow-auto pr-2"></div>
                        @guest
                            <div class="text-sm text-gray-500 italic mb-4">For full product specs, brochures, and pricing details please login.</div>
                        @endguest
                        <div class="mt-auto flex flex-col gap-2">
                            @guest
                                <a href="{{ route('login') }}" class="bg-green-600 text-white w-full text-center py-2 rounded font-semibold text-sm hover:bg-green-700">Login to Add to Cart</a>
                                <a href="{{ route('login') }}" class="bg-orange-500 text-white w-full text-center py-2 rounded font-semibold text-sm hover:bg-orange-600">Get Quote</a>
                            @endguest
                            @auth
                                <form method="POST" action="{{ route('cart.add') }}" id="bmCartForm">
                                    @csrf
                                    <input type="hidden" name="product_id" id="bmCartProductId" value="">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" id="bmCartBtn" class="bg-green-600 text-white w-full py-2 rounded font-semibold text-sm hover:bg-green-700">Add to Cart</button>
                                </form>
                                <a href="{{ route('quotes.create') }}" class="bg-orange-500 text-white w-full text-center py-2 rounded font-semibold text-sm hover:bg-orange-600">Get Quote</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function openBrowseModal(card){
    const modal = document.getElementById('browseModal');
    const modalContent = modal.querySelector('.bg-white');
    try {
        const data = JSON.parse(card.getAttribute('data-product'));
        document.getElementById('bmName').textContent = data.name || 'Product';
        document.getElementById('bmDesc').textContent = data.description || 'No description available.';
        document.getElementById('bmImage').src = data.image || '{{ asset('images/gemarclogo.png') }}';
        const cartId = document.getElementById('bmCartProductId');
        if(cartId) cartId.value = data.id;
        const cartBtn = document.getElementById('bmCartBtn');
        if(cartBtn){
                if(data.stock > 0){ cartBtn.disabled=false; cartBtn.textContent='Add to Cart'; cartBtn.classList.remove('bg-gray-400','cursor-not-allowed'); cartBtn.classList.add('bg-green-600'); }
                else { cartBtn.disabled=true; cartBtn.textContent='Out of Stock'; cartBtn.classList.add('bg-gray-400','cursor-not-allowed'); cartBtn.classList.remove('bg-green-600'); }
        }
        
        // Show modal with animation
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Trigger animations
        setTimeout(() => {
            modal.style.opacity = '1';
            modalContent.style.transform = 'scale(1) translateY(0)';
        }, 10);
        
    } catch(e){ console.error('Invalid product data', e); }
}
function closeBrowseModal(){
  const modal = document.getElementById('browseModal');
  const modalContent = modal.querySelector('.bg-white');
  
  // Animate out
  modal.style.opacity = '0';
  modalContent.style.transform = 'scale(0.9) translateY(20px)';
  
  // Hide after animation
  setTimeout(() => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }, 300);
}
document.addEventListener('keydown',e=>{ if(e.key==='Escape') closeBrowseModal(); });

// Real-time search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('productSearch') || document.getElementById('product-search-input');
    const productCards = document.querySelectorAll('.product-card');
    const noResults = document.getElementById('noResults');
    const productGrid = document.getElementById('productGrid');

    if (!searchInput) return;

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleCount = 0;

        productCards.forEach(card => {
            const terms = (card.getAttribute('data-search-terms') || '').toLowerCase();
            const isMatch = !searchTerm || terms.includes(searchTerm);
            card.style.display = isMatch ? 'flex' : 'none';
            if (isMatch) visibleCount++;
        });

        if (visibleCount === 0 && searchTerm) {
            noResults.style.display = 'block';
            productGrid.style.display = 'none';
        } else {
            noResults.style.display = 'none';
            productGrid.style.display = 'grid';
        }
    });
});
</script>
@endpush
