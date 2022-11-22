<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
          <br>
          {{-- <div>
            <form action="{{url('product_search')}}" method="GET">
                @csrf
                <input style="width: 500px;" type="text" name="search" placeholder="search for something">
                <input type="submit" value="search">
            </form>
           </div> --}}

       </div>
       <div class="row">
        @foreach ($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('product_details',$product->id)}}" class="option1">
                        Product details
                      </a>
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
                <div class="img-box" style="padding: 20px">
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
                    &#2547;{{$product->price}}
                   </h6>

                   @endif


                </div>
             </div>
          </div>
          @endforeach
          <span style="padding-top:20px;  padding-left:25px; ">
          {!!$products->withQueryString()->links('pagination::bootstrap-4')!!}
         </span>
    </div>
 </section>
