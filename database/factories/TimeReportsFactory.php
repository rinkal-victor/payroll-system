<?php

/** @var Factory $factory */

use App\TimeReports;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(App\TimeReports::class, function (Faker $faker) {
    return [
            'report_no' => $faker->unique(),
            'name' => $faker->unique(),
    ];
});
