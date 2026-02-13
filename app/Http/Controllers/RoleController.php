<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * with('users')->get()
     */
    
    public function index()
    {
        $roles= Role::all();

        return view('dashboard.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        $permissions = Permission::whereIn('id', $request-> input('permission'))->get();

        foreach ($permissions as $permission) {
            $role->syncPermissions($permission);
        }
        
        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        $rolePermissions = $role->permissions->pluck('name');
        return view('dashboard.role.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('dashboard.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,id',
        ]);

        // Récupération du rôle
        $role = Role::findOrFail($id);
        
        // Mise à jour du nom du rôle
        $role->update([
            'name' => $request->input('name'),
            'guard_name' => 'web'
        ]);

        // Nettoyage du cache des permissions
        app()["cache"]->forget('spatie.permission.cache');
        
        // Mise à jour des permissions
        $permissionIds = $request->input('permission', []);
        $permissions = Permission::whereIn('id', $permissionIds)->get();
        $role->syncPermissions($permissions);
        
        return redirect()
            ->route('role.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $permissions =Permission::all();

        foreach ($permissions as $permission) {
            
            $role->revokePermissionTo($permission);
        }
        Role::where('id', $id)->delete();
        return redirect()->route('role.index')->with('warning', 'Role deleted successfully.');
    }
}
