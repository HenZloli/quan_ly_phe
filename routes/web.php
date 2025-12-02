<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DrinkController;


Route::get('/register/', [AuthController::class, 'showRegisterForm']);
Route::post('/register/', [AuthController::class, 'register']);

Route::get('/', function () {
    return redirect()->route('AccManager.login'); // redirect thẳng tới login
});

Route::get('/login/', [AuthController::class, 'showLoginForm'])->name('AccManager.login');
Route::post('/login/', [AuthController::class, 'login']);
Route::get('/logout/', [AuthController::class, 'logout']);

//==============================User=========================//


// Route::get('/dashboard/', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::middleware('admin')->group(function () {
    Route::get('/trang_chu', [AuthController::class, 'trang_chu_ui']);
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::post('/menu/order', [MenuController::class, 'order'])->name('menu.order');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('user.orders');
    Route::post('/my-orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('user.cancelOrder');
    Route::post('/my-orders/{id}/delete', [OrderController::class, 'deleteOrder'])->name('user.deleteOrder');




    Route::get('/admin', [AdminController::class, 'dashboard']);
});


//Group cho admin
// Route::middleware(['auth','role:admin'])->group(function() {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::post('/admin/set-role/{id}', [AdminController::class, 'setRole'])->name('admin.setRole');
// });

//=========================================Admin Routes=========================================
Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/set-role/{id}', [AdminController::class, 'setRole'])->name('admin.setRole');

    Route::get('/admin/materials', [AdminController::class,'materialsIndex'])->name('admin.materials');
    Route::post('/admin/materials', [AdminController::class,'materialsStore'])->name('admin.materials.store');
    Route::put('/admin/materials/{id}', [AdminController::class,'materialsUpdate'])->name('admin.materials.update');
    Route::delete('/admin/materials/{id}', [AdminController::class,'materialsDelete'])->name('admin.materials.delete');

    Route::get('/admin/drinks', [DrinkController::class,'index'])->name('admin.drinks.index');
    Route::post('/admin/drinks', [DrinkController::class,'store'])->name('admin.drinks.store');
    Route::put('drinks/{id}', [DrinkController::class,'update'])->name('admin.drinks.update');
    Route::delete('drinks/{id}', [DrinkController::class,'delete'])->name('admin.drinks.delete');

});

Route::middleware(['admin'])->group(function(){
    Route::get('/staff', [StaffController::class, 'dashboard'])->name('staff.dashboard');
    Route::post('/staff/order/{id}', [StaffController::class, 'updateStatus'])->name('staff.updateStatus');
    Route::post('/staff/order/{id}/cancel', [StaffController::class, 'cancelOrder'])->name('staff.cancelOrder');

});

