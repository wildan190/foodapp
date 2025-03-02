<?php

namespace App\Domain\Roles\Application;

use App\Domain\Roles\Domain\RolesEntity;
use App\Repositories\Interface\RolesRepositoryInterface;

class CreateRoles
{
    private RolesRepositoryInterface $rolesRepository;

    public function __construct(RolesRepositoryInterface $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public function execute(RolesEntity $roleEntity): void
    {
        $this->rolesRepository->createRole($roleEntity);
    }
}
