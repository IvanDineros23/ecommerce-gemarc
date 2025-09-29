@extends('layouts.app')
@section('title', 'Quote Management | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-2">Quote Management</h1>
        <p class="text-gray-700">View and manage all customer quote requests here.</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">

        {{-- Filters --}}
        <form method="GET" action="" class="mb-4 flex flex-wrap gap-2 items-center justify-between">
            <div class="flex gap-2 items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search user or quote..."
                       class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-200 min-w-[220px]">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Search</button>
            </div>
            <div class="flex gap-2 items-center">
                <label for="status" class="font-semibold text-gray-700">Status:</label>
                <select name="status" id="status" onchange="this.form.submit()"
                        class="border border-gray-300 rounded px-2 py-2 focus:outline-none focus:ring-2 focus:ring-purple-200">
                    <option value="">All</option>
                    <option value="open" {{ request('status')=='open' ? 'selected' : '' }}>Open</option>
                    <option value="done" {{ request('status')=='done' ? 'selected' : '' }}>Done</option>
                    <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <label for="sort" class="font-semibold text-gray-700 ml-4">Sort:</label>
                <select name="sort" id="sort" onchange="this.form.submit()"
                        class="border border-gray-300 rounded px-2 py-2 focus:outline-none focus:ring-2 focus:ring-purple-200">
                    <option value="desc" {{ request('sort','desc')=='desc' ? 'selected' : '' }}>Newest to Oldest</option>
                    <option value="asc"  {{ request('sort')=='asc' ? 'selected' : '' }}>Oldest to Newest</option>
                </select>
            </div>
        </form>

        {{-- Table --}}
        <table class="min-w-full text-sm">
            <thead>
            <tr class="text-left border-b">
                <th class="py-2">Quote #</th>
                <th class="py-2">Customer</th>
                <th class="py-2">Date</th>
                <th class="py-2">Status</th>
                <th class="py-2 text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quotes as $quote)
                <tr class="border-b">
                    <td class="py-2 font-mono">{{ $quote->id }}</td>
                    <td class="py-2">{{ $quote->user->name ?? 'N/A' }}</td>
                    <td class="py-2">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2">{{ ucfirst($quote->status ?? 'pending') }}</td>
                    <td class="py-2 text-center">
                        <div class="inline-flex gap-2">
                            <button type="button"
                                    class="bg-purple-100 text-purple-800 px-3 py-1 rounded hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-400 flex items-center gap-1 font-semibold min-w-[110px]"
                                    onclick="showQuoteModal({{ $quote->id }})">
                                <span>👁️</span><span>View Details</span>
                            </button>

                            @if($quote->response_file)
                                <a href="{{ asset('storage/' . $quote->response_file) }}" target="_blank"
                                   class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 flex items-center gap-1 min-w-[110px]">
                                    <span>⬇️</span><span>Download</span>
                                </a>
                            @endif

                            <form method="POST" action="{{ route('employee.quotes.management.destroy', $quote->id) }}"
                                  class="inline-block min-w-[110px]" onsubmit="return confirm('Delete this quote?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 flex items-center gap-1">
                                    <span>🗑️</span><span>Delete</span>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('employee.quotes.management.done', $quote->id) }}"
                                  class="inline-block min-w-[110px]" onsubmit="return confirm('Mark as done?');">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 flex items-center gap-1">
                                    <span>✔️</span><span>Mark as Done</span>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('employee.quotes.management.cancel', $quote->id) }}"
                                  class="inline-block min-w-[110px]" onsubmit="return confirm('Cancel this quote?');">
                                @csrf @method('PATCH')
                                <button type="submit" class="bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-600 flex items-center gap-1">
                                    <span>🚫</span><span>Cancel</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- MODALS: render one per quote (AFTER the table) --}}
        @foreach($quotes as $quote)
            <div id="quote-modal-{{ $quote->id }}" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
                {{-- Backdrop (click to close) --}}
                <div class="absolute inset-0 bg-black/50" onclick="closeQuoteModal({{ $quote->id }})"></div>

                {{-- Centered wrapper with comfortable margins --}}
                <div class="relative flex min-h-full items-center justify-center p-4 md:p-10 lg:p-16">
                    <div
                        class="relative w-full max-w-3xl rounded-2xl bg-white shadow-xl ring-1 ring-black/5
                               max-h-[85vh] overflow-hidden
                               transform transition-all duration-200
                               hover:shadow-2xl hover:-translate-y-0.5 hover:scale-[1.01]">

                        {{-- Close button (top-right) --}}
                        <button type="button"
                                onclick="closeQuoteModal({{ $quote->id }})"
                                class="absolute top-3 right-3 inline-flex items-center justify-center
                                       h-10 w-10 rounded-full text-gray-500 hover:text-gray-700
                                       hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-300"
                                aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        {{-- Scrollable content --}}
                        <div class="p-6 md:p-10 space-y-6 overflow-y-auto max-h-[85vh]">
                            <div class="text-center">
                                <h2 class="text-xl font-bold text-purple-800">Quote #{{ $quote->id }}</h2>
                                <div class="mt-2 text-sm text-gray-600">
                                    Customer:
                                    <span class="font-semibold text-gray-900">{{ $quote->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    Date: {{ $quote->created_at->format('Y-m-d H:i') }}
                                </div>
                            </div>

                            <div>
                                <div class="font-semibold mb-3">Requested Items:</div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full text-xs border">
                                        <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-1 px-2 text-left">Product</th>
                                            <th class="py-1 px-2 text-center">Qty</th>
                                            <th class="py-1 px-2 text-right">Unit Price</th>
                                            <th class="py-1 px-2 text-right">Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quote->items as $item)
                                            <tr class="border-t">
                                                <td class="py-1 px-2">{{ $item->name }}</td>
                                                <td class="py-1 px-2 text-center">{{ $item->quantity }}</td>
                                                <td class="py-1 px-2 text-right">₱{{ number_format($item->unit_price, 2) }}</td>
                                                <td class="py-1 px-2 text-right">₱{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="w-full flex justify-end font-bold text-lg text-purple-700 mt-4">
                                    Total: ₱{{ number_format($quote->total, 2) }}
                                </div>
                            </div>

                            <form method="POST" action="{{ route('employee.quotes.upload', $quote->id) }}"
                                  enctype="multipart/form-data" class="border-t pt-6 text-center">
                                @csrf
                                <label class="block mb-2 font-semibold">Upload Quotation (PDF only):</label>
                                <input type="file" name="quote_file" accept="application/pdf" class="mb-3" required>
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    Upload PDF
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- /MODALS --}}
    </div>
</div>

<script>
    function showQuoteModal(id) {
        document.querySelectorAll('[id^=quote-modal-]').forEach(m => m.classList.add('hidden'));
        document.getElementById('quote-modal-' + id).classList.remove('hidden');
    }
    function closeQuoteModal(id) {
        document.getElementById('quote-modal-' + id).classList.add('hidden');
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            document.querySelectorAll('[id^=quote-modal-]').forEach(m => m.classList.add('hidden'));
        }
    });
</script>
@endsection
