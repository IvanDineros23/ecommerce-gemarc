@extends('layouts.app')
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
