<header class="header_section">
    <div class="container">
       <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{url('/')}}"><img width="250" src="{{url('home/images/logo.png')}}" alt="#" /></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav">
                <li class="nav-item active">
                   <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                </li>
               <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                   <ul class="dropdown-menu">
                      <li><a href="about.html">About</a></li>
                      <li><a href="testimonial.html">Testimonial</a></li>
                   </ul>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="{{url('view_product')}}">Products</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="blog_list.html">Blog</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="contact.html">Contact</a>
                </li>

                @if (Route::has('login'))

                        @auth

                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_cart')}}">Cart:<span style="color: #f7444e;">{{App\Models\cart::where('user_id','=',Auth::user()->id)->count()}}</span></a>
                        </li>

                        @else

                         <li class="nav-item">
                           <a class="nav-link"  href="{{url('show_cart')}}">Cart:0</a>
                        </li>


                        @endauth

                        @endif



                        @if (Route::has('login'))

                        @auth

                        <li class="nav-item">
                           <a class="nav-link"   href="{{url('show_order')}}">Order:<span style="color: #f7444e;; margin:auto;">{{App\Models\order::where('user_id','=',Auth::user()->id)->count()}}</span></a>
                        </li>

                        @else

                         <li class="nav-item">
                           <a class="nav-link"  style="color: #f7444e;" href="{{url('show_order')}}">Order:0</a>
                        </li>


                        @endauth

                        @endif

                 {{-- <li class="nav-item">
                    <a class="nav-link" href="{{url('show_order')}}">Order</i></a>
                 </li> --}}



                <form class="form-inline">
                   <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                   <i class="fa fa-search" aria-hidden="true"></i>
                   </button>
                </form>

                @if (Route::has('login'))

                @auth
                <li class="nav-item">

                    <x-app-layout>

                    </x-app-layout>

                 </li>

               @else
                <li class="nav-item">
                    <a class="btn btn-primary" href="{{ route('login') }}" id="logincss">Login</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-success" href="{{ route('register') }}">Registration</a>
                 </li>

                 @endauth
                 @endif

             </ul>
          </div>
       </nav>
    </div>
 </header>
