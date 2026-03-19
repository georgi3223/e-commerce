<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::where('role', 'user')->count(),
            'totalAdmins' => User::where('role', 'admin')->count(),
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'completedOrders' => Order::where('status', 'completed')->count(),
            'totalRevenue' => Order::where('status', 'completed')->sum('total_price'),
            'recentOrders' => Order::with(['user', 'orderItems.product'])
                ->latest()
                ->take(10)
                ->get(),
            'recentUsers' => User::where('role', 'user')
                ->latest()
                ->take(5)
                ->get(),
            'lowStockProducts' => Product::where('stock', '<', 10)
                ->where('stock', '>', 0)
                ->take(5)
                ->get(),
            'outOfStockProducts' => Product::where('stock', 0)->count(),
        ];

        return view('admin.dashboard', $data);
    }
}