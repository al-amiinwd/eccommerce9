<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use session;
use PDF;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{

    public function view_category()
    {
        if(Auth::id())
        {
            $data=Category::all();
            return view('admin.view_category',compact('data'));
        }else{
            return redirect('login');
        }

    }


    public function add_category(Request $request)
    {
        if(Auth::id()){
            $data=New Category;
            $data->category=$request->category;
            $data->save();
            return redirect()->back()->with('message', 'category added successfully');
        }else{
            return redirect('login');
        }

    }

    public function delete_category($id)
    {
        if(Auth::id()){
            $data=Category::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'category deleted successfully');
        }else{
            return redirect('login');
        }

    }

    public function add_product()
    {
        if(Auth::id()){
            return view('admin.view_product');
        }else{
            return redirect('login');
        }

    }



    public function deliverd($id)
    {
        if(Auth::id()){
            $order=order::find($id);
            $order->delivary_status="Deliverd";
            $order->payment_status="Paid";
            $order->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }

    }


    public function order()
    {
        if(Auth::id()){
            $orders=order::all();

            return view('admin.order',compact('orders',));
        }else{
            return redirect('login');
        }

    }

    public function delete_order($id)
    {
        if(Auth::id()){
            $orders=order::find($id);
            $orders->delete();
            return redirect()->back();
        }else{
            return redirect('login');
        }

    }


    public function print_pdf($id)
    {
        if(Auth::id()){
            $order=order::find($id);
            $pdf=PDF::loadView('admin.pdf',compact('order'));
            return $pdf->download('Order Details.pdf');
        }else{
            return redirect('login');
        }

    }

    public function send_email($id)
    {
        if(Auth::id()){
            $order=order::find($id);
            return view('admin.email',compact('order'));
        }else{
            return redirect('login');
        }

    }



    public function send_user_email(Request $request, $id)
    {
        if(Auth::id()){
            $order=order::find($id);
            $details=[
                'greeting'=> $request->greeting,
                'firstline'=> $request->firstline,
                'body'=> $request->body,
                'button'=> $request->button,
                'url'=> $request->url,
                'lastline'=> $request->lastline,
            ];
            Notification::send($order,new SendEmailNotification($details));
            return redirect()->back();
        }else{
            return redirect('login');
        }

    }


    public function searchdata(Request $request)
    {
        if(Auth::id()){
            $searchtext=$request->search;
            $orders=order::where('name','LIKE',"%$searchtext%")->orwhere('address','LIKE',"%$searchtext%")->orwhere('product_title','LIKE',"%$searchtext%")->get();


            return view('admin.order',compact('orders'));
        }else{
            return redirect('login');
        }

    }

    public function add_comment(Request $request)
    {

        if(Auth::id())
        {
            $comments=new Comment;
            $comments->name=auth::user()->name;
            $comments->user_id=auth::user()->id;
            $comments->comment=$request->comment;
            $comments->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }

    }
    public function reply_comment(Request $request)
    {

        if(Auth::id())
        {
            $reply=new Reply;
            $reply->name=auth::user()->name;
            $reply->user_id=auth::user()->id;
            $reply->comment_id=$request->commentId;
            $reply->reply=$request->reply;
            $reply->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }

    }
}
