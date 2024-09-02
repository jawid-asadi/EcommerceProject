<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        label{
            display: inline-block;
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
                <h1 style="text-align: center; font-size: 25px;">Send Email to {{ $order->email }}</h1>
                <form action="{{ url('send_user_email', $order->id) }}" method="POST">
                    @csrf
                    <div class="" style="padding-left: 35%; padding-top: 30px; width: 70%;">
                        <label for="">Email Greeting:</label>
                        <input type="text" name="greeting" class="form-control text-dark">
                    </div>
                    <div class="" style="padding-left: 35%; padding-top: 30px; width: 70%;">
                        <label for="">Email FirstLine:</label>
                        <input type="text" name="firstline" class="form-control text-dark">
                    </div>
                    <div class="" style="padding-left: 35%; padding-top: 30px; width: 70%;">
                        <label for="">Email Body:</label>
                        <input type="text" name="body" class="form-control text-dark">
                    </div>
                    <div class="" style="padding-left: 35%; padding-top: 30px; width: 70%;">
                        <label for="">Email Button Name:</label>
                        <input type="text" name="button" class="form-control text-dark">
                    </div>
                    <div class="" style="padding-left: 35%; padding-top: 30px; width: 70%;">
                        <label for="">Email Url:</label>
                        <input type="text" name="url" class="form-control text-dark">
                    </div>
                    <div class="" style="padding-left: 35%; padding-top: 30px; width: 70%;">
                        <label for="">Email Last Line:</label>
                        <input type="text" name="lastline" class="form-control text-dark">
                    </div>

                    <div class="" style="padding-left: 35%; padding-top: 30px; width: 70%;">
                        <input type="submit" value="send email" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
