<?php

namespace App\Domain\Roles\Infrastructure;

use App\Domain\Roles\Domain\RolesEntity;
use App\Repositories\Interface\RolesRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesRepository implements RolesRepositoryInterface
{
    public function getAllRoles(int $perPage): LengthAwarePaginator
    {
        return Role::paginate($perPage);
    }

    public function createRole(RolesEntity $roleEntity): void
    {
        $role = Role::create(['name' => $roleEntity->name]);

        if (! empty($roleEntity->permissions)) {
            $permissions = Permission::whereIn('id', $roleEntity->permissions)->get();
            $role->syncPermissions($permissions);
        }
    }
}
