@php
  $key = $tab ?? 'all';               // unique key per tab
  $wrapId = "orders-wrap-{$key}";
  $tableId = "{$key}-orders-table";
@endphp

<div id="{{ $wrapId }}" class="space-y-3">

  <div class="flex justify-end">
    <button type="button"
      data-bulk
      class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow-sm transition disabled:opacity-50 disabled:cursor-not-allowed"
      disabled>
      Bulk Delete
    </button>
  </div>

  <table id="{{ $tableId }}" class="min-w-full text-sm text-center bg-white sortable-table">
    <thead class="bg-gray-50">
      <tr class="border-b">
        <th class="py-2 px-3 text-center cursor-pointer" data-sort-key="order"   data-sort-type="string">Order #</th>
        <th class="py-2 px-3 text-center cursor-pointer" data-sort-key="customer"data-sort-type="string">Customer</th>
        <th class="py-2 px-3 text-center cursor-pointer" data-sort-key="date"    data-sort-type="date">Date</th>
        <th class="py-2 px-3 text-center cursor-pointer" data-sort-key="status"  data-sort-type="string">Status</th>
        <th class="py-2 px-3 text-center cursor-pointer" data-sort-key="total"   data-sort-type="number">Total</th>
        <th class="py-2 px-3 text-center">Actions</th>
        <th class="py-2 px-3 text-center">
          <input type="checkbox" data-select-all class="cursor-pointer">
        </th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $order)
        <tr class="border-t text-center hover:bg-gray-50">
          <td class="py-2 px-3 font-mono text-center">{{ $order->reference_number ?? $order->id }}</td>
          <td class="py-2 px-3 text-center">{{ $order->user->name ?? $order->customer_name ?? 'N/A' }}</td>
          <td class="py-2 px-3 text-center">{{ $order->created_at->format('Y-m-d H:i') }}</td>
          <td class="py-2 px-3 text-center">{{ ucfirst($order->status) }}</td>
          <td class="py-2 px-3 text-center">₱{{ number_format($order->total_amount ?? 0, 2) }}</td>
          <td class="py-2 px-3 text-center">
            <div class="inline-flex gap-2 flex-wrap justify-center">
              <button type="button" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700"
                onclick="openOrderDetailsModal({{ $order->id }})">View Details</button>

              @if(!in_array($tab ?? '', ['cancelled', 'done']))
              <form method="POST" action="{{ route('employee.orders.done', $order) }}" style="display:inline">
                @csrf @method('PATCH')
                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Mark as Done</button>
              </form>
              @endif

              @if(($tab ?? '') !== 'cancelled')
              <form method="POST" action="{{ route('employee.orders.upload', $order) }}" enctype="multipart/form-data" style="display:inline">
                @csrf
                <input type="file" name="receipt" accept="application/pdf" class="hidden" id="upload-{{ $order->id }}"
                       onchange="this.form.submit()">
                <label for="upload-{{ $order->id }}" class="bg-orange-500 text-white px-3 py-1 rounded cursor-pointer hover:bg-orange-600">
                  Upload Receipt
                </label>
              </form>
              @endif

              <form method="POST" action="{{ route('employee.orders.destroy', $order) }}" style="display:inline"
                    onsubmit="return confirm('Delete this order?');">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
              </form>
            </div>
          </td>
          <td class="py-2 px-3 text-center">
            <input type="checkbox" class="order-checkbox cursor-pointer" value="{{ $order->id }}">
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="py-4 text-center text-gray-500">No orders found.</td></tr>
      @endforelse
    </tbody>
  </table>

</div>

<script>
(() => {
  const wrap         = document.getElementById(@json($wrapId));
  if (!wrap) return;

  const bulkDelete   = wrap.querySelector('[data-bulk]');
  const selectAll    = wrap.querySelector('[data-select-all]');
  const getChecks    = () => [...wrap.querySelectorAll('.order-checkbox')];

  // --- helpers
  function setBulkState() {
    const cbs = getChecks();
    const checked = cbs.filter(c => c.checked).length;
    bulkDelete && (bulkDelete.disabled = checked === 0);

    // update header checkbox state
    if (selectAll) {
      selectAll.checked = checked > 0 && checked === cbs.length;
      selectAll.indeterminate = checked > 0 && checked < cbs.length;
    }
  }

  // header "check all"
  if (selectAll) {
    selectAll.addEventListener('change', (e) => {
      getChecks().forEach(cb => cb.checked = e.target.checked);
      setBulkState();
    });
  }

  // row checkboxes
  getChecks().forEach(cb => cb.addEventListener('change', setBulkState));

  // BULK DELETE (walang binago; call setBulkState after DOM remove)
  bulkDelete && bulkDelete.addEventListener('click', async () => {
    const ids = getChecks().filter(c => c.checked).map(c => c.value);
    if (!ids.length || !confirm(`Delete ${ids.length} selected order(s)?`)) return;

    const res  = await fetch(@json(route('employee.orders.bulkDestroy')), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ ids })
    });

    const data = await res.json().catch(() => ({}));
    if (!res.ok) return toast(data.message || 'Failed to delete selected orders.', 'error');

    // remove only rows in this table
    ids.forEach(id => wrap.querySelector(`.order-checkbox[value="${id}"]`)?.closest('tr')?.remove());
    setBulkState();
    toast('Selected orders deleted successfully!', 'success');
  });

  function toast(msg, type='success') {
    const n = document.createElement('div');
    n.className = `fixed top-4 right-4 z-[99999] px-4 py-2 rounded shadow text-sm ${
      type==='success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
    }`;
    n.textContent = msg; document.body.appendChild(n); setTimeout(()=>n.remove(), 3000);
  }

  // initial state on load
  setBulkState();
})();
</script>
