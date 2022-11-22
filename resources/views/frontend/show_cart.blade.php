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

      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <style class="text/css">
    .center{
        margin: auto;
        width: 50%;
        text-align: center;
        padding: 30px;


    }
    table,th,td{
        border: 2px solid grey;

    }
    .dg{
        font-size: 20px;
        padding: 5px;
        background: skyblue;
    }
      </style>
   </head>
   <body>
    @include('sweetalert::alert')
      <div class="hero_area">
         <!-- header section strats -->
         @include('frontend.layouts.header')
         <!-- end header section -->

         {{-- @if(session('message'))
         <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" area-label="close">×</a>
            <h2>{{session()->get('message')}}</h2>
         </div>
         @endif --}}

      <div class="center">
        <table>
            <tr>
                <th class="dg">Produc Title</th>
                <th class="dg">Product Quantity</th>
                <th class="dg">Price</th>
                <th class="dg">Image</th>
                <th class="dg">Action</th>
            </tr>
            <?php $totalprice=0 ?>
            @foreach ($carts as $cart)
            <tr>
                <td>{{$cart->product_title}}</td>
                <td>{{$cart->quantity}}</td>
                <td>&#2547;{{$cart->price}}</td>
                <td><img style="width: 80px; height:80px;" src="product/{{$cart->image}}" alt=""></td>
                <td>
                    <a onclick="confirmation(event)" style="color: red;" href="{{url('remove_cart',$cart->id)}}">Cancel Order</a>
                </td>
            </tr>
            <?php $totalprice=$totalprice + $cart->price  ?>
            @endforeach
        </table>
        <div style="font-size: 20px; padding:30px;">
          Total Price : &#2547; {{$totalprice}}
        </div>
        <div>
            <h1 style="font-size: 20px; padding:10px;">Proceed to Order</h1>
            <a class="btn btn-success" href="{{url('cash_order')}}">Cash on Delivary</a>
            <a class="btn btn-success" href="{{url('/stripe',$totalprice)}}">Pay Using Card</a>
        </div>
      </div>

      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

         </p>
      </div>

      {{--script for sweet alert --}}
      <script>
        function confirmation(ev) {
          ev.preventDefault();
          var urlToRedirect = ev.currentTarget.getAttribute('href');
          console.log(urlToRedirect);
          swal({
              title: "Are you sure to cancel this product",
              text: "You will not be able to revert this!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willCancel) => {
              if (willCancel) {



                  window.location.href = urlToRedirect;

              }


          });


      }
  </script>

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
