<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\GaleriController as PublicGaleriController;
use App\Http\Controllers\Public\TentangController as PublicTentangController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\BeritaController as PublicBeritaController;
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

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tentang Kami
Route::get('/tentang', [PublicTentangController::class, 'index'])->name('public.tentang');

// Galeri
Route::get('/galeri', [PublicGaleriController::class, 'index'])->name('public.galeri');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirimPesan'])->name('kontak.kirim');

// Berita
Route::get('/berita', [PublicBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [PublicBeritaController::class, 'show'])->name('berita.show');


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
    
Route::resource('berita', BeritaController::class);



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

    // User & Role (Hanya Superadmin)
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
