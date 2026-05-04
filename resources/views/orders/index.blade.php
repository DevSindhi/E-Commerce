<x-app-layout>

<x-slot name="header">
    <h2 class="fw-bold">My Orders</h2>
</x-slot>

<div class="container py-4">

@if($orders->count() > 0)

    @foreach($orders as $order)

        <div class="card mb-4 shadow-sm">

            <div class="card-header bg-dark text-white">
                Order #{{ $order->order_number }} |
                Total: ₹{{ $order->total_amount }} |
                Status: {{ ucfirst($order->status) }}
            </div>

            <div class="card-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($order->items as $item)

                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>₹{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ $item->price * $item->quantity }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>

    @endforeach

@else

    <p>You have no orders yet 📦</p>

@endif

</div>

</x-app-layout>