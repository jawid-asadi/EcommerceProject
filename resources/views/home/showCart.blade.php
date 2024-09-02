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
      <link rel="shortcut icon" href="{{asset('home/images/favicon.png')}}" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
    @include('sweetalert::alert')
      <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')


         <!-- end header section -->
         <div class="">
            <h1 class="total m-auto text-center">Cart Page</h1>

                 @if(@session()->has('message'))
                    <div class="alert alert-success">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>

                        {{ session()->get('message') }}
                    </div>

                @endif
         </div>






        <div class="">
            @if(isset($cart) && $cart->count() > 0)
            <table class="table table-bordered">
                <tr>

                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                <?php $totalprice = 0; ?>
                    @foreach ($cart as $cart)
                        <tr>

                            <td>{{ $cart->product_title }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->price }}</td>
                            <td><img src="/product/{{ $cart->image }}" alt="" width="50px" height="50px"></td>
                            <td><a href="{{ url('remove_cart', $cart->id) }}" class="btn btn-danger" onclick="confirmation(event)">
                                Remove</a></td>

                        </tr>

                    <?php $totalprice = $totalprice + $cart->price; ?>
                     @endforeach
                     <h1 class="total">Total Price : {{ $totalprice }}</h1>

                     <div class="font-size">
                        <h1 class="total">Proceed to Ordery</h1>
                        <a href="{{ url('cash_order') }}" class="btn btn-danger">Cache On Delivery</a>
                        <a href="{{ url('stripe',$totalprice) }}" class="btn btn-warning">Pay Using Card</a>
                    </div>
                @else
                    <p class="alert alert-warning">Your cart is empty<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button></p>

                @endif



            </table>
        </div>









      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>

      <script>
        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                title: "Are you sure to cancel the product",
                text: "Your product will be removed from cart.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if(willCancel){

                    window.location.href = urlToRedirect;
                }
            });

        }
      </script>
      <!-- jQery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>

