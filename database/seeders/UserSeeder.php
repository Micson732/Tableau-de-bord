<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Attendre que les rôles soient créés
    \App\Models\User::unguard();  // Désactiver temporairement la protection des attributs
    
    $superAdmin = \App\Models\User::firstOrCreate(
        ['email' => 'superadmin@example.com'],
        [
            'name' => 'Super Admin',
            'password' => Hash::make('superadmin123'),
        ]
    );
    
    $admin = \App\Models\User::firstOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
        ]
    );
    
    $visitor = \App\Models\User::firstOrCreate(
        ['email' => 'visitor@example.com'],
        [
            'name' => 'Visitor',
            'password' => Hash::make('visitor123'),
        ]
    );
    
    \App\Models\User::reguard();  // Réactiver la protection des attributs
    
    // Maintenant que les utilisateurs sont créés, on peut assigner les rôles
    $superAdmin->syncRoles(['Super Admin']);
    $admin->syncRoles(['Admin']);
    $visitor->syncRoles(['Visitor']);
}
}
