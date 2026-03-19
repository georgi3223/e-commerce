@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<header>
    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}">Add New Product</a>
</header>

<section>
    @forelse($products as $product)
        <article>
            <h3>{{ $product->name }}</h3>
            <p>Price: ${{ number_format($product->price,2) }}</p>
            <p>{{ Str::limit($product->description, 100) }}</p>

            <a href="{{ route('admin.products.edit', $product) }}">Edit</a>
        </article>
    @empty
        <p>No products found.</p>
    @endforelse
</section>
@endsection
