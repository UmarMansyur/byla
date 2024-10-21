<?php

use App\Http\Controllers\AdminAuthentication;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\BankAdmin;
use App\Http\Controllers\BankAdminController;
use App\Http\Controllers\BankTransfer;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\StockManajemenController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserAuthentication;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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
    Route::put('/merchants/update-status/{id}', [MerchantController::class, 'update_status'])->name('admin.merchant.update-status');

    Route::get('/bank', [BankAdminController::class, 'index'])->name('List Bank');
    Route::get('/bank/data', [BankAdminController::class, 'get_data_json'])->name('admin.bank.data');
    Route::get('/bank/delete/{id}', [BankAdminController::class, 'destroy'])->name('admin.bank.delete');
    Route::post('/bank/store', [BankAdminController::class, 'store'])->name('admin.bank.store');

    // transfer topup
    Route::get('/transfer-topup', [TransferController::class, 'get_data_topup_admin'])->name('Transfer Topup Page');
    Route::get('/transfer-topup/data', [TransferController::class, 'get_data_topup'])->name('Transfer Topup Data');
    Route::post('/topup/tolak/{id}', [TransferController::class, 'tolak_topup'])->name('admin.topup.tolak');
    Route::post('/topup/setujui/{id}', [TransferController::class, 'setujui_topup'])->name('admin.topup.setujui');
    Route::get('/transfer', [TransferController::class, 'get_data_transfer_admin'])->name('Transfer Page');
    Route::get('/transfer/get-data-json', [TransferController::class, 'get_data_transfer_admin_json'])->name('Transfer Get Data JSON');
    Route::post('/transfer/disetujui', [TransferController::class, 'disetujui_transfer'])->name('admin.transfer.disetujui');
    Route::post('/transfer/ditolak', [TransferController::class, 'ditolak_transfer'])->name('admin.transfer.ditolak');
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


Route::get('/otp', [UserAuthentication::class, 'otp_page'])->name('OTP Page');
Route::post('/otp', [UserAuthentication::class, 'otp'])->name('OTP');
Route::group(['middleware' => 'user'], function() {
    Route::get('/pin', [SaldoController::class, 'pin_page'])->name('pin');
    Route::post('/pin', [SaldoController::class, 'pin_store'])->name('Save PIN');

    Route::get('/profile', [ProfileController::class, 'index'])->name('Profile Page');
    Route::get('/profile/detail', [ProfileController::class, 'detail'])->name('Profile Detail Page');
    Route::get('/profile/update', [ProfileController::class, 'update_page'])->name('Profile Update Page');
    Route::put('/profile/update', [ProfileController::class, 'update_profile'])->name('Profile Update');
    Route::get('/my-qrcode', [SaldoController::class, 'my_qrCode'])->name('My QR Code Page');
    Route::get('/scan-qr', [SaldoController::class, 'scan_qr_page'])->name('Scan QR Page');

    Route::get('/product', [ProductController::class, 'index'])->name('Product Page');

    Route::get('/store', [StoreController::class, 'index'])->name('Store Page');
    Route::get('/store/activate', [StoreController::class, 'activate_page'])->name('Store Activate Page');
    Route::get('/store/activate/{id}', [StoreController::class, 'edit_page'])->name('Edit Store Page');
    Route::put('/store/activate/{id}', [StoreController::class, 'edit'])->name('Edit Store');
    Route::post('/store', [StoreController::class, 'store'])->name('Store Activate');
    // product
    Route::get('/product/add', [ProductController::class, 'add_page'])->name('Add Product Page');
    Route::post('/product/add', [ProductController::class, 'add'])->name('Add Product');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit_page'])->name('Edit Product Page');
    Route::put('/product/edit/{id}', [ProductController::class, 'edit'])->name('Edit Product');
    Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('Delete Product');
    // stock manajemen page and update stock
    Route::get('/stock/manajemen', [StockManajemenController::class, 'index'])->name('Stock Management Page');
    Route::get('/stock/manajemen/update', [StockManajemenController::class, 'update'])->name('Update Stock');
    // transaction
    Route::get('/transaction', [TransactionController::class, 'index'])->name('Transaction Page');
    Route::get('/transaction/bayar', [TransactionController::class, 'bayar_page'])->name('Transaction Bayar Page');
    Route::post('/transaction/payment', [TransactionController::class, 'bayar'])->name('Transaction Bayar')->withoutMiddleware([VerifyCsrfToken::class]);
    Route::get('/transaction/final', [TransactionController::class, 'transaction_page'])->name('Transaction Scan Page');
    Route::get('/transaction/checkout', [TransactionController::class, 'checkout_page'])->name('Transaction Checkout Page');
    Route::post('/transaction/checkout', [TransactionController::class, 'checkout'])->name('Transaction Checkout');
    Route::get('/transaction/success', [TransactionController::class, 'success_page'])->name('Transaction Success Page');

    Route::get('/history', [HistoryController::class, 'history_page'])->name('History Page');
    Route::get('/history/detail/{id}', [HistoryController::class, 'history_detail_page'])->name('History Detail Page');
    Route::get('/history/download', [HistoryController::class, 'download_excel'])->name('Download Excel');
    Route::get('/history/export', [HistoryController::class, 'export_excel'])->name('Export Excel');
    Route::get('/topup', [TransferController::class, 'topup_page'])->name('Topup Page');
    Route::post('/topup', [TransferController::class, 'topup'])->name('Topup Store');
    Route::get('/topup/success', [TransferController::class, 'success_page'])->name('Topup Success Page');
    Route::get('/topup/error', [TransferController::class, 'error_page'])->name('Topup Error Page');

    Route::get('/topup/history', [TransferController::class, 'transfer_history'])->name('Topup History Page');

    Route::get('/transfer-qr', [TransferController::class, 'transfer_qr_page'])->name('Transfer QR Page');
    Route::post('/transfer-qr', [TransferController::class, 'transfer_qr'])->name('Transfer QR');
    Route::post('/read-notif', [NotificationController::class, 'read_notif'])->name('read_notif');

    Route::get('/transfer-bank', [BankTransfer::class, 'index'])->name('Transfer Bank Page');
    Route::post('/transfer-bank/get-account-details', [BankTransfer::class, 'getAccountDetails'])->name('Transfer Bank Get Account Details');
    Route::post('/transfer-bank', [BankTransfer::class, 'transfer'])->name('Transfer Bank');
    
});
Route::post('/transaction/cart', [TransactionController::class, 'cart'])->name('Transaction Cart')->withoutMiddleware([VerifyCsrfToken::class]);
