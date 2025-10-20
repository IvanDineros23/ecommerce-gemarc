<div class="products-search" id="products-search">
    <div style="position:relative;flex:1;">
        <input
            id="product-search-input"
            type="{{ (isset($mode) && $mode === 'browse') ? 'text' : 'search' }}"
            class="search-input"
            placeholder="Search products..."
            aria-label="Search products"
            autocomplete="off"
        />
        <div id="product-search-suggestions" class="search-suggestions" role="listbox" aria-label="Search suggestions" hidden></div>
    </div>
    <button id="product-search-clear" type="button" title="Clear search" aria-label="Clear search" style="display:none;width:44px;height:44px;border:none;border-radius:50%;background:transparent;color:#0f172a;align-items:center;justify-content:center;cursor:pointer;box-shadow:none;z-index:70;margin-left:-18px;transition:background .2s,box-shadow .2s;">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 8L14 14M14 8L8 14" stroke="#0f172a" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>
    <button id="product-search-btn" class="search-btn" type="button" aria-label="Search" style="margin-left:0;z-index:60"><i class="fas fa-search"></i></button>
    <script>
/* Keyword/page mapping (used only outside browse mode) */
const keywordRedirects = {
  about:                 { url: '/about',                 label: 'About Us' },
  aggregates:            { url: '/aggregates',            label: 'Aggregates' },
  'asphalt-bitumen':     { url: '/asphalt-bitumen',       label: 'Asphalt-Bitumen' },
  blogs:                 { url: '/blogs',                 label: 'Blogs' },
  calibration:           { url: '/calibration',           label: 'Calibration' },
  contact:               { url: '/contact',               label: 'Contact' },
  'cement-mortar':       { url: '/cement-mortar',         label: 'Cement-Mortar' },
  'concrete-mortar':     { url: '/concrete-mortar',       label: 'Concrete-Mortar' },
  'customer-feedback':   { url: '/customer-feedback',     label: 'Customer Feedbacks' },
  'drilling-machine':    { url: '/drilling-machine',      label: 'Drilling Machines' },
  home:                  { url: '/',                      label: 'Home' },
  'industrial-equipment':{ url: '/industrial-equipment',  label: 'Industrial Equipment' },
  news:                  { url: '/news',                  label: 'News' },
  pavetest:              { url: '/pavetest',              label: 'Pavetest' },
  products:              { url: '/browse',                label: 'Browse Products' },
  quote:                 { url: '/quote',                 label: 'Quote' },
  services:              { url: '/services',              label: 'Services' },
  soil:                  { url: '/soil',                  label: 'Soil' },
  steel:                 { url: '/steel',                 label: 'Steel' },
};

