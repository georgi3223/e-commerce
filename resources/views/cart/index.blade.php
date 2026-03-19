@extends('layouts.app')

@section('title', 'Shopping Cart - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cart/index.css') }}">
@endsection

@section('content')
<section class="cart-section">
    <h2>Shopping Cart</h2>

    @if(!empty($cartItems) && count($cartItems) > 0)

        <div class="cart-items">
            @foreach($cartItems as $item)
            <article class="cart-item">

                <div class="cart-image">
                    @if($item['product']->image)
                        <img src="{{ asset('storage/products/' . $item['product']->image) }}"
                             alt="{{ $item['product']->name }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="No image">
                    @endif
                </div>

                <div class="cart-info">
                    <h3>{{ $item['product']->name }}</h3>
                    <p class="price">${{ number_format($item['product']->price, 2) }}</p>
                </div>

                <div class="cart-quantity">
                    <form method="POST" action="{{ route('cart.update', $item['product']->id) }}">
                        @csrf
                        @method('PATCH')
                        <label for="quantity_{{ $item['product']->id }}">Qty</label>
                        <input type="number"
                               id="quantity_{{ $item['product']->id }}"
                               name="quantity"
                               value="{{ $item['quantity'] }}"
                               min="1"
                               max="{{ $item['product']->stock }}">
                        <button type="submit" class="btn-update">Update</button>
                    </form>
                </div>

                <div class="cart-total">
                    <strong>
                        ${{ number_format($item['product']->price * $item['quantity'], 2) }}
                    </strong>
                </div>

                <div class="cart-remove">
                    <form method="POST" action="{{ route('cart.remove', $item['product']->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove">Remove</button>
                    </form>
                </div>

            </article>
            @endforeach
        </div>

        <div class="cart-summary">
            <h3>Cart Summary</h3>
            <p>Total: <strong>${{ number_format($total, 2) }}</strong></p>

            <div class="cart-actions">
                <a href="{{ route('products.index') }}" class="btn-secondary">
                    Continue Shopping
                </a>

                @auth
                    <a href="{{ route('checkout.index') }}" class="btn-primary">
                        Proceed to Checkout
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">
                        Login to Checkout
                    </a>
                @endauth
            </div>

            <form method="POST" action="{{ route('cart.clear') }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn-clear"
                        onclick="return confirm('Clear entire cart?')">
                    Clear Cart
                </button>
            </form>
        </div>

    @else
        <div class="cart-empty">
            <p>Your cart is empty</p>
            <a href="{{ route('products.index') }}" class="btn-primary">
                Browse Products
            </a>
        </div>
    @endif
</section>
@endsection
