@extends('layouts.ecommerce')

@section('title', $product->name . ' | Gemarc Enterprises Inc.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="md:flex">
            <!-- Product Image -->
            <div class="md:flex-shrink-0 md:w-1/2 p-6 bg-gray-50 flex items-center justify-center">
                @php $img = $product->firstImagePath(); @endphp
                @if($img)
                    <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" class="max-w-full max-h-[400px] object-contain">
                @else
                    <img src="/images/gemarclogo.png" alt="No Image" class="max-w-full max-h-[400px] object-contain">
                @endif
            </div>

            <!-- Product Details -->
            <div class="p-8 md:w-1/2">
                <div class="uppercase tracking-wide text-sm text-green-700 font-semibold">Product Details</div>
                <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                
                @if($product->description)
                <div class="mt-4 text-gray-600">
                    {!! nl2br(e($product->description)) !!}
                </div>
                @endif

                <div class="mt-6 space-y-4">
                    @if($product->specifications)
                    <div class="border-t pt-4">
                        <h3 class="text-lg font-semibold text-gray-900">Specifications</h3>
                        <div class="mt-2 text-gray-600">
                            {!! nl2br(e($product->specifications)) !!}
                        </div>
                    </div>
                    @endif

                    <div class="flex gap-4">
                        <button onclick="window.history.back()" class="bg-gray-100 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            Back
                        </button>
                        <a href="{{ route('cart.add', ['product' => $product->id]) }}" 
                           class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition-colors duration-200 text-center">
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection