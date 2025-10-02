@extends('layouts.app')
@section('title', 'Quote Management | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-8 text-center">
        <h1 class="text-3xl font-bold text-purple-800 mb-2 text-center">Quote Management</h1>
        <p class="text-gray-700 text-center">View and manage all customer quote requests here.</p>
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
        <table class="min-w-full text-sm text-center">
            <thead>
            <tr class="border-b">
                <th class="py-2 text-center">Quote #</th>
                <th class="py-2 text-center">Customer</th>
                <th class="py-2 text-center">Date</th>
                <th class="py-2 text-center">Status</th>
                <th class="py-2 text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quotes as $quote)
                <tr class="border-b text-center">
                    <td class="py-2 font-mono text-center">
                        {{ $quote->number ?? ('GEI-GDS-' . date('Y', strtotime($quote->created_at)) . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT)) }}
                    </td>
                    <td class="py-2 text-center">{{ $quote->user->name ?? 'N/A' }}</td>
                    <td class="py-2 text-center">{{ $quote->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2 text-center">{{ ucfirst($quote->status ?? 'pending') }}</td>
                    <td class="py-2 text-center">
                        <div class="inline-flex gap-2 justify-center flex-wrap">
                            <a href="{{ route('quotes.pdf', $quote->id) }}" target="_blank"
                               class="bg-blue-100 text-blue-900 px-3 py-1 rounded hover:bg-blue-200 border-2 border-blue-900 flex items-center gap-1 min-w-[110px]">
                                <span>📄</span><span>View PDF</span>
                            </a>

                            <a href="{{ route('employee.quotes.edit', $quote->id) }}"
                               class="bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-600 flex items-center gap-1 min-w-[110px]">
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

                            <form method="POST" action="{{ route('employee.quotes.management.destroy', $quote->id) }}"
                                  class="inline-block min-w-[110px] confirmable-form"
                                  data-confirm="Are you sure you want to delete this quote?">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 flex items-center gap-1 confirm-btn">
                                    <span>🗑️</span><span>Delete</span>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('employee.quotes.management.done', $quote->id) }}"
                                  class="inline-block min-w-[110px] confirmable-form"
                                  data-confirm="Mark this quote as done?">
                                @csrf
                                @method('PATCH')
                                <button type="button"
                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 flex items-center gap-1 confirm-btn">
                                    <span>✔️</span><span>Mark as Done</span>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('employee.quotes.management.cancel', $quote->id) }}"
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
            @endforeach
            </tbody>
        </table>

        {{-- Confirmation Modal (default: hidden only; JS toggles flex) --}}
        <div id="confirmation-modal" class="fixed inset-0 z-50 hidden bg-black/40 items-center justify-center">
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-xs w-full text-center relative">
                <div id="confirmation-message" class="mb-6 text-lg text-gray-800 font-semibold">Are you sure?</div>
                <div class="flex justify-center gap-4">
                    <button id="confirm-yes" class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 font-bold">Yes</button>
                    <button id="confirm-no" class="bg-gray-300 text-gray-800 px-5 py-2 rounded hover:bg-gray-400 font-bold">Cancel</button>
                </div>
            </div>
        </div>

     {{-- MODALS: render one per quote (AFTER the table) --}}
@foreach($quotes as $quote)
  <div id="quote-modal-{{ $quote->id }}"
       class="fixed inset-0 z-50 hidden items-center justify-center"
       role="dialog" aria-modal="true" aria-labelledby="quote-title-{{ $quote->id }}">
    <!-- overlay -->
    <div class="absolute inset-0 bg-black/40" onclick="closeQuoteModal({{ $quote->id }})"></div>

    <!-- modal container (relative so absolute children anchor properly) -->
    <div class="relative bg-white rounded-xl shadow-lg w-[92vw] max-w-3xl p-6 md:p-8 border border-purple-100">

      <!-- CLOSE BUTTON — hard-right, hard-top -->
      <button type="button"
              onclick="closeQuoteModal({{ $quote->id }})"
              class="inline-flex items-center justify-center w-9 h-9 rounded-full text-gray-500 hover:text-purple-700 hover:bg-gray-100 focus:outline-none"
              aria-label="Close"
              style="position:absolute; right:0.75rem; top:0.75rem;">
        <span class="text-2xl leading-none">&times;</span>
      </button>

      <!-- header (center) -->
      <div class="text-center">
        <div class="text-[11px] tracking-widest text-gray-400 uppercase mb-1">Quote Reference</div>
        <h2 id="quote-title-{{ $quote->id }}" class="text-2xl md:text-3xl font-extrabold text-purple-800">
          {{ $quote->number ?? ('GEI-GDS-' . date('Y', strtotime($quote->created_at)) . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT)) }}
        </h2>
      </div>

      <!-- meta (top-left) -->
      <div class="mt-4 text-gray-700 text-sm">
        <div><span class="font-semibold">Customer:</span> {{ $quote->user->name ?? 'N/A' }}</div>
        <div><span class="font-semibold">Date:</span> {{ $quote->created_at->format('Y-m-d H:i') }}</div>
      </div>

      <!-- content (centered) -->
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
          <div class="font-bold text-lg text-purple-700 mt-4">Total: ₱{{ number_format($quote->total, 2) }}</div>
        </div>
      </div>

      <!-- upload (centered) -->
      <form method="POST" action="{{ route('employee.quotes.upload', $quote->id) }}"
            enctype="multipart/form-data"
            class="mt-6 pt-6 border-t text-center">
        @csrf
        <label class="block mb-2 font-semibold text-gray-700">Upload Quotation (PDF only):</label>
        <div class="flex flex-col md:flex-row items-center justify-center gap-3">
          <input type="file" name="quote_file" accept="application/pdf" class="border rounded px-3 py-2" required>
          <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 font-semibold">
            Upload PDF
          </button>
        </div>
      </form>
    </div>
  </div>
@endforeach
{{-- /MODALS --}}


<script>
    // --- Confirmation modal logic (toggle hidden <-> flex) ---
    let confirmForm = null;
    const confirmModal = document.getElementById('confirmation-modal');
    const confirmNo = document.getElementById('confirm-no');
    const confirmYes = document.getElementById('confirm-yes');


  // --- Confirmation modal logic (toggle hidden <-> flex) ---
  let confirmEscListener = null;
  document.querySelectorAll('.confirm-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const form = btn.closest('form');
      confirmForm = form;
      document.getElementById('confirmation-message').textContent =
        form.getAttribute('data-confirm') || 'Are you sure?';
      // show: remove hidden, add flex
      confirmModal.classList.remove('hidden');
      confirmModal.classList.add('flex');
      document.body.classList.add('overflow-hidden');
      // ESC close for confirmation modal
      confirmEscListener = function(e) {
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

  confirmNo.onclick = function() {
    // hide: add hidden, remove flex
    confirmModal.classList.add('hidden');
    confirmModal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
    confirmForm = null;
    if (confirmEscListener) {
      document.removeEventListener('keydown', confirmEscListener);
      confirmEscListener = null;
    }
  };

  confirmYes.onclick = function() {
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

    // --- Quote modals (toggle hidden <-> flex) ---
    function showQuoteModal(id) {
        // hide all open quote modals first
        document.querySelectorAll('[id^=quote-modal-]').forEach(m => {
            m.classList.add('hidden');
            m.classList.remove('flex');
        });

        const modal = document.getElementById('quote-modal-' + id);
        // show: remove hidden, add flex
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');

        // ESC close for this modal only
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
        // hide: add hidden, remove flex
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
