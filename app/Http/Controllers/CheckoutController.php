<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Show Checkout Page
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // 1. Calculate the grand total
        $grandTotal = 0;
        foreach ($cartItems as $item) {
            $grandTotal += $item->product->price * $item->quantity;
        }

        // 2. Pass BOTH variables to the view using compact()
        return view('checkout.index', compact('cartItems', 'grandTotal'));
    }

    // Place Order
    public function placeOrder()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        DB::beginTransaction();

        try {
            // calculate total
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->price * $item->quantity;
            }

            // create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => time() . rand(100, 999),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'shipping_address' => 'Default Address'
            ]);

            // insert order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
            }

            // clear cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', 'Something went wrong!');
        }
    }

    public function orders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
}