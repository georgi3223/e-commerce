@extends('layouts.app')

@section('title', 'Order Details - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/orders/show.css') }}">
@endsection

@section('content')
<section>
    <div>
        <a href="{{ route('orders.index') }}">← Back to Orders</a>
        <h2>Order #{{ $order->id }}</h2>
    </div>
    <div>
        <span>{{ ucfirst($order->status) }}</span>
        <span>{{ ucfirst($order->payment_status) }}</span>
    </div>
</section>

<section>
    <div>
        <article>
            <h3>Order Information</h3>
            <div>
                <div>
                    <strong>Order Date:</strong>
                    <span>{{ $order->created_at->format('F d, Y H:i:s') }}</span>
                </div>
                <div>
                    <strong>Payment Method:</strong>
                    <span>{{ ucfirst($order->payment_method) }}</span>
                </div>
                <div>
                    <strong>Total Amount:</strong>
                    <span>${{ number_format($order->total_price, 2) }}</span>
                </div>
                @if($order->notes)
                <div>
                    <strong>Order Notes:</strong>
                    <span>{{ $order->notes }}</span>
                </div>
                @endif
            </div>
        </article>

        <article>
            <h3>Shipping Address</h3>
            @if($order->address)
                <address>
                    {{ $order->address->address_line1 }}<br>
                    @if($order->address->address_line2)
                        {{ $order->address->address_line2 }}<br>
                    @endif
                    {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->postal_code }}<br>
                    {{ $order->address->country }}
                </address>
            @else
                <p>No shipping address</p>
            @endif
        </article>
    </div>
</section>

<section>
    <h3>Order Items</h3>
    <div>
        @foreach($order->orderItems as $item)
        <article>
            <div>
                <div>
                    <h4>{{ $item->product ? $item->product->name : 'Product Deleted' }}</h4>
                    <p>${{ number_format($item->price, 2) }} × {{ $item->quantity }}</p>
                </div>
                <div>
                    <strong>${{ number_format($item->price * $item->quantity, 2) }}</strong>
                </div>
            </div>
        </article>
        @endforeach
    </div>
    
    <div>
        <div>
            <strong>Total:</strong>
            <strong>${{ number_format($order->total_price, 2) }}</strong>
        </div>
    </div>
</section>

@if($order->canBeCancelled())
<section>
    <h3>Actions</h3>
    <form method="POST" action="{{ route('orders.cancel', $order->id) }}">
        @csrf
        @method('PATCH')
        <p>You can cancel this order if you change your mind.</p>
        <button type="submit" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>
    </form>
</section>
@endif
@endsection