<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RolePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read Permission,admin'])->only('index');
        $this->middleware(['permission:Create Permission,admin'])->only('create', 'store');
        $this->middleware(['permission:Update Permission,admin'])->only('edit', 'update');
        $this->middleware(['permission:Delete Permission,admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        $title = 'Delete Role!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('group_name');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolePermissionRequest $request)
    {
        // Create the role
        $role = Role::create(
            [
                'name' => $request->role,
                'guard_name' => 'admin'
            ]
        );

        // Assign permissions to the role
        $role->syncPermissions($request->permissions);

        toast(__('backend.Role created successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::all()->groupBy('group_name');
        $role = Role::findOrFail($id);
        $rolesPermissions = $role->permissions;
        $rolesPermissions = $rolesPermissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('permissions', 'role', 'rolesPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolePermissionRequest $request, string $id)
    {
        // Update the role
        $role = Role::findOrFail($id);
        $role->update(
            [
                'name' => $request->role,
                'guard_name' => 'admin'
            ]
        );

        // Assign permissions to the role
        $role->syncPermissions($request->permissions);

        toast(__('backend.Role updated successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            if($role->name === 'Administrator') {
                toast(__('backend.Administrator cannot be deleted'), 'error')->width('350')->timerProgressBar();
            } else {
                $role->delete();

                toast(__('backend.Role deleted successfully'), 'success')->width('350')->timerProgressBar();
            }
        } catch (\Throwable $th) {
            toast(__('backend.Role deleted error'), 'error')->width('350')->timerProgressBar();
        }

        return redirect()->route('admin.roles.index');
    }
}
