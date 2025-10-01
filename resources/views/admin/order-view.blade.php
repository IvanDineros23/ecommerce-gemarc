@extends('layouts.admin')
@section('title', 'Order Details | Admin Panel')

@section('content')
<div class="py-6 px-2">
    <h2 class="text-lg font-semibold mb-4 text-center">Order #{{ $order->id }}</h2>
    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-2">
        <div>
            <div><span class="font-bold">Customer:</span> {{ $order->user->name ?? 'Guest' }}</div>
            <div><span class="font-bold">Email:</span> {{ $order->user->email ?? '-' }}</div>
        </div>
        <div>
            <div><span class="font-bold">Date:</span> {{ $order->created_at->format('Y-m-d H:i') }}</div>
            <div><span class="font-bold">Status:</span> {{ ucfirst($order->status) }}</div>
        </div>
    </div>
    <div class="mb-4">
        <span class="font-bold">Total:</span> ₱{{ number_format($order->total, 2) }}
    </div>
    <div>
        <div class="font-bold mb-2">Order Items</div>
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
                    @foreach($order->items as $item)
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
