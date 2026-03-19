@extends('layouts.app')

@section('title', 'Products - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
@endsection

@section('content')
<section>
    <h2>All Products</h2>
    
    <form method="GET" action="{{ route('products.index') }}">
        <div>
            <div>
                <label for="search">Search:</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search products...">
            </div>

            <div>
                <label for="category">Category:</label>
                <select id="category" name="category">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="sort">Sort By:</label>
                <select id="sort" name="sort">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                </select>
            </div>

            <button type="submit">Filter</button>
            <a href="{{ route('products.index') }}">Clear Filters</a>
        </div>
    </form>
</section>

<section>
    <p>Showing {{ $products->count() }} of {{ $products->total() }} products</p>
    
    @if($products->count() > 0)
        <div>
            @foreach($products as $product)
            <article>
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" width="200" height="200">
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="No image" width="200" height="200">
                @endif
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->category->name }}</p>
                <p>{{ Str::limit($product->description, 100) }}</p>
                <p><strong>${{ number_format($product->price, 2) }}</strong></p>
                <p>Stock: {{ $product->stock }}</p>
                <div>
                    <a href="{{ route('products.show', $product->slug) }}">View Details</a>
                    @if($product->stock > 0)
                        <form method="POST" action="{{ route('cart.add', $product->id) }}" style="display:inline;">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit">Add to Cart</button>
                        </form>
                    @else
                        <p>Out of Stock</p>
                    @endif
                </div>
            </article>
            @endforeach
        </div>

        <div>
            {{ $products->links() }}
        </div>
    @else
        <p>No products found</p>
    @endif
</section>
@endsection