<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
{
    $this->registerPolicies();

    // ✅ Superadmin bisa akses semua permission
    Gate::before(function ($user, $ability) {
        return $user->isSuperAdmin() ? true : null;
    });

    // ✅ Register semua permission dari tabel
    try {
        foreach (\App\Models\Permission::all() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission->name);
            });
        }
    } catch (\Throwable $e) {
        // Boleh kosong, untuk proses seeding
    }
}

}
