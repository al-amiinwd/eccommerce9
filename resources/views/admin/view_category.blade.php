<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.layouts.css')
    <style type="text/css">
    .div_center{
        text-align: center;
        padding-top: 40px;
    }
    .h2_font{
        font-size: 30px;
        padding-bottom: 40px;
    }
    .font_color{
        color: black;
    }
    .table{
        margin: auto;
        width: 50%;
        text-align: center;
        margin-top: 30px;
        border: 3px solid white;
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

            @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
            @endif
            <div class="div_center">
               <h2 class="h2_font">
                Add category
              </h2>
              <form action="{{url('add_category')}}" method="POST">
                @csrf
                <input type="text" class="font_color" name="category" placeholder="Write category name">
                <input type="submit" name="submit" class="btn btn-primary" value="Add category">
              </form>
            </div>

            <table class="table">
                <tr>
                    <td>Category Name</td>
                    <td>Action</td>
                </tr>
                @foreach ($data as $data)
                <tr>
                    <td>{{$data->category}}</td>
                    <td><a onclick="return confirm('Are you sure to delete?')" class="btn btn-danger" href="{{url('delete_category',$data->id)}}">Delete</a></td>
                </tr>
                @endforeach
            </table>
        </div>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.layouts.script')
    <!-- End custom js for this page -->
  </body>
</html>

