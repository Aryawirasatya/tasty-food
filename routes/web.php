<?php

use App\Http\Controllers\admin\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\TentangController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\BeritaController;

// ===================
// PUBLIC ROUTES
// ===================
Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
// Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
// Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
// Route::get('/berita', [BeritaController::class, 'index'])->name('berita');

// ===================
// ADMIN ROUTES
// ===================
Route::middleware(['auth','IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles',RoleController::class);

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================
// AUTH ROUTES (Breeze)
// ===================
require __DIR__.'/auth.php';
