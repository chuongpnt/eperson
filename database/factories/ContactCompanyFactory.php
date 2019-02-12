<?php

$factory->define(App\Engine\Models\ContactCompany::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "address" => $faker->name,
        "website" => $faker->name,
        "email" => $faker->name,
    ];
});
