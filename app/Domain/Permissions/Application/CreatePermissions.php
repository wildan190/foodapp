<?php

namespace App\Domain\Permissions\Application;

use App\Domain\Permissions\Domain\PermissionsEntity;
use App\Repositories\Interface\PermissionsRepositoryInterface;

class CreatePermissions
{
    private PermissionsRepositoryInterface $permissionsRepository;

    public function __construct(PermissionsRepositoryInterface $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function execute(PermissionsEntity $permissionEntity): void
    {
        $this->permissionsRepository->createPermission($permissionEntity);
    }
}
