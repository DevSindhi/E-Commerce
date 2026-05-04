@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-3">Edit Product</h2>

<div class="container py-4">

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category" value="{{ old('category', $product->category) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Product Image (optional)</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-success mb-3">Update</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>

</form>

</div>

@endsection