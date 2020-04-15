<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Site;
use Faker\Generator as Faker;

$factory->define(Site::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text(5),
        'image' => "https://i.picsum.photos/id/{$faker->numberBetween(10,20)}/200/300.jpg",
    ];
});
