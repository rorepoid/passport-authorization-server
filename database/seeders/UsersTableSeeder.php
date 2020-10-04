<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $john = User::create([
            'username' => 'john_doe',
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('secret'),
        ]);
        $nat = User::create([
            'username' => 'nat',
            'name' => 'Nat Friedman',
            'email' => 'nat@github.com',
            'password' => bcrypt('secret'),
        ]);
        $nobuo = User::create([
            'username' => 'nobuo',
            'name' => 'Nobuo Kawakami',
            'email' => 'nobuo@niconico.com',
            'password' => bcrypt('secret'),
        ]);

        $john->assignRole('Super Admin');
        $nat->givePermissionTo('sites');
        $nobuo->givePermissionTo('sites');

        User::factory()->create();
    }
}
