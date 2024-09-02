<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

/*
|
|
|
|Admin side Routes
|
|
|
*/
//Admin panel section routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

//category section routes
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add_category', [AdminController::class, 'add_category']);
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

//  product section routes
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/show_product', [AdminController::class, 'show_product']);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
Route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);
Route::put('/update_product/{id}', [AdminController::class, 'update_product']);

//admin order routes
Route::get('/order', [AdminController::class, 'order']);
Route::get('/delivered/{id}', [AdminController::class, 'delivered']);
Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);
Route::get('/send_email/{id}', [AdminController::class, 'send_email']);
Route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email']);
Route::get('/search', [AdminController::class, 'search']);

/*
|
|
|
|User side Routes
|
|
|
*/

//client product routes
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/show_cart', [HomeController::class, 'show_cart']);
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
Route::get('/cash_order', [HomeController::class, 'cash_order']);
Route::get('/show_order', [HomeController::class, 'show_order']);
Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);
Route::post('/add_comment', [HomeController::class, 'add_comment']);
Route::post('/add_reply', [HomeController::class, 'add_reply']);
Route::get('/product_search', [HomeController::class, 'product_search']);
Route::get('/search_product', [HomeController::class, 'search_product']);
Route::get('/products', [HomeController::class, 'products']);
Route::get('/contact', [HomeController::class, 'contact']);

//amount routes
Route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe/{totalprice}', 'stripePost')->name('stripe.post');
});
