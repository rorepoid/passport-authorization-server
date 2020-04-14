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
        User::create([
            'username' => 'john_doe',
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('secret'),
        ]);
        User::create([
            'username' => 'nat',
            'name' => 'Nat Friedman',
            'email' => 'nat@github.com',
            'password' => bcrypt('secret'),
        ]);
        User::create([
            'username' => 'nobuo',
            'name' => 'Nobuo Kawakami',
            'email' => 'nobuo@niconico.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
