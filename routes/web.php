<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;



Route::get('/register/', [AuthController::class, 'showRegisterForm']);
Route::post('/register/', [AuthController::class, 'register']);

Route::get('/', function () {
    return redirect()->route('AccManager.login'); // redirect thẳng tới login
});

Route::get('/login/', [AuthController::class, 'showLoginForm'])->name('AccManager.login');
Route::post('/login/', [AuthController::class, 'login']);
Route::get('/logout/', [AuthController::class, 'logout']);

//==============================User=========================//



Route::middleware('admin')->group(function () {
    Route::get('/trang_chu', [AuthController::class, 'trang_chu_ui']);
    Route::get('/admin', [AdminController::class, 'dashboard']);
});



//=========================================Admin Routes=========================================
Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/set-role/{id}', [AdminController::class, 'setRole'])->name('admin.setRole');
});


