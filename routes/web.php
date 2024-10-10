<?php

use App\Http\Controllers\AdminAuthentication;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\BankAdmin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminAuthentication::class, 'login_page']);
Route::post('/admin/login', [AdminAuthentication::class, 'login'])->name('admin.login');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
    Route::get('/admin/logout', [AdminAuthentication::class, 'logout'])->name('Administrator Logout');
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
    Route::get('/merchants', [MerchantController::class, 'index'])->name('Merchant Page');
    Route::get('/merchants/update/{id}', [MerchantController::class, 'edit_page'])->name('edit merchant');
    Route::get('/merchants/data', [MerchantController::class, 'get_data_json'])->name('admin.merchants.data');
    Route::get('/merchants/add', [MerchantController::class, 'add_page'])->name('admin.merchants.add');
    Route::post('/merchants/add', [MerchantController::class, 'add'])->name('admin.merchants.store');
    Route::put('/merchants/edit/{id}', [MerchantController::class, 'edit'])->name('admin.merchant.update');
    Route::get('/merchants/delete/{id}', [MerchantController::class, 'delete'])->name('admin.merchant.delete');
});

Route::get('/', [HomeController::class, 'index'])->name('user.home');

Route::get('/bank', [BankAdmin::class, 'list_bank'])->name('List Bank');
