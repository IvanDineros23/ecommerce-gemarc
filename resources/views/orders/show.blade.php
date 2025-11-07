@extends('layouts.app')
@section('title', 'Order Details | Gemarc Enterprises Inc.')
@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg">
        <div class="border-b border-gray-200 bg-gray-50 px-8 py-6 rounded-t-xl">
            <h1 class="text-3xl font-bold text-green-800">Order Details</h1>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <div class="text-gray-700 mb-4 text-lg">
                        <span class="text-gray-500">Reference #:</span> 
                        <span class="font-semibold ml-2">{{ $order->reference_number }}</span>
                    </div>
                    <div class="text-gray-700 mb-4 text-lg">
                        <span class="text-gray-500">Order Date:</span>
                        <span class="font-semibold ml-2">{{ $order->created_at->format('F d, Y h:i A') }}</span>
                    </div>
                    <div class="text-gray-700 mb-4 text-lg">
                        <span class="text-gray-500">Status:</span>
                        <span class="font-semibold ml-2">{{ ucfirst($order->status) }}</span>
                    </div>
                </div>
                <div>
                    <div class="text-gray-700 mb-4 text-lg">
                        <span class="text-gray-500">Mode of Payment:</span>
                        <span class="font-semibold ml-2">{{ $order->payment_method ?? 'N/A' }}</span>
                    </div>
                    <div class="text-gray-700 mb-4 text-lg">
                        <span class="text-gray-500">Mode of Delivery:</span>
                        <span class="font-semibold ml-2">{{ $order->delivery_method ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden mb-8">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="py-4 px-6 text-left text-base font-semibold text-gray-900">Product</th>
                        <th class="py-4 px-6 text-center text-base font-semibold text-gray-900">Quantity</th>
                        <th class="py-4 px-6 text-right text-base font-semibold text-gray-900">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <tr class="hover:bg-white transition-colors duration-150">
                            <td class="py-5 px-6">
                                <div class="text-base font-medium text-gray-900">{{ $item->name }}</div>
                            </td>
                            <td class="py-5 px-6">
                                <div class="text-base font-medium text-center text-gray-900">{{ $item->quantity }}</div>
                            </td>
                            <td class="py-5 px-6">
                                <div class="flex items-center justify-end gap-4">
                                    @if($order->status === 'cancelled')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            Cancelled
                                        </span>
                                    @elseif($item->quote_status === 'ready')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            Quote Ready
                                        </span>
                                        <a href="{{ route('quotes.download', $item->quote_id) }}" 
                                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 rounded-lg transition-colors duration-200"
                                           title="Download Quote PDF">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3v-13" />
                                            </svg>
                                            View Quote
                                        </a>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            Pending Quote
                                        </span>
                                        <div class="text-sm text-gray-600">
                                            Quote in preparation
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($order->status !== 'cancelled')
        <div class="bg-blue-50 rounded-lg p-6 mb-8 flex items-start gap-4">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-blue-900 mb-1">Quote Process</h3>
                <p class="text-base text-blue-700">
                    Our team will review your order and prepare a detailed quote. You'll receive a notification once the quote is ready for viewing.
                </p>
            </div>
        </div>
        @endif
        <a href="{{ route('orders.index') }}" 
           class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-base font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to My Orders
        </a>
    </div>
</div>
@endsection
