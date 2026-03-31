<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrangChuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [TrangChuController::class, 'index'])->name('trangchu');
Route::get('/trangchu', [TrangChuController::class, 'index']); 

Route::get('/login', function () {
    return view('users.login');
})->name('login');
Route::post('/login', [UserController::class, 'Login']);

Route::get('/register', [UserController::class, 'GetUser'])->name('register');
Route::post('/register', [UserController::class, 'Register']);


// --- ROUTE BẢO MẬT (Chỉ đăng nhập mới vào được) ---
Route::middleware(['auth'])->group(function () {
    
    // Quản lý Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Trang hiển thị form thêm mới
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Xử lý lưu dữ liệu từ form gửi lên
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Quản lý Sản phẩm (Thêm/Sửa/Xóa)
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    
    Route::get('/logout', [UserController::class, 'Logout'])->name('logout');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});