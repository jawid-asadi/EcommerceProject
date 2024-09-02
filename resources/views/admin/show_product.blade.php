
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .center{
            margin: auto;
            width: 50%;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;

        }
        .font_size{
            font-size: 40px;
            text-align: center;
            padding-top: 20px;
        }
        .image_size{
            width: 150px;
            height: 150px;
        }
        .th_color{
            background: skyblue;
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
            <div class="content-wrapper">

                @if(@session()->has('message'))
                    <div class="alert alert-success">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>

                        {{ session()->get('message') }}
                    </div>

                @endif

                <h1 class="font_size">All Products</h1>
                {{--     --}}
                <table class="center table table-bordered table-dark text-white">
                    <tr class="th_color">
                        <th>id</th>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr class="text-light">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>
                                <img src="/product/{{ $product->image }}" alt="" class="image_size square-image">
                            </td>
                            <td>
                                <a href="{{ url('delete_product', $product->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to Delete!')">
                                    Delete</a>
                            </td>
                            <td>
                                <a href="{{ url('edit_product', $product->id) }}" class="btn btn-success">
                                    Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>

