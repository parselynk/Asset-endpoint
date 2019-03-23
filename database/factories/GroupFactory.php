<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence
    ];
});

$factory->afterCreating(App\Group::class, function ($group, $faker) {
    $group->users()->attach(factory(App\User::class, rand(1, 5))->create());
});


$factory->afterCreating(App\Group::class, function ($group, $faker) {
    $group->assets()->attach(factory(App\Asset::class, rand(2, 5))->create());
});
