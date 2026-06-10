<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<h2>Edit Product</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $product->name }}" required>
    <br><br>

    <label>Category:</label>
    <input type="text" name="category" value="{{ $product->category }}" required>
    <br><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>
    <br><br>

    <label>Rating:</label>
    <input type="number" step="0.1" min="0" max="5" name="rating" value="{{ $product->rating }}">
    <br><br>

    <button type="submit">Update Product</button>
</form>

<br>

<a href="{{ route('products.index') }}">⬅ Back</a>

</body>
</html>
