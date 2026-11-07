<?php

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Halaman Beranda (Katalog Layanan Dikelompokkan Per Kategori)
Route::get('/', [ServiceController::class, 'index'])->name('home');

// Halaman Detail Layanan dengan Formulir Pemesanan
Route::get('/layanan/{service}', [ServiceController::class, 'show'])->name('services.show');

// Route Khusus Pengguna Login (Pelanggan)
Route::middleware('auth')->group(function () {
    Route::post('/layanan/{service}/pesan', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/layanan/{service}', [OrderController::class, 'store']);
    Route::get('/pesanan-saya', [OrderController::class, 'index'])->name('orders.my');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Khusus Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('services', AdminServiceController::class);
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__.'/auth.php';
