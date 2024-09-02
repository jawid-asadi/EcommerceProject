<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
</head>
<body>
    <h1 class="bg-primary">Order Details</h1>

    Customer Name:<P>{{ $order->name }}</P>
    Customer Email:<P>{{ $order->email }}</P>
    Customer Phone:<P>{{ $order->phone }}</P>
    Customer Address:<P>{{ $order->address }}</P>
    Customer ID:<P>{{ $order->user_id }}</P>

    Product Name:<P>{{ $order->product_title }}</P>
    Product Price:<P>{{ $order->price }}</P>
    Product Quantity:<P>{{ $order->quantity }}</P>
    Product Payment_status:<P>{{ $order->payment_status }}</P>
    Product ID:<P>{{ $order->product_id }}</P>
    Product Image:<img src="product/{{ $order->image }}" width="200px">
</body>
</html>
