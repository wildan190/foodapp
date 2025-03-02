<?php

namespace App\Domain\Permissions\Application;

use App\Repositories\Interface\PermissionsRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GetPermissions
{
    private PermissionsRepositoryInterface $permissionsRepository;

    public function __construct(PermissionsRepositoryInterface $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function execute(int $perPage = 10): LengthAwarePaginator
    {
        return $this->permissionsRepository->getAllPermissions($perPage);
    }
}
