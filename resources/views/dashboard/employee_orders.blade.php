@extends('layouts.ecommerce')

@section('title', 'Order Management | Gemarc Enterprises Inc.')

@section('content')
<div class="py-8">
    <div class="flex flex-col items-center justify-center mb-4 text-center">
        <h1 class="text-3xl font-bold text-green-800 mb-2">Order Management</h1>
        <p class="text-gray-700">View and manage all customer orders here.</p>
    </div>

    {{-- Toast notification --}}
    @if(session('success'))
        <div id="toast-success"
             class="fixed top-4 right-4 z-50 bg-green-600 text-white px-4 py-2 rounded shadow-lg text-sm flex items-center gap-2">
            <span>✅</span>
            <span>{{ session('success') }}</span>
        </div>
        <script>
            setTimeout(function () {
                const toast = document.getElementById('toast-success');
                if (toast) toast.remove();
            }, 4000);
        </script>
    @endif

    <div class="bg-white rounded-xl shadow border border-gray-200 mt-4">
        <div class="flex justify-end px-4 pt-6">
            <button type="button"
                class="bg-green-700 hover:bg-green-800 text-white font-semibold px-5 py-2 rounded-lg shadow-sm transition"
                onclick="openManualOrderModal()">
                + Create Manual Order
            </button>
        </div>

        {{-- TABS HEADER --}}
        <div class="px-4 pt-4 border-b border-gray-200">
            <div class="inline-flex rounded-lg overflow-hidden bg-gray-50">
                <button type="button"
                        class="tab-trigger px-4 py-2 text-sm font-semibold text-green-700 bg-white border-b-2 border-green-600"
                        data-tab="manual-orders">
                    Manual Orders
                </button>
                <button type="button"
                        class="tab-trigger px-4 py-2 text-sm font-semibold text-gray-500 hover:text-green-700 hover:bg-green-50 border-b-2 border-transparent"
                        data-tab="pending-orders">
                    Pending Orders
                </button>
                <button type="button"
                        class="tab-trigger px-4 py-2 text-sm font-semibold text-gray-500 hover:text-green-700 hover:bg-green-50 border-b-2 border-transparent"
                        data-tab="done-orders">
                    Done Orders
                </button>
                <button type="button"
                        class="tab-trigger px-4 py-2 text-sm font-semibold text-gray-500 hover:text-green-700 hover:bg-green-50 border-b-2 border-transparent"
                        data-tab="all-orders">
                    All Orders
                </button>
                <button type="button"
                        class="tab-trigger px-4 py-2 text-sm font-semibold text-gray-500 hover:text-green-700 hover:bg-green-50 border-b-2 border-transparent"
                        data-tab="cancelled-orders">
                    Cancelled Orders
                </button>
            </div>
        </div>

        {{-- TAB PANELS --}}
        <div class="p-4 md:p-6 space-y-6">

            {{-- Manual Orders --}}
            <div id="manual-orders" class="tab-panel">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
                    <div class="w-full md:w-1/3">
                        <input type="text"
                               id="manual-orders-search"
                               placeholder="Search manual orders (order #, customer, status, etc.)"
                               class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="text-xs text-gray-500">
                        Tip: Click column headers to sort.
                    </div>
                </div>

                @include('dashboard.partials.employee_orders_table', [
                    'orders' => $manualOrders,
                    'tab'    => 'manual'
                ])
            </div>

            {{-- Pending Orders --}}
            <div id="pending-orders" class="tab-panel hidden">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
                    <div class="w-full md:w-1/3">
                        <input type="text"
                               id="pending-orders-search"
                               placeholder="Search pending orders (order #, customer, status, etc.)"
                               class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="text-xs text-gray-500">
                        Tip: Click column headers to sort.
                    </div>
                </div>

                @include('dashboard.partials.employee_orders_table', [
                    'orders' => $pendingOrders,
                    'tab'    => 'pending'
                ])
            </div>

            {{-- Done Orders --}}
            <div id="done-orders" class="tab-panel hidden">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
                    <div class="w-full md:w-1/3">
                        <input type="text"
                               id="done-orders-search"
                               placeholder="Search done orders (order #, customer, status, etc.)"
                               class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="text-xs text-gray-500">
                        Tip: Click column headers to sort.
                    </div>
                </div>

                @include('dashboard.partials.employee_orders_table', [
                    'orders' => $doneOrders,
                    'tab'    => 'done'
                ])
            </div>

            {{-- All Orders --}}
            <div id="all-orders" class="tab-panel hidden">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
                    <div class="w-full md:w-1/3">
                        <input type="text"
                               id="all-orders-search"
                               placeholder="Search orders (order #, customer, status, etc.)"
                               class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="text-xs text-gray-500">
                        Tip: Click column headers to sort.
                    </div>
                </div>

                @include('dashboard.partials.employee_orders_table', [
                    'orders' => $allOrders,
                    'tab'    => 'all'
                ])
            </div>

            {{-- Cancelled Orders --}}
            <div id="cancelled-orders" class="tab-panel hidden">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
                    <div class="w-full md:w-1/3">
                        <input type="text"
                               id="cancelled-orders-search"
                               placeholder="Search cancelled orders (order #, customer, status, etc.)"
                               class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="text-xs text-gray-500">
                        Tip: Click column headers to sort.
                    </div>
                </div>

                @include('dashboard.partials.employee_orders_table', [
                    'orders' => $cancelledOrders,
                    'tab'    => 'cancelled'
                ])
            </div>

        </div>
    </div>
