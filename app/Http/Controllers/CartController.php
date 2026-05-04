<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show Cart Page
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    // Add to Cart
    public function add($productId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $product = Product::findOrFail($productId);

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        return back()->with('success', 'Added to cart!');
    }

    // Update quantity
    public function update(Request $request, $id)
    {
        Cart::findOrFail($id)->update([
            'quantity' => $request->quantity
        ]);

        return back();
    }

    // Remove item
    public function remove($id)
    {
        Cart::findOrFail($id)->delete();

        return back();
    }
}