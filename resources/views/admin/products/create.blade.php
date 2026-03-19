@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
<header>
    <h2>Add New Product</h2>
</header>

<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf

    <label>
        Name:
        <input type="text" name="name" value="{{ old('name') }}" required>
    </label>
    <br>

    <label>
        Description:
        <textarea name="description" required>{{ old('description') }}</textarea>
    </label>
    <br>

    <label>
        Price:
        <input type="number" name="price" step="0.01" value="{{ old('price') }}" required>
    </label>
    <br>

    <label>
        Active:
        <input type="checkbox" name="is_active" {{ old('is_active') ? 'checked' : '' }}>
    </label>
    <br>

    <button type="submit">Create Product</button>
</form>
@endsection
