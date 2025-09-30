@extends('layouts.app')
@section('title', 'Checkout | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold text-green-800 mb-4">Order Receipt</h1>
        <div class="flex justify-between items-center mb-2">
            <span class="text-gray-700">Reference #: <span class="font-semibold">{{ isset($order) ? $order->reference_number : 'N/A' }}</span></span>
        </div>
        <div class="mb-6">
            <div class="text-gray-700 mb-2">Order Date: <span class="font-semibold">{{ isset($order) ? $order->created_at->format('F d, Y h:i A') : now()->format('F d, Y h:i A') }}</span></div>
            <div class="text-gray-700 mb-2">Customer: <span class="font-semibold">{{ auth()->user()->name }}</span></div>
            <div class="text-gray-700 mb-2">Mode of Payment: <span class="font-semibold">{{ request('payment_method') ?? 'N/A' }}</span></div>
            <div class="text-gray-700 mb-2">Mode of Delivery: <span class="font-semibold">{{ request('delivery_method') ?? 'N/A' }}</span></div>
        </div>
        <table class="w-full mb-6 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-3 text-left">Product</th>
                    <th class="py-2 px-3 text-right">Qty</th>
                    <th class="py-2 px-3 text-right">Unit Price</th>
                    <th class="py-2 px-3 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td class="py-2 px-3">{{ $item->product->name }}</td>
                        <td class="py-2 px-3 text-right">{{ $item->qty }}</td>
                        <td class="py-2 px-3 text-right">₱{{ number_format($item->unit_price, 2) }}</td>
                        <td class="py-2 px-3 text-right">₱{{ number_format($item->qty * $item->unit_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="font-bold">
                    <td colspan="3" class="py-2 px-3 text-right">Total</td>
                    <td class="py-2 px-3 text-right">₱{{ number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="flex justify-between items-center mt-8">
            <div class="flex flex-col md:flex-row gap-6 w-full">
                <form method="POST" action="{{ route('cart.checkout.process') }}" x-data="{ showModal: {{ session('checkout_success') ? 'true' : 'false' }} }" class="flex-1">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-1">Mode of Payment</label>
                            <select name="payment_method" id="payment_method" class="border rounded px-3 py-2 w-full">
                                <option value="cod">Cash on Delivery</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="gcash">GCash</option>
                            </select>
                        </div>
                        <div>
                            <label for="delivery_method" class="block text-sm font-semibold text-gray-700 mb-1">Mode of Delivery</label>
                            <select name="delivery_method" id="delivery_method" class="border rounded px-3 py-2 w-full">
                                <option value="pickup">Pickup</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded font-semibold hover:bg-orange-600 w-full md:w-auto">Checkout Now</button>
                    <!-- Success Modal -->
                    <div x-show="showModal" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
                        <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
                            <div class="text-green-600 text-4xl mb-2">&#10003;</div>
                            <h2 class="text-xl font-bold mb-2">Order Successful!</h2>
                            <p class="mb-4">Thank you for your order. Redirecting to dashboard...</p>
                            <button @click="window.location.href='{{ route('dashboard') }}'" class="bg-green-600 text-white px-4 py-2 rounded font-semibold hover:bg-green-700">Go to Dashboard Now</button>
                        </div>
                    </div>
                    <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('checkoutModal', () => ({
                            showModal: false,
                            init() {
                                this.$watch('showModal', value => {
                                    if (value) {
                                        setTimeout(() => {
                                            window.location.href = '{{ route('dashboard') }}';
                                        }, 2000);
                                    }
                                });
                            }
                        }));
                    });
                    </script>
                </form>
            <div class="flex justify-start mt-6">
                <div class="flex flex-col items-start gap-2">
                    <a href="{{ route('shop.index') }}" class="bg-green-600 text-white px-3 py-1 rounded font-semibold hover:bg-green-700 text-sm">Back to Shop</a>
                    <button onclick="window.print()" class="bg-blue-500 text-white px-3 py-1 rounded font-semibold hover:bg-blue-600 text-sm mt-1">Print</button>
                </div>
            </div>
            </div>
                <!-- Success Modal -->
                <div x-show="showModal" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
                    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
                        <div class="text-green-600 text-4xl mb-2">&#10003;</div>
                        <h2 class="text-xl font-bold mb-2">Order Successful!</h2>
                        <p class="mb-4">Thank you for your order. Redirecting to dashboard...</p>
                        <button @click="window.location.href='{{ route('dashboard') }}'" class="bg-green-600 text-white px-4 py-2 rounded font-semibold hover:bg-green-700">Go to Dashboard Now</button>
                    </div>
                </div>
                <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('checkoutModal', () => ({
                        showModal: false,
                        init() {
                            this.$watch('showModal', value => {
                                if (value) {
                                    setTimeout(() => {
                                        window.location.href = '{{ route('dashboard') }}';
                                    }, 2000);
                                }
                            });
                        }
                    }));
                });
                </script>
            </form>
        </div>
    </div>
</div>
@endsection
