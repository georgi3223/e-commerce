@extends('layouts.app')

@section('title', 'Home - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<section>
    <h2>Welcome to Our Store</h2>
    <p>Discover amazing products at great prices!</p>
</section>

<section>
    <h2>Shop by Category</h2>
    @if($categories->count() > 0)
        <div>
            @foreach($categories as $category)
            <article>
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->description }}</p>
                <p>{{ $category->products_count }} products</p>
                <a href="{{ route('products.index', ['category' => $category->id]) }}">Browse {{ $category->name }}</a>
            </article>
            @endforeach
        </div>
    @else
        <p>No categories available</p>
    @endif
</section>

<section>
    <h2>Featured Products</h2>
    @if($featuredProducts->count() > 0)
        <div>
            @foreach($featuredProducts as $product)
            <article>
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" width="200" height="200">
               
                @endif
                <h3>{{ $product->name }}</h3>
                <p>{{ Str::limit($product->description, 100) }}</p>
                <p><strong>${{ number_format($product->price, 2) }}</strong></p>
                <p>Stock: {{ $product->stock }} available</p>
                <div>
                    <a href="{{ route('products.show', $product->slug) }}">View Details</a>
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            </article>
            @endforeach
        </div>
    @else
        <p>No featured products available</p>
    @endif
</section>

<section>
    <h2>New Arrivals</h2>
    @if($newArrivals->count() > 0)
        <div>
            @foreach($newArrivals as $product)
            <article>
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" width="200" height="200">
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="No image" width="200" height="200">
                @endif
                <h3>{{ $product->name }}</h3>
                <p>{{ Str::limit($product->description, 100) }}</p>
                <p><strong>${{ number_format($product->price, 2) }}</strong></p>
                <div>
                    <a href="{{ route('products.show', $product->slug) }}">View Details</a>
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            </article>
            @endforeach
        </div>
    @else
        <p>No new products available</p>
    @endif
</section>
@endsection