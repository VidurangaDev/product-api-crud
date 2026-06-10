<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>

<h2>Create Product</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <label>Name:</label>
    <input type="text" name="name" required>
    <br><br>

    <label>Category:</label>
    <input type="text" name="category" required>
    <br><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" required>
    <br><br>

    <label>Rating:</label>
    <input type="number" step="0.1" min="0" max="5" name="rating">
    <br><br>

    <button type="submit">Save Product</button>
</form>

</body>
</html>
