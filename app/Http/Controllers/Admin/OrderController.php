<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Make sure you have an Order model!
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show all orders
    public function index()
    {
        // Fetch all orders, ordering by newest first
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Update order status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully!');
    }

    // Delete an order
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted successfully!');
    }
}