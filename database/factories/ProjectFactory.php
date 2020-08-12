<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'status' => $faker->randomElement([
            'planned',
            'running',
            'on hold',
            'finished',
            'cancel'
        ]),
    ];
});
