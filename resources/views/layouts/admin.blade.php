<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/layouts/admin.css') }}">
</head>
<body>

    <!-- Admin Navbar -->
    <header>
        <div>
            <h1>Admin Panel</h1>
            <p>Manage your shop efficiently</p>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main Admin Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div>
            <p>&copy; {{ date('Y') }} Admin Panel</p>
            <p>Manage products, orders, and users from here</p>
        </div>
    </footer>

</body>
</html>
