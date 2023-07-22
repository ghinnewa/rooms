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
            'name' => 'System Admin',
            'email' => 'admin@glucc.com',
            'password' => bcrypt('glucc2023glucc')
        ]);

        // Assign the 'system admin' role to the user
        $user->assignRole($role);

    }
}
