<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Models\Site;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    protected $model = Site::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->text(5),
            'user_id' => (User::factory()->create())->id,
            'image' => "https://picsum.photos/id/{$this->faker->numberBetween(10,20)}/200/300.jpg",
        ];
    }
}
