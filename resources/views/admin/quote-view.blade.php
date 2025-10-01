@extends('layouts.admin')
@section('title', 'Quote Details | Admin Panel')

@section('content')
<div class="py-6 px-2">
    <h2 class="text-lg font-semibold mb-4 text-center">Quote #{{ $quote->id }}</h2>
    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-2">
        <div>
            <div><span class="font-bold">Customer:</span> {{ $quote->user->name ?? 'Guest' }}</div>
            <div><span class="font-bold">Email:</span> {{ $quote->user->email ?? '-' }}</div>
        </div>
        <div>
            <div><span class="font-bold">Date:</span> {{ $quote->created_at->format('Y-m-d H:i') }}</div>
            <div><span class="font-bold">Status:</span> {{ ucfirst($quote->status ?? 'pending') }}</div>
        </div>
    </div>
    <div class="mb-4">
        <span class="font-bold">Total:</span> ₱{{ number_format($quote->total, 2) }}
    </div>
    <div>
        <div class="font-bold mb-2">Quote Items</div>
        <div class="overflow-x-auto">
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 border-b text-left">Product</th>
                        <th class="px-3 py-2 border-b text-right">Quantity</th>
                        <th class="px-3 py-2 border-b text-right">Unit Price</th>
                        <th class="px-3 py-2 border-b text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quote->items as $item)
                    <tr>
                        <td class="px-3 py-2 border-b">{{ $item->product->name ?? 'Product Deleted' }}</td>
                        <td class="px-3 py-2 border-b text-right">{{ $item->quantity }}</td>
                        <td class="px-3 py-2 border-b text-right">₱{{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-3 py-2 border-b text-right">₱{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
