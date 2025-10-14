@extends('layouts.ecommerce')

@section('content')
<div class="container mx-auto max-w-2xl p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Quotation</h2>
    <form action="{{ route('employee.quotes.update', $quote->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Name</label>
            <input type="text" name="customer_name" class="border rounded p-2 w-full" value="{{ $quote->user->name ?? '' }}" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Email</label>
            <input type="email" name="customer_email" class="border rounded p-2 w-full" value="{{ $quote->user->email ?? '' }}" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Address</label>
            <input type="text" name="customer_address" class="border rounded p-2 w-full" value="{{ $quote->user->address ?? '' }}" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Contact Number</label>
            <input type="text" name="customer_contact" class="border rounded p-2 w-full" value="{{ $quote->user->contact_no ?? '' }}" required>
        </div>
        <div class="mb-6">
            <label class="block font-semibold mb-1">Quotation Items</label>
            <!-- Collapsible: Select from Available Items -->
            <div class="mb-2">
                <button type="button" id="toggle-checklist" class="w-full flex justify-between items-center bg-gray-200 px-4 py-2 rounded-t font-semibold focus:outline-none">
                    <span>Select from Available Items</span>
                    <svg id="icon-checklist" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="checklist-items" class="bg-gray-50 rounded-b p-4">
                    @php
                        $quoteProductMap = collect($quote->items)->keyBy('product_id');
                    @endphp
                    <div class="space-y-2">
                    @foreach($products as $product)
                        @php
                            $item = $quoteProductMap[$product->id] ?? null;
                        @endphp
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 checklist-row hover:bg-gray-100 rounded px-2 py-1">
                            <div class="flex items-center gap-2 min-w-0 w-full sm:w-auto">
                                <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="product-check accent-green-600" id="product-{{ $product->id }}" {{ $item ? 'checked' : '' }}>
                                <label for="product-{{ $product->id }}" class="cursor-pointer select-none break-words w-full sm:w-64">{{ $product->name }}</label>
                            </div>
                            <div class="flex gap-2 w-full sm:w-auto">
                                <input type="number" name="product_quantities[{{ $product->id }}]" value="{{ $item ? $item->quantity : '' }}" min="1" class="border rounded p-2 w-20 min-w-[80px] product-qty focus:ring-2 focus:ring-green-400" placeholder="Qty" style="display:{{ $item ? 'block' : 'none' }};">
                                <input type="number" name="product_prices[{{ $product->id }}]" value="{{ $item ? $item->unit_price : '' }}" min="0" step="0.01" class="border rounded p-2 w-28 min-w-[100px] product-price focus:ring-2 focus:ring-green-400" placeholder="Unit Price" style="display:{{ $item ? 'block' : 'none' }};">
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <!-- Collapsible: Manual Input -->
            <div class="mt-4">
                <button type="button" id="toggle-manual" class="w-full flex justify-between items-center bg-gray-200 px-4 py-2 rounded-t font-semibold focus:outline-none">
                    <span>Manual Input</span>
                    <svg id="icon-manual" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="manual-items" class="bg-gray-50 rounded-b p-4" style="display:none;">
                    <div id="items-list" class="space-y-3 mb-4">
                        @foreach($quote->items as $i => $item)
                            <div class="flex flex-wrap items-center gap-3 item-row">
                                <input type="text" name="items[{{ $i }}][name]" value="{{ $item->name }}" class="border rounded p-2 w-1/2 min-w-[180px]" required placeholder="e.g. Product Name">
                                <input type="number" name="items[{{ $i }}][quantity]" value="{{ $item->quantity }}" min="1" class="border rounded p-2 w-20 min-w-[80px]" required placeholder="e.g. 1">
                                <input type="number" name="items[{{ $i }}][unit_price]" value="{{ $item->unit_price }}" min="0" step="0.01" class="border rounded p-2 w-28 min-w-[100px]" required placeholder="e.g. 1000.00">
                                <button type="button" class="remove-item bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="add-item" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition">+ Add New Item</button>
                    </div>
                </div>
            </div>
        </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Save Changes</button>
    <a href="{{ route('employee.quotes.management.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let itemIndex = {{ count($quote->items) }};
        const manualRadio = document.getElementById('manual');
        const checklistRadio = document.getElementById('checklist');
        const manualItems = document.getElementById('manual-items');
        const checklistItems = document.getElementById('checklist-items');
        // Collapsible panels for checklist and manual
        const checklistPanel = document.getElementById('checklist-items');
        const manualPanel = document.getElementById('manual-items');
        const toggleChecklist = document.getElementById('toggle-checklist');
        const toggleManual = document.getElementById('toggle-manual');
        const iconChecklist = document.getElementById('icon-checklist');
        const iconManual = document.getElementById('icon-manual');
        let checklistOpen = true;
        let manualOpen = false;
        function updatePanels() {
            checklistPanel.style.display = checklistOpen ? '' : 'none';
            manualPanel.style.display = manualOpen ? '' : 'none';
            iconChecklist.style.transform = checklistOpen ? 'rotate(0deg)' : 'rotate(-90deg)';
            iconManual.style.transform = manualOpen ? 'rotate(0deg)' : 'rotate(-90deg)';
        }
        toggleChecklist.addEventListener('click', function() {
            checklistOpen = !checklistOpen;
            updatePanels();
        });
        toggleManual.addEventListener('click', function() {
            manualOpen = !manualOpen;
            updatePanels();
        });
        updatePanels();
        // Checklist: show/hide qty/price fields for checked products
        document.querySelectorAll('.product-check').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const row = this.closest('.checklist-row');
                const qty = row.querySelector('.product-qty');
                const price = row.querySelector('.product-price');
                if (this.checked) {
                    qty.style.display = 'block';
                    price.style.display = 'block';
                    qty.required = true;
                    price.required = true;
                } else {
                    qty.style.display = 'none';
                    price.style.display = 'none';
                    qty.required = false;
                    price.required = false;
                }
            });
        });
    });
</script>
@endsection
