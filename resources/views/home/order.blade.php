<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />

      <style>
        th{
            background-color: paleturquoise;

        }
        .total{
            font-size: 30px;
            text-emphasis: bold;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')

        <div>
            <table class="table-striped table-bordered m-auto table-sm table-hover">
                <tr>
                    <th class="p-3">Product Title</th>
                    <th class="p-3">Quantity</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Payment Status</th>
                    <th class="p-3">Delivery Status</th>
                    <th class="p-3">Images</th>
                    <th class="p-3 ">Cancel</th>
                </tr>

                @foreach ($order as $order)
                    <tr>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td><img src="/product/{{ $order->image }}" alt="" width="60px"></td>

                        <td>
                            @if($order->delivery_status == 'processing')
                                <a href="{{ url('cancel_order', $order->id) }}" onclick="return confirm('are you sure to cancel the order!')" class="btn btn-danger btn-sm ">cancel order</a>

                            @elseif($order->delivery_status == 'delivered')
                                <p style="color:red">Not Allowed!</p>

                            @else
                                <p>canceled</p>
                            @endif
                        </td>
                    </tr>

                @endforeach

            </table>
        </div>


      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>