</div>

{{-- ORDER DETAILS MODALS – one per order, usable from any tab --}}
@foreach($allOrders as $order)
    <div id="order-details-modal-{{ $order->id }}"
         class="order-details-modal fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40">
        <div class="absolute inset-0" onclick="closeOrderDetailsModal({{ $order->id }})"></div>

        <div class="relative bg-white rounded-xl shadow-xl max-w-3xl w-11/12 md:w-3/4 lg:w-1/2 p-6 max-h-[85vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-green-800">
                    Order #{{ $order->reference_number ?? $order->id }}
                </h2>
                <button type="button"
                        class="text-gray-500 hover:text-gray-800 text-2xl leading-none"
                        onclick="closeOrderDetailsModal({{ $order->id }})">
                    &times;
                </button>
            </div>

            <div class="mb-1 text-gray-700">
                Customer:
                <span class="font-semibold">
                    {{ $order->user->name ?? $order->customer_name ?? 'N/A' }}
                </span>
            </div>
            <div class="mb-1 text-gray-700">
                Date:
                <span class="font-semibold">
                    {{ $order->created_at->format('Y-m-d H:i') }}
                </span>
            </div>
            <div class="mb-1 text-gray-700">
                Status:
                <span class="font-semibold">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div class="mb-1 text-gray-700">
                Mode of Payment:
                <span class="font-semibold">
                    {{ $order->payment_method ?? 'N/A' }}
                </span>
            </div>
            <div class="mb-1 text-gray-700">
                Mode of Delivery:
                <span class="font-semibold">
                    {{ $order->delivery_method ?? 'N/A' }}
                </span>
            </div>
            <div class="mb-3 text-gray-700">
                Total:
                <span class="font-semibold">
                    ₱{{ number_format($order->total_amount ?? 0, 2) }}
                </span>
            </div>

            <div class="mb-1 text-gray-700">
                Remarks:
                <span class="font-semibold">
                    {{ $order->remarks ?? 'No remarks provided.' }}
                </span>
            </div>

            <div class="mb-3">
                <label for="remarks-{{ $order->id }}" class="block text-sm font-medium text-gray-700">
                    Remarks
                </label>
                <textarea id="remarks-{{ $order->id }}" name="remarks" rows="3"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                    placeholder="Enter remarks for this order">{{ $order->remarks }}</textarea>
            </div>
            <button type="button"
                class="mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
                onclick="saveRemarks({{ $order->id }})">
                Save Remarks
            </button>

            <h3 class="font-semibold text-gray-800 mb-2">Items</h3>
            <table class="w-full text-sm mb-4">
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
                            <td class="py-2 px-3">
                                {{ $item->product->name ?? $item->name }}
                            </td>
                            <td class="py-2 px-3 text-right">
                                {{ $item->quantity }}
                            </td>
                            <td class="py-2 px-3 text-right">
                                ₱{{ number_format($item->unit_price, 2) }}
                            </td>
                            <td class="py-2 px-3 text-right">
                                ₱{{ number_format($item->quantity * $item->unit_price, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end">
                <button type="button"
                        class="mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
                        onclick="closeOrderDetailsModal({{ $order->id }})">
                    Close
                </button>
            </div>
        </div>
    </div>
@endforeach

{{-- JS for tabs + order details + sorting + search --}}
<script>
    // TAB LOGIC
    function setActiveTab(tabId) {
        const panels = document.querySelectorAll('.tab-panel');
        const triggers = document.querySelectorAll('.tab-trigger');

        panels.forEach(p => {
            p.classList.toggle('hidden', p.id !== tabId);
        });

        triggers.forEach(btn => {
            const isActive = btn.dataset.tab === tabId;
            btn.classList.toggle('text-green-700', isActive);
            btn.classList.toggle('bg-white', isActive);
            btn.classList.toggle('border-green-600', isActive);
            btn.classList.toggle('text-gray-500', !isActive);
            btn.classList.toggle('bg-green-50', !isActive);
            btn.classList.toggle('border-transparent', !isActive);
        });
    }

    // ORDER DETAILS MODALS
    function openOrderDetailsModal(orderId) {
        const modal = document.getElementById('order-details-modal-' + orderId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeOrderDetailsModal(orderId) {
        const modal = document.getElementById('order-details-modal-' + orderId);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.order-details-modal').forEach(function (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        }
    });

    // TABLE SORTING
    function sortTable(table, colIndex, direction, type) {
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);

        rows.sort((a, b) => {
            let av = a.cells[colIndex].innerText.trim();
            let bv = b.cells[colIndex].innerText.trim();

            if (type === 'number') {
                av = parseFloat(av.replace(/[^\d.-]/g, '')) || 0;
                bv = parseFloat(bv.replace(/[^\d.-]/g, '')) || 0;
            } else if (type === 'date') {
                av = new Date(av).getTime();
                bv = new Date(bv).getTime();
            } else {
                av = av.toLowerCase();
                bv = bv.toLowerCase();
            }

            if (av < bv) return direction === 'asc' ? -1 : 1;
            if (av > bv) return direction === 'asc' ? 1 : -1;
            return 0;
        });

        rows.forEach(row => tbody.appendChild(row));
    }

    function attachSorting(table) {
        if (!table) return;
        const headers = table.querySelectorAll('thead th[data-sort-key]');
        headers.forEach((th, index) => {
            th.addEventListener('click', () => {
                const current = th.dataset.sortDir === 'asc' ? 'desc' : 'asc';
                th.dataset.sortDir = current;
                const type = th.dataset.sortType || 'string';
                sortTable(table, index, current, type);
            });
        });
    }

    // GENERIC TABLE SEARCH
    function attachTableSearch(inputId, tableId) {
        const searchInput = document.getElementById(inputId);
        const table = document.getElementById(tableId);

        if (!searchInput || !table || !table.tBodies.length) return;

        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase();
            const rows = table.tBodies[0].rows;

            Array.from(rows).forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    }

    function saveRemarks(orderId) {
        const textarea = document.getElementById('remarks-' + orderId);
        if (!textarea) {
            showToast('Remarks field not found.', 'error');
            return;
        }

        const remarks = textarea.value.trim();
        if (!remarks) {
            showToast('Please enter a remark before saving.', 'error');
            return;
        }

        fetch(`/employee/orders/${orderId}/remarks`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ remarks }),
        })
        .then(async (response) => {
            const data = await response.json().catch(() => ({}));

            if (response.ok) {
                showToast('✅ Remarks saved successfully!', 'success');
                closeOrderDetailsModal(orderId); // Close the modal after saving
            } else {
                showToast(data.message || '❌ Failed to save remarks.', 'error');
            }
        })
        .catch(() => {
            showToast('⚠️ Network error while saving remarks.', 'error');
        });
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `
            fixed top-4 right-4 z-[99999] px-4 py-2 rounded shadow-lg text-sm flex items-center gap-2
            ${type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'}
        `;
        toast.innerHTML = `<span>${message}</span>`;
        document.body.appendChild(toast);

        setTimeout(() => toast.remove(), 4000);
    }

    document.addEventListener('DOMContentLoaded', function () {
        setActiveTab('manual-orders');

        document.querySelectorAll('.tab-trigger').forEach(btn => {
            btn.addEventListener('click', function () {
                setActiveTab(this.dataset.tab);
            });
        });

        // sorting for all tables
        document.querySelectorAll('table.sortable-table').forEach(table => {
            attachSorting(table);
        });

        // search for each tab
        attachTableSearch('manual-orders-search',    'manual-orders-table');
        attachTableSearch('pending-orders-search',   'pending-orders-table');
        attachTableSearch('done-orders-search',      'done-orders-table');
        attachTableSearch('all-orders-search',       'all-orders-table');
        attachTableSearch('cancelled-orders-search', 'cancelled-orders-table');
    });

    // Multi-order delete functionality
    const selectAllCheckbox = document.getElementById('select-all');
    const orderCheckboxes = document.querySelectorAll('.order-checkbox');
    const deleteSelectedButton = document.getElementById('delete-selected');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', () => {
            orderCheckboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
            toggleDeleteButton();
        });
    }

    orderCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', toggleDeleteButton);
    });

    function toggleDeleteButton() {
        const anySelected = Array.from(orderCheckboxes).some(checkbox => checkbox.checked);
        deleteSelectedButton.disabled = !anySelected;
    }

    if (deleteSelectedButton) {
        deleteSelectedButton.addEventListener('click', () => {
            const selectedIds = Array.from(orderCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            if (selectedIds.length > 0) {
                fetch('/employee/orders/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to delete orders.');
                    }
                });
            }
        });
    }
</script>

{{-- manual order modal (may sarili nang scripts sa partial na ito) --}}
@include('dashboard.partials.manual_order_modal')
@endsection
