<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\SiteController;

// Forex EA Website — root level routes
include('forex.php');

// Site contact page (separate from forex contact-us)
Route::get('/old-contact', [SiteController::class, 'contact'])->name('contact.page');

// Password reset link request form route
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Authentication routes
Auth::routes();

// Include admin route file
include('admin.php');
