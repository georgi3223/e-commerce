<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::where('slug', 'electronics')->first();
        $clothing = Category::where('slug', 'clothing')->first();
        $books = Category::where('slug', 'books')->first();
        $homeGarden = Category::where('slug', 'home-garden')->first();

        $products = [
            // Electronics (5 products)
            [
                'category_id' => $electronics->id,
                'name' => 'Wireless Headphones',
                'slug' => 'wireless-headphones',
                'description' => 'High-quality wireless headphones with noise cancellation.',
                'price' => 79.99,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'Smart Watch',
                'slug' => 'smart-watch',
                'description' => 'Fitness tracker with heart rate monitor and GPS.',
                'price' => 199.99,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'USB-C Charger',
                'slug' => 'usb-c-charger',
                'description' => '65W fast charging adapter for all devices.',
                'price' => 29.99,
                'stock' => 100,
                'is_active' => true,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'Wireless Mouse',
                'slug' => 'wireless-mouse',
                'description' => 'Ergonomic wireless mouse with long battery life.',
                'price' => 24.99,
                'stock' => 75,
                'is_active' => true,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'Bluetooth Speaker',
                'slug' => 'bluetooth-speaker',
                'description' => 'Portable waterproof speaker with 12-hour battery.',
                'price' => 44.99,
                'stock' => 60,
                'is_active' => true,
            ],

            // Clothing (5 products)
            [
                'category_id' => $clothing->id,
                'name' => 'Cotton T-Shirt',
                'slug' => 'cotton-t-shirt',
                'description' => 'Comfortable cotton t-shirt in multiple colors.',
                'price' => 19.99,
                'stock' => 150,
                'is_active' => true,
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Slim Fit Jeans',
                'slug' => 'slim-fit-jeans',
                'description' => 'Premium denim jeans with modern fit.',
                'price' => 59.99,
                'stock' => 80,
                'is_active' => true,
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Winter Jacket',
                'slug' => 'winter-jacket',
                'description' => 'Warm waterproof jacket with insulation.',
                'price' => 129.99,
                'stock' => 40,
                'is_active' => true,
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Running Shoes',
                'slug' => 'running-shoes',
                'description' => 'Lightweight running shoes with cushioning.',
                'price' => 79.99,
                'stock' => 60,
                'is_active' => true,
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Hoodie',
                'slug' => 'hoodie',
                'description' => 'Comfortable cotton blend hoodie.',
                'price' => 39.99,
                'stock' => 100,
                'is_active' => true,
            ],

            // Books (4 products)
            [
                'category_id' => $books->id,
                'name' => 'Programming Guide',
                'slug' => 'programming-guide',
                'description' => 'Learn modern programming practices.',
                'price' => 49.99,
                'stock' => 35,
                'is_active' => true,
            ],
            [
                'category_id' => $books->id,
                'name' => 'Mystery Novel',
                'slug' => 'mystery-novel',
                'description' => 'Bestselling mystery thriller.',
                'price' => 24.99,
                'stock' => 55,
                'is_active' => true,
            ],
            [
                'category_id' => $books->id,
                'name' => 'Cooking Book',
                'slug' => 'cooking-book',
                'description' => 'Over 200 delicious recipes.',
                'price' => 34.99,
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'category_id' => $books->id,
                'name' => 'Self-Help Guide',
                'slug' => 'self-help-guide',
                'description' => 'Transform your life with practical strategies.',
                'price' => 19.99,
                'stock' => 60,
                'is_active' => true,
            ],

            // Home & Garden (4 products)
            [
                'category_id' => $homeGarden->id,
                'name' => 'LED Desk Lamp',
                'slug' => 'led-desk-lamp',
                'description' => 'Adjustable LED lamp with USB port.',
                'price' => 34.99,
                'stock' => 65,
                'is_active' => true,
            ],
            [
                'category_id' => $homeGarden->id,
                'name' => 'Plant Pot Set',
                'slug' => 'plant-pot-set',
                'description' => 'Set of 3 ceramic pots with saucers.',
                'price' => 24.99,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'category_id' => $homeGarden->id,
                'name' => 'Kitchen Knife Set',
                'slug' => 'kitchen-knife-set',
                'description' => '8-piece stainless steel knife set.',
                'price' => 89.99,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'category_id' => $homeGarden->id,
                'name' => 'Throw Pillows',
                'slug' => 'throw-pillows',
                'description' => 'Set of 4 decorative pillows.',
                'price' => 39.99,
                'stock' => 55,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}