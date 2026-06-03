<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DonorController;

Route::prefix('admin')->middleware('admin')->group(function () {

    // ===============================
    // Dashboard
    // ===============================
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
    });

    // ===============================
    // Account
    // ===============================
    Route::prefix('account')->controller(AccountController::class)->group(function () {
        Route::get('/', 'index')->name('account.index');
        Route::get('/edit', 'edit')->name('account.edit');
        Route::post('/update', 'update')->name('account.update');
    });

    // ===============================
    // Blood Requests
    // ===============================
    Route::prefix('blood-requests')->controller(\App\Http\Controllers\FrontendEmergencyRequestController::class)->group(function () {
        Route::get('/', 'adminIndex')->name('admin.blood_requests.index');
        Route::get('/{id}', 'adminShow')->name('admin.blood_requests.show');
        Route::post('/fulfilled/{id}', 'markFulfilled')->name('admin.blood_requests.fulfilled');
        Route::delete('/delete/{id}', 'adminDelete')->name('admin.blood_requests.delete');
    });

    // ===============================
    // Contact
    // ===============================
    Route::prefix('contact')->controller(ContactController::class)->group(function () {
        Route::get('/', 'index')->name('contact.index');
    });

    // ===============================
    // Donor List CRUD
    // ===============================
    Route::prefix('donor_list')->controller(DonorController::class)->group(function () {
        Route::get('/', 'index')->name('donor.index');
        Route::get('/search/ajax', 'ajaxSearch')->name('donor.search.ajax');
        Route::get('/export/pdf', 'exportPDF')->name('donor.export.pdf');
        Route::get('/export/csv', 'exportCSV')->name('donor.export.csv');
        Route::get('/create', 'create')->name('donor.create');
        Route::post('/store', 'store')->name('donor.store');
        Route::get('/edit/{id}', 'edit')->name('donor.edit');
        Route::post('/update/{id}', 'update')->name('donor.update');
        Route::delete('/delete/{id}', 'delete')->name('donor.delete');
    });
});