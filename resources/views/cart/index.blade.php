<x-app-layout>

<x-slot name="header">
    <h2 class="fw-bold">My Cart</h2>
</x-slot>

<div class="container py-4">

@if($cartItems->count() > 0)

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    @php $grandTotal = 0; @endphp

    @foreach($cartItems as $item)

        @php
            $total = $item->price * $item->quantity;
            $grandTotal += $total;
        @endphp

        <tr>
            <td>{{ $item->product->name }}</td>

            <td>₹{{ $item->price }}</td>

            <td>
                <!-- UPDATE FORM -->
                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control w-50 me-2">
                    <button class="btn btn-primary btn-sm">Update</button>
                </form>
            </td>

            <td>₹{{ $total }}</td>

            <td>
                <!-- REMOVE FORM -->
                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">Remove</button>
                </form>
            </td>
        </tr>

    @endforeach

    </tbody>
</table>

<h4 class="text-center">Grand Total: ₹{{ $grandTotal }}</h4>
<div class="text-center mt-3">
    <a href="{{ route('checkout.index') }}" class="btn btn-success">
        Proceed to Checkout
    </a>
</div>
@else

<p>Your cart is empty 🛒</p>

@endif

</div>

</x-app-layout>