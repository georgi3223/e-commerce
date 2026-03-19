<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $categories = Category::withCount('products')
            ->take(6)
            ->get();

        $newArrivals = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('featuredProducts', 'categories', 'newArrivals'));
    }
}