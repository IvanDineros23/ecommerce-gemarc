@extends('layouts.ecommerce')
@section('title', 'Request a Quote | Gemarc Enterprises Inc.')
@section('content')
<div class="container py-4">
    <h2 class="text-center text-success fw-bold mb-4">Request a Quote</h2>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <form class="mb-3">
                <div class="input-group">
                    <input type="text" id="product-search" class="form-control" placeholder="Search products..." autocomplete="off">
                    <button class="btn btn-outline-secondary" type="button" id="clear-search">Clear</button>
                </div>
            </form>
    <form method="POST" action="{{ route('quotes.store') }}">
        @csrf
        <div class="table-responsive">
            <table class="table table-hover" id="products-table">
                <thead style="background-color: #e8f5e9;">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Add</th>
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
            </div>
            
            <div class="mb-4 mt-4">
                <label for="notes" class="form-label fw-medium">Additional Notes</label>
                <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Any special instructions or requirements..."></textarea>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-success px-4 py-2">
                    Submit Quote Request
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('product-search');
    const clearBtn = document.getElementById('clear-search');
    const rows = document.querySelectorAll('.product-row');
    
    function filterRows() {
        const val = searchInput.value.toLowerCase();
        let found = 0;
        
        rows.forEach(row => {
            const name = row.querySelector('.product-name').textContent.toLowerCase();
            const desc = row.querySelector('.product-desc').textContent.toLowerCase();
            if (name.includes(val) || desc.includes(val)) {
                row.style.display = '';
                found++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show no results message
        let noResults = document.getElementById('no-results');
        if (found === 0 && val.length > 0) {
            if (!noResults) {
                noResults = document.createElement('div');
                noResults.id = 'no-results';
                noResults.className = 'alert alert-info text-center my-3';
                noResults.textContent = 'No products found matching your search.';
                document.getElementById('products-table').parentNode.appendChild(noResults);
            }
            noResults.style.display = '';
        } else if (noResults) {
            noResults.style.display = 'none';
        }
    }
    
    searchInput.addEventListener('input', filterRows);
    clearBtn.addEventListener('click', function() {
        searchInput.value = '';
        filterRows();
        searchInput.focus();
    });
    
    // Add hover effect to rows
    rows.forEach(row => {
        row.addEventListener('mouseover', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        row.addEventListener('mouseout', function() {
            this.style.backgroundColor = '';
        });
    });
</script>
@endpush
@endsection
