<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Ingredient;

$factory->define(Ingredient::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Food($faker));
    return [
        'title' => $faker->ingredient,
        'unit' => $faker->measurement,
    ];
});
