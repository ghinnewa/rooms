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
        $role =Role::findOrCreate('admin','web');
        $role->syncPermissions(Permission::all());
        $role =Role::findOrCreate('data_entry','web');
        $role->syncPermissions(['cards show', 'cards index',]);


    }
}
