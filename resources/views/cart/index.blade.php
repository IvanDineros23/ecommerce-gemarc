@extends('layouts.ecommerce')

@section('content')
<!-- Toast Notification Container (Same as Shop Page) -->
<div x-data="toastNotification()" x-init="window.toastData = $data" class="fixed top-20 right-4 z-[9999] space-y-2 w-80" x-cloak>
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
                        <svg x-show="toast.type === 'info'" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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

                  <li class="px-6 py-4" x-data="{ qty: {{ $qty }} }">
                    <div class="flex items-start gap-6">
                      <!-- Larger Product Image -->
                      <div class="w-32 h-32 rounded-xl bg-gray-50 border border-gray-100 overflow-hidden flex-shrink-0">
                        <img src="{{ $img }}" alt="{{ $p->name }}" class="w-full h-full object-contain">
                      </div>

                      <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                          <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 line-clamp-1 mb-3">{{ $p->name }}</h3>
                            
                            <!-- Specifications/Customization Field -->
                            <div class="mb-4">
                              <label class="block text-sm font-medium text-gray-700 mb-2">
                                Specifications / Customization Notes
                              </label>
                              <textarea 
                                name="specifications[{{ $item->id }}]" 
                                rows="3" 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"
                                placeholder="Enter any specific requirements, modifications, or technical specifications for this item..."
                              >{{ $item->specifications ?? '' }}</textarea>
                              <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                Our sales team will contact you for pricing based on your specifications.
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="flex items-center justify-between flex-wrap gap-3">
                          <!-- Quantity stepper with description -->
                          <div class="flex flex-col">
                            <label class="text-xs text-gray-600 mb-1 font-medium">Quantity</label>
                            <div class="inline-flex items-center rounded-md border border-gray-200 overflow-hidden bg-white">
                              <button type="button" class="w-7 h-7 grid place-items-center text-gray-600 hover:bg-gray-50 text-sm transition-colors"
                                      onclick="let input = this.nextElementSibling; let val = Math.max(1, parseInt(input.value || 1) - 1); input.value = val;">−</button>
                              <input type="number" min="1"
                                     name="quantities[{{ $item->id }}]"
                                     value="{{ $qty }}"
                                     class="w-10 h-7 text-center outline-none text-sm font-medium border-x border-gray-200"
                                     style="-webkit-appearance: none; -moz-appearance: textfield; appearance: none;"
                                     placeholder="1"
                                     onchange="this.value = Math.max(1, parseInt(this.value || 1));">
                              <button type="button" class="w-7 h-7 grid place-items-center text-gray-600 hover:bg-gray-50 text-sm transition-colors"
                                      onclick="let input = this.previousElementSibling; let val = parseInt(input.value || 1) + 1; input.value = val;">+</button>
                            </div>
                          </div>

                          <!-- Contact Sales Notice -->
                          <div class="text-right ml-auto">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg px-3 py-2">
                              <div class="text-sm font-semibold text-blue-800">Contact Sales for Pricing</div>
                              <div class="text-xs text-blue-600">Custom quotes available</div>
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
                  Update Cart & Specifications
                </button>
                <div class="text-right">
                  <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                    <div class="text-sm font-semibold text-green-800">Ready for Quote</div>
                    <div class="text-xs text-green-600">{{ $items->count() }} item(s) in cart</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Submit Order Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mt-4">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-lg font-bold text-gray-800 mb-1">Submit Order Request</h3>
                  <p class="text-sm text-gray-600">Convert your cart to an order with specifications</p>
                </div>
                <button id="submitOrderBtn" onclick="submitCartAsOrder()" 
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                  <i id="submitOrderIcon" class="fas fa-paper-plane"></i>
                  <span id="submitOrderText">Submit Order</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Sales Contact -->
          <div class="w-full">
            <div class="bg-white rounded-2xl shadow-lg p-8">
              <div class="text-center mb-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i class="fas fa-headset text-2xl text-blue-600"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Contact Sales Department</h2>
                <p class="text-gray-600 text-sm">Get personalized pricing based on your specifications</p>
              </div>
              
              <div class="space-y-4">
                <!-- Contact Information -->
                <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-lg p-6 text-center">
                  <div class="space-y-3">
                    <div class="flex items-center justify-center gap-2 text-lg">
                      <i class="fas fa-envelope text-blue-600"></i>
                      <span class="font-semibold text-gray-800">sales@gemarcph.com</span>
                    </div>
                    <div class="flex items-center justify-center gap-2 text-lg">
                      <i class="fas fa-phone text-green-600"></i>
                      <span class="font-semibold text-gray-800">+63 909 087 9416</span>
                    </div>
                    <div class="text-sm text-gray-600 font-medium">Marketing Department</div>
                  </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  <button onclick="window.open('mailto:sales@gemarcph.com?subject=Cart Quote Request&body=Please provide a quote for the items in my cart with the specifications I have provided.')" 
                          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                    <i class="fas fa-envelope"></i>
                    Email Quote Request
                  </button>
                  
                  <button onclick="window.open('tel:+639090879416')"
                          class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                    <i class="fas fa-phone"></i>
                    Call Sales Team
                  </button>
                </div>

                <p class="text-center text-sm text-gray-500 mt-4">
                  <i class="fas fa-clock mr-1"></i>
                  Our sales team will review your specifications and provide competitive pricing within 24 hours.
                </p>
              </div>
            </div>
          </div>
          <br>
        </div>
      </form>
    @endif
  </div>
