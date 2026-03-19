@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<section>
    <div>
        <h2>Manage Orders</h2>
        <p>Total: {{ $orders->total() }} orders</p>
    </div>
    
    <form method="GET" action="{{ route('admin.orders.index') }}">
        <div>
            <div>
                <label for="search">Search</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Order ID, Name, Email">
            </div>

            <div>
                <label for="status">Filter by Status</label>
                <select id="status" name="status">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div>
                <button type="submit">Apply Filters</button>
                <a href="{{ route('admin.orders.index') }}">Clear All</a>
            </div>
        </div>
    </form>
</section>

<section>
    @if($orders->count() > 0)
        <div>
            @foreach($orders as $order)
            <article>
                <div>
                    <div>
                        <h3>Order #{{ $order->id }}</h3>
                        <span>{{ $order->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div>
                        <span>{{ ucfirst($order->status) }}</span>
                        <span>{{ ucfirst($order->payment_status) }}</span>
                    </div>
                </div>

                <div>
                    <div>
                        <h4>Customer</h4>
                        <p>{{ $order->user->name ?? 'Guest' }}</p>
                        <p>{{ $order->user->email ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h4>Order Details</h4>
                        <p>Items: {{ $order->orderItems->count() }}</p>
                        <p>Total: ${{ number_format($order->total_price, 2) }}</p>
                    </div>

                    <div>
                        <h4>Actions</h4>
                        <a href="{{ route('admin.orders.show', $order->id) }}">View Details</a>
                        @if($order->status == 'cancelled')
                            <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this order permanently?')">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div>
            {{ $orders->links() }}
        </div>
    @else
        <div>
            <p>No orders found</p>
            <p>Try adjusting your filters or search query</p>
        </div>
    @endif
</section>
@endsection