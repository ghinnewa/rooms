<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreatePermissionsFromRoutes extends Command
{
    protected $signature = 'permissions:create-from-routes';

    protected $description = 'Create permissions based on routes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $name = $route->getName();

            if ($name) {
                // Create the permission if it doesn't exist
                $permission = Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
                $this->info('Created/Updated permission: ' . $name);
            }
        }

        $this->info('Permissions created/updated successfully.');
    }
}
