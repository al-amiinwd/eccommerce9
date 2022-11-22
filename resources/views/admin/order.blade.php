<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.layouts.css')
    <style type="text/css">

    .h2_font{
        font-size: 35px;
        font-weight: bold;
        padding-bottom: 20px;
        text-align: center;
        color: blueviolet
    }
    .table{
        text-align: center;
        margin: auto;
        width: 100%;
        border: 1px solid white;
    }
    .bg{
        background-color: skyblue
    }
    .bg{
       font-size: 1px;
    }

    </style>
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{url('admin/assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- partial:partials/_sidebar.html -->
      @include('admin.layouts.sidebar')
      <!-- partial navbar -->
      @include('admin.layouts.header')
        <!-- partial navbar end -->
        <div class="main-panel">
        <div class="content-wrapper">

            <h2 class="h2_font">ALL Order List</h2>

            <div style="padding-left: 400px; padding-bottom:20px;">
                <form action="{{url('search')}}" method="get">
                    @csrf
                    <input style="color: black" type="text" name="search" placeholder="Search For Something">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
            </div>

            <table class="table">
                <tr class="bg">
                    <th style="padding: 1px;">Name</th>
                    <th style="padding: 1px;">Email</th>
                    <th style="padding: 1px;;">Phone</th>
                    <th style="padding: 1px;;">Address</th>
                    <th style="padding: 1px;;">Product <br> Name</th>
                    <th style="padding: 1px;;">Quantity</th>
                    <th style="padding: 1px;;">Price</th>
                    <th style="padding: 1px;;">Payment <br> Status</th>
                    <th style="padding: 1px;;">Delivary <br> status</th>
                    <th style="padding: 1px;;">Image</th>
                    <th style="padding: 0px;;">Deliverd</th>
                    <th style="padding: 0px;;">Print <br> PDF</th>
                    <th style="padding: 0px;;">Send <br> Emial</th>
                    <th style="padding: 0px;;">Delete</th>
                </tr>
                @forelse ($orders as $order)
                <tr>
                    <td style="padding: 1px;;">{{$order->name}}</td>
                    <td style="padding: 1px;;">{{$order->email}}</td>
                    <td style="padding: 1px;;">{{$order->phone}}</td>
                    <td style="padding: 1px;;">{{$order->address}}</td>
                    <td style="padding: 1px;;">{{$order->product_title}}</td>
                    <td style="padding: 1px;;">{{$order->quantity}}</td>
                    <td style="padding: 1px;;;">{{$order->price}}</td>
                    <td style="padding: 1px;;">{{$order->payment_status}}</td>
                    <td style="padding: 1px;;">{{$order->delivary_status}}</td>
                    <td>
                       <img style="width: 100px; height:30px;" src="/product/{{$order->image}}" alt="">
                    </td>
                    <td style="padding: 2px;">
                        @if($order->delivary_status=='Processing')
                    <a onclick="return confirm('Are you sure to deliverd this product !!!')" class="btn btn-success btn-sm" href="{{url('/deliverd',$order->id)}}" style="padding: 0px;">Deliverd</a>
                        @else
                        <p style="color:palegreen">Deliverd</p>
                        @endif
                    </td>
                    <td>
                       <a style="padding: 0px;;" class="btn btn-primary btn-sm" href="{{url('/print_pdf',$order->id)}}">PDF Print</a>
                     </td>
                     <td>
                        <a style="padding: 0px;;" class="btn btn-info btn-sm" href="{{url('/send_email',$order->id)}}">Send Email</a>
                      </td>
                      <td>
                        <a style="padding: 0px;;" class="btn btn-danger btn-sm" href="{{url('delete_order',$order->id)}}">delete</a>
                      </td>
                    </tr>

                    @empty
                    <tr>
                        <td style="color: yellow"  colspan="16">No Data Found</td>
                    </tr>

                @endforelse
            </table>

        </div>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.layouts.script')
    <!-- End custom js for this page -->
  </body>
</html>
