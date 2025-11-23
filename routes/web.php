<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


Route::get('/register/', [AuthController::class, 'showRegisterForm']);
Route::post('/register/', [AuthController::class, 'register']);

Route::get('/login/', [AuthController::class, 'showLoginForm']);
Route::post('/login/', [AuthController::class, 'login']);

Route::get('/dashboard/', [AuthController::class, 'dashboard'])->middleware('auth');
Route::post('/logout/', [AuthController::class, 'logout'])->middleware('auth');


// Group cho admin
Route::middleware(['auth','role:admin'])->group(function() {
    Route::get('/admin/users', [AdminController::class, 'index']); // danh sách users
    Route::get('/admin/users/create', [AdminController::class, 'create']); // form tạo user
    Route::post('/admin/users', [AdminController::class, 'store']); // lưu user mới
});
