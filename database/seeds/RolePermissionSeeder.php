<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'site owner']);
        $permission = Permission::make([
            'name' => 'sites',
        ]);
        $permission->saveOrFail();

        $permission->assignRole($role);
    }
}
