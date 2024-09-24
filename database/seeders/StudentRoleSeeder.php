<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StudentRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the student role
        $studentRole = Role::create(['name' => 'student']);

        // Define the permissions you want to assign to the student role
        $permissions = [
      'examSchedules.index',
      'login',
      'regester',
      'logout',
      'dashboard',
      'password.request',
      'password.email',
      'password.reset',
      'password.update',
      'password.confirm',
      'home',
      'users.show',
      'cards.edit',
      'users.edit',
      'users.update',
      'cards.show',
      'cards.edit',
      'cards.create',
      'cards.update',
      'cards.store',
      'examScheduleItems.index'

        ];

        // Create and assign permissions to the student role
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $studentRole->givePermissionTo($permission);
        }
    }
}
