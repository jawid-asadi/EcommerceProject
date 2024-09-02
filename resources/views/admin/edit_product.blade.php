
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="/public">
    @include('admin.css')

    <style>
        {{--  .div_center{
            text-align: center;
            padding-top: 40px;
        }  --}}
        .font_size{
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color{
            color: black;
            padding-bottom: 20px;
        }

        label{
            display: inline-block;
            width: 200px;:
        }

        .div_design{
            padding-bottom: 15px;
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

                <div class="div_center">
                    <h1 class="font_size">Add Product</h1>

                    <form action="{{ url('/update_product',$products->id) }}" method="POST" enctype="multipart/form-data" class="form">

                    @csrf
                    @method('PUT')
                    <div class="div_design" class="form-controll">
                        <label for="" class="form-label">Product Title: </label>
                        <input type="text" class="text_color form-control" name="title" value="{{ old('title', $products->title) }}"  placeholder="Write " required>
                    </div>

                    <div class="div_design" class="form-controll">
                        <label for="" class="form-label">Product Description: </label>
                        <input type="text" class="text_color form-control" value="{{ old('description', $products->description) }}" name="description" placeholder="Write " required>
                    </div>

                    <div class="div_design" class="form-controll">
                        <label for="" class="form-label">Product Quantity: </label>
                        <input type="number" min="0" class="text_color form-control" value="{{ old('quantity', $products->quantity) }}" name="quantity" placeholder="Write " required>
                    </div>

                    <div class="div_design" class="form-controll">
                        <label for="" class="form-label">Product Price: </label>
                        <input type="number" class="text_color form-control" value="{{ old('price', $products->price) }}" name="price" placeholder="Write " required>
                    </div>

                    <div class="div_design" class="form-controll">
                        <label for="" class="form-label">Discount Prise: </label>
                        <input type="number" class="text_color form-control" value="{{ old('discount_price', $products->discount_price) }}" name="discount_price" placeholder="Write ">
                    </div>

                    <div class="div_design" class="form-controll">
                        <label for="" class="form-label">Product Category: </label>
                       <select name="category" id="" class="text_color form-control" required>
                            <option value="{{  $products->category }}" >{{  $products->category }}</option>

                            @foreach ($category as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach

                       </select>
                    </div>

                    <div class="div_design" class="form-controll">
                        <label for="" class="form-label">Current Product Image: </label>
                        <img src="/product/{{ $products->image }}" height="100" width="100" alt="">
                    </div>

                    <div class="div_design" class="form-controll">
                        <label for="" class="form-label">Change Product Image: </label>
                        <input type="file" class="form-control" name="image" placeholder="Write ">
                    </div>

                    <div class="div_design" class="form-controll">

                        <input type="submit" value="Update" class="btn btn-warning">
                    </div>

                </form>

                </div>

            </div>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>