document.addEventListener('DOMContentLoaded', function () {
  // Detect Browse mode from Blade include
  let isBrowseMode = false;
  try { isBrowseMode = !!@json(isset($mode) && $mode === 'browse'); } catch(e){}

  const input = document.getElementById('product-search-input');
  const suggestionsBox = document.getElementById('product-search-suggestions');
  const btn = document.getElementById('product-search-btn');
  const clearBtn = document.getElementById('product-search-clear');
  if (!input) return;

  // Universal: hide native clear, manage our clear button
  function updateClearVisibility(){
    clearBtn.style.display = (input.value.trim().length>0) ? 'flex' : 'none';
  }
  input.addEventListener('input', updateClearVisibility);
  updateClearVisibility();
  clearBtn?.addEventListener('click', ()=>{
    input.value=''; input.focus(); updateClearVisibility();
    // keep UX consistent: fire input for inline filter on browse
    input.dispatchEvent(new Event('input', { bubbles:true }));
  });

  /* ===================== BROWSE MODE (NO SUGGESTIONS) ===================== */
  if (isBrowseMode) {
    // Never show / render suggestions
    if (suggestionsBox) suggestionsBox.hidden = true;

    // Focus should NOT open anything
    input.addEventListener('focus', ()=>{});   // no-op
    input.addEventListener('blur', ()=>{});    // no-op

    // Enter & Search button = inline filter (no reload)
    function applyInlineFilter(q){
      // your browse page listens to `input` already
      input.value = q || '';
      input.dispatchEvent(new Event('input', { bubbles:true }));
      input.focus();
    }
    input.addEventListener('keydown', (e)=>{
      if (e.key === 'Enter'){ e.preventDefault(); applyInlineFilter(input.value.trim()); }
    });
    btn.addEventListener('click', ()=>{
      const q = input.value.trim(); if (!q) return; applyInlineFilter(q);
    });

    // Stop here; skip all suggestion code below
    return;
  }

  /* ===================== NON-BROWSE PAGES (WITH SUGGESTIONS) ===================== */

  // style for suggestions
  const style = document.createElement('style');
  style.innerHTML = `
    .search-suggestions{position:absolute;left:0;right:0;top:calc(100% + 12px);background:#fff;border-radius:10px;box-shadow:0 14px 40px rgba(2,6,23,.12);z-index:160;max-height:360px;overflow:auto;padding:6px;border:1px solid rgba(15,23,42,.06)}
    .search-suggestions .section-title{font-weight:700;color:#059669;font-size:.95rem;margin:.5rem 0 .25rem 0;padding-left:.5rem;}
    .search-suggestions .item{display:flex;gap:.75rem;align-items:center;padding:.5rem;border-radius:6px;cursor:pointer}
    .search-suggestions .item:hover,.search-suggestions .item.active{background:linear-gradient(90deg,rgba(16,185,129,.06),rgba(16,185,129,.02))}
    .search-suggestions .item img{width:46px;height:46px;object-fit:cover;border-radius:6px}
    .search-suggestions .item .meta{flex:1}
    .search-suggestions .item .meta .name{font-weight:600;color:#0f172a}
    .search-suggestions .item .meta .type{font-size:.9rem;color:#64748b}
    .search-input::-webkit-search-cancel-button{-webkit-appearance:none;appearance:none;display:none}
    .search-input::-ms-clear{display:none;width:0;height:0}
    .search-input::-webkit-search-decoration{display:none}
  `;
  document.head.appendChild(style);

  let controller = null, activeIndex = -1, items = [];
  function clearSuggestions(){
    if(!suggestionsBox) return;
    suggestionsBox.innerHTML='';
    suggestionsBox.classList.remove('open');
    suggestionsBox.setAttribute('aria-hidden','true');
    suggestionsBox.hidden=true;
    items=[]; activeIndex=-1;
  }
  function setActive(idx){ items.forEach((it,i)=> it.classList.toggle('active', i===idx)); activeIndex = idx; if(idx>=0 && items[idx]) items[idx].scrollIntoView({block:'nearest'}); }

  function render(productList, pageList){
    if(!suggestionsBox) return;
    suggestionsBox.innerHTML = '';
    let count = 0;

    if(productList.length){
      const section = document.createElement('div');
      section.innerHTML = `<div class='section-title'>Products</div>`;
      productList.forEach(p=>{
        const div = document.createElement('div');
        div.className = 'item'; div.setAttribute('role','option');
        div.innerHTML = `<img src="${p.image_url}" alt="${p.name}"><div class='meta'><div class='name'>${p.name}</div></div>`;
        div.addEventListener('click', ()=>{ window.location.href = '/browse?q='+encodeURIComponent(p.name); });
        section.appendChild(div); count++;
      });
      suggestionsBox.appendChild(section);
    }

    if(pageList.length){
      const section = document.createElement('div');
      section.innerHTML = `<div class='section-title'>Pages</div>`;
      pageList.forEach(p=>{
        const div = document.createElement('div');
        div.className = 'item'; div.setAttribute('role','option');
        div.innerHTML = `<div class='meta'><div class='name'>${p.label}</div></div>`;
        div.addEventListener('click', ()=>{ window.location.href = p.url; });
        section.appendChild(div); count++;
      });
      suggestionsBox.appendChild(section);
    }

    if(count > 0){
      suggestionsBox.classList.add('open');
      suggestionsBox.setAttribute('aria-hidden','false');
      suggestionsBox.hidden = false;
    } else {
      suggestionsBox.classList.remove('open');
      suggestionsBox.setAttribute('aria-hidden','true');
      suggestionsBox.hidden = true;
    }
    items = Array.from(suggestionsBox.querySelectorAll('.item'));
  }

  function debounce(fn, t=180){ let to; return (...a)=>{ clearTimeout(to); to=setTimeout(()=>fn(...a),t); }; }

  async function fetchProductSuggestions(q){
    if(controller) controller.abort();
    controller = new AbortController();
    try{
      const res = await fetch('/landing-search?q='+encodeURIComponent(q), { signal: controller.signal });
      if(!res.ok) return [];
      return await res.json();
    }catch(e){ return []; }
  }

  async function showSuggestions(val){
    const query = (val||'').trim().toLowerCase();
    let productList = [], pageList = [];

    if(query.length){
      productList = await fetchProductSuggestions(query);
      for(const key in keywordRedirects){
        const item = keywordRedirects[key];
        if (key.includes(query) || query.includes(key) || item.label.toLowerCase().includes(query)){
          pageList.push({label:item.label,url:item.url});
        }
      }
    } else {
      pageList = Object.values(keywordRedirects).map(i=>({label:i.label,url:i.url})).slice(0,8);
    }
    render(productList, pageList);
  }

  const debounced = debounce(showSuggestions, 180);
  input.addEventListener('input', e=> debounced(e.target.value));
  input.addEventListener('focus', ()=>{ showSuggestions(input.value); });
  input.addEventListener('blur', ()=> setTimeout(()=> clearSuggestions(), 180));
  // Hide suggestions on Escape or click outside
  input.addEventListener('keydown', e => { if(e.key==='Escape') clearSuggestions(); });
  document.addEventListener('click', e => {
    if (!e.target.closest('.products-search')) clearSuggestions();
  });

  input.addEventListener('keydown', (e)=>{
    if(!items.length) return;
    if(e.key==='ArrowDown'){ e.preventDefault(); setActive(Math.min(activeIndex+1, items.length-1)); }
    else if(e.key==='ArrowUp'){ e.preventDefault(); setActive(Math.max(activeIndex-1, 0)); }
    else if(e.key==='Enter'){ e.preventDefault(); if(activeIndex>=0 && items[activeIndex]) items[activeIndex].click(); else if(input.value.trim()) window.location.href='/browse?q='+encodeURIComponent(input.value.trim()); }
    else if(e.key==='Escape'){ clearSuggestions(); }
  });

  btn.addEventListener('click', ()=>{
    const q = input.value.trim(); if(!q) return;
    window.location.href = '/browse?q='+encodeURIComponent(q);
  });
});
</script>
</div>
