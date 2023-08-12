<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cart</h1>
    <table class="cart-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <td>{{ $cart->product_name }}</td>
                <td><img src="{{ $cart->image }}" alt="{{ $cart->product_name }}" width="50"></td>
                <td>{{ $cart->product_name }}</td>
                <td>{{ $cart->price }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>{{ $cart->price * $cart->quantity }}</td>
                <td>
                    <form action="{{ route('cart.delete', ['id' => $cart->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>