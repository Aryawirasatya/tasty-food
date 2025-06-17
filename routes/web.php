<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Admin\{
    DashboardController,
    TentangController,
    GaleriController,
    BeritaController,
    InformasiKontakController,
    RoleController,
    UserController,
    ProfileController,
    ContactMessageController
};

// ===================
// PUBLIC ROUTES
// ===================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirimPesan'])->name('kontak.kirim');
Route::delete('/kontak-pesan/{kontak_pesan}', [KontakController::class, 'destroy'])->name('kontak-pesan.destroy');

// ===================
// ADMIN ROUTES
// ===================
Route::middleware(['auth', 'IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tentang Kami
    Route::prefix('tentang')->name('tentang.')->group(function () {
        Route::get('/', [TentangController::class, 'index'])->name('index');
        Route::get('/edit', [TentangController::class, 'edit'])->name('edit');
        Route::put('/update', [TentangController::class, 'update'])->name('update');
    });

    // Galeri
    Route::resource('galeri', GaleriController::class);

    // Berita
    Route::resource('berita', BeritaController::class)->parameters([
        'berita' => 'berita'
    ]);

    // Informasi Kontak
    Route::prefix('kontak')->name('kontak.')->group(function () {
        Route::get('/', [InformasiKontakController::class, 'index'])->name('index');
        Route::get('/edit', [InformasiKontakController::class, 'edit'])->name('edit');
        Route::put('/update', [InformasiKontakController::class, 'update'])->name('update');
    });

    // Pesan Kontak
    Route::resource('kontak-pesan', ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Dummy Test
    Route::view('/test-form', 'test');
    Route::post('/debug-test', fn () => dd('Form berhasil terkirim'));

    // Manajemen User & Role (Superadmin Only)
    Route::middleware('IsSuperAdmin')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });

    // Profile (Opsional)
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================
// AUTH ROUTES (Laravel Breeze)
// ===================
require __DIR__ . '/auth.php';
