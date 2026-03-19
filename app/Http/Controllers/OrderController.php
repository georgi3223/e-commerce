<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['orderItems.product'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = auth()->user()->orders()
            ->with(['orderItems.product', 'address'])
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);

        // Only allow cancellation if order is pending
        if ($order->status !== 'pending') {
            return back()->with('error', 'This order cannot be cancelled');
        }

        $order->update(['status' => 'cancelled']);

        // Restore product stock
        foreach ($order->orderItems as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        return back()->with('success', 'Order cancelled successfully');
    }
}