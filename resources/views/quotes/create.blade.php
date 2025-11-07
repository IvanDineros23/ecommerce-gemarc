@extends('layouts.ecommerce')
@section('title', 'Request a Quote | Gemarc Enterprises Inc.')
@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Title Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Create Quote Request</h1>
            <p class="text-lg text-gray-600">Select products and specify your requirements for a customized quote</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">Product Selection</h2>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 m-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="p-8">
                <div class="mb-6">
                    <div class="flex gap-2">
                        <div class="flex-grow">
                            <input type="text" 
                                   id="product-search" 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                   placeholder="Search products..." 
                                   autocomplete="off">
                        </div>
                        <button type="button" 
                                id="clear-search" 
                                class="px-6 py-3 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            Clear
                        </button>
                    </div>
                </div>

                <form method="POST" action="{{ route('quotes.store') }}" class="space-y-6">
                    @csrf
        <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
            <table class="w-full" id="products-table">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-900">Image</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-900">Product</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold text-gray-900">Description</th>
                        <th class="py-4 px-6 text-center text-sm font-semibold text-gray-900">Quantity</th>
                        <th class="py-4 px-6 text-center text-sm font-semibold text-gray-900">Add</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="product-row">
                        <td class="text-center">
                            @php
                                $img = null;
                                if (isset($product->images) && count($product->images)) {
                                    $img = $product->images->first()->path ?? null;
                                } elseif (!empty($product->image)) {
                                    $img = $product->image;
                                }
                            @endphp
                            @if($img)
                                <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: contain;" />
                            @else
                                <div class="bg-light text-secondary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">No Image</div>
                            @endif
                        </td>
                        <td class="product-name fw-medium">{{ $product->name }}</td>
                        <td class="product-desc text-secondary">{{ $product->description }}</td>
                        <td class="text-center">
                            <input type="number" name="quantities[{{ $product->id }}]" min="0" max="9999" value="0" class="form-control" style="width: 70px; margin: 0 auto;">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" class="form-check-input" name="products[]" value="{{ $product->id }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                        </table>
                    </div>

                    <!-- Additional Notes Section -->
                    <div class="border-t border-gray-200 mt-8 pt-8">
                        <div class="space-y-4">
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                    Additional Notes
                                </label>
                                <textarea 
                                    id="notes" 
                                    name="notes" 
                                    rows="4" 
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                    placeholder="Any special instructions or requirements..."></textarea>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-base font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Submit Quote Request
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('product-search');
    const clearBtn = document.getElementById('clear-search');
    const rows = document.querySelectorAll('.product-row');
    const tableBody = document.querySelector('#products-table tbody');
    
    function filterRows() {
        const val = searchInput.value.toLowerCase().trim();
        let found = 0;
        
        rows.forEach(row => {
            const name = row.querySelector('.product-name').textContent.toLowerCase();
            const desc = row.querySelector('.product-desc').textContent.toLowerCase();
            
            if (val === '' || name.includes(val) || desc.includes(val)) {
                row.style.display = '';
                found++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Handle no results message
        let noResults = document.getElementById('no-results');
        if (found === 0 && val.length > 0) {
            if (!noResults) {
                noResults = document.createElement('tr');
                noResults.id = 'no-results';
                noResults.innerHTML = `
                    <td colspan="5" class="text-center py-4">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-search me-2"></i>
                            No products found matching "<strong>${val}</strong>". Try different keywords.
                        </div>
                    </td>
                `;
                tableBody.appendChild(noResults);
            } else {
                noResults.querySelector('strong').textContent = val;
                noResults.style.display = '';
            }
        } else if (noResults) {
            noResults.style.display = 'none';
        }

        // Update search input styling based on results
        if (val.length > 0) {
            searchInput.classList.remove('is-invalid');
            if (found === 0) {
                searchInput.classList.add('is-invalid');
            } else {
                searchInput.classList.add('is-valid');
            }
        } else {
            searchInput.classList.remove('is-valid', 'is-invalid');
        }
    }
    
    // Real-time search as user types
    searchInput.addEventListener('input', function() {
        filterRows();
        
        // Show/hide clear button based on input
        if (this.value.length > 0) {
            clearBtn.style.display = 'block';
        } else {
            clearBtn.style.display = 'block'; // Always show for better UX
        }
    });
    
    // Clear search functionality
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.classList.remove('is-valid', 'is-invalid');
        filterRows();
        searchInput.focus();
    });

    // Enhanced keyboard support
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            this.value = '';
            this.classList.remove('is-valid', 'is-invalid');
            filterRows();
        }
    });
    
    // Add enhanced hover effect to rows
    rows.forEach(row => {
        row.addEventListener('mouseover', function() {
            if (this.style.display !== 'none') {
                this.style.backgroundColor = '#f8f9fa';
                this.style.transform = 'scale(1.01)';
                this.style.transition = 'all 0.2s ease';
            }
        });
        row.addEventListener('mouseout', function() {
            this.style.backgroundColor = '';
            this.style.transform = 'scale(1)';
        });
    });

    // Focus search input on page load
    searchInput.focus();
});
</script>
@endpush
@endsection
