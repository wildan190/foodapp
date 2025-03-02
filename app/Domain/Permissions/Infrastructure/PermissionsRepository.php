<?php

namespace App\Domain\Permissions\Infrastructure;

use App\Domain\Permissions\Domain\PermissionsEntity;
use App\Repositories\Interface\PermissionsRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Permission;

class PermissionsRepository implements PermissionsRepositoryInterface
{
    public function getAllPermissions(int $perPage): LengthAwarePaginator
    {
        return Permission::paginate($perPage);
    }

    public function createPermission(PermissionsEntity $permissionEntity): void
    {
        Permission::create(['name' => $permissionEntity->name]);
    }
}
