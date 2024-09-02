<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
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
   </head>
   <body>
      <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->


      <!-- product section -->
      @include('home.product_view')
      <!-- end product section -->

      <!--comment and reply system start here-->

      <div class="" style="padding-bottom: 20px;">
        <h1 style="font-size:30px; padding-top:20px; text-align:center; padding-bottom:20px;">Comments</h1>

        <form action="{{ url('/add_comment') }}" method="POST">
            @csrf
            <textarea placeholder="Comments something here..." class="form-control" name="comment" cols="8" rows="9" style="width:600px; height: 150px; margin:auto;"></textarea>

            <input type="submit" value="send Comment" style="margin-top: 10px;">
        </form>
      </div>

      <div class="" style="padding-left: 20%;">
        <h1 style="font-size: 20px; padding-bottom: 20px;">All Comments</h1>

        @foreach($comments as $comments)
            <div style="padding-bottom: 10px;">
                <!--  <img src="{{ $comment->user->profile_image ?? '/default.jpg' }}" alt="User image">  -->
                <b>{{ $comments->name }}</b>
                <p>{{ $comments->comment }}</p>
                <a href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{ $comments->id }}">Reply</a>

                @foreach ($reply as $rep)

                @if($rep->comment_id==$comments->id)
                    <div class="" style="padding-left: 3%; padding-top: 10px; padding-bottom: 10px;">

                        <b>{{ $rep->name }}</b>
                        <p>{{ $rep->reply }}</p>
                        <a href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{ $comments->id }}">Reply</a>

                    </div>
                @endif
                @endforeach

            </div>
        @endforeach



        <div class="replyDiv" style="display: none;">

            <form action="{{ url('add_reply') }}" method="POST">

                @csrf
                <input type="text" name="CommentId" id="CommentId" hidden>
                <textarea style="height: 60px; width: 500px;" name="reply" placeholder="write somthing here to reply" class=""></textarea>
                <br>
                <button type="submit" class="btn btn-primary">Reply</button>
                <a href="javascript::void(0);" class="btn btn-info" onclick="reply_close(this)">close</a>

            </form>
        </div>
      </div>



      <!--comment and reply system end here-->


      <!-- end client section -->

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>


      <!-- custome javaScript-->

        <script>
            function reply(caller){

                document.getElementById('CommentId').value = $(caller).attr('data-Commentid');
                $('.replyDiv').insertAfter($(caller));
                $('.replyDiv').show();
            }

            function reply_close(caller){
                $('.replyDiv').hide();
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                var scrollpos = localStorage.getItem('scrollpos');
                if (scrollpos) window.scrollTo(0, scrollpos);
            });

            window.onbeforeunload = function(e) {
                localStorage.setItem('scrollpos', window.scrollY);
            };
        </script>
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

