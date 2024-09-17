<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Create or find the Super Admin role and assign all permissions
            $superAdminRole = Role::findOrCreate('super admin', 'web');
            $superAdminRole->syncPermissions(Permission::all()); // Grant all permissions
    
            // Create or find the Admin role
            $adminRole = Role::findOrCreate('admin', 'web');
    
            // Define permissions that Admin should NOT have (related to user management)
            $restrictedPermissions = [
                'users.create', // Permission to create users
                'users.edit',   // Permission to edit users
                'users.delete', // Permission to delete users
                'users.show',   // Permission to view users
                'users.index',  // Permission to list users
            ];
    
            // Get all permissions except the restricted ones for the Admin role
            $allowedPermissions = Permission::whereNotIn('name', $restrictedPermissions)->get();
    
            // Sync the allowed permissions with the Admin role
            $adminRole->syncPermissions($allowedPermissions);

      


     



    }
}
