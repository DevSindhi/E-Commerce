<x-app-layout>

<x-slot name="header">
    <h2 class="fw-bold">Home</h2>
</x-slot>

<style>
   .product-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .product-img {
        height: 220px;
        object-fit: cover;
        width: 100%;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .card-body p {
        flex-grow: 1;
    }

    .carousel-item img {
        height: 400px;
        object-fit: cover;
    }

    .carousel-caption {
        position: absolute;
        bottom: 0px;
        left: 50px;
        right: auto;
        transform: none;

        background: rgba(0, 0, 0, 0.5);
        padding: 12px 20px;
        border-radius: 8px;

        width: fit-content;
        max-width: 500px;
    }
    .features{
        background-color:
    }
</style>

<div class="container py-4">

    <!-- CAROUSEL -->
    <div id="mainCarousel" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel">

    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
    </div>

    <div class="carousel-inner rounded">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100">

            <div class="carousel-caption d-flex flex-column justify-content-center align-items-start h-100 text-start">
                <h1 class="fw-bold text-white">Welcome to MyShop</h1>
                <p class="text-white">Discover amazing products</p>
                <a href="{{ route('products.index') }}" class="btn btn-light mt-2">
                    Shop Now
                </a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="{{ asset('images/banner2.jpg') }}" class="d-block w-100">

            <div class="carousel-caption d-flex flex-column justify-content-center align-items-start h-100 text-start">
                <h1 class="fw-bold text-white">Latest Products</h1>
                <p class="text-white">Explore new arrivals</p>
                <a href="{{ route('products.index') }}" class="btn btn-warning mt-2"> Browse </a>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button> -->

</div>

    <!-- FEATURED PRODUCTS -->
    <h3 class="mb-4">Featured Products</h3>

    <div class="row">
        @foreach(\App\Models\Product::latest()->take(6)->get() as $product)
            <div class="col-lg-4 col-md-6 d-flex mb-4">
                <div class="card product-card shadow-sm w-100">

                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="product-img">
                    @endif

                    <div class="card-body">

                        <h5>{{ $product->name }}</h5>

                        <p class="text-muted small">
                            {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                        </p>

                        <p class="price">₹{{ $product->price }}</p>

                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm mt-auto">
                            View More
                        </a>

                    </div>

                </div>
            </div>
        @endforeach
    </div>

    <!-- FEATURES SECTION -->
    <div class="row text-center" style="margin:8% 0;">

        <div class="col-md-4">
            <div class="features">
                <h4>🚚 Fast Delivery</h4>
                <p class="text-muted">Get your orders delivered quickly.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="features">
                <h4>💳 Secure Payment</h4>
                <p class="text-muted">Multiple safe payment options.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="features">
                <h4>📦 Easy Returns</h4>
                <p class="text-muted">Hassle-free return policy.</p>
            </div>
        </div>

    </div>

    <!-- CALL TO ACTION -->
    <div class="text-center mt-5">
        <h4>Start Shopping Now!</h4>
        <a href="{{ route('products.index') }}" class="btn btn-success mt-2">
            Shop Now
        </a>
    </div>

</div>

</x-app-layout>