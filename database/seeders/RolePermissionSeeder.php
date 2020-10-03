<?php

namespace Database\Seeders;

use App\Models\User;
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
        Role::create(['name' => 'Super Admin']);

        $role = Role::create(['name' => 'site owner']);
        $permission = Permission::make([
            'name' => 'sites',
        ]);
        $permission->saveOrFail();

        $permission->assignRole($role);
    }
}
