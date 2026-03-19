@extends('layouts.app')

@section('title', $product->name . ' - E-Commerce Store')

@section('content')
<section>
    <a href="{{ route('products.index') }}">← Back to Products</a>
    
    <div>
        <div>
            @if($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" width="400">
            @else
                <img src="{{ asset('images/no-image.png') }}" alt="No image" width="400">
            @endif
        </div>

        <div>
            <h2>{{ $product->name }}</h2>
            <p>Category: {{ $product->category->name }}</p>
            <h3>${{ number_format($product->price, 2) }}</h3>
            
            @if($product->stock > 0)
                <p>In Stock: {{ $product->stock }} available</p>
            @else
                <p><strong>Out of Stock</strong></p>
            @endif

            <div>
                <h4>Description</h4>
                <p>{{ $product->description }}</p>
            </div>

            @if($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <div>
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                    </div>
                    <button type="submit">Add to Cart</button>
                </form>
            @else
                <button disabled>Out of Stock</button>
            @endif
        </div>
    </div>
</section>

@if($relatedProducts->count() > 0)
<section>
    <h3>Related Products</h3>
    <div>
        @foreach($relatedProducts as $related)
        <article>
            @if($related->image)
                <img src="{{ asset('storage/products/' . $related->image) }}" alt="{{ $related->name }}" width="150" height="150">
            @else
                <img src="{{ asset('images/no-image.png') }}" alt="No image" width="150" height="150">
            @endif
            <h4>{{ $related->name }}</h4>
            <p>${{ number_format($related->price, 2) }}</p>
            <a href="{{ route('products.show', $related->slug) }}">View Details</a>
        </article>
        @endforeach
    </div>
</section>
@endif
@endsection