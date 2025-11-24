@extends('layouts.ecommerce')

@section('content')
<br>
<div class="container mx-auto max-w-7xl p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Quotation</h2>

    {{-- Toast / validation messages --}}
    @if(session('success'))
        <div id="toast-success" class="mb-4 p-3 rounded bg-green-600 text-white">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div id="toast-error" class="mb-4 p-3 rounded bg-red-600 text-white">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employee.quotes.update', $quote->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- CUSTOMER INFO --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Name</label>
            <input type="text" name="customer_name" class="border rounded p-2 w-full"
                   value="{{ $quote->user->name ?? '' }}" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Email</label>
            <input type="email" name="customer_email" class="border rounded p-2 w-full"
                   value="{{ $quote->user->email ?? '' }}" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Address</label>
            <input type="text" name="customer_address" class="border rounded p-2 w-full"
                   value="{{ $quote->user->address ?? '' }}" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Contact Number</label>
            <input type="text" name="customer_contact" class="border rounded p-2 w-full"
                   value="{{ $quote->user->contact_no ?? '' }}" required>
        </div>

        {{-- NOTES (COLLAPSIBLE) --}}
        <div class="mb-4">
            <button type="button" id="toggle-notes"
                    class="w-full flex justify-between items-center bg-gray-200 px-4 py-2 rounded-t font-semibold focus:outline-none">
                <span>Notes (will appear on PDF)</span>
                <svg id="icon-notes" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="notes-panel" class="bg-gray-50 rounded-b p-4" style="display:none;">
                <textarea name="notes" id="notes-textarea"
                          class="border rounded p-2 w-full" rows="12"
                          placeholder="Enter notes for the quotation">{{ old('notes', $quote->notes ?? '') }}</textarea>
            </div>
        </div>

        {{-- QUOTATION ITEMS --}}
        <div class="mb-6">
            <label class="block font-semibold mb-1">Quotation Items</label>

            {{-- COLLAPSIBLE: SELECT FROM AVAILABLE ITEMS --}}
            <div class="mb-2">
                <button type="button" id="toggle-checklist"
                        class="w-full flex justify-between items-center bg-gray-200 px-4 py-2 rounded-t font-semibold focus:outline-none">
                    <span>Select from Available Items</span>
                    <svg id="icon-checklist" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="checklist-items" class="bg-gray-50 rounded-b p-4">
                    @php
                        $quoteProductMap = collect($quote->items)->keyBy('product_id');
                    @endphp

                    {{-- 🔍 SEARCH + PAGINATION BAR (single horizontal line) --}}
                    <div class="flex flex-row items-center gap-3 mb-3">
                        <input type="text" id="quote-item-search"
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none"
                               placeholder="Search available items...">

                        <div class="flex items-center gap-2">
                            <button type="button" id="prev-page"
                                    class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white hover:bg-gray-100">
                                Previous
                            </button>
                            <button type="button" id="next-page"
                                    class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white hover:bg-gray-100">
                                Next
                            </button>
                        </div>
                    </div>

                    {{-- 📄 ITEMS LIST (will be paginated client-side) --}}
                    <div id="quote-items-pagination" class="space-y-2 max-h-80 overflow-y-auto pr-1">
                        @foreach($products as $product)
                            @php
                                $item = $quoteProductMap[$product->id] ?? null;
                            @endphp
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 checklist-row hover:bg-gray-100 rounded px-2 py-1 bg-white"
                                 data-name="{{ strtolower($product->name) }}">
                                <div class="flex items-center gap-2 min-w-0 w-full sm:w-auto">
                                    <input type="checkbox"
                                           name="product_ids[]"
                                           value="{{ $product->id }}"
                                           class="product-check accent-green-600"
                                           id="product-{{ $product->id }}"
                                           {{ $item ? 'checked' : '' }}>
                                    <label for="product-{{ $product->id }}"
                                           class="cursor-pointer select-none break-words w-full sm:w-64">
                                        {{ $product->name }}
                                    </label>
                                </div>
                                <div class="flex gap-2 w-full sm:w-auto">
                                    <input type="number"
                                           name="product_quantities[{{ $product->id }}]"
                                           value="{{ $item ? $item->quantity : '' }}"
                                           min="1"
                                           class="border rounded p-2 w-20 min-w-[80px] product-qty focus:ring-2 focus:ring-green-400"
                                           placeholder="Qty"
                                           style="display:{{ $item ? 'block' : 'none' }};">
                                    <input type="number"
                                           name="product_prices[{{ $product->id }}]"
                                           value="{{ $item ? $item->unit_price : '' }}"
                                           min="0" step="0.01"
                                           class="border rounded p-2 w-28 min-w-[100px] product-price focus:ring-2 focus:ring-green-400"
                                           placeholder="Unit Price"
                                           style="display:{{ $item ? 'block' : 'none' }};">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- COLLAPSIBLE: MANUAL INPUT --}}
            <div class="mt-4">
                <button type="button" id="toggle-manual"
                        class="w-full flex justify-between items-center bg-gray-200 px-4 py-2 rounded-t font-semibold focus:outline-none">
                    <span>Manual Input</span>
                    <svg id="icon-manual" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="manual-items" class="bg-gray-50 rounded-b p-4" style="display:none;">
                    <div id="items-list" class="space-y-3 mb-4">
                        @foreach($quote->items as $i => $item)
                            <div class="flex flex-wrap items-center gap-3 item-row">
                                <input type="text" name="items[{{ $i }}][name]"
                                       value="{{ $item->name }}"
                                       class="border rounded p-2 w-1/2 min-w-[180px]"
                                       required placeholder="e.g. Product Name">
                                <input type="number" name="items[{{ $i }}][quantity]"
                                       value="{{ $item->quantity }}" min="1"
                                       class="border rounded p-2 w-20 min-w-[80px]" required placeholder="e.g. 1">
                                <input type="number" name="items[{{ $i }}][unit_price]"
                                       value="{{ $item->unit_price }}" min="0" step="0.01"
                                       class="border rounded p-2 w-28 min-w-[100px]"
                                       required placeholder="e.g. 1000.00">
                                <button type="button"
                                        class="remove-item bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="add-item"
                                class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition">
                            + Add New Item
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Totals block: Subtotal, VAT, Total -->
        <div class="mb-6 p-4 bg-gray-50 rounded border">
            <h3 class="font-semibold mb-3">Totals</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Subtotal</label>
                    <input type="number" step="0.01" id="subtotal_input" name="subtotal"
                           class="border rounded p-2 w-full" value="{{ number_format($quote->subtotal ?? 0, 2, '.', '') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">VAT (12%)</label>
                    <input type="number" step="0.01" id="vat_input" name="vat"
                           class="border rounded p-2 w-full" value="{{ number_format($quote->vat ?? 0, 2, '.', '') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total</label>
                    <input type="number" step="0.01" id="total_input" name="total"
                           class="border rounded p-2 w-full" value="{{ number_format($quote->total ?? 0, 2, '.', '') }}">
                </div>
            </div>
        </div>

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Save Changes
        </button>
        <a href="{{ route('employee.quotes.management.index') }}"
           class="ml-4 text-gray-600 hover:underline">
            Cancel
        </a>
    </form>
</div>
<br>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = {{ count($quote->items) }};

    // --------- Collapsibles ----------
    const checklistPanel   = document.getElementById('checklist-items');
    const manualPanel      = document.getElementById('manual-items');
    const toggleChecklist  = document.getElementById('toggle-checklist');
    const toggleManual     = document.getElementById('toggle-manual');
    const iconChecklist    = document.getElementById('icon-checklist');
    const iconManual       = document.getElementById('icon-manual');

    let checklistOpen = true;
    let manualOpen    = false;

    function updatePanels() {
        checklistPanel.style.display = checklistOpen ? '' : 'none';
        manualPanel.style.display    = manualOpen ? '' : 'none';
        iconChecklist.style.transform = checklistOpen ? 'rotate(0deg)' : 'rotate(-90deg)';
        iconManual.style.transform    = manualOpen ? 'rotate(0deg)' : 'rotate(-90deg)';
    }

    toggleChecklist.addEventListener('click', function () {
        checklistOpen = !checklistOpen;
        updatePanels();
    });
    toggleManual.addEventListener('click', function () {
        manualOpen = !manualOpen;
        updatePanels();
    });
    updatePanels();

    // --------- Notes collapsible ----------
    const toggleNotes = document.getElementById('toggle-notes');
    const notesPanel  = document.getElementById('notes-panel');
    const iconNotes   = document.getElementById('icon-notes');
    let notesOpen     = {{ isset($notesAreDefault) && $notesAreDefault ? 'false' : 'true' }};

    function updateNotesPanel() {
        notesPanel.style.display = notesOpen ? '' : 'none';
        iconNotes.style.transform = notesOpen ? 'rotate(0deg)' : 'rotate(-90deg)';
    }
    if (toggleNotes) {
        toggleNotes.addEventListener('click', function () {
            notesOpen = !notesOpen;
            updateNotesPanel();
        });
        updateNotesPanel();
    }

    // --------- Toast auto-hide ----------
    const toast = document.getElementById('toast-success');
    if (toast) setTimeout(() => { toast.style.display = 'none'; }, 3000);
    const terr = document.getElementById('toast-error');
    if (terr) setTimeout(() => { terr.style.display = 'none'; }, 8000);

    // --------- QUOTATION ITEMS: client-side search + pagination ----------
    const searchInput    = document.getElementById('quote-item-search');
    const itemsContainer = document.getElementById('quote-items-pagination');
    const prevPageBtn    = document.getElementById('prev-page');
    const nextPageBtn    = document.getElementById('next-page');

    const allRows = Array.from(itemsContainer.querySelectorAll('.checklist-row'));
    const itemsPerPage = 12;
    let currentPage = 1;
    let filteredRows = allRows.slice(); // initial = all

    // show/hide qty/price when checkbox checked
    function bindCheckboxBehaviour(scope) {
        scope.querySelectorAll('.product-check').forEach(function (checkbox) {
            const row   = checkbox.closest('.checklist-row');
            const qty   = row.querySelector('.product-qty');
            const price = row.querySelector('.product-price');

            function sync() {
                if (checkbox.checked) {
                    qty.style.display   = 'block';
                    price.style.display = 'block';
                    qty.required        = true;
                    price.required      = true;
                } else {
                    qty.style.display   = qty.value ? 'block' : 'none';
                    price.style.display = price.value ? 'block' : 'none';
                    qty.required        = false;
                    price.required      = false;
                }
            }

            checkbox.addEventListener('change', sync);
            // initial state
            sync();
        });
    }

    bindCheckboxBehaviour(itemsContainer);

    function renderPage(page) {
        // hide all
        allRows.forEach(row => row.style.display = 'none');

        const totalPages = Math.max(1, Math.ceil(filteredRows.length / itemsPerPage));
        if (page < 1) page = 1;
        if (page > totalPages) page = totalPages;
        currentPage = page;

        const start = (currentPage - 1) * itemsPerPage;
        const end   = start + itemsPerPage;

        filteredRows.slice(start, end).forEach(row => {
            row.style.display = 'flex';
        });

        // enable/disable buttons
        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = currentPage === totalPages;
    }

    function applySearch() {
        const term = (searchInput.value || '').toLowerCase();
        if (!term) {
            filteredRows = allRows.slice();
        } else {
            filteredRows = allRows.filter(row =>
                (row.dataset.name || '').includes(term)
            );
        }
        renderPage(1);
    }

    searchInput.addEventListener('input', applySearch);

    prevPageBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (!this.disabled) renderPage(currentPage - 1);
    });

    nextPageBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (!this.disabled) renderPage(currentPage + 1);
    });

    // initial render
    applySearch();

    // --------- Totals calculation (subtotal, VAT, total) ----------
    const subtotalEl = document.getElementById('subtotal_input');
    const vatEl      = document.getElementById('vat_input');
    const totalInput = document.getElementById('total_input');

    function toNumber(v) {
        const n = parseFloat(String(v).replace(/,/g, ''));
        return isFinite(n) ? n : 0;
    }
    function fmt(n) { return Number(n || 0).toFixed(2); }

    function recalcFromItems() {
        let subtotal = 0;

        // Manual items
        document.querySelectorAll('#items-list .item-row').forEach(function (row) {
            const q = row.querySelector('input[name$="[quantity]"]');
            const p = row.querySelector('input[name$="[unit_price]"]');
            const qty = q ? toNumber(q.value) : 0;
            const price = p ? toNumber(p.value) : 0;
            subtotal += qty * price;
        });

        // Selected products from checklist
        document.querySelectorAll('.checklist-row').forEach(function (row) {
            const cb = row.querySelector('.product-check');
            if (!cb || !cb.checked) return;
            const q = row.querySelector('.product-qty');
            const p = row.querySelector('.product-price');
            const qty = q ? toNumber(q.value) : 0;
            const price = p ? toNumber(p.value) : 0;
            subtotal += qty * price;
        });

        const vat = subtotal * 0.12;
        const total = subtotal + vat;

        subtotalEl.value = fmt(subtotal);
        vatEl.value = fmt(vat);
        totalInput.value = fmt(total);
    }

    function recalcFromTotal() {
        const total = toNumber(totalInput.value);
        const subtotal = total / 1.12;
        const vat = total - subtotal;

        subtotalEl.value = fmt(subtotal);
        vatEl.value = fmt(vat);
    }

    // When user edits subtotal directly, recalc VAT only (do NOT auto-update Total)
    if (subtotalEl) {
        subtotalEl.addEventListener('input', function () {
            const subtotal = toNumber(subtotalEl.value);
            const vat = subtotal * 0.12;
            // update VAT field but do not override Total here — user requested Total not auto-updated
            vatEl.value = fmt(vat);
        });
    }

    // When user edits VAT directly, do NOT auto-update Total (VAT is independent)
    if (vatEl) {
        vatEl.addEventListener('input', function () {
            // Leave Total unchanged when VAT is manually edited
            // Optionally validate numeric format for VAT
            vatEl.value = fmt(toNumber(vatEl.value));
        });
    }

    // Bind events: any change in quantities/prices or checkboxes -> recalcFromItems
    document.querySelectorAll('.product-qty, .product-price').forEach(function (el) {
        el.addEventListener('input', recalcFromItems);
    });
    document.querySelectorAll('.product-check').forEach(function (el) {
        el.addEventListener('change', recalcFromItems);
    });
    // Manual items binding (dynamic rows may be added)
    const itemsList = document.getElementById('items-list');
    if (itemsList) {
        itemsList.addEventListener('input', function (e) {
            if (e.target && (e.target.name && (e.target.name.includes('[quantity]') || e.target.name.includes('[unit_price]')))) {
                recalcFromItems();
            }
        });
    }

    // When user edits total directly, propagate back to subtotal & vat
    if (totalInput) {
        totalInput.addEventListener('input', function () {
            recalcFromTotal();
        });
    }

    // Initialize totals on load
    recalcFromItems();
});
</script>
@endsection
