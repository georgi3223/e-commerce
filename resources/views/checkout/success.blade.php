@extends('layouts.app')

@section('title', 'Order Successful - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/checkout/success.css') }}">
@endsection

@section('content')
<section>
    <h2>Order Placed Successfully!</h2>
    
    <div>
        <p>✓ Thank you for your order!</p>
        <p>Order ID: <strong>#{{ $order->id }}</strong></p>
        <p>Total: <strong>${{ number_format($order->total_price, 2) }}</strong></p>
        <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>
        <p>We'll send you an email confirmation shortly.</p>
    </div>

    <div>
        <h3>Order Details</h3>
        @foreach($order->orderItems as $item)
        <article>
            <p>{{ $item->product ? $item->product->name : 'Product Deleted' }}</p>
            <p>Quantity: {{ $item->quantity }}</p>
            <p>${{ number_format($item->price * $item->quantity, 2) }}</p>
        </article>
        @endforeach
    </div>

    <div>
        <a href="{{ route('orders.show', $order->id) }}">View Order Details</a>
        <a href="{{ route('products.index') }}">Continue Shopping</a>
        <a href="{{ route('orders.index') }}">View All Orders</a>
    </div>
</section>
@endsection