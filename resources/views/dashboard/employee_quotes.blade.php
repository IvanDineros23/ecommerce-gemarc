@extends('layouts.app')
@section('title', 'Quote Management | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-2">Quote Management</h1>
        <p class="text-gray-700">View and manage all customer quote requests here.</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th class="py-2">Quote #</th>
                    <th class="py-2">Customer</th>
                    <th class="py-2">Date</th>
                    <th class="py-2">Status</th>
                    <th class="py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotes as $quote)
                <tr class="border-b">
                    <td class="py-2 font-mono">{{ $quote->id }}</td>
                    <td class="py-2">{{ $quote->user->name ?? 'N/A' }}</td>
                    <td class="py-2">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2">{{ ucfirst($quote->status ?? 'pending') }}</td>
                    <td class="py-2">
                        <button class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700" onclick="showQuoteModal({{ $quote->id }})">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @foreach($quotes as $quote)
        <div id="quote-modal-{{ $quote->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
                <button onclick="closeQuoteModal({{ $quote->id }})" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-bold mb-2 text-purple-800">Quote #{{ $quote->id }}</h2>
                <div class="mb-2 text-sm text-gray-600">Customer: <span class="font-semibold text-gray-900">{{ $quote->user->name ?? 'N/A' }}</span></div>
                <div class="mb-4 text-sm text-gray-600">Date: {{ $quote->created_at->format('Y-m-d H:i') }}</div>
                <div class="mb-4">
                    <div class="font-semibold mb-1">Requested Items:</div>
                    <table class="min-w-full text-xs border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-1 px-2">Product</th>
                                <th class="py-1 px-2">Qty</th>
                                <th class="py-1 px-2">Unit Price</th>
                                <th class="py-1 px-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quote->items as $item)
                            <tr>
                                <td class="py-1 px-2">{{ $item->name }}</td>
                                <td class="py-1 px-2 text-center">{{ $item->quantity }}</td>
                                <td class="py-1 px-2 text-right">₱{{ number_format($item->unit_price, 2) }}</td>
                                <td class="py-1 px-2 text-right">₱{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right font-bold text-lg text-purple-700 mb-2">Total: ₱{{ number_format($quote->total, 2) }}</div>

                <form method="POST" action="{{ route('employee.quotes.upload', $quote->id) }}" enctype="multipart/form-data" class="mt-4 border-t pt-4">
                    @csrf
                    <label class="block mb-2 font-semibold">Upload Quotation (PDF only):</label>
                    <input type="file" name="quote_file" accept="application/pdf" class="mb-2" required>
                    <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Upload PDF</button>
                </form>
            </div>
        </div>
        @endforeach
        <script>
        function showQuoteModal(id) {
            // Hide all modals first
            document.querySelectorAll('[id^=quote-modal-]').forEach(function(modal) {
                modal.classList.add('hidden');
            });
            // Show the selected modal
            document.getElementById('quote-modal-' + id).classList.remove('hidden');
        }
        function closeQuoteModal(id) {
            document.getElementById('quote-modal-' + id).classList.add('hidden');
        }
        // Optional: close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^=quote-modal-]').forEach(function(modal) {
                    modal.classList.add('hidden');
                });
            }
        });
        </script>
    </div>
</div>
@endsection
