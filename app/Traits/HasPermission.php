<?php

namespace App\Traits;

use App\Models\Permission;

namespace App\Traits;

trait HasPermission
{
    public function hasPermission(string $permissionName): bool
    {
        if ($this->isSuperAdmin()) return true;

        return $this->role
            && $this->role->permissions
            && $this->role->permissions->contains('name', $permissionName);
    }
}
