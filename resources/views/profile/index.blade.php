@extends('layouts.app')

@section('title', 'My Profile - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile/index.css') }}">
@endsection

@section('content')
<section>
    <h2>My Profile</h2>
</section>

<section>
    <h3>Update Profile</h3>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
            @error('phone')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">New Password (leave blank to keep current):</label>
            <input type="password" id="password" name="password">
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit">Update Profile</button>
    </form>
</section>

<section>
    <h3>Quick Links</h3>
    <nav>
        <a href="{{ route('profile.addresses') }}">Manage Addresses</a>
        <a href="{{ route('orders.index') }}">My Orders</a>
    </nav>
</section>
@endsection