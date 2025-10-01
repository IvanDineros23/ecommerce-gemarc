@extends('layouts.admin')
@section('content')
<div class="max-w-xl mx-auto py-10">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Product</h1>
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Product Name</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Description</label>
            <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Unit Price</label>
            <input type="number" name="unit_price" class="w-full border border-gray-300 rounded px-3 py-2" min="0" step="0.01" value="{{ old('unit_price', $product->unit_price) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Stock Quantity</label>
            <input type="number" name="stock_qty" class="w-full border border-gray-300 rounded px-3 py-2" min="0" step="1" value="{{ old('stock_qty', $product->stock) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Image</label>
            <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2">
            @php $img = $product->firstImagePath(); @endphp
            @if($img)
                <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded mt-2">
            @endif
        </div>
        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 font-semibold">Update Product</button>
        <a href="{{ route('admin.products') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
