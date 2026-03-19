<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <p>Welcome, {{ auth()->user()->name }}</p>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}">Products</a>
            <a href="{{ route('admin.orders.index') }}">Orders</a>
            <a href="{{ route('admin.users.index') }}">Users</a>
            <a href="{{ route('logout') }}">Logout</a>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div>
                <p><strong>Success:</strong> {{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div>
                <p><strong>Error:</strong> {{ session('error') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Admin Panel. All rights reserved.</p>
    </footer>
</body>
</html>