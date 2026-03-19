@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<section>
    <div>
        <div>
            <a href="{{ route('admin.orders.index') }}">← Back to Orders</a>
            <h2>Order #{{ $order->id }}</h2>
        </div>
        <div>
            <span>{{ ucfirst($order->status) }}</span>
            <span>{{ ucfirst($order->payment_status) }}</span>
        </div>
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
            </div>
        </article>

        <article>
            <h3>Customer Information</h3>
            @if($order->user)
                <div>
                    <div>
                        <strong>Name:</strong>
                        <span>{{ $order->user->name }}</span>
                    </div>
                    <div>
                        <strong>Email:</strong>
                        <span>{{ $order->user->email }}</span>
                    </div>
                    <div>
                        <strong>Phone:</strong>
                        <span>{{ $order->user->phone ?? 'N/A' }}</span>
                    </div>
                </div>
            @else
                <p>Guest User</p>
            @endif
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
                <p>No shipping address provided</p>
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
                    <h4>
                        @if($item->product)
                            {{ $item->product->name }}
                        @else
                            Product Deleted
                        @endif
                    </h4>
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

<section>
    <h3>Update Order Status</h3>
    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
        @csrf
        @method('PATCH')
        
        <div>
            <label for="status">Change Status</label>
            <select id="status" name="status">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit">Update Status</button>
        </div>
    </form>
</section>

@if($order->status == 'cancelled')
<section>
    <h3>Danger Zone</h3>
    <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}">
        @csrf
        @method('DELETE')
        <p>This order is cancelled and can be permanently deleted.</p>
        <button type="submit" onclick="return confirm('Delete this order permanently? This action cannot be undone.')">Delete Order Permanently</button>
    </form>
</section>
@endif
@endsection