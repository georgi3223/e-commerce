@extends('layouts.app')

@section('title', 'My Orders - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/orders/index.css') }}">
@endsection

@section('content')
<section>
    <h2>My Orders</h2>
</section>

<section>
    @if($orders->count() > 0)
        <div>
            @foreach($orders as $order)
            <article>
                <div>
                    <div>
                        <h3>Order #{{ $order->id }}</h3>
                        <p>{{ $order->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <span>{{ ucfirst($order->status) }}</span>
                        <span>{{ ucfirst($order->payment_status) }}</span>
                    </div>
                </div>

                <div>
                    <div>
                        <h4>Items</h4>
                        @foreach($order->orderItems as $item)
                        <p>{{ $item->product ? $item->product->name : 'Product Deleted' }} × {{ $item->quantity }}</p>
                        @endforeach
                    </div>

                    <div>
                        <h4>Total</h4>
                        <p><strong>${{ number_format($order->total_price, 2) }}</strong></p>
                    </div>

                    <div>
                        <h4>Payment</h4>
                        <p>{{ ucfirst($order->payment_method) }}</p>
                    </div>
                </div>

                <div>
                    <a href="{{ route('orders.show', $order->id) }}">View Details</a>
                    @if($order->canBeCancelled())
                        <form method="POST" action="{{ route('orders.cancel', $order->id) }}" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" onclick="return confirm('Cancel this order?')">Cancel Order</button>
                        </form>
                    @endif
                </div>
            </article>
            @endforeach
        </div>

        <div>
            {{ $orders->links() }}
        </div>
    @else
        <div>
            <p>You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}">Start Shopping</a>
        </div>
    @endif
</section>
@endsection