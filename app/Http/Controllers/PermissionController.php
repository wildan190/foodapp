<?php

namespace App\Http\Controllers;

use App\Domain\Permissions\Application\CreatePermissions;
use App\Domain\Permissions\Application\GetPermissions;
use App\Domain\Permissions\Domain\PermissionsEntity;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private GetPermissions $getPermissions;

    private CreatePermissions $createPermissions;

    public function __construct(GetPermissions $getPermissions, CreatePermissions $createPermissions)
    {
        $this->getPermissions = $getPermissions;
        $this->createPermissions = $createPermissions;
    }

    public function index()
    {
        $permissions = $this->getPermissions->execute(10);

        return view('pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('pages.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        $permissionEntity = new PermissionsEntity($request->name);
        $this->createPermissions->execute($permissionEntity);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }
}
