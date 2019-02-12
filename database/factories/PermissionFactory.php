<?php

$factory->define(App\Engine\Models\Permission::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
