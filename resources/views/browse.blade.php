@extends('layouts.app')
@section('title','Browse Products | Gemarc Enterprises Inc.')

@push('styles')
<style>
/* ===== Browse-page overrides ===== */

/* Huwag mag-reserve ng space para sa anumang suggestions; disable on this page */
.browse-wrapper #product-search-suggestions,
.browse-wrapper .products-search .suggestions{
  display:none !important;
}

/* Ibaba ang z-index ng search controls sa browse page */
.browse-wrapper .products-search{ position:relative; z-index: 1; }
.browse-wrapper .products-search .search-btn{ z-index: 1 !important; }

/* Taasan ang modal overlay para laging nasa ibabaw */
#browseModal{ z-index: 9999 !important; }

/* --- your existing styles --- */
/* Product grid layout & cards */
.browse-wrapper{padding:2.5rem 0}
.browse-search{max-width:600px;margin:0 auto 3rem;width:100%;padding:0 1rem;}
.new-search-bar{position:relative;width:100%;max-width:500px;margin:0 auto;}
.new-search-input{
  width:100%;padding:14px 50px 14px 20px;border:1px solid #ddd;border-radius:30px;
  font-size:16px;background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.1);transition:border-color .2s;outline:none;
}
.new-search-input:focus{border-color:#28a745;}
.new-search-input::placeholder{color:#999;}
.search-icon{position:absolute;right:18px;top:50%;transform:translateY(-50%);color:#999;font-size:16px;pointer-events:none;}

#productGrid{ display:grid; grid-template-columns:repeat(1,1fr); gap:1.75rem; }
@media (min-width:640px){ #productGrid{ grid-template-columns:repeat(2,1fr);} }
@media (min-width:1024px){ #productGrid{ grid-template-columns:repeat(3,1fr);} }

.product-item{display:block;width:100%;margin:0;padding:0;}
.product-card{
  display:flex;flex-direction:column;background:#fff;border-radius:1rem;box-shadow:0 4px 20px rgba(0,0,0,.08);
  overflow:visible;transition:all .3s ease;height:100%;cursor:pointer;position:relative;min-height:360px;
}
.product-card:hover{transform:translateY(-4px);box-shadow:0 10px 30px rgba(0,0,0,.12);}

.card-image-container{
  width:100%;height:200px;padding:1.25rem;background:#fff;display:flex;align-items:center;justify-content:center;
  border-bottom:1px solid #f0f4f8;position:relative;z-index:1;
}
.card-image{max-width:100%;max-height:100%;object-fit:contain;transition:transform .3s;position:relative;z-index:2;}
.product-card:hover .card-image{transform:scale(1.05);}

.card-content{
  padding:1.25rem;background:#fff;margin-top:auto;min-height:100px;display:flex;align-items:center;justify-content:center;
  position:relative;border-top:1px solid #e5e7eb;z-index:10;background:#fff !important;border:2px solid #e5e7eb !important;box-shadow:0 2px 8px rgba(0,0,0,0.04);
}
.card-title{
  font-size:1.15rem !important;font-weight:700 !important;color:#17643b !important;background:#fff !important;text-align:center !important;
  margin:0 !important;line-height:1.4 !important;width:100% !important;display:block !important;visibility:visible !important;opacity:1 !important;
  position:relative !important;z-index:11 !important;border:none !important;box-shadow:none !important;
}
.card-title{
  opacity:1 !important;background-color:white;z-index:10;position:relative;word-break:break-word;overflow-wrap:break-word;padding:.5rem 0;
  display:block !important;visibility:visible !important;border-top:1px solid #f0f4f8;
}
.browse-wrapper .product-card::after,
.browse-wrapper .product-card::before{display:none !important;content:none !important;opacity:0 !important;}
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

    <div id="productGrid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem;">
      @forelse($products as $product)
        @php($img = $product->firstImagePath())
        @php($imgUrl = $img ? asset('storage/'.$img) : asset('images/gemarclogo.png'))
        <div class="product-card"
             onclick="openBrowseModal(this)"
             data-product="{{ json_encode(['id'=>$product->id,'name'=>$product->name,'description'=>$product->description,'image'=>$imgUrl,'stock'=>$product->stock]) }}"
             data-search-terms="{{ strtolower($product->name . ' ' . $product->description) }}">
          <div style="flex:1;display:flex;align-items:center;justify-content:center;width:100%;margin-bottom:1rem;">
            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" style="width:100%;max-width:280px;max-height:220px;object-fit:contain;">
          </div>
          <div style="width:100%;text-align:center;min-height:60px;display:flex;align-items:center;justify-content:center;">
            <span style="font-size:1.15rem;font-weight:700;color:#17643b;background:#fff;padding:.5rem;display:block;border-radius:.5rem;line-height:1.3;">
              {{ $product->name }}
            </span>
          </div>
        </div>
      @empty
        <div class="col-span-full"><div class="alert alert-light border">No products to display yet.</div></div>
      @endforelse
    </div>

    <div id="noResults" style="display:none;text-align:center;padding:2rem;color:#666;font-size:1.1rem;">
      No products found matching your search.
    </div>

    <!-- always-visible CTA -->
    <section class="py-10">
      <div class="max-w-5xl mx-auto px-4">
        <div class="border border-gray-200 bg-white rounded-xl p-5 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
          <div class="flex items-center gap-3 text-gray-800 text-sm sm:text-base">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-gray-100">
              <i class="fas fa-search text-gray-600"></i>
            </span>
            <p>
              <span class="font-semibold text-green-700">Finding something?</span>
              Some items may not be listed yet. Contact us for inquiries.
            </p>
          </div>
          <div class="flex items-center gap-2">
            <a href="{{ url('/contact') }}" class="px-3 py-2 text-sm font-medium rounded-lg bg-green-600 text-white hover:bg-green-700">
              Contact
            </a>
            <a href="mailto:sales@gemarcph.com" class="px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
              Email
            </a>
            <a href="tel:+639090879416" class="hidden sm:inline-flex px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
              Call
            </a>
          </div>
        </div>
      </div>
    </section>

@endsection

@push('scripts')
<script>
/* ---------- Modal ---------- */
function openBrowseModal(card){
  const modal = document.getElementById('browseModal');
  const modalContent = modal.querySelector('.bg-white');
  try{
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
    modal.classList.remove('hidden'); modal.classList.add('flex');
    setTimeout(()=>{ modal.style.opacity='1'; modalContent.style.transform='scale(1) translateY(0)'; },10);
  }catch(e){ console.error('Invalid product data', e); }
}
function closeBrowseModal(){
  const modal = document.getElementById('browseModal');
  const modalContent = modal.querySelector('.bg-white');
  modal.style.opacity='0'; modalContent.style.transform='scale(.9) translateY(20px)';
  setTimeout(()=>{ modal.classList.add('hidden'); modal.classList.remove('flex'); },300);
}
document.addEventListener('keydown',e=>{ if(e.key==='Escape') closeBrowseModal(); });

/* ---------- ENTER-ONLY SEARCH (no live filtering) ---------- */
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('productSearch') || document.getElementById('product-search-input');
  const grid  = document.getElementById('productGrid');
  const cards = Array.from(document.querySelectorAll('.product-card'));
  const noResults = document.getElementById('noResults');
  if (!input || !grid) return;

  const searchWrap = input.closest('.products-search');
  const searchBtn  = searchWrap ? searchWrap.querySelector('.search-btn') : null;

  const normalize = s => (s||'').toLowerCase().replace(/\s+/g,' ').trim();

  function filterGrid(q){
    const term = normalize(q);
    let shown = 0;
    cards.forEach(c=>{
      const terms = (c.getAttribute('data-search-terms')||'').toLowerCase();
      const match = !term || terms.includes(term);
      c.style.display = match ? 'flex' : 'none';
      if(match) shown++;
    });
    const hasQ = !!term;
    if(noResults){
      noResults.style.display = (hasQ && shown===0) ? 'block' : 'none';
      grid.style.display      = (hasQ && shown===0) ? 'none'  : 'grid';
    }
  }

  function setQueryParam(q){
    const url = new URL(window.location.href);
    if(q) url.searchParams.set('q', q); else url.searchParams.delete('q');
    window.history.replaceState({},'',url);
  }

  function commit(){
    const q = input.value;
    setQueryParam(q);
    filterGrid(q);
  }

  // ENTER to search
  input.addEventListener('keydown', (e)=>{
    if(e.key === 'Enter'){
      e.preventDefault();
      commit();
    }
  });

  // click magnifier to search (kung button)
  if (searchBtn){
    searchBtn.addEventListener('click', (e)=>{
      e.preventDefault();
      commit();
    });
  }

  // restore from ?q= (supports deep-link/back button)
  const initialQ = new URL(window.location.href).searchParams.get('q') || '';
  if(initialQ){
    input.value = initialQ;
    filterGrid(initialQ);
  }
});
</script>
@endpush
