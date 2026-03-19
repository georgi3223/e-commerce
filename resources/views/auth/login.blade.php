@extends('layouts.app')

@section('title', 'Login - E-Commerce Store')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<section class="login-section">
    <h2>Login</h2>

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group remember">
            <label>
                <input type="checkbox" name="remember">
                Remember Me
            </label>
        </div>

        <button type="submit" class="btn-login">Login</button>
    </form>

    <p class="register-link">
        Don't have an account?
        <a href="{{ route('register') }}">Register here</a>
    </p>
</section>
@endsection
