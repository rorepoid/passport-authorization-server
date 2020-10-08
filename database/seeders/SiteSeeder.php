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
        $nat = User::where('username', 'nat')->first();
        $github = Site::create([
            'name' => 'Github',
            'description' => 'Github xd',
            'user_id' => optional($nat)->id ?? 1,
            'image' => 'https://kinsta.com/es/wp-content/uploads/sites/8/2018/05/qu%C3%A9-es-github-1.png',
        ]);

        $nobuo = User::where('username', 'nobuo')->first();
        $nico = Site::create([
            'name' => 'Nico Nico Douga',
            'description' => 'Japanese yt XD',
            'user_id' => optional($nobuo)->id ?? 1,
            'image' => 'https://vignette.wikia.nocookie.net/nico-nico-douga/images/2/2f/NND.jpg/revision/latest/scale-to-width-down/340?cb=20180623023209&path-prefix=es',
        ]);

        Site::factory()
                ->count(20)
                ->hasUsers(20)
                ->create();
    }
}
