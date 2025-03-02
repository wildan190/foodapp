<?php

namespace App\Http\Controllers;

use App\Domain\Roles\Application\CreateRoles;
use App\Domain\Roles\Application\GetRoles;
use App\Domain\Roles\Domain\RolesEntity;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    private GetRoles $getRoles;

    private CreateRoles $createRoles;

    public function __construct(GetRoles $getRoles, CreateRoles $createRoles)
    {
        $this->getRoles = $getRoles;
        $this->createRoles = $createRoles;
    }

    public function index()
    {
        $roles = $this->getRoles->execute(10);

        return view('pages.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('pages.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $roleEntity = new RolesEntity(
            $request->name,
            $request->permissions ?? []
        );

        $this->createRoles->execute($roleEntity);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }
}
