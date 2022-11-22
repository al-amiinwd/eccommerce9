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
      <link rel="shortcut icon" href="{{url('home/images/favicon.png')}}" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{url('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{url('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{url('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{url('home/css/responsive.css')}}" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>

    @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
         @include('frontend.layouts.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('frontend.layouts.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('frontend.layouts.whysection')
      <!-- end why section -->

      <!-- arrival section -->
      @include('frontend.layouts.arrival')
      <!-- end arrival section -->

      <!-- product section -->
      @include('frontend.layouts.product_view')
      <!-- end product section -->

      {{-- coments section --}}
      <div style="padding-bottom:30px; text-align:center;" >
        <h1 style="padding-bottom: 20px; padding-top:20px; text-align:center; font-size:40px; color:#f7444e;">Comments</h1>
        <form action="{{url('add_comment')}}" method="POST">
            @csrf
        <textarea  placeholder="Write something" style="width: 600px; height:100px;" name="comment">
        </textarea>
        <br>
        <input type="submit" class="btn btn-primary" value="Comment">

        </form>
      </div>
      <div style="padding-left:25%;">
        <h1 style="font-size:20px; padding-bottom: 10px;">All Comments</h1>

        @foreach ($comments as $comment)
        <div>
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <a style="color: cornflowerblue" href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>


            <div style="padding-bottom:10px; padding-left:3%;">
                @foreach ($reply as $rep)
                @if ($rep->comment_id==$comment->id)
                <b>{{$rep->name}}</b>
                <p>{{$rep->reply}}</p>
                <a style="color: cornflowerblue" href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
                @endif
                @endforeach
            </div>

        </div>
        @endforeach

        {{-- reply text box --}}

        <div style="display: none;" class="replyDiv">
            <form action="{{url('reply_comment')}}" method="POST">
                @csrf
            <input type="text" id="commentId" name="commentId"  hidden="">
            <textarea style="width: 300px; height:20px;" placeholder="write somthing" name="reply" ></textarea>
            <br>
            <button style="color: cornflowerblue"  class="btn btn-warning btn-sm" type="submit">Reply</button>

            <a style="color: rgb(243, 39, 39)" class="btn btn-sm" href="javascript::void(0);" onclick="reply_close(this)">Close</a>
        </form>

        </div>
      </div>
      {{-- coments section end --}}

      <!-- subscribe section -->
      @include('frontend.layouts.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('frontend.layouts.client')
      <!-- end client section -->
      <!-- footer start -->
      @include('frontend.layouts.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>

      <script type="text/javascript">
        function reply(caller)
        {
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
        }
        function reply_close(caller)
        {
            $('.replyDiv').hide();
        }
      </script>



      <!-- jQery -->
      <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
        </script>
      <script src="{{url('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{url('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{url('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{url('home/js/custom.js')}}"></script>
   </body>
</html>
