<?php

namespace App\Http\Controllers\Admin;
use App\Models\Permission;

use App\Http\Controllers\Controller;
use App\Models\permission as ModelsPermission;
use App\Models\Role;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {       
        

        $roles = Role::all();
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $permissions = Permission::all();
    $groupedPermissions = $permissions->groupBy(function ($permission) {
        return explode('_', $permission->name)[1] ?? 'lainnya';
    });
    return view('admin.roles.create', compact('groupedPermissions'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role created.');
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
    public function edit(Role $role)
{
    if ($role->name === 'superadmin') {
        return redirect()->route('admin.roles.index')->with('error', 'Role superadmin tidak bisa diedit atau dihapus.');
    }

    $permissions = Permission::all();
    $rolePermissions = $role->permissions->pluck('id')->toArray();

    return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
}


    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        
       

        $role->update(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {   
            if ($role->name === 'superadmin') {
        return redirect()->route('admin.roles.index')->with('error', 'Role superadmin tidak bisa diedit atau dihapus.');
    }

        $role->delete();
        return redirect()->route('admin.roles.index')->with('success','Role deleted.');
    }
}
