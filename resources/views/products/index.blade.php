<x-app-layout>

<x-slot name="header">
    <h2 class="fw-bold">Products</h2>
</x-slot>

<style>
    .product-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .product-img {
        height: 220px;
        object-fit: cover;
    }

    .price {
        font-size: 18px;
        font-weight: bold;
        color: #28a745;
    }

    .category {
        font-size: 14px;
        color: gray;
    }
</style>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Products</h2>
        @auth
        <a href="{{ route('products.create') }}" class="btn btn-dark">+ Add Product</a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-md-4">

                <div class="card product-card shadow-sm">

                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top product-img">
                    @endif

                    <div class="card-body">

                        <h5 class="fw-bold">{{ $product->name }}</h5>

                        <p class="text-muted small">
                            {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                        </p>

                        <p class="price">₹{{ $product->price }}</p>

                        <p class="category">{{ $product->category }}</p>

                        <div class="d-flex gap-2">
                            <!-- ADD TO CART (VISIBLE TO ALL) -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm">
                                    🛒 Add to Cart
                                </button>
                            </form>

                            <!-- ONLY FOR LOGGED-IN USERS -->
                            @auth
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

</x-app-layout>