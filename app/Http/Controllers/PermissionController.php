<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $permission = permission::create(['name' => $request->input('name'),'guard_name'=>'web']);
        return redirect()->route('permission.index')->with('success', 'Permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
        return view('dashboard.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);
        $permission->update(['name' => $request->input('name'),'guard_name'=>'web']);
        return redirect()->route('permission.index')->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('success', 'Permission deleted successfully');
    }

    public function rolePermissions(Request $request)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('dashboard.permission.role-permission', compact('roles', 'permissions'));
    }

    public function syncPermissions(Request $request)
    {
        $request->validate([
            'permissions.*' => 'array',
        ]);

        $roles = Role::all();
        
        foreach ($roles as $role) {
            $permissions = $request->input("permissions.{$role->name}", []);
            $role->syncPermissions($permissions);
        }

        return redirect()->route('role-permission')
            ->with('success', 'Permissions synchronisées avec succès');
    }
}
