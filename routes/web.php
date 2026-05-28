<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 1. Halaman depan langsung diarahkan ke inventaris
Route::get('/', function () {
    return redirect()->route('products.index');
});

// 2. yang bisa akses cuma yang sudah login
Route::middleware(['auth'])->group(function () {

    // Rute utama CRUD lu
    Route::resource('products', ProductController::class);

    // 3. Akali bawaan Breeze: kalau dia nyari /dashboard, belokin ke /products
    Route::get('/dashboard', function () {
        return redirect('/products');
    })->name('dashboard');
});

// 4. File routing bawaan Breeze (untuk sistem Login & Register)
require __DIR__ . '/auth.php';
