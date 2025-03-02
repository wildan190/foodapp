<?php

namespace App\Domain\Permissions\Domain;

class PermissionsEntity
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
