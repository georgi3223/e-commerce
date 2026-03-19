@extends('layouts.app')

@section('title', 'Checkout - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/checkout/index.css') }}">
@endsection

@section('content')
<section>
    <h2>Checkout</h2>
    <a href="{{ route('cart.index') }}">← Back to Cart</a>
</section>

<section>
    <div>
        <div>
            <h3>Order Summary</h3>
            @foreach($cartItems as $item)
            <article>
                <div>
                    <p>{{ $item['product']->name }}</p>
                    <p>Quantity: {{ $item['quantity'] }}</p>
                </div>
                <p>${{ number_format($item['product']->price * $item['quantity'], 2) }}</p>
            </article>
            @endforeach
            <div>
                <strong>Total:</strong>
                <strong>${{ number_format($total, 2) }}</strong>
            </div>
        </div>

        <div>
            <h3>Shipping & Payment</h3>
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf

                <div>
                    <h4>Select Shipping Address</h4>
                    @if($addresses->count() > 0)
                        @foreach($addresses as $address)
                        <div>
                            <label>
                                <input type="radio" name="address_id" value="{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }} required>
                                <strong>{{ $address->address_line1 }}</strong>
                                @if($address->address_line2)
                                    <p>{{ $address->address_line2 }}</p>
                                @endif
                                <p>{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</p>
                                <p>{{ $address->country }}</p>
                            </label>
                        </div>
                        @endforeach
                        <a href="{{ route('profile.addresses') }}">Add New Address</a>
                    @else
                        <p>You don't have any saved addresses.</p>
                        <a href="{{ route('profile.addresses') }}">Add Address</a>
                    @endif
                    @error('address_id')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <h4>Payment Method</h4>
                    <div>
                        <label>
                            <input type="radio" name="payment_method" value="cash" checked required>
                            Cash on Delivery
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="payment_method" value="card" required>
                            Credit/Debit Card
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="payment_method" value="paypal" required>
                            PayPal
                        </label>
                    </div>
                    @error('payment_method')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notes">Order Notes (optional):</label>
                    <textarea id="notes" name="notes" rows="4" placeholder="Special instructions...">{{ old('notes') }}</textarea>
                </div>

                <button type="submit">Place Order</button>
            </form>
        </div>
    </div>
</section>
@endsection