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

      <style>
        .center{
            margin: auto;
            padding: 30px;
            width: 80%;
            text-align: center;

        }
        table,th,td{
            border: 2px solid black;
        }
        th{
           background-color: skyblue;
           padding: 10px;;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
      </style>
   </head>
   <body>

         <!-- header section strats -->
         @include('frontend.layouts.header')
         <!-- end header section -->
         @if(session()->has('message'))
         <div class="alert arert-danger">
            <h1>{{session()->get('message')}}</h1>
         </div>
         @endif
        <div class="center">
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment_status</th>
                    <th>Delivary_status</th>
                    <th>Image</th>
                    <th>Cancel Order</th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->delivary_status}}</td>
                <td><img style="width: 70px; height:80px;" src="{{url('product',$order->image)}}" alt=""></td>
                <td>
                    @if($order->delivary_status=='Processing')
                    <a onclick="return confirm('are you to cancel this Product !')" class="btn btn-danger bnt-sm" href="{{url('/cancel_order',$order->id)}}">Cancel Order</a>
                    @else
                    <p class="btn btn-info">Product Deliverd</p>
                    @endif
                </td>

                </tr>
                @endforeach
            </table>
        </div>
      <!-- footer start -->
      @include('frontend.layouts.footer')
      <!-- footer end -->
