<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Food($faker));
    return [
        'title' => $faker->ingredient,
        'synopsis' => $faker->realText,
    ];
});
