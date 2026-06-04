<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\BlogController;


Route::prefix('/admin')->middleware('admin')->group(function () {

    // Dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
    });

    //Account
    Route::prefix('/account')->controller(AccountController::class)->group(function () {
        Route::get('/', 'index');               
        Route::get('/edit',  'edit');
        Route::post('/update', 'update');
    });

     // Contact
    Route::prefix('/contact')->controller(ContactController::class)->group(function () {
        Route::get('/', 'index');
    });

    // Projects
    Route::prefix('/projects')->name('admin.projects.')->controller(ProjectController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Testimonials
    Route::prefix('/testimonials')->name('admin.testimonials.')->controller(TestimonialController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Blog
    Route::prefix('/blog')->name('admin.blog.')->controller(BlogController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });
});