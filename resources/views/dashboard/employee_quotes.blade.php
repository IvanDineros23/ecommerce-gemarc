@extends('layouts.ecommerce')
@section('title', 'Quote Management | Gemarc Enterprises Inc.')
@section('content')
{{-- Toast notifications --}}
@php
    $toastType = null;
    $toastMessage = null;

    if (session('success')) {
        $toastType = 'success';
        $toastMessage = session('success');
    } elseif (session('error')) {
        $toastType = 'error';
        $toastMessage = session('error');
    } elseif (session('info')) {
        $toastType = 'info';
        $toastMessage = session('info');
    }
@endphp

@if($toastType && $toastMessage)
    <div id="toast"
         class="fixed top-4 right-4 z-50 transition-opacity duration-300">
        <div class="flex items-start gap-3 px-4 py-3 rounded-lg shadow-lg
            @if($toastType === 'success') bg-green-600 text-white
            @elseif($toastType === 'error') bg-red-600 text-white
            @else bg-blue-600 text-white @endif">
            <div class="mt-0.5">
                @if($toastType === 'success')
                    ✅
                @elseif($toastType === 'error')
                    ❌
                @else
                    ℹ️
                @endif
            </div>
            <div class="text-sm font-medium">
                {{ $toastMessage }}
            </div>
            <button type="button"
                    onclick="hideToast()"
                    class="ml-2 text-white/80 hover:text-white text-lg leading-none">
                &times;
            </button>
        </div>
    </div>

    <script>
        function hideToast() {
            const toast = document.getElementById('toast');
            if (!toast) return;
            toast.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => toast.remove(), 300);
        }

        // auto-hide after 4 seconds
        window.addEventListener('load', function () {
            setTimeout(hideToast, 4000);
        });
    </script>
