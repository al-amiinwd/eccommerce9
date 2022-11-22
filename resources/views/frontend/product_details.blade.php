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
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('frontend.layouts.header')
         <!-- end header section -->

      <div class="col-sm-6 col-md-4 col-lg-4"  style="margin: auto; width:50% padding:px;">
        <div class="box">
           <div class="img-box">
               <img src="/product/{{$product->image}}" alt="">
           </div>
           <div class="detail-box">
              <h5>
                 {{$product->title}}
              </h5>

              @if($product->discount_price!=null)
              <h6 style="color: red">
               Discount Price
               <br>
               &#2547;{{$product->discount_price}}
              </h6>
              <h6 style="text-decoration: line-through; color: blue" >
               Price
               &#2547;{{$product->price}}
              </h6>
              @else
              <h6 style="color: blue">
               Price
               <br>
               &#2547;{{$product->price}}
              </h6>
              @endif
              <h6 style="font-style: italic">Product Details : {{$product->description}} </h6>
              <h6 style="font-style: italic">Product Category : {{$product->category}} </h6>
              <h6 style="font-style: italic">Available Quantity: {{$product->quantity}} </h6>

              <form action="{{url('add_cart',$product->id)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="number" value="1" min="1" name="quantity" style="width: 100px; height:52px">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Add to cart">
                    </div>
                </div>
              </form>

           </div>
        </div>

     </div>


      <!-- footer start -->
      @include('frontend.layouts.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>
      <!-- jQery -->
      <script src="{{url('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{url('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{url('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{url('home/js/custom.js')}}"></script>
   </body>
</html>
