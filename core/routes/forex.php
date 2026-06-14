<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForexController;
use App\Http\Controllers\OrderController;

Route::controller(ForexController::class)->group(function () {
    Route::get('/', 'home')->name('forex.home');
    // Dynamic store routes
    Route::get('/products', 'products')->name('forex.products');
    Route::get('/product/{slug}', 'productDetail')->name('forex.product-detail');
    Route::get('/source-codes', 'sourceCodes')->name('forex.source-codes');
    Route::get('/source-code/{slug}', 'sourceCodeDetail')->name('forex.source-code-detail');
    // Other routes
    Route::get('/partnership', 'partnership')->name('forex.partnership');
    Route::post('/partnership', 'partnerSubmit')->name('forex.partner-submit');
    Route::get('/contact-us', 'contactUs')->name('forex.contact-us');
    Route::post('/contact-us', 'contactSubmit')->name('forex.contact-submit');
    Route::get('/cart', 'cart')->name('forex.cart');
    Route::get('/payment-details', 'paymentDetails')->name('forex.payment-details');
    Route::get('/knowledgebase', 'knowledgebase')->name('forex.knowledgebase');
    Route::get('/terms-of-services', 'terms')->name('forex.terms');
    Route::get('/privacy-policy', 'privacy')->name('forex.privacy');
    Route::get('/cookie-policy', 'cookies')->name('forex.cookies');
});

// Login redirect (uses frontend auth system)
Route::get('/forex-login', function () {
    return redirect()->route('login');
})->name('forex.login');

// Order routes
Route::post('/order', [OrderController::class, 'placeOrder'])->name('order.place');
Route::post('/order/confirm-payment', [OrderController::class, 'confirmPayment'])->name('order.confirm-payment');
Route::get('/order/success/{order?}', [OrderController::class, 'success'])->name('order.success');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('forex.my-orders')->middleware('auth');
Route::get('/my-partnership', [ForexController::class, 'myPartnership'])->name('forex.my-partnership')->middleware('auth');

// Notification routes
Route::get('/notification/{id}/read', [OrderController::class, 'markNotificationRead'])->name('notification.read')->middleware('auth');
Route::post('/notifications/read-all', [OrderController::class, 'markAllNotificationsRead'])->name('notification.read-all')->middleware('auth');

// Profile routes
use App\Http\Controllers\ProfileController;
Route::get('/profile', [ProfileController::class, 'show'])->name('forex.profile')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('forex.profile.update')->middleware('auth');

