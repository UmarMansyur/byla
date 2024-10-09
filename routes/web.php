<?php

use App\Http\Controllers\AdminAuthentication;
use App\Http\Controllers\AdminDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminAuthentication::class, 'login_page']);
Route::post('/admin/login', [AdminAuthentication::class, 'login'])->name('admin.login');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
});
