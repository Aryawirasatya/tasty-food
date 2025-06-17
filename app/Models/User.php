<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_superadmin',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_superadmin' => 'boolean',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role && $this->role->permissions->isNotEmpty();
    }

    public function isSuperAdmin()
{
    return (bool) $this->is_superadmin;
}


    public function canAkses(string $permissionName): bool
{
    // Kalau superadmin, langsung true tanpa cek apapun lagi
    if ($this->isSuperAdmin()) {
        return true;
    }

    // Cek role dan permission
    return $this->role?->permissions?->contains('name', $permissionName) ?? false;
}


    public function hasPermission(string $permissionName): bool
{
    return $this->role
        && $this->role->permissions
        && $this->role->permissions->contains('name', $permissionName);
}


}
