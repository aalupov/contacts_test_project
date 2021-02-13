<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contacts;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Contacts::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
