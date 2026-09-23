<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\PostController;

Route::prefix('admin')->middleware('admin')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);

    // Posts
    Route::prefix('posts')->controller(PostController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');       
        Route::post('/store', 'store');        
        Route::get('/edit/{id}', 'edit');       
        Route::post('/update/{id}', 'update')->name('posts.update'); 
        Route::get('/delete/{id}', 'delete'); 
        Route::get('/file/{id}', 'viewFile')->name('posts.viewFile');
    });

    // Contacts
    Route::prefix('contacts')->controller(ContactController::class)->group(function () {
        Route::get('/', 'index');
    });

    // Settings
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::post('/settings', [SettingsController::class, 'update']);

    // Categories
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index');        
        Route::get('/create', 'create');      
        Route::post('/store', 'store');       
        Route::get('/edit/{id}', 'edit');  
        Route::post('/update/{id}', 'update');  
        Route::get('/delete/{id}', 'delete');   
    });

    // Sliders
    Route::prefix('sliders')->controller(SliderController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');       
        Route::post('/store', 'store');        
        Route::get('/edit/{id}', 'edit');       
        Route::post('/update/{id}', 'update'); 
        Route::get('/delete/{id}', 'delete'); 
    });

});