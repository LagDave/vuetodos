<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Todo::class, function (Faker $faker) {
    return [
        "title"=> $faker->text(30),
        "is_completed"=> mt_rand(0,1)
    ];
});
