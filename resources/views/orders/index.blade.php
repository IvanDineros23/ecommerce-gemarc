@extends('layouts.ecommerce')
@section('title', 'My Orders | Gemarc Enterprises Inc.')

@push('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>[x-cloak]{display:none!important}</style>

    <script>
        // Toast notification (success/error)
        function toastNotification() {
            return {
                toasts: [],
                showToast(message, type = 'success') {
                    const id = Date.now();
                    this.toasts.push({ id, message, type });
                    setTimeout(() => this.removeToast(id), 3000);
                },
                removeToast(id) {
                    this.toasts = this.toasts.filter(toast => toast.id !== id);
                }
            };
        }

        // Order manager + ESC / click-outside close + tabs
        function orderManager() {
            return {
                showModal: false,
                orderToDelete: null,
                orderReference: '',
                activeTab: 'pending', // 'pending' | 'cancelled'
                showDetailsModal: false,
                orderDetails: null,

                openCancelModal(orderId, orderRef) {
                    this.orderToDelete = orderId;
                    this.orderReference = orderRef;
                    this.showModal = true;
                    document.body.classList.add('overflow-hidden');
                },

                closeModal() {
                    this.showModal = false;
                    document.body.classList.remove('overflow-hidden');
                },

                handleKeydown(e) {
                    if (e.key === 'Escape') {
                        this.closeModal();
                        this.closeDetailsModal();
                    }
                },

                async cancelOrder() {
                    try {
                        const token = document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content');

                        const response = await fetch(`/orders/${this.orderToDelete}/cancel`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) throw new Error('Failed to cancel order');

                        window.toastData.showToast('Order cancelled successfully', 'success');
                        this.closeModal();
                        setTimeout(() => window.location.reload(), 1500);
                    } catch (error) {
                        console.error('Error:', error);
                        window.toastData.showToast('Failed to cancel order. Please try again.', 'error');
                    }
                },

                async viewOrderDetails(orderId) {
                    this.showDetailsModal = true;
                    this.orderDetails = null;
                    try {
                        const response = await fetch(`/orders/${orderId}/json`, {
                            headers: { 'Accept': 'application/json' }
                        });
                        if (!response.ok) throw new Error('Failed to fetch order details');
                        const data = await response.json();
                        this.orderDetails = data;
                    } catch (error) {
                        this.orderDetails = null;
                        window.toastData.showToast('Failed to load order details.', 'error');
                    }
                },

                closeDetailsModal() {
                    this.showDetailsModal = false;
                    this.orderDetails = null;
                }
            };
        }
    </script>
@endpush

@section('content')
    <!-- Toast Notification Container -->
    <div x-data="toastNotification()" 
         x-init="window.toastData = $data"
         x-cloak
         class="fixed top-4 right-4 space-y-2 w-80 pointer-events-none"
         style="z-index: 99999;">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="true" 
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-x-full opacity-0"
                 x-transition:enter-end="translate-x-0 opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="translate-x-0 opacity-100"
                 x-transition:leave-end="translate-x-full opacity-0"
                 class="w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg x-show="toast.type === 'success'" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg x-show="toast.type === 'error'" class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900" x-text="toast.message"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="removeToast(toast.id)" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                                <span class="sr-only">Close</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Main Content Alpine.js Wrapper -->
    <div x-data="orderManager()" @keydown.window="handleKeydown($event)">
        <!-- Cancel Confirmation Modal -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <!-- Overlay (click outside to close) -->
            <div x-show="showModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-black bg-opacity-60"
                 style="backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);"
                 @click="closeModal()">
            </div>

            <!-- Modal Panel -->
            <div x-show="showModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative z-10 bg-white rounded-lg shadow-xl transform transition-all sm:max-w-lg w-full mx-4"
                 @click.stop>

                <!-- Header -->
                <div class="flex items-center justify-center gap-2 px-6 pt-6">
                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Cancel Order</h3>
                </div>

                <!-- Body -->
                <div class="px-6 py-4 text-center">
                    <p class="text-sm text-gray-600">
                        Are you sure you want to cancel order 
                        <span class="font-semibold text-gray-900" x-text="orderReference"></span>? 
                        This action cannot be undone.
                    </p>
                </div>

                <!-- Buttons -->
                <div class="bg-gray-50 px-6 py-4 flex justify-center gap-3">
                    <button type="button" 
                            @click="cancelOrder()" 
                            class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Cancel Order
                    </button>
                    <button type="button" 
                            @click="closeModal()" 
                            class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-6 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Keep Order
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container py-4">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                <div class="card-header bg-white py-3 border-bottom">
                    <h4 class="card-title mb-0 fw-bold">My Orders</h4>
                </div>

                @php
                    $pendingOrders = $orders->where('status', 'pending');
                    $cancelledOrders = $orders->where('status', 'cancelled');
                @endphp

                <div class="card-body p-0" x-data>
                    <!-- Tabs -->
                    <div class="px-3 pt-3 border-bottom">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <button type="button"
                                        class="nav-link"
                                        :class="activeTab === 'pending' ? 'active' : ''"
                                        @click="activeTab = 'pending'">
                                    Pending Orders
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button"
                                        class="nav-link"
                                        :class="activeTab === 'cancelled' ? 'active' : ''"
                                        @click="activeTab = 'cancelled'">
                                    Cancelled Orders
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Pending Orders Tab -->
                    <div x-show="activeTab === 'pending'" x-cloak>
                        @if($pendingOrders->isEmpty())
                            <div class="p-5 text-center">
                                <div class="mb-3">
                                    <i class="fas fa-clipboard-list fa-3x text-muted"></i>
                                </div>
                                <h5 class="text-muted">No pending orders</h5>
                                <p class="text-muted">You haven't placed any pending orders yet.</p>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Browse Products
                                </a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Reference #</th>
                                            <th>Date</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendingOrders as $order)
                                            <tr>
                                                <td>{{ $order->reference_number }}</td>
                                                <td>{{ $order->created_at->format('F d, Y h:i A') }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary"
                                                            @click="viewOrderDetails('{{ $order->id }}')">
                                                            <i class="fas fa-eye me-1"></i> View
                                                        </button>
                                                        <a href="tel:+639090879416" 
                                                           class="btn btn-sm btn-outline-success" 
                                                           title="Call Marketing Department: +63 909 087 9416">
                                                            <i class="fas fa-phone me-1"></i> Marketing
                                                        </a>
                                                        <button type="button" 
                                                                class="btn btn-sm btn-outline-danger"
                                                                @click="openCancelModal('{{ $order->id }}', '{{ $order->reference_number }}')">
                                                            <i class="fas fa-times me-1"></i> Cancel
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <!-- Cancelled Orders Tab -->
                    <div x-show="activeTab === 'cancelled'" x-cloak>
                        @if($cancelledOrders->isEmpty())
                            <div class="p-5 text-center">
                                <div class="mb-3">
                                    <i class="fas fa-ban fa-3x text-muted"></i>
                                </div>
                                <h5 class="text-muted">No cancelled orders</h5>
                                <p class="text-muted">You haven't cancelled any orders yet.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Reference #</th>
                                            <th>Date</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cancelledOrders as $order)
                                            <tr>
                                                <td>{{ $order->reference_number }}</td>
                                                <td>{{ $order->created_at->format('F d, Y h:i A') }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-danger">Cancelled</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary"
                                                            @click="viewOrderDetails('{{ $order->id }}')">
                                                            <i class="fas fa-eye me-1"></i> View
                                                        </button>
                                                        <a href="tel:+639090879416" 
                                                           class="btn btn-sm btn-outline-success" 
                                                           title="Call Marketing Department: +63 909 087 9416">
                                                            <i class="fas fa-phone me-1"></i> Marketing
                                                        </a>
                                                        <!-- No cancel button na dito, cancelled na -->
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Order Details Modal -->
        <div x-show="showDetailsModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div x-show="showDetailsModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-black bg-opacity-60"
                 style="backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);"
                 @click="closeDetailsModal()">
            </div>
            <div x-show="showDetailsModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative z-10 bg-white rounded-lg shadow-xl transform transition-all sm:max-w-2xl w-full mx-4 p-6"
                 @click.stop>
                <template x-if="orderDetails">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-green-800">Order Details</h2>
                            <button @click="closeDetailsModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                        </div>
                        <div class="mb-2"><span class="font-semibold">Reference #:</span> <span x-text="orderDetails.reference_number"></span></div>
                        <div class="mb-2"><span class="font-semibold">Order Date:</span> <span x-text="orderDetails.created_at"></span></div>
                        <div class="mb-2"><span class="font-semibold">Status:</span> <span x-text="orderDetails.status"></span></div>
                        <div class="mb-2"><span class="font-semibold">Mode of Payment:</span> <span x-text="orderDetails.payment_method"></span></div>
                        <div class="mb-2"><span class="font-semibold">Mode of Delivery:</span> <span x-text="orderDetails.delivery_method"></span></div>
                        <div class="mt-4">
                            <table class="w-full text-sm border">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-2 px-3 text-left">Product</th>
                                        <th class="py-2 px-3 text-center">Quantity</th>
                                        <th class="py-2 px-3 text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="item in orderDetails.items" :key="item.id">
                                        <tr>
                                            <td class="py-2 px-3" x-text="item.name"></td>
                                            <td class="py-2 px-3 text-center" x-text="item.quantity"></td>
                                            <td class="py-2 px-3 text-right">
                                                <template x-if="orderDetails.status === 'cancelled'">
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Cancelled</span>
                                                </template>
                                                <template x-if="orderDetails.status !== 'cancelled' && item.quote_status === 'ready'">
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Quote Ready</span>
                                                </template>
                                                <template x-if="orderDetails.status !== 'cancelled' && item.quote_status !== 'ready'">
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending Quote</span>
                                                </template>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
                <template x-if="!orderDetails">
                    <div class="text-center py-8 text-gray-500">Loading...</div>
                </template>
            </div>
        </div>
    </div>
@endsection
