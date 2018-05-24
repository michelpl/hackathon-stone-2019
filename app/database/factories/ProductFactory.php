<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(),
        'ean' => $faker->ean13,
        'price' => rand(10, 100)
    ];
});
