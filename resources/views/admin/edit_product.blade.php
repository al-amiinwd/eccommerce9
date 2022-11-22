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
    label{
        display: inline block;
        width: 300px;
    }
    .design{
        padding-bottom: 20px;
    }
    .img{
        width: 70px;
        height: 70px;
        margin: auto;

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
               <h2 class="h2_font">Update Product</h2>
                <form action="{{url('update_product',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

            <div class="design">
                <label for="title">Product Title :</label>
                <input type="text" class="font_color" name="title" value="{{$product->title}}" >
            </div>
            <div class="design">
                <label for="title">Product Description  :</label>
                <input type="text" class="font_color" name="description" value="{{$product->description}}" >
            </div>
            <div class="design">
                <label for="title">Product Quantity  :</label>
                <input type="number" min="0" class="font_color" name="quantity" value="{{$product->quantity}}" >
            </div>
            <div class="design">
                <label for="title">Product Price :</label>
                <input type="number" class="font_color" name="price" value="{{$product->price}}"  >
            </div>
            <div class="design">
                <label for="title">Product Discount_price :</label>
                <input type="number" class="font_color" name="discount_price" value="{{$product->discount_price}}" >
            </div>
            <div class="design">
                <label for="title">Product Category	 :</label>

                <select class="font_color" id="" name="category" >
                    <option value="{{$product->category}}" selected="">{{$product->category}}</option>

                    @foreach ($categories as $category)
                    <option value="{{ $category->category}}">{{ $category->category}}</option>
                    @endforeach
                </select>
            </div>

            <div class="design">
                <label for="title">Current Product Image :</label>
                <img class="img" src="/product/{{$product->image}}" alt="">
            </div>

            <div class="design">
                <label for="title">Change Product Image :</label>
                <input type="file"  name="image" value="{{$product->image}}" >
            </div>
            <div class="design">
                <input type="submit" class="btn btn-primary"  value="Update Product">
            </div>
        </form>

            </div>
        </div>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.layouts.script')
    <!-- End custom js for this page -->
  </body>
</html>
