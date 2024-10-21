<?php

use App\Http\Controllers\AdminAuthentication;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\AdminNotification;
use App\Http\Controllers\BankAdmin;
use App\Http\Controllers\BankAdminController;
use App\Http\Controllers\BankTransfer;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanTopupController;
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
    Route::prefix('merchants')->group(function () {
        Route::get('/', [MerchantController::class, 'index'])->name('Merchant Page');
        Route::get('/data', [MerchantController::class, 'get_data_json'])->name('admin.merchants.data');
        Route::get('/add', [MerchantController::class, 'add_page'])->name('admin.merchants.add');
        Route::post('/add', [MerchantController::class, 'add'])->name('admin.merchants.store');
        Route::get('/update/{id}', [MerchantController::class, 'edit_page'])->name('edit merchant');
        Route::put('/edit/{id}', [MerchantController::class, 'edit'])->name('admin.merchant.update');
        Route::get('/delete/{id}', [MerchantController::class, 'delete'])->name('admin.merchant.delete');
        Route::put('/update-status/{id}', [MerchantController::class, 'update_status'])->name('admin.merchant.update-status');
    });
    // Bank routes
    Route::prefix('bank')->group(function () {
        Route::get('/', [BankAdminController::class, 'index'])->name('List Bank');
        Route::get('/data', [BankAdminController::class, 'get_data_json'])->name('admin.bank.data');
        Route::get('/delete/{id}', [BankAdminController::class, 'destroy'])->name('admin.bank.delete');
        Route::post('/store', [BankAdminController::class, 'store'])->name('admin.bank.store');
    });
    // Transfer and topup routes
    Route::prefix('transfer')->group(function () {
        Route::get('/topup', [TransferController::class, 'get_data_topup_admin'])->name('Transfer Topup Page');
        Route::get('/topup/data', [TransferController::class, 'get_data_topup'])->name('Transfer Topup Data');
        Route::post('/topup/tolak/{id}', [TransferController::class, 'tolak_topup'])->name('admin.topup.tolak');
        Route::post('/topup/setujui/{id}', [TransferController::class, 'setujui_topup'])->name('admin.topup.setujui');
        Route::get('/', [TransferController::class, 'get_data_transfer_admin'])->name('Transfer Page');
        Route::get('/get-data-json', [TransferController::class, 'get_data_transfer_admin_json'])->name('Transfer Get Data JSON');
        Route::post('/disetujui', [TransferController::class, 'disetujui_transfer'])->name('admin.transfer.disetujui');
        Route::post('/ditolak', [TransferController::class, 'ditolak_transfer'])->name('admin.transfer.ditolak');
    });
    // admin
    Route::get('/admin/notifications', [AdminNotification::class, 'index'])->name('admin.notifications');
    Route::get('/admin/notifications/data', [AdminNotification::class, 'get_data_json'])->name('admin.notifications.data');
    Route::get('/admin/notifications/read-all', [AdminNotification::class, 'read_all'])->name('admin.notifications.read-all');
    Route::get('/admin/notifications/read-one/{id}', [AdminNotification::class, 'read_one'])->name('admin.notifications.read-one');
    Route::get('/admin/notifications/clear-all', [AdminNotification::class, 'clear_all'])->name('admin.notifications.clear-all');
    Route::get('/laporan-transfer', [LaporanTopupController::class, 'index'])->name('admin.laporan-transfer');
    Route::get('/laporan-transfer/data', [LaporanTopupController::class, 'get_data_json'])->name('admin.laporan-transfer.data');
    // profile
    Route::get('/admin/profile', [ProfileController::class, 'admin_index'])->name('admin.profile');
    Route::put('/admin/profile/update', [ProfileController::class, 'admin_update_profile'])->name('admin.profile.update');
    Route::put('/admin/profile/update-password', [ProfileController::class, 'admin_update_password'])->name('admin.profile.update-password');
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

    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('Profile Page');
        Route::get('/detail', [ProfileController::class, 'detail'])->name('Profile Detail Page');
        Route::get('/update', [ProfileController::class, 'update_page'])->name('Profile Update Page');
        Route::put('/update', [ProfileController::class, 'update_profile'])->name('Profile Update');
    });

    // Store routes
    Route::prefix('store')->group(function () {
        Route::get('/', [StoreController::class, 'index'])->name('Store Page');
        Route::get('/activate', [StoreController::class, 'activate_page'])->name('Store Activate Page');
        Route::get('/activate/{id}', [StoreController::class, 'edit_page'])->name('Edit Store Page');
        Route::put('/activate/{id}', [StoreController::class, 'edit'])->name('Edit Store');
        Route::post('/', [StoreController::class, 'store'])->name('Store Activate');
    });

    // Product routes
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('Product Page');
        Route::get('/add', [ProductController::class, 'add_page'])->name('Add Product Page');
        Route::post('/add', [ProductController::class, 'add'])->name('Add Product');
        Route::get('/edit/{id}', [ProductController::class, 'edit_page'])->name('Edit Product Page');
        Route::put('/edit/{id}', [ProductController::class, 'edit'])->name('Edit Product');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('Delete Product');
    });

    // Transaction routes
    Route::prefix('transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('Transaction Page');
        Route::get('/bayar', [TransactionController::class, 'bayar_page'])->name('Transaction Bayar Page');
        Route::post('/payment', [TransactionController::class, 'bayar'])->name('Transaction Bayar')->withoutMiddleware([VerifyCsrfToken::class]);
        Route::get('/final', [TransactionController::class, 'transaction_page'])->name('Transaction Scan Page');
        Route::get('/checkout', [TransactionController::class, 'checkout_page'])->name('Transaction Checkout Page');
        Route::post('/checkout', [TransactionController::class, 'checkout'])->name('Transaction Checkout');
        Route::get('/success', [TransactionController::class, 'success_page'])->name('Transaction Success Page');
    });

    // History routes
    Route::prefix('history')->group(function () {
        Route::get('/', [HistoryController::class, 'history_page'])->name('History Page');
        Route::get('/detail/{id}', [HistoryController::class, 'history_detail_page'])->name('History Detail Page');
        Route::get('/detail/print/{id}', [HistoryController::class, 'history_detail_print'])->name('History Detail Print');
        Route::get('/download', [HistoryController::class, 'download_excel'])->name('Download Excel');
        Route::get('/export', [HistoryController::class, 'export_excel'])->name('Export Excel');
    });

    // Topup routes
    Route::prefix('topup')->group(function () {
        Route::get('/', [TransferController::class, 'topup_page'])->name('Topup Page');
        Route::post('/', [TransferController::class, 'topup'])->name('Topup Store');
        Route::get('/success', [TransferController::class, 'success_page'])->name('Topup Success Page');
        Route::get('/error', [TransferController::class, 'error_page'])->name('Topup Error Page');
        Route::get('/history', [TransferController::class, 'transfer_history'])->name('Topup History Page');
    });

    Route::get('/my-qrcode', [SaldoController::class, 'my_qrCode'])->name('My QR Code Page');
    Route::get('/scan-qr', [SaldoController::class, 'scan_qr_page'])->name('Scan QR Page');

    Route::get('/transfer-qr', [TransferController::class, 'transfer_qr_page'])->name('Transfer QR Page');
    Route::post('/transfer-qr', [TransferController::class, 'transfer_qr'])->name('Transfer QR');
    Route::post('/read-notif', [NotificationController::class, 'read_notif'])->name('read_notif');

    Route::get('/transfer-bank', [BankTransfer::class, 'index'])->name('Transfer Bank Page');
    Route::post('/transfer-bank/get-account-details', [BankTransfer::class, 'getAccountDetails'])->name('Transfer Bank Get Account Details');
    Route::post('/transfer-bank', [BankTransfer::class, 'transfer'])->name('Transfer Bank');
    
});
Route::post('/transaction/cart', [TransactionController::class, 'cart'])->name('Transaction Cart')->withoutMiddleware([VerifyCsrfToken::class]);

