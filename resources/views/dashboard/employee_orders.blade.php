@extends('layouts.ecommerce')
@section('title', 'Order Management | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-green-800 mb-2">Order Management</h1>
        <p class="text-gray-700">View and manage all customer orders here.</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th class="py-2">Order #</th>
                    <th class="py-2">Customer</th>
                    <th class="py-2">Date</th>
                    <th class="py-2">Status</th>
                    <th class="py-2">Total</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b">
                    <td class="py-2 font-mono">{{ $order->reference_number }}</td>
                    <td class="py-2">{{ $order->user->name ?? 'N/A' }}</td>
                    <td class="py-2">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2">{{ ucfirst($order->status) }}</td>
                    <td class="py-2">₱{{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-2 flex gap-2">
                        <!-- View Details Button -->
                        <button class="bg-green-600 text-white px-2 py-1 rounded" onclick="toggleOrderDetails({{ $order->id }})">View Details</button>
                        <!-- Mark as Done Button -->
                        <form method="POST" action="{{ route('employee.orders.done', $order) }}" style="display:inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded">Mark as Done</button>
                        </form>
                        <!-- Upload Receipt Button -->
                        <form method="POST" action="{{ route('employee.orders.upload', $order) }}" enctype="multipart/form-data" style="display:inline">
                            @csrf
                            <input type="file" name="receipt" accept="application/pdf" class="hidden" id="upload-{{ $order->id }}" onchange="this.form.submit()">
                            <label for="upload-{{ $order->id }}" class="bg-orange-500 text-white px-2 py-1 rounded cursor-pointer hover:bg-orange-600">Upload Receipt</label>
                        </form>
                        <!-- Delete Order Button -->
                        <form method="POST" action="{{ route('employee.orders.destroy', $order) }}" style="display:inline" onsubmit="return confirm('Delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr id="order-details-{{ $order->id }}" style="display: none; background: #f9f9f9;">
                    <td colspan="6" class="p-0">
                        <div class="p-6">
                            <h2 class="text-xl font-bold mb-2 text-green-800">Order #{{ $order->reference_number }}</h2>
                            <div class="mb-1 text-gray-700">Customer: <span class="font-semibold">{{ $order->user->name ?? 'N/A' }}</span></div>
                            <div class="mb-1 text-gray-700">Date: <span class="font-semibold">{{ $order->created_at->format('Y-m-d H:i') }}</span></div>
                            <div class="mb-1 text-gray-700">Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span></div>
                            <div class="mb-1 text-gray-700">Mode of Payment: <span class="font-semibold">{{ $order->payment_method ?? 'N/A' }}</span></div>
                            <div class="mb-1 text-gray-700">Mode of Delivery: <span class="font-semibold">{{ $order->delivery_method ?? 'N/A' }}</span></div>
                            <div class="mb-3 text-gray-700">Total: <span class="font-semibold">₱{{ number_format($order->total_amount, 2) }}</span></div>
                            <table class="w-full text-sm mb-2">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-2 px-3 text-left">Product</th>
                                        <th class="py-2 px-3 text-right">Qty</th>
                                        <th class="py-2 px-3 text-right">Unit Price</th>
                                        <th class="py-2 px-3 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td class="py-2 px-3">{{ $item->product->name ?? $item->name }}</td>
                                        <td class="py-2 px-3 text-right">{{ $item->quantity }}</td>
                                        <td class="py-2 px-3 text-right">₱{{ number_format($item->unit_price, 2) }}</td>
                                        <td class="py-2 px-3 text-right">₱{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function toggleOrderDetails(orderId) {
        var detailsRow = document.getElementById('order-details-' + orderId);
        if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
            detailsRow.style.display = 'table-row';
        } else {
            detailsRow.style.display = 'none';
        }
    }
</script>
@endsection
