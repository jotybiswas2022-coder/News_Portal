<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SourceCodeController;

Route::prefix('admin')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Contact messages
    Route::get('/contact', [DashboardController::class, 'contact'])->name('admin.contact');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');

    // Partnership applications
    Route::get('/partners', [PartnerController::class, 'index'])->name('admin.partners.index');
    Route::post('/partners/{id}/status', [PartnerController::class, 'updateStatus'])->name('admin.partners.status');
    Route::delete('/partners/{id}', [PartnerController::class, 'destroy'])->name('admin.partners.destroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Source Codes
    Route::get('/source-codes', [SourceCodeController::class, 'index'])->name('admin.source-codes.index');
    Route::get('/source-codes/create', [SourceCodeController::class, 'create'])->name('admin.source-codes.create');
    Route::post('/source-codes', [SourceCodeController::class, 'store'])->name('admin.source-codes.store');
    Route::get('/source-codes/{id}/edit', [SourceCodeController::class, 'edit'])->name('admin.source-codes.edit');
    Route::put('/source-codes/{id}', [SourceCodeController::class, 'update'])->name('admin.source-codes.update');
    Route::delete('/source-codes/{id}', [SourceCodeController::class, 'destroy'])->name('admin.source-codes.destroy');
});
