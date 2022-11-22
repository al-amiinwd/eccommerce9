<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use APP\Models\User;
use APP\Models\Category;
use App\Models\Product;
use App\Models\order;
use App\Models\Comment;
use App\Models\Reply;
use session;



class HomeController extends Controller
{

    public function redirect()
    {
        $usertype=Auth::User()->usertype;
        if($usertype=='1'){
            $total_products=product::all()->count();
            $total_orders=order::all()->count();
            $total_users=user::all()->count();

            $order=order::all();
            $total_revenue=0;
            foreach ($order as $order)
            {
                $total_revenue= $total_revenue + $order->price;
            }

            $order_processing=order::where('delivary_status','=','processing')->count();
            $total_delivers=order::where('delivary_status','=','deliverd')->count();

            return view('admin.home',compact('total_products','total_orders','total_users','total_revenue','total_delivers','order_processing'));
        }else{
            $products=Product::paginate(6);
            $comments=comment::orderby('id','desc')->get();
            $reply=reply::all();
        return view('frontend.home',compact('products','comments','reply'));
        };
    }

    public function index()
    {
        if(Auth::id()){
            $products=Product::paginate(6);
            $reply=reply::all();
            $comments=comment::orderby('id','desc')->get();
            return view('frontend.home',compact('products','reply','comments'));
        }else{
            return redirect('login');
        }

    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
