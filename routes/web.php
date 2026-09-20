<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\OrderManageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\user\SearchController;


Route::prefix('/user/order')->middleware('auth')->controller(OrderManageController::class)->group(function () {
    Route::post('/store', 'store');
});

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('/cart', 'cart');
    Route::get('/add_cart/{id}', 'addcart');
    Route::get('/manage/{type}/{id}', 'manage');
    Route::get('/billing', 'billing');
    Route::get('/orders', 'orders');

});



Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/product/{id}', 'product');
});

// Public catalogue: keyword search and category browsing
Route::get('/search', [SearchController::class, 'search']);

// Public contact form (homepage "Let's Connect" section)
Route::post('/contactus', [UserController::class, 'contactus']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Auth::routes();

include('admin.php');
