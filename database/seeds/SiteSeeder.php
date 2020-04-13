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
            'name' => 'my_first_site',
            'description' => 'A site xd',
        ]);

        Site::create([
            'name' => 'my_second_site',
            'description' => 'Another site xd',
        ]);
    }
}
