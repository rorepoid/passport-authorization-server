<?php

use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SiteSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SiteSeeder::class);
    }
}
