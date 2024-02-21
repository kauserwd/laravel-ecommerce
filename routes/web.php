<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('index');
}); */
Route::get('/',[HomeController::class, 'index']);
Route::get('/redirect',[HomeController::class, 'redirect'])->middleware('auth','verified');
Route::get('/product_details_view/{id}',[HomeController::class, 'ProductView']);

Route::post('/add_to_cart/{id}',[HomeController::class, 'add_cart']);
Route::get('/show_cart_view',[HomeController::class, 'ShowCart']);

Route::get('/show_order_view',[HomeController::class, 'ShowOrder']);
Route::get('/cancel_order/{id}',[HomeController::class, 'CancelOrder']);

Route::get('/cart_delete/{id}',[HomeController::class, 'DeleteCart']);
Route::get('/cash_order',[HomeController::class, 'CashOrder']);
Route::get('/stripe/{totalprice}',[HomeController::class, 'stripe']);
Route::get('/stripe/{totalprice}',[HomeController::class, 'stripePost'])->name('stripe.post');

/* comment section */
Route::post('/add_comment',[HomeController::class, 'add_comment']);
Route::post('/add_reply',[HomeController::class, 'add_reply']);

/* product search section start */
Route::get('/product_search',[HomeController::class, 'product_search']);
/* show all products in navbar */
Route::get('/products',[HomeController::class, 'products']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/view_category',[AdminController::class, 'ViewCategory']);

Route::post('/add_category',[AdminController::class, 'AddCategory']);
Route::get('/cat_show/{id}',[AdminController::class, 'ShoCategory']);
Route::post('/Update_category/{id}',[AdminController::class, 'UpdateCategory']);
Route::get('/cat_delete/{id}',[AdminController::class, 'DeleteCategory']);

Route::get('/View_products',[AdminController::class, 'ViewProducts']);


Route::post('/add_products',[AdminController::class, 'AddProducts']);
Route::get('/show_products',[AdminController::class, 'ShowProducts']);
Route::get('/product_show/{id}',[AdminController::class, 'updateShow']);
Route::post('/product_update/{id}',[AdminController::class, 'UpdateProducts']);
Route::get('/product_delete/{id}',[AdminController::class, 'DeleteProduct']);

Route::get('/view_order',[AdminController::class, 'ViewOrder']);
Route::get('/delevered/{id}',[AdminController::class, 'delevered']);
Route::get('/print_pdf/{id}',[AdminController::class, 'PrintPdf']);

Route::get('/send_email/{id}',[AdminController::class, 'SendEmail']);
Route::post('/send_user_email/{id}',[AdminController::class, 'send_user_email']);

/* search products */
Route::get('/search',[AdminController::class, 'SearchData']);