@endif
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-2 text-center">Quote Management</h1>
    </div>

    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('employee.quotes.manual.create.form') }}"
           class="bg-green-600 text-white px-5 py-2 rounded shadow hover:bg-green-700 font-bold">
            + Create Manual Quote
        </a>
    </div>

    {{-- MAIN CARD --}}
    <div class="bg-white rounded-xl shadow border border-gray-200">
        {{-- Tabs header --}}
        <div class="px-4 pt-4 border-b border-gray-200">
            <div class="inline-flex rounded-lg overflow-hidden bg-gray-50">
                <button
                    type="button"
                    class="tab-trigger px-4 py-2 text-sm font-semibold text-purple-700 bg-white border-b-2 border-purple-600"
                    data-tab="manual-quotes">
                    Manual Quotes
                </button>
                <button
                    type="button"
                    class="tab-trigger px-4 py-2 text-sm font-semibold text-gray-500 hover:text-purple-700 hover:bg-purple-50 border-b-2 border-transparent"
                    data-tab="pending-quotes">
                    Pending Quotes
                </button>
                <button
                    type="button"
                    class="tab-trigger px-4 py-2 text-sm font-semibold text-gray-500 hover:text-purple-700 hover:bg-purple-50 border-b-2 border-transparent"
                    data-tab="all-quotes">
                    All Quotes
                </button>
                <button
                    type="button"
                    class="tab-trigger px-4 py-2 text-sm font-semibold text-gray-500 hover:text-purple-700 hover:bg-purple-50 border-b-2 border-transparent"
                    data-tab="cancelled-quotes">
                    Cancelled Quotes
                </button>
            </div>
            {{-- Cancelled Quotes --}}
            <div id="cancelled-quotes" class="tab-panel hidden">
                <div class="mb-3">
                    <h2 class="text-lg font-semibold text-gray-800">Cancelled Quotes</h2>
                    <p class="text-xs text-gray-500">Quotes that were marked as cancelled.</p>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full text-sm text-center bg-white">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="py-2 px-3 text-center">Quote #</th>
                                <th class="py-2 px-3 text-center">Customer</th>
                                <th class="py-2 px-3 text-center">Date</th>
                                <th class="py-2 px-3 text-center">Status</th>
                                <th class="py-2 px-3 text-center">Source</th>
                                <th class="py-2 px-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cancelledQuotes as $quote)
                                <tr class="border-t text-center hover:bg-gray-50">
                                    <td class="py-2 px-3 font-mono text-center">
                                        {{ $quote->number ?? ('GEI-GDS-' . date('Y', strtotime($quote->created_at)) . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT)) }}
                                    </td>
                                    <td class="py-2 px-3 text-center">{{ $quote->user->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-3 text-center">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="py-2 px-3 text-center">
                                        <span class="inline-flex items-center justify-center px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">
                                            Cancelled
                                        </span>
                                    </td>
                                    <td class="py-2 px-3 text-center text-xs text-gray-500">
                                        {{ $quote->order ? 'From Order' : 'Manual' }}
                                    </td>
                                    <td class="py-2 px-3 text-center">
                                        <div class="inline-flex gap-2 justify-center flex-wrap">
                                            <a href="{{ route('quotes.pdf', $quote->id) }}" target="_blank"
                                               class="bg-blue-100 text-blue-900 px-3 py-1 rounded hover:bg-blue-200 border-2 border-blue-900 flex items-center gap-1 min-w-[110px]">
                                                <span>📄</span><span>View PDF</span>
                                            </a>
                                            <button type="button"
                                                    class="bg-purple-100 text-purple-800 px-3 py-1 rounded hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-400 flex items-center gap-1 font-semibold min-w-[110px]"
                                                    onclick="showQuoteModal({{ $quote->id }})">
                                                <span>👁️</span><span>View Details</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-500">
                                        No cancelled quotes found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- TAB PANELS --}}
        <div class="p-4 md:p-6 space-y-6">
            {{-- Manual Quotes --}}
            <div id="manual-quotes" class="tab-panel">
                <div class="mb-3">
                    <h2 class="text-lg font-semibold text-gray-800">Manual Quotes</h2>
                    <p class="text-xs text-gray-500">Quotes that were created manually (no linked order).</p>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full text-sm text-center bg-white">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="py-2 px-3 text-center">Quote #</th>
                                <th class="py-2 px-3 text-center">Customer</th>
                                <th class="py-2 px-3 text-center">Date</th>
                                <th class="py-2 px-3 text-center">Status</th>
                                <th class="py-2 px-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($manualQuotes as $quote)
                                <tr class="border-t text-center hover:bg-gray-50">
                                    <td class="py-2 px-3 font-mono text-center">
                                        {{ $quote->number ?? ('GEI-GDS-' . date('Y', strtotime($quote->created_at)) . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT)) }}
                                    </td>
                                    <td class="py-2 px-3 text-center">{{ $quote->user->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-3 text-center">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="py-2 px-3 text-center">
                                        <span class="inline-flex items-center justify-center px-2 py-1 rounded-full text-xs
                                            @if(($quote->status ?? 'pending') === 'done')
                                                bg-green-100 text-green-700
                                            @elseif(($quote->status ?? 'pending') === 'cancelled')
                                                bg-red-100 text-red-700
                                            @else
                                                bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ ucfirst($quote->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-3 text-center">
                                        <div class="inline-flex gap-2 justify-center flex-wrap">
                                            <a href="{{ route('quotes.pdf', $quote->id) }}" target="_blank"
                                               class="bg-blue-100 text-blue-900 px-3 py-1 rounded hover:bg-blue-200 border-2 border-blue-900 flex items-center gap-1 min-w-[110px]">
                                                <span>📄</span><span>View PDF</span>
                                            </a>
                                            <a href="{{ route('employee.quotes.edit', $quote->id) }}"
                                               class="bg-orange-100 text-orange-900 px-3 py-1 rounded hover:bg-orange-200 border-2 border-orange-900 flex items-center gap-1 min-w-[110px]">
                                                <span>✏️</span><span>Edit</span>
                                            </a>
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

                                            <form method="POST"
                                                  action="{{ route('employee.quotes.management.destroy', $quote->id) }}"
                                                  class="inline-block min-w-[110px] confirmable-form"
                                                  data-confirm="Are you sure you want to delete this quote?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 flex items-center gap-1 confirm-btn">
                                                    <span>🗑️</span><span>Delete</span>
                                                </button>
                                            </form>

                                            <form method="POST"
                                                  action="{{ route('employee.quotes.management.done', $quote->id) }}"
                                                  class="inline-block min-w-[110px] confirmable-form"
                                                  data-confirm="Mark this quote as done?">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 flex items-center gap-1 confirm-btn">
                                                    <span>✔️</span><span>Mark as Done</span>
                                                </button>
                                            </form>

                                            <form method="POST"
                                                  action="{{ route('employee.quotes.management.cancel', $quote->id) }}"
                                                  class="inline-block min-w-[110px] confirmable-form"
                                                  data-confirm="Cancel this quote?">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                        class="bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-600 flex items-center gap-1 confirm-btn">
                                                    <span>🚫</span><span>Cancel</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">
                                        No manual quotes found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pending Orders --}}
            <div id="pending-quotes" class="tab-panel hidden">
                <div class="mb-3">
                    <h2 class="text-lg font-semibold text-gray-800">Pending Quotes</h2>
                    <p class="text-xs text-gray-500">Orders that do not have a quotation yet.</p>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="table-auto w-full text-sm bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">Order #</th>
                                <th class="px-4 py-2 text-left">Customer</th>
                                <th class="px-4 py-2 text-left">Date</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-right">Total</th>
                                <th class="px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ordersNeedingQuote as $order)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $order->reference_number ?? $order->id }}</td>
                                    <td class="px-4 py-2">{{ optional($order->user)->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                                    <td class="px-4 py-2 text-right">
                                        ₱{{ number_format($order->total_amount ?? 0, 2) }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="inline-flex gap-2">
                                            <form action="{{ route('employee.quotes.from_order', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 rounded bg-blue-600 text-white text-xs hover:bg-blue-700">Create Quote</button>
                                            </form>
                                            <form action="{{ route('employee.quotes.cancel_order', $order->id) }}" method="POST" class="confirmable-form" data-confirm="Are you sure you want to cancel this order?">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="px-3 py-1 rounded bg-yellow-500 text-black text-xs hover:bg-yellow-600 confirm-btn">Cancel</button>
                                            </form>
                                            <form action="{{ route('employee.quotes.cancel_order', $order->id) }}" method="POST" class="confirmable-form" data-confirm="Are you sure you want to delete this order?">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="px-3 py-1 rounded bg-red-600 text-white text-xs hover:bg-red-700 confirm-btn">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                        All pending quotes already have quotations.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- All Quotes --}}
            <div id="all-quotes" class="tab-panel hidden">
                <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">All Quotes</h2>
                        <p class="text-xs text-gray-500">
                            All quotations (manual & from orders). Use the search box to filter.
                        </p>
                    </div>

                    <form method="GET"
                          action="{{ route('employee.quotes.management.index') }}"
                          class="flex items-center gap-2">
                        <input type="text"
                               name="search"
                               value="{{ $search }}"
                               placeholder="Search by quote #, customer, status..."
                               class="border border-gray-300 rounded px-3 py-1 text-sm w-64">
                        <button type="submit"
                                class="px-3 py-1 rounded bg-purple-600 text-white text-sm hover:bg-purple-700">
                            Search
                        </button>
                        @if($search)
                            <a href="{{ route('employee.quotes.management.index') }}"
                               class="text-xs text-gray-500 hover:underline">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full text-sm text-center bg-white">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="py-2 px-3 text-center">Quote #</th>
                                <th class="py-2 px-3 text-center">Customer</th>
                                <th class="py-2 px-3 text-center">Date</th>
                                <th class="py-2 px-3 text-center">Status</th>
                                <th class="py-2 px-3 text-center">Source</th>
                                <th class="py-2 px-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allQuotes as $quote)
                                <tr class="border-t text-center hover:bg-gray-50">
                                    <td class="py-2 px-3 font-mono text-center">
                                        {{ $quote->number ?? ('GEI-GDS-' . date('Y', strtotime($quote->created_at)) . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT)) }}
                                    </td>
                                    <td class="py-2 px-3 text-center">{{ $quote->user->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-3 text-center">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="py-2 px-3 text-center">
                                        <span class="inline-flex items-center justify-center px-2 py-1 rounded-full text-xs
                                            @if(($quote->status ?? 'pending') === 'done')
                                                bg-green-100 text-green-700
                                            @elseif(($quote->status ?? 'pending') === 'cancelled')
                                                bg-red-100 text-red-700
                                            @else
                                                bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ ucfirst($quote->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-3 text-center text-xs text-gray-500">
                                        {{ $quote->order ? 'From Order' : 'Manual' }}
                                    </td>
                                    <td class="py-2 px-3 text-center">
                                        <div class="inline-flex gap-2 justify-center flex-wrap">
                                            <a href="{{ route('quotes.pdf', $quote->id) }}" target="_blank"
                                               class="bg-blue-100 text-blue-900 px-3 py-1 rounded hover:bg-blue-200 border-2 border-blue-900 flex items-center gap-1 min-w-[110px]">
                                                <span>📄</span><span>View PDF</span>
                                            </a>
                                            <a href="{{ route('employee.quotes.edit', $quote->id) }}"
                                               class="bg-orange-100 text-orange-900 px-3 py-1 rounded hover:bg-orange-200 border-2 border-orange-900 flex items-center gap-1 min-w-[110px]">
                                                <span>✏️</span><span>Edit</span>
                                            </a>
                                            <button type="button"
                                                    class="bg-purple-100 text-purple-800 px-3 py-1 rounded hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-400 flex items-center gap-1 font-semibold min-w-[110px]"
                                                    onclick="showQuoteModal({{ $quote->id }})">
                                                <span>👁️</span><span>View Details</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-500">
                                        No quotes found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CONFIRMATION MODAL --}}
<div id="confirmation-modal" class="fixed inset-0 z-50 hidden bg-black/40 items-center justify-center">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-xs w-full text-center relative">
        <div id="confirmation-message" class="mb-6 text-lg text-gray-800 font-semibold">Are you sure?</div>
        <div class="flex justify-center gap-4">
            <button id="confirm-yes"
                    class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 font-bold">
                Yes
            </button>
            <button id="confirm-no"
                    class="bg-gray-300 text-gray-800 px-5 py-2 rounded hover:bg-gray-400 font-bold">
                Cancel
            </button>
        </div>
    </div>
</div>

{{-- QUOTE DETAIL MODALS (use allQuotes para kumpleto) --}}
@foreach($allQuotes as $quote)
  <div id="quote-modal-{{ $quote->id }}"
       class="fixed inset-0 z-50 hidden items-center justify-center"
       role="dialog" aria-modal="true" aria-labelledby="quote-title-{{ $quote->id }}">
    <div class="absolute inset-0 bg-black/40" onclick="closeQuoteModal({{ $quote->id }})"></div>

    <div class="relative bg-white rounded-xl shadow-lg w-[92vw] max-w-3xl p-6 md:p-8 border border-purple-100">
      <button type="button"
              onclick="closeQuoteModal({{ $quote->id }})"
              class="inline-flex items-center justify-center w-9 h-9 rounded-full text-gray-500 hover:text-purple-700 hover:bg-gray-100 focus:outline-none"
              aria-label="Close"
              style="position:absolute; right:0.75rem; top:0.75rem;">
        <span class="text-2xl leading-none">&times;</span>
      </button>

      <div class="text-center">
        <div class="text-[11px] tracking-widest text-gray-400 uppercase mb-1">Quote Reference</div>
        <h2 id="quote-title-{{ $quote->id }}" class="text-2xl md:text-3xl font-extrabold text-purple-800">
          {{ $quote->number ?? ('GEI-GDS-' . date('Y', strtotime($quote->created_at)) . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT)) }}
        </h2>
      </div>

      <div class="mt-4 text-gray-700 text-sm">
        <div><span class="font-semibold">Customer:</span> {{ $quote->user->name ?? 'N/A' }}</div>
        <div><span class="font-semibold">Date:</span> {{ $quote->created_at->format('Y-m-d H:i') }}</div>
      </div>

      <div class="mt-6">
        <div class="font-semibold mb-2 text-gray-700 text-center">Requested Items</div>

        <div class="mx-auto max-w-[720px] overflow-x-auto rounded border border-gray-200 bg-gray-50">
          <table class="w-full text-xs">
            <thead>
              <tr class="bg-gray-100">
                <th class="py-2 px-3 text-left">Product</th>
                <th class="py-2 px-3 text-center">Qty</th>
                <th class="py-2 px-3 text-right">Unit Price</th>
                <th class="py-2 px-3 text-right">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($quote->items as $item)
                <tr class="border-t border-gray-200">
                  <td class="py-2 px-3">{{ $item->name }}</td>
                  <td class="py-2 px-3 text-center">{{ $item->quantity }}</td>
                  <td class="py-2 px-3 text-right">₱{{ number_format($item->unit_price, 2) }}</td>
                  <td class="py-2 px-3 text-right">₱{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="w-full flex justify-center">
          <div class="font-bold text-lg text-purple-700 mt-4">
              Total: ₱{{ number_format($quote->total, 2) }}
          </div>
        </div>
      </div>

      <form method="POST" action="{{ route('employee.quotes.upload', $quote->id) }}"
            enctype="multipart/form-data"
            class="mt-6 pt-6 border-t text-center">
        @csrf
        <label class="block mb-2 font-semibold text-gray-700">Upload Quotation (PDF only):</label>
        <div class="flex flex-col md:flex-row items-center justify-center gap-3">
          <input type="file" name="quote_file" accept="application/pdf"
                 class="border rounded px-3 py-2" required>
          <button type="submit"
                  class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 font-semibold">
            Upload PDF
          </button>
        </div>
      </form>
    </div>
  </div>
@endforeach

<script>
    function setActiveTab(tabId) {
        const panels = document.querySelectorAll('.tab-panel');
        const triggers = document.querySelectorAll('.tab-trigger');

        panels.forEach(p => {
            p.classList.toggle('hidden', p.id !== tabId);
        });

        triggers.forEach(btn => {
            const isActive = btn.dataset.tab === tabId;
            btn.classList.toggle('text-purple-700', isActive);
            btn.classList.toggle('bg-white', isActive);
            btn.classList.toggle('border-purple-600', isActive);
            btn.classList.toggle('text-gray-500', !isActive);
            btn.classList.toggle('bg-purple-50', !isActive);
            btn.classList.toggle('border-transparent', !isActive);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // kung may search, default sa All Quotes tab
    const defaultTab = '{{ $search ? 'all-quotes' : 'manual-quotes' }}';
        setActiveTab(defaultTab);

        document.querySelectorAll('.tab-trigger').forEach(btn => {
            btn.addEventListener('click', function () {
                setActiveTab(this.dataset.tab);
            });
        });
    });

    // --- Confirmation modal logic ---
    let confirmForm = null;
    const confirmModal = document.getElementById('confirmation-modal');
    const confirmNo = document.getElementById('confirm-no');
    const confirmYes = document.getElementById('confirm-yes');
    let confirmEscListener = null;

    document.querySelectorAll('.confirm-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const form = btn.closest('form');
            confirmForm = form;
            document.getElementById('confirmation-message').textContent =
                form.getAttribute('data-confirm') || 'Are you sure?';

            confirmModal.classList.remove('hidden');
            confirmModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');

            confirmEscListener = function (e) {
                if (e.key === 'Escape') {
                    confirmModal.classList.add('hidden');
                    confirmModal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                    confirmForm = null;
                    document.removeEventListener('keydown', confirmEscListener);
                }
            };
            document.addEventListener('keydown', confirmEscListener);
        });
    });

    confirmNo.onclick = function () {
        confirmModal.classList.add('hidden');
        confirmModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        confirmForm = null;
        if (confirmEscListener) {
            document.removeEventListener('keydown', confirmEscListener);
            confirmEscListener = null;
        }
    };

    confirmYes.onclick = function () {
        if (confirmForm) confirmForm.submit();
        confirmModal.classList.add('hidden');
        confirmModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        confirmForm = null;
        if (confirmEscListener) {
            document.removeEventListener('keydown', confirmEscListener);
            confirmEscListener = null;
        }
    };

    // --- Quote modals ---
    function showQuoteModal(id) {
        document.querySelectorAll('[id^=quote-modal-]').forEach(m => {
            m.classList.add('hidden');
            m.classList.remove('flex');
        });

        const modal = document.getElementById('quote-modal-' + id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        function escListener(e) {
            if (e.key === 'Escape') {
                closeQuoteModal(id);
            }
        }
        modal._escListener = escListener;
        document.addEventListener('keydown', escListener);
    }

    function closeQuoteModal(id) {
        const modal = document.getElementById('quote-modal-' + id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');

        if (modal._escListener) {
            document.removeEventListener('keydown', modal._escListener);
            modal._escListener = null;
        }
    }
</script>
@endsection
