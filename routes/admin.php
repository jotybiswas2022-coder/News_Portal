<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\ExperienceController;
use App\Http\Controllers\admin\SkillController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\FaqController;


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

    // Experiences
    Route::prefix('/experiences')->name('admin.experiences.')->controller(ExperienceController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Skills
    Route::prefix('/skills')->name('admin.skills.')->controller(SkillController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Services
    Route::prefix('/services')->name('admin.services.')->controller(ServiceController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // FAQs
    Route::prefix('/faqs')->name('admin.faqs.')->controller(FaqController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });
});