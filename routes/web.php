<?php

use App\Http\Controllers\AdminAuthentication;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminAuthentication::class, 'login_page']);
Route::post('/admin/login', [AdminAuthentication::class, 'login'])->name('admin.login');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/users/edit/{id}', [UserController::class, 'edit_page'])->name('admin.users.edit_page');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/data', [UserController::class, 'get_data_json'])->name('admin.users.data');
    Route::get('/delete/users/{id}', [UserController::class, 'hapus'])->name('admin.users.destroy');
    Route::get('/users/add', [UserController::class, 'add'])->name('admin.users.add');
    Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.update');
    Route::put('/users/change-password', [UserController::class, 'change_password'])->name('admin.users.change-password');

    // merchants
    Route::get('/merchants', [MerchantController::class, 'index'])->name('admin.merchants');
    Route::get('/merchants/data', [MerchantController::class, 'get_data_json'])->name('admin.merchants.data');
    Route::get('/merchants/add', [MerchantController::class, 'add_page'])->name('admin.merchants.add_page');
    Route::post('/merchants/add', [MerchantController::class, 'add'])->name('admin.merchants.add');
    Route::get('/merchants/edit/{id}', [MerchantController::class, 'edit_page'])->name('admin.merchants.edit_page');
    Route::put('/merchants/edit/{id}', [MerchantController::class, 'edit'])->name('admin.merchants.update');
    Route::delete('/merchants/delete/{id}', [MerchantController::class, 'delete'])->name('admin.merchants.delete');
});
