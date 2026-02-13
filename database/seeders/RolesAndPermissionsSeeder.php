<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Réinitialiser les rôles et permissions mis en cache
        app()["cache"]->forget('spatie.permission.cache');

        // Créer les permissions si elles n'existent pas
        $permissions = [
            'role-list', 'role-create', 'role-show', 'role-update', 'role-delete',
            'user-list', 'user-create', 'user-show', 'user-update', 'user-delete',
            'permission-list', 'permission-create', 'permission-show', 
            'permission-update', 'permission-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Créer ou mettre à jour les rôles avec leurs permissions
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions([
            'user-list', 'user-create', 'user-show', 'user-update', 'user-delete'
        ]);

        $visitor = Role::firstOrCreate(['name' => 'Visitor']);
        $visitor->syncPermissions(['user-list']);
    }
}
