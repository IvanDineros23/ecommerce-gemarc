@extends('layouts.ecommerce')
@section('title', 'Saved Items | Gemarc Enterprises Inc.')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success fw-bold">Saved Items</h2>
        <a href="{{ route('shop.index') }}" class="btn btn-warning">Go to All Products</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if($savedItems->isEmpty())
        <div class="text-center py-5 my-4">
            <div class="mb-3">
                <i class="fas fa-heart text-muted" style="font-size: 4rem;"></i>
            </div>
            <h4 class="text-muted">No saved items yet.</h4>
            <p class="text-muted mb-4">Items you save will appear here.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-success">Browse Products</a>
        </div>
    @else
        <div class="row">
            @foreach($savedItems as $item)
                @php $product = $item->product; @endphp
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="text-center py-4 bg-light">
                            <img src="{{ $product && $product->firstImagePath() ? asset('storage/'.$product->firstImagePath()) : '/images/gemarclogo.png' }}" 
                                alt="{{ $product->name ?? 'Product' }}" 
                                class="img-fluid" style="height: 150px; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $product->name ?? 'Product not found' }}</h5>
                            <p class="card-text text-muted small mb-3" style="height: 3em; overflow: hidden;">{{ $product->description ?? '' }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold fs-5">₱{{ number_format($product->unit_price ?? 0,2) }}</span>
                                <a href="{{ route('shop.show', $product->id) }}" class="btn btn-sm btn-outline-success">View Details</a>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-shopping-cart me-1"></i> Add to Cart
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('saved.destroy', $item->id) }}" onsubmit="return confirm('Remove this item from saved?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt me-1"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
