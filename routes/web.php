<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ContactFormController;


use App\Http\Controllers\Admin\{
    DashboardController,
    TentangController,
    GaleriController,
    BeritaController,
    InformasiKontakController,
    RoleController,
    UserController,
    ProfileController
};
use App\Http\Controllers\Public\KontakController;


// ===================
// PUBLIC ROUTES
// ===================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirimPesan'])->name('kontak.kirim');
Route::delete('/kontak-pesan/{kontak_pesan}', [KontakController::class, 'destroy'])->name('kontak-pesan.destroy');


// (Aktifkan jika frontend sudah tersedia)
// Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
// Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
// Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
// Route::get('/berita', [BeritaController::class, 'index'])->name('berita');

// ===================
// ADMIN ROUTES
// ===================
Route::middleware(['auth', 'IsAdmin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tentang Kami
    Route::prefix('tentang')->name('tentang.')->group(function () {
        Route::get('/', [TentangController::class, 'index'])->name('index');
        Route::get('/edit', [TentangController::class, 'edit'])->name('edit');
        Route::put('/update', [TentangController::class, 'update'])->name('update');
    });

    // CRUD Galeri dan Berita
    Route::resource('galeri', GaleriController::class);
    Route::resource('berita', BeritaController::class)->parameters([
        'berita' => 'berita' // Force binding param name
    ]);

    Route::prefix('kontak')->name('kontak.')->group(function () {
    Route::get('/', [InformasiKontakController::class, 'index'])->name('index');
    Route::get('/edit', [InformasiKontakController::class, 'edit'])->name('edit');
    Route::put('/update', [InformasiKontakController::class, 'update'])->name('update');
});

    Route::resource('kontak-pesan', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);




    // Dummy form test
    Route::view('/test-form', 'test');
    Route::post('/debug-test', fn () => dd('Form berhasil terkirim'));

    // CRUD Role dan User (Khusus Superadmin)
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
// AUTH ROUTES (Breeze)
// ===================
require __DIR__ . '/auth.php';
