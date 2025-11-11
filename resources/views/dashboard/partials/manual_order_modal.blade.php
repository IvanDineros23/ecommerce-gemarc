<div id="manual-order-modal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40">
    <div class="absolute inset-0" onclick="closeManualOrderModal()"></div>

    {{-- CARD --}}
    <div
        class="relative bg-white rounded-xl shadow-xl w-full max-w-lg md:max-w-xl lg:max-w-2xl mx-2
               max-h-[90vh] overflow-y-auto overflow-x-hidden p-4 md:p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-green-800">Create Manual Order</h2>
            <button type="button"
                    class="text-gray-500 hover:text-gray-800 text-2xl leading-none"
                    onclick="closeManualOrderModal()">
                &times;
            </button>
        </div>

        <form id="manual-order-form"
              method="POST"
              action="{{ route('employee.orders.manual.store') }}"
              class="space-y-4">
            @csrf

            {{-- Customer Name --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Customer Name</label>
                <input type="text" name="customer_name"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Order Items --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Order Items</label>
                <div id="manual-order-items">
                    <div class="flex flex-wrap items-center gap-2 mb-2"
                         v-for="(item, idx) in orderItems"
                         :key="idx">

                        {{-- product select – kumakain ng natitirang space --}}
                        <select :name="`order_products[${idx}][product_id]`"
                                class="border rounded px-2 py-1 flex-1 min-w-[150px]"
                                required>
                            <option value="">Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>

                        {{-- qty --}}
                        <input :name="`order_products[${idx}][quantity]`"
                               type="number" min="1"
                               class="border rounded px-2 py-1 w-20"
                               placeholder="Qty" required>

                        {{-- unit price --}}
                        <input :name="`order_products[${idx}][unit_price]`"
                               type="number" min="0" step="0.01"
                               class="border rounded px-2 py-1 w-24"
                               placeholder="Price" required>

                        {{-- remove button --}}
                        <button type="button"
                                class="text-red-500 font-bold px-2"
                                @click="removeItem(idx)">
                            &times;
                        </button>
                    </div>
                </div>
                <button type="button"
                        class="mt-2 px-3 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200"
                        @click="addItem">
                    + Add Product
                </button>
            </div>

            {{-- Total --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Total Amount</label>
          <input type="number" name="total_amount"
              class="w-full border rounded px-3 py-2"
              min="0" step="0.01"
              required
              v-model.number="totalAmount">
            </div>

            {{-- Payment / Delivery --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Mode of Payment</label>
                <input type="text" name="payment_method"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Mode of Delivery</label>
                <input type="text" name="delivery_method"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded"
                        onclick="closeManualOrderModal()">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded font-semibold">
                    Save Order
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
<script>
    // Modal open/close helpers (same as before)
    function openManualOrderModal() {
        const modal = document.getElementById('manual-order-modal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }
    function closeManualOrderModal() {
        const modal = document.getElementById('manual-order-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeManualOrderModal();
        }
    });

    // Vue for dynamic product rows and total calculation
    new Vue({
        el: '#manual-order-form',
        data: {
            orderItems: [
                { product_id: '', quantity: 1, unit_price: 0 }
            ],
            totalAmount: 0
        },
        methods: {
            addItem() {
                this.orderItems.push({ product_id: '', quantity: 1, unit_price: 0 });
            },
            removeItem(idx) {
                this.orderItems.splice(idx, 1);
                this.updateTotal();
            },
            updateTotal() {
                this.totalAmount = this.orderItems.reduce((sum, item) => {
                    const qty = parseFloat(item.quantity) || 0;
                    const price = parseFloat(item.unit_price) || 0;
                    return sum + (qty * price);
                }, 0).toFixed(2);
            }
        },
        watch: {
            orderItems: {
                handler: function() { this.updateTotal(); },
                deep: true
            }
        },
        mounted() {
            this.updateTotal();
        }
    });
</script>
