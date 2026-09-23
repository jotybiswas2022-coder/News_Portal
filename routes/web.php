<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;




Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::post('/contactus', 'contactus')->name('contact.send');

});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/category/{id}', 'list');
    Route::get('/post/{id}', 'post')->name('post.show');
});

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Auth::routes();

include('admin.php');
