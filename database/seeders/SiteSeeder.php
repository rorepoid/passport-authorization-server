<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;
use App\Models\User;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'name' => 'Github',
            'description' => 'Github xd',
            'user_id' => optional(User::where('username', 'nat')->first(), function ($user) {
                return $user->id;
            }) ?? 1,
            'image' => 'https://kinsta.com/es/wp-content/uploads/sites/8/2018/05/qu%C3%A9-es-github-1.png',
            ]);

            Site::create([
            'name' => 'Nico Nico Douga',
            'description' => 'Japanese yt XD',
            'user_id' => optional(User::where('username', 'nobuo')->first(), function ($user) {
                return $user->id;
            }) ?? 1,
            'image' => 'https://vignette.wikia.nocookie.net/nico-nico-douga/images/2/2f/NND.jpg/revision/latest/scale-to-width-down/340?cb=20180623023209&path-prefix=es',
        ]);

        factory(Site::class, 20)->create();
    }
}
