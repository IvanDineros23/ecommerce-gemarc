@php
    // id para ma-target sa JS (sorting/search)
    $tableId = isset($tab) ? $tab . '-orders-table' : null;
@endphp

<table @if($tableId) id="{{ $tableId }}" @endif
       class="min-w-full text-sm text-center bg-white sortable-table">
    <thead class="bg-gray-50">
        <tr class="border-b">
            <th class="py-2 px-3 text-center cursor-pointer"
                data-sort-key="order" data-sort-type="string">
                Order #
            </th>
            <th class="py-2 px-3 text-center cursor-pointer"
                data-sort-key="customer" data-sort-type="string">
                Customer
            </th>
            <th class="py-2 px-3 text-center cursor-pointer"
                data-sort-key="date" data-sort-type="date">
                Date
            </th>
            <th class="py-2 px-3 text-center cursor-pointer"
                data-sort-key="status" data-sort-type="string">
                Status
            </th>
            <th class="py-2 px-3 text-center cursor-pointer"
                data-sort-key="total" data-sort-type="number">
                Total
            </th>
            <th class="py-2 px-3 text-center">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr class="border-t text-center hover:bg-gray-50">
                <td class="py-2 px-3 font-mono text-center">
                    {{ $order->reference_number ?? $order->id }}
                </td>
                <td class="py-2 px-3 text-center">
                    {{ $order->user->name ?? $order->customer_name ?? 'N/A' }}
                </td>
                <td class="py-2 px-3 text-center">
                    {{ $order->created_at->format('Y-m-d H:i') }}
                </td>
                <td class="py-2 px-3 text-center">
                    {{ ucfirst($order->status) }}
                </td>
                <td class="py-2 px-3 text-center">
                    ₱{{ number_format($order->total_amount ?? 0, 2) }}
                </td>
                <td class="py-2 px-3 text-center">
                    <div class="inline-flex gap-2 flex-wrap justify-center">
                        {{-- VIEW DETAILS (always visible) --}}
                        <button type="button"
                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700"
                                onclick="openOrderDetailsModal({{ $order->id }})">
                            View Details
                        </button>

                        {{-- MARK AS DONE (only for non-cancelled, non-done) --}}
                        @if(!in_array($tab ?? '', ['cancelled', 'done']))
                            <form method="POST"
                                  action="{{ route('employee.orders.done', $order) }}"
                                  style="display:inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Mark as Done
                                </button>
                            </form>
                        @endif

                        {{-- UPLOAD RECEIPT (hide on cancelled; allowed on done & others) --}}
                        @if(($tab ?? '') !== 'cancelled')
                            <form method="POST"
                                  action="{{ route('employee.orders.upload', $order) }}"
                                  enctype="multipart/form-data"
                                  style="display:inline">
                                @csrf
                                <input type="file"
                                       name="receipt"
                                       accept="application/pdf"
                                       class="hidden"
                                       id="upload-{{ $order->id }}"
                                       onchange="this.form.submit()">
                                <label for="upload-{{ $order->id }}"
                                       class="bg-orange-500 text-white px-3 py-1 rounded cursor-pointer hover:bg-orange-600">
                                    Upload Receipt
                                </label>
                            </form>
                        @endif

                        {{-- DELETE (always visible) --}}
                        <form method="POST"
                              action="{{ route('employee.orders.destroy', $order) }}"
                              style="display:inline"
                              onsubmit="return confirm('Delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="py-4 text-center text-gray-500">
                    No orders found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
