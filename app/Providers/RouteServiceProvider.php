<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Berita;


class RouteServiceProvider extends ServiceProvider
{   

    public const HOME ='/admin/dashboard';
    public function boot(): void
    {
        // Route untuk publik
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Route untuk API
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));


         Route::bind('berita', function ($value) {
        return request()->is('berita/*')
            ? \App\Models\Berita::where('slug', $value)->firstOrFail()
            : \App\Models\Berita::findOrFail($value);
    });
        // Route untuk admin
    }
}
