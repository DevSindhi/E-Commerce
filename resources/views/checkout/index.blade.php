<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold">Checkout</h2>
    </x-slot>

    <div class="container py-4">

        @if($cartItems->isEmpty())
            <div class="alert alert-warning text-center">
                <p class="mb-0">Your cart is empty 🛒</p>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Return to Shop
                </a>
            </div>
        @else

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            
                            <td class="text-center">₹{{ number_format($item->product->price, 2) }}</td>
                            
                            <td class="text-center">{{ $item->quantity }}</td>
                            
                            <td class="text-end">₹{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="text-center mt-4">Grand Total: ₹{{ number_format($grandTotal, 2) }}</h4>

            <div class="text-center mt-4">
                <form action="{{ route('place.order') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success px-5 py-2 fw-bold">
                        Confirm & Place Order
                    </button>
                </form>
            </div>

        @endif

    </div>

</x-app-layout>