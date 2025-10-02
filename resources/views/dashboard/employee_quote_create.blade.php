@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Create New Quotation</h2>
    <form action="{{ route('employee.quotes.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Name</label>
            <input type="text" name="customer_name" class="border rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Email</label>
            <input type="email" name="customer_email" class="border rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Customer Address</label>
            <input type="text" name="customer_address" class="border rounded p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Contact Number</label>
            <input type="text" name="customer_contact" class="border rounded p-2 w-full" required>
        </div>
        <div class="mb-6">
            <label class="block font-semibold mb-1">Quotation Items</label>
            <div class="flex items-center mb-2">
                <input type="radio" name="item_mode" value="manual" id="manual" checked class="mr-2">
                <label for="manual">Manual Input</label>
                <input type="radio" name="item_mode" value="checklist" id="checklist" class="ml-6 mr-2">
                <label for="checklist">Select from Available Items</label>
            </div>
            <div id="manual-items">
                <textarea name="manual_items" rows="4" class="border rounded p-2 w-full" placeholder="Type items here, one per line..."></textarea>
            </div>
            <div id="checklist-items" style="display:none;">
                @foreach($products as $product)
                    <div class="flex items-center mb-1">
                        <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="mr-2">
                        <span>{{ $product->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Create Quotation</button>
        <a href="{{ route('employee.dashboard') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const manualRadio = document.getElementById('manual');
        const checklistRadio = document.getElementById('checklist');
        const manualItems = document.getElementById('manual-items');
        const checklistItems = document.getElementById('checklist-items');
        manualRadio.addEventListener('change', function() {
            if (manualRadio.checked) {
                manualItems.style.display = '';
                checklistItems.style.display = 'none';
            }
        });
        checklistRadio.addEventListener('change', function() {
            if (checklistRadio.checked) {
                manualItems.style.display = 'none';
                checklistItems.style.display = '';
            }
        });
    });
</script>
@endsection
