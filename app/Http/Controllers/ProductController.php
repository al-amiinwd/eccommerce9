<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Session;
use Stripe;

class ProductController extends Controller
{

    public function create_product()
    {
        if(Auth::id()){
            $categories=Category::all();
            return view('admin.create_product',compact('categories'));
        }else{
            return redirect('login');
        }

    }


    public function add_product(Request $request)
    {
        if(Auth::id()){
            $product=new Product;
            $product->title=$request->title;
            $product->description=$request->description;
            $product->quantity=$request->quantity;
            $product->price=$request->price;
            $product->discount_price=$request->discount_price;
            $product->category=$request->category;

            $image=$request->image;
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $image->move('product',$imagename);
            $product->image=$imagename;

            $product->save();
            return redirect()->back()->with('message', 'Product added successfully');
        }else{
            return redirect('login');
        }


    }


    public function show_product()
    {
        if(Auth::id()){
            $products=Product::all();
            return view('admin.show_product',compact('products'));
        }else{
            return redirect('login');
        }

    }

    public function view_product()
    {
        if(Auth::id()){
            $products=Product::paginate(6);
            $comments=comment::orderby('id','desc')->get();
            $reply=reply::all();
            return view('frontend.product',compact('products','comments','reply'));
        }else{
            return redirect('login');
        }

    }


    public function edit_product($id)
    {
        if(Auth::id()){
            $product=Product::find($id);
            $categories=Category::all();
            return view('admin.edit_product',compact('product','categories'));
        }else{
            return redirect('login');
        }

    }


    public function update_product(Request $request, $id)
    {
        if(Auth::id()){
            $product=Product::find($id);
            $product->title=$request->title;
            $product->description=$request->description;
            $product->quantity=$request->quantity;
            $product->price=$request->price;
            $product->discount_price=$request->discount_price;
            $product->category=$request->category;

            $image=$request->image;
            if($image){
                $imagename=time().'.'.$image->getClientOriginalExtension();
                $image->move('product',$imagename);
                $product->image=$imagename;
            }

            $product->save();
            return redirect()->back()->with('message', 'Product updated successfully');
        }else{
            return redirect('login');
        }

    }


    public function delete_product($id)
    {
        if(Auth::id()){
            $products=Product::find($id);
            $products->delete();
            return redirect()->back()->with('message', 'Product deleted successfully');
        }else{
            return redirect('login');
        }

    }

    public function product_search(Request $request)
    {
        if(Auth::id()){
            $reply=reply::all();
            $comments=comment::orderby('id','desc')->get();
            $searchtext=$request->search;
            $products=product::where('title','LIKE',"%$searchtext%")->orWhere('category','LIKE',"%$searchtext%")->paginate(10);
            return view('frontend.product',compact('products','reply','comments'));
        }else{
            return redirect('login');
        }

    }

    public function product_details($id)
    {
        if(Auth::id()){
            $product=product::find($id);
            return view('frontend.product_details',compact('product'));
        }else{
            return redirect('login');
        }

    }

    public function add_cart(Request $request, $id)
    {
        if(Auth::id()){
            $user=Auth::user();
            $userid=$user->id;
            $product=product::find($id);

            $product_exit_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

            if($product_exit_id)
            {
                $cart=cart::find($product_exit_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->quantity;

                if($product->discount_price!=null){
                    $cart->price=$product->discount_price * $cart->quantity;
                }else{
                    $cart->price=$product->price * $cart->quantity;
                }
                $cart->save();
                Alert::success('Product added Successfully','We have Added The Product To Cart');
                return redirect()->back();
            }
            else
            {
                $cart=new cart;
                $cart->name=$user->name;
                $cart->email=$user->email;
                $cart->phone=$user->phone;
                $cart->address=$user->address;
                $cart->user_id=$user->id;

                $cart->product_title=$product->title;

                if($product->discount_price!=null){
                    $cart->price=$product->discount_price * $request->quantity;
                }else{
                    $cart->price=$product->price * $request->quantity;
                }

                $cart->quantity=$request->quantity;
                $cart->image=$product->image;
                $cart->product_id=$product->id;



                $cart->save();
                return redirect()->back()->with('message','Product Added Successfully!');
            }

            $cart=new cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            $cart->product_title=$product->title;

            if($product->discount_price!=null){
                $cart->price=$product->discount_price * $request->quantity;
            }else{
                $cart->price=$product->price * $request->quantity;
            }

            $cart->quantity=$request->quantity;
            $cart->image=$product->image;
            $cart->product_id=$product->id;



            $cart->save();
            return redirect()->back();

        }else{
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $carts=cart::where('user_id','=',$id)->get();
            return view('frontend.show_cart',compact('carts'));
        }else{
            return redirect('login');
        }

    }

    public function show_order()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $orders=order::where('user_id','=',$id)->get();
            return view('frontend.show_order',compact('orders'));
        }else{
            return redirect('login');
        }

    }

    public function cancel_order($id)
    {
        if(Auth::id()){
            $orders=order::find($id);
            $orders->delivary_status='You canceled the order';
            $orders->save();

            $orders->delivary_status='You canceled the order';
            $orders->delete();
            return redirect()->back()->with('messase','You canceled this order');
        }else{
            return redirect('login');
        }

    }


    public function remove_cart($id)
    {
        if(Auth::id()){
            $cart=cart::find($id);
            $cart->delete();
            return redirect()->back();
        }else{
            return redirect('login');
        }

    }
    public function cash_order()
    {
        if(Auth::id()){
            $user=Auth::user();
            $userid=$user->id;
            $data=cart::where('user_id','=',$userid)->get();

            foreach($data as $data)
            {
                $order=new order;
                $order->name=$data->name;
                $order->email=$data->email;
                $order->phone=$data->phone;
                $order->address=$data->address;
                $order->user_id=$data->user_id;

                $order->product_title=$data->product_title;
                $order->quantity=$data->quantity;
                $order->price=$data->price;
                $order->image=$data->image;
                $order->product_id=$data->product_id;

                $order->payment_status='Cash on Delivary';
                $order->delivary_status='Processing';

                $order->save();

                $cart_id=$data->id;
                $cart=cart::find($cart_id);
                $cart->delete();

            }
            return redirect()->back()->with('message','We have received your order, We will connect with you soon ....');
        }else{
            return redirect('login');
        }


    }
    public function stripe($totalprice)
    {
        if(Auth::id()){
            return view('frontend.stripe',compact('totalprice'));
        }else{
            return redirect('login');
        }

    }

    public function stripePost(Request $request,$totalprice)
    {
        if(Auth::id()){
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create ([
                    "amount" => $totalprice * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Thanks for the Payment"
            ]);

            $user=Auth::user();
            $userid=$user->id;
            $data=cart::where('user_id','=',$userid)->get();

            foreach($data as $data)
            {
                $order=new order;
                $order->name=$data->name;
                $order->email=$data->email;
                $order->phone=$data->phone;
                $order->address=$data->address;
                $order->user_id=$data->user_id;

                $order->product_title=$data->product_title;
                $order->quantity=$data->quantity;
                $order->price=$data->price;
                $order->image=$data->image;
                $order->product_id=$data->product_id;

                $order->payment_status='Paid';
                $order->delivary_status='Processing';

                $order->save();

                $cart_id=$data->id;
                $cart=cart::find($cart_id);
                $cart->delete();

            }

            Session::flash('success', 'Payment successful!');

            return back();
        }else{
            return redirect('login');
        }

    }

}
