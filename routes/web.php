<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController; 
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\BlogController; 
use App\Http\Controllers\AdminController; 
use Illuminate\Support\Facades\Auth; 

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

// Ana səhifə
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// OTP doğrulama üçün POST
Route::post('/otp-verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');

// Auth middleware 
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/users', [UserController::class, 'index']);
    Route::get('/dashboard/blogs', [BlogController::class, 'index']);
    
    // Blog
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    
    // Blog redaktə etmək, güncəlləmək və silmək üçün routelar
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

// Admin 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.index'); // Admin paneli
});
