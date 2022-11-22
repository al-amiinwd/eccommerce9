<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');

//frontend
route::get('/',[HomeController::class,'index']);

//backend
route::get('/view_category',[AdminController::class,'view_category']);
route::post('/add_category',[AdminController::class,'add_category']);
route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
route::get('/order',[AdminController::class,'order']);
route::get('/delete_order/{id}',[AdminController::class,'delete_order']);
route::get('/deliverd/{id}',[AdminController::class,'deliverd']);
route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
route::get('/send_email/{id}',[AdminController::class,'send_email']);
route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);
route::get('/search',[AdminController::class,'searchdata']);
route::post('/add_comment',[AdminController::class,'add_comment']);
route::post('/reply_comment',[AdminController::class,'reply_comment']);




route::get('/create_product',[ProductController::class,'create_product']);
route::post('/add_product',[ProductController::class,'add_product']);
route::get('/show_product',[ProductController::class,'show_product']);
route::get('/view_product',[ProductController::class,'view_product']);
route::get('/edit_product/{id}',[ProductController::class,'edit_product']);
route::post('/update_product/{id}',[ProductController::class,'update_product']);
route::get('/delete_product/{id}',[ProductController::class,'delete_product']);
route::get('/product_details/{id}',[ProductController::class,'product_details']);
route::post('/add_cart/{id}',[ProductController::class,'add_cart']);
route::get('/show_cart',[ProductController::class,'show_cart']);
route::get('/product_search',[ProductController::class,'product_search']);

route::get('/show_order',[ProductController::class,'show_order']);
route::get('/cancel_order/{id}',[ProductController::class,'cancel_order']);

route::get('/remove_cart/{id}',[ProductController::class,'remove_cart']);
route::get('/cash_order',[ProductController::class,'cash_order']);
route::get('/stripe/{totalprice}',[ProductController::class,'stripe']);

//payment stripe card
Route::post('/stripe/{totalprice}',[ProductController::class,'stripePost'])->name('stripe.post');


