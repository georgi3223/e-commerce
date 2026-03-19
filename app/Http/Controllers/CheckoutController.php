<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = $this->getCart();
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = $this->getTotal($cartItems);
        $addresses = auth()->user()->addresses;

        return view('checkout.index', compact('cartItems', 'total', 'addresses'));
    }

    public function store(StoreOrderRequest $request)
    {
        $cartItems = $this->getCart();

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        try {
            $order = DB::transaction(function () use ($request, $cartItems) {
                // Calculate total price
                $totalPrice = 0;
                foreach ($cartItems as $item) {
                    $totalPrice += $item['product']->price * $item['quantity'];
                }

                // Create order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'address_id' => $request->address_id,
                    'total_price' => $totalPrice,
                    'status' => 'pending',
                    'payment_method' => $request->payment_method,
                    'payment_status' => 'pending',
                    'notes' => $request->notes,
                ]);

                // Create order items and reduce stock
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product']->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['product']->price,
                    ]);

                    // Reduce product stock
                    $item['product']->decrement('stock', $item['quantity']);
                }

                return $order;
            });

            // Clear cart after successful order
            $this->clearCart();

            return redirect()
                ->route('checkout.success', $order->id)
                ->with('success', 'Order placed successfully');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function success($orderId)
    {
        $order = auth()->user()->orders()->findOrFail($orderId);
        
        return view('checkout.success', compact('order'));
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

    private function clearCart()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }
    }
}