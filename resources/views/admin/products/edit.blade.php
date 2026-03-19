@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<header>
    <h2>Edit Product</h2>
</header>

<form method="POST" action="{{ route('admin.products.update', $product) }}">
    @csrf
    @method('PUT')

    <label>
        Name:
        <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
    </label>
    <br>

    <label>
        Description:
        <textarea name="description" required>{{ old('description', $product->description) }}</textarea>
    </label>
    <br>

    <label>
        Price:
        <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
    </label>
    <br>

    <label>
        Active:
        <input type="checkbox" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
    </label>
    <br>

    <button type="submit">Update Product</button>
</form>
@endsection
