<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCart();
        $total = $this->getTotal($cartItems);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if (!$product->is_active) {
            return back()->with('error', 'This product is not available');
        }

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available');
        }

        if (Auth::check()) {
            // Add to database for authenticated users
            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($cart) {
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                ]);
            }
        } else {
            // Add to session for guests
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $request->quantity;
            } else {
                $cart[$product->id] = [
                    'product' => $product,
                    'quantity' => $request->quantity,
                ];
            }

            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product added to cart');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available');
        }

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($cart) {
                $cart->quantity = $request->quantity;
                $cart->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }
        }

        return back()->with('success', 'Cart updated');
    }

    public function remove(Product $product)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed from cart');
    }

    public function clear()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart.index')->with('success', 'Cart cleared');
    }

    // Helper methods
    private function getCart()
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->map(function ($cart) {
                    return [
                        'product' => $cart->product,
                        'quantity' => $cart->quantity,
                    ];
                })
                ->toArray();
        } else {
            $cartItems = session()->get('cart', []);
        }

        return $cartItems;
    }

    private function getTotal($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['product']->price * $item['quantity'];
        }

        return $total;
    }
}