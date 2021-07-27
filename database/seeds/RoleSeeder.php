<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $config = Config::get('permission_list');
            // Initial Role
            collect($config['role'])->each(fn ($role) => Role::findOrCreate($role));

            // Initial Permission
            collect($config['permission_list'])
                ->each(function ($permissionGroup) {
                    $permission = collect($permissionGroup)
                        ->each(fn ($permission) => Permission::findOrCreate($permission,'web'));
                });

            foreach (collect($config['role']) as $role) {
                $find_role = Role::findByName($role);
                if ($find_role) {
                    $permission = $role === 'superadmin' ? Permission::all() : $config[$role];
                    $find_role->givePermissionTo($permission);
                }
            }
        } catch (\Exception $e) {
            $this->command->info('Role Failed to seed with reason : ' . $e);
        }
    }
}
