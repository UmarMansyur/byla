<?php

use App\Http\Controllers\AdminAuthentication;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminAuthentication::class, 'login_page']);
Route::post('/admin/login', [AdminAuthentication::class, 'login'])->name('admin.login');