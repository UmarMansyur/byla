<?php

use App\Http\Controllers\AdminAuthentication;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\BankAdmin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\UserAuthentication;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/bank', [BankAdmin::class, 'list_bank'])->name('List Bank');
Route::get('/login', [UserAuthentication::class, 'login_page'])->name('Halaman Login Pengguna');
Route::post('/login', [UserAuthentication::class, 'login'])->name('Login Pengguna');
Route::get('/register', [UserAuthentication::class, 'register_page'])->name('Halaman Register Pengguna');
Route::post('/register', [UserAuthentication::class, 'register'])->name('Register Pengguna');

Route::get('/verify-email', [UserAuthentication::class, 'verify_email'])->name('Verify Email');
Route::get('/login-google', [UserAuthentication::class, 'login_google'])->name('Login Google');
Route::get('/auth/google/callback', [UserAuthentication::class, 'handle_google_callback'])->name('Google Callback');
Route::get('/logout', [UserAuthentication::class, 'logout'])->name('Logout Pengguna');

Route::get('/forgot-password', [UserAuthentication::class, 'forgot_password_page'])->name('Forgot Password Page');
Route::post('/forgot-password', [UserAuthentication::class, 'forgot_password'])->name('Forgot Password');

Route::get('/reset-password', [UserAuthentication::class, 'reset_password_page'])->name('Reset Password Page');
Route::post('/reset-password', [UserAuthentication::class, 'reset_password'])->name('Reset Password');


Route::group(['middleware' => 'user'], function(){
    Route::get('/pin', [SaldoController::class, 'pin_page'])->name('pin');
    Route::post('/pin', [SaldoController::class, 'pin_store'])->name('Save PIN');

    Route::get('/profile', [ProfileController::class, 'index'])->name('Profile Page');
    Route::get('/profile/detail', [ProfileController::class, 'detail'])->name('Profile Detail Page');
    Route::get('/profile/update', [ProfileController::class, 'update_page'])->name('Profile Update Page');
    Route::put('/profile/update', [ProfileController::class, 'update_profile'])->name('Profile Update');
    Route::get('/my-qrcode', [SaldoController::class, 'my_qrCode'])->name('My QR Code Page');
    Route::get('/scan-qr', [SaldoController::class, 'scan_qr_page'])->name('Scan QR Page');
});
