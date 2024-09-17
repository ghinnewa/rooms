<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Spatie\Permission\Models\Role;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::findById(1);
        $role->syncPermissions(Permission::all());

        // Create a new user
        $user = ModelsUser::create([
            'name' => 'super admin | admin',
            'email' => 'admin@glucc.com',
            'password' => bcrypt('glucc2023glucc')
        ]);

        // Assign the 'super admin | admin' role to the user
        $user->assignRole($role);

    }
}
