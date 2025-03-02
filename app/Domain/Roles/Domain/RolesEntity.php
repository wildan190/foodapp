<?php

namespace App\Domain\Roles\Domain;

class RolesEntity
{
    public string $name;

    public array $permissions;

    public function __construct(string $name, array $permissions = [])
    {
        $this->name = $name;
        $this->permissions = $permissions;
    }
}
