<?php

use Illuminate\Database\Seeder;
use App\Site;

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
            'image' => 'https://kinsta.com/es/wp-content/uploads/sites/8/2018/05/qu%C3%A9-es-github-1.png',
            ]);

            Site::create([
            'name' => 'Nico Nico Douga',
            'description' => 'Japanese yt XD',
            'image' => 'https://vignette.wikia.nocookie.net/nico-nico-douga/images/2/2f/NND.jpg/revision/latest/scale-to-width-down/340?cb=20180623023209&path-prefix=es',
        ]);
    }
}
