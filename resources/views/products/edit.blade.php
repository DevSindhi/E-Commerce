<x-app-layout>

<x-slot name="header">
    <h2>Edit Product</h2>
</x-slot>

<div class="container py-4">

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
    @csrf
    @method('PUT')

    <label class="mb-1">Name</label>
    <input type="text" name="name" value="{{ $product->name }}" class="form-control mb-3">
    
    <label class="mb-1">Address</label>
    <textarea name="description" class="form-control mb-3">{{ $product->description }}</textarea>

    <label class="mb-1">Price</label>
    <input type="number" name="price" value="{{ $product->price }}" class="form-control mb-3">
    
    <label class="mb-1">Category</label>
    <input type="text" name="category" value="{{ $product->category }}" class="form-control mb-3">
    
    <label class="mb-1">Product Image</label>
    <input type="file" name="image" class="form-control mb-3">

    <button class="btn btn-success mb-2">Update</button>
    <a class="btn btn-secondary" href="{{ route('products.index') }}">Back</a>

</form>

</div>

</x-app-layout>