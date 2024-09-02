<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .center{
            margin: auto;
            width: 50%;
            {{--  border: 2px solid white;  --}}
            text-align: center;
            margin-top: 40px;
            font-size: 40px;
            font-weight: bold;

        }
        .header{
            background-color: paleturquoise;
        }

    </style>

  </head>
  <body>
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')

      <!-- partial -->
      @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
            <class="content-wrapper">
                <h1 class="center">All Orders</h1>

                <div class="pb-4" style="margin-left: 35%; padding-top:50px;">
                    <form action="{{ url('search') }}" method="get">
                        <input type="search" name="search" placeholder="Search order..." class="inline-block text-dark">

                        <input type="submit" value="search" class="btn btn-outline-primary inline-block" >
                    </form>
                </div>

                <table class="table-bordered table-striped" >
                    <tr class="header bg-primary">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Deliver</th>
                        <th>Print PDF</th>
                        <th>Email</th>

                    </tr>

                    @forelse ($order as $order)
                        <tr class="text-white">
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->product_title }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->delivery_status }}</td>
                            <td><img src="/product/{{ $order->image }}" alt=""></td>


                            <td>
                                @if($order->delivery_status == 'processing')
                                    <a href="{{ url('delivered', $order->id) }}" onclick="return confirm('Are you sure to delivered this product! ')"
                                        class="btn btn-primary">Delivered</a>
                                @else
                                    <p style='color:green'>Delivered</p>


                                @endif


                            </td>

                            <td>
                                <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary btn-sm">Print pdf</a>
                            </td>
                            <td>
                                <a href="{{ url('send_email', $order->id) }}" class="btn btn-info btn-sm">Send Email</a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                NO Data Found
                            </td>
                        </tr>
                    @endforelse


                </table>
            </div>
        </div>

        //if you want to generate four dives in one command
        {{--  .div$*4  --}}


    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
