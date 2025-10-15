@extends('layouts.ecommerce')

@section('content')
<div class="py-10">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex items-center gap-3 mb-6">
      <div class="bg-green-100 p-3 rounded-full shadow">
        <svg class="w-6 h-6 text-green-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A2 2 0 008.48 18h7.04a2 2 0 001.83-2.3L17 13M7 13V6h13"/>
        </svg>
      </div>
      <h1 class="text-3xl font-extrabold text-green-800">Your Cart</h1>
    </div>

    @if($items->isEmpty())
    <div class="bg-white rounded-2xl shadow-lg p-8 animate-fadein flex items-center justify-center min-h-[320px]">
      @if($items->isEmpty())
        <div class="w-full flex flex-col items-center justify-center">
        <div class="mx-auto w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="12" r="10"/>
            <path stroke-linecap="round" d="M8 12h8m-4-4v8"/>
          </svg>
        </div>
        <p class="text-xl font-semibold text-gray-600">Your cart is empty.</p>
        <p class="text-gray-400 mb-6">Browse our products and add items to your cart.</p>
        <a href="{{ route('shop.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-green-600 text-white font-semibold shadow hover:bg-green-700 transition">Go to Shop</a>
           </div>
        </div>
    @else
      <form method="POST" action="{{ route('cart.update') }}" x-data x-on:update-total.window="recalcTotals()">
        @csrf

        <div class="grid lg:grid-cols-3 gap-6">
          <!-- Items -->
          <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow overflow-hidden">
              <div class="px-6 py-4 border-b bg-green-50">
                <div class="text-sm font-semibold text-green-700">Items ({{ $items->count() }})</div>
              </div>

              <ul class="divide-y">
                @foreach($items as $item)
                  @php
                    $p = $item->product;
                    $price = $item->unit_price;
                    $qty   = $item->qty;
                    $img   = method_exists($p,'firstImagePath') && $p->firstImagePath()
                            ? asset('storage/'.$p->firstImagePath())
                            : asset('images/gemarclogo.png');
                  @endphp

                  <li class="px-6 py-4" x-data="{ qty: {{ $qty }}, price: {{ $price }} }">
                    <div class="flex items-center gap-4">
                      <div class="w-16 h-16 rounded-xl bg-gray-50 border border-gray-100 overflow-hidden flex-shrink-0">
                        <img src="{{ $img }}" alt="{{ $p->name }}" class="w-full h-full object-contain">
                      </div>

                      <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                          <h3 class="font-semibold text-gray-800 line-clamp-1">{{ $p->name }}</h3>
                          <div class="text-right">
                            <div class="text-sm text-gray-500">Unit</div>
                            <div class="font-semibold">₱{{ number_format($price, 2) }}</div>
                          </div>
                        </div>

                        <div class="mt-3 flex items-center justify-between flex-wrap gap-3">
                          <!-- qty stepper -->
                          <div class="inline-flex items-center rounded-lg border border-gray-200 overflow-hidden">
                            <button type="button" class="w-9 h-9 grid place-items-center text-gray-600 hover:bg-gray-50"
                                    @click="if(qty>1){ qty--; $refs.input.value=qty; $dispatch('update-total'); }">−</button>
                            <input x-ref="input" type="number" min="1"
                                   name="quantities[{{ $item->id }}]"
                                   class="w-14 h-9 text-center outline-none"
                                   :value="qty"
                                   @input="qty = Math.max(1, parseInt($event.target.value || 1)); $dispatch('update-total')">
                            <button type="button" class="w-9 h-9 grid place-items-center text-gray-600 hover:bg-gray-50"
                                    @click="qty++; $refs.input.value=qty; $dispatch('update-total')">+</button>
                          </div>

                          <!-- row subtotal -->
                          <div class="text-right ml-auto">
                            <div class="text-xs text-gray-500">Subtotal</div>
                            <div class="font-bold text-gray-900"
                                 x-text="'₱' + (qty * price).toLocaleString(undefined,{minimumFractionDigits:2})">
                              ₱{{ number_format($price * $qty,2) }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>

              <div class="px-6 py-4 border-t bg-gray-50 flex items-center justify-between">
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-white border border-gray-200 text-gray-700 font-semibold hover:bg-gray-100">
                  Update Cart
                </button>
                <div class="text-right">
                  <div class="text-sm text-gray-500">Cart Total</div>
                  <div class="text-2xl font-extrabold text-green-700">₱<span id="cart-total">{{ number_format($total,2) }}</span></div>
        </div>
      @endif
              </div>
            </div>
          </div>

          <!-- Summary / Checkout -->
          <div class="w-full flex flex-col items-center justify-center mt-8">
            @php
              $user = Auth::user();
              $defaultPayment  = $user->payment_details['method'] ?? null;
              $defaultDelivery = $user->delivery_option['method'] ?? null;
            @endphp
            <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center min-h-[320px] w-full max-w-xl">
              <h2 class="text-lg font-bold text-gray-800 mb-6">Checkout</h2>
              <div class="space-y-4 w-full">
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Payment Method</label>
                  <select form="checkout-form" name="payment_method"
                          class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-green-500"
                          required>
                    <option value="">Select payment method</option>
                    <option value="cod"   @selected($defaultPayment=='cod')>Cash on Delivery (COD)</option>
                    <option value="gcash" @selected($defaultPayment=='gcash')>GCash</option>
                    <option value="bank"  @selected($defaultPayment=='bank')>Bank Transfer</option>
                  </select>
                  @if($defaultPayment)
                    <div class="text-xs text-green-700 mt-1">Default: <span class="font-semibold">{{ strtoupper($defaultPayment) }}</span></div>
                  @endif
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Delivery Method</label>
                  <select form="checkout-form" name="delivery_method"
                          class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-green-500"
                          required>
                    <option value="">Select delivery method</option>
                    <option value="pickup"   @selected($defaultDelivery=='pickup')>Pickup</option>
                    <option value="delivery" @selected($defaultDelivery=='delivery')>Delivery</option>
                  </select>
                  @if($defaultDelivery)
                    <div class="text-xs text-green-700 mt-1">Default: <span class="font-semibold">{{ ucfirst($defaultDelivery) }}</span></div>
                  @endif
                </div>
              </div>
              <form id="checkout-form" method="GET" action="{{ route('cart.checkout') }}" class="mt-6 w-full">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold shadow hover:bg-orange-600 transition">
                  Proceed to Checkout
                </button>
              </form>
              <p class="text-xs text-gray-400 mt-3">Taxes/shipping computed at checkout.</p>
            </div>
          </div>
          <br>
        </div>
      </form>
    @endif
  </div>
</div>

@push('scripts')
<script>
  function recalcTotals(){
    // recompute total on the fly (no server call)
    const rows = document.querySelectorAll('[x-data]');
    let total = 0;
    rows.forEach(r=>{
      const state = Alpine.$data(r);
      if(state && typeof state.qty !== 'undefined' && typeof state.price !== 'undefined'){
        total += (Number(state.qty)||0) * (Number(state.price)||0);
      }
    });
    const el = document.getElementById('cart-total');
    if(el) el.textContent = total.toLocaleString(undefined,{minimumFractionDigits:2, maximumFractionDigits:2});
  }
</script>
@endpush
@endsection
