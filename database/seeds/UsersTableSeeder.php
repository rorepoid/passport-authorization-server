<?php

use Illuminate\Database\Seeder;
use App\User;

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

        factory(User::class, 100)->create();
    }
}
