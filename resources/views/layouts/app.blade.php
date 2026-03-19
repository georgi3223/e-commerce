<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce Store')</title>
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      @yield('styles')
</head>
<body>
    <header>
        <div>
            <h1>E-Commerce Store</h1>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('cart.index') }}">Cart</a>
                @auth
                    <a href="{{ route('profile.index') }}">Profile</a>
                    <a href="{{ route('orders.index') }}">My Orders</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div>
                <p>✓ {{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div>
                <p>✗ {{ session('error') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} E-Commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>