</div>

@push('scripts')
<style>
  /* Remove spinner arrows from number input */
  input[type="number"]::-webkit-outer-spin-button,
  input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  
  input[type="number"] {
    -moz-appearance: textfield;
    appearance: textfield;
  }
</style>

<script>
  // Toast notification system (same as shop page)
  function toastNotification() {
      return {
          toasts: [],
          showToast(message, type = 'success') {
              const id = Date.now();
              this.toasts.push({ id, message, type });
              setTimeout(() => {
                  this.removeToast(id);
              }, 3000);
          },
          removeToast(id) {
              this.toasts = this.toasts.filter(toast => toast.id !== id);
          }
      }
  }

  // Function to show toast from forms (unified function)
  function showToast(message, type = 'success') {
      if (window.toastData) {
          window.toastData.showToast(message, type);
      }
  }

  // Cart functionality for quote-based system
  document.addEventListener('DOMContentLoaded', function() {
    // Auto-save specifications when user types
    const textareas = document.querySelectorAll('textarea[name^="specifications"]');
    textareas.forEach(textarea => {
      let timeout;
      textarea.addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
          // Visual feedback that specs are being saved
          this.style.borderColor = '#10b981';
          setTimeout(() => {
            this.style.borderColor = '';
          }, 1000);
        }, 500);
      });
    });

    // Update item count display
    function updateItemCount() {
      const itemCount = document.querySelectorAll('.product-row').length;
      const countDisplays = document.querySelectorAll('.item-count');
      countDisplays.forEach(display => {
        display.textContent = itemCount;
      });
    }

    // Initialize item count
    updateItemCount();
  });

  // Function to submit cart as order (updated to use unified toast)
  function submitCartAsOrder() {
    const submitBtn = document.getElementById('submitOrderBtn');
    const submitIcon = document.getElementById('submitOrderIcon');
    const submitText = document.getElementById('submitOrderText');
    
    // Disable button and show loading state
    submitBtn.disabled = true;
    submitIcon.className = 'fas fa-spinner fa-spin';
    submitText.textContent = 'Submitting...';
    
    // Show loading toast
    showToast('Processing your order...', 'info');
    
    // First update the cart with specifications
    const form = document.querySelector('form[action="{{ route('cart.update') }}"]');
    if (form) {
      // Create FormData from the cart form
      const formData = new FormData(form);
      
      // Submit via AJAX to place order
      fetch('{{ route('cart.place-order') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json',
        },
        body: formData
      })
      .then(response => {
        if (response.ok) {
          // Show success toast
          showToast('Order submitted successfully! Redirecting to orders page...', 'success');
          
          // Update button to success state
          submitIcon.className = 'fas fa-check';
          submitText.textContent = 'Order Submitted!';
          
          // Redirect after short delay
          setTimeout(() => {
            window.location.href = '{{ route('orders.index') }}';
          }, 1500);
        } else {
          throw new Error('Failed to submit order');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('Failed to submit order. Please try again.', 'error');
        
        // Reset button state
        submitBtn.disabled = false;
        submitIcon.className = 'fas fa-paper-plane';
        submitText.textContent = 'Submit Order';
      });
    } else {
      showToast('Cart form not found. Please refresh the page.', 'error');
      
      // Reset button state
      submitBtn.disabled = false;
      submitIcon.className = 'fas fa-paper-plane';
      submitText.textContent = 'Submit Order';
    }
  }
</script>
@endpush
@endsection
