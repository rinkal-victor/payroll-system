<?php

/** @var Factory $factory */

//use App\PayrollReports;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(App\PayrollReport::class, function (Faker $faker) {
    return [
        'employee_id' => $faker->numberBetween(1,100),
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'amount' => $faker->numberBetween(1000,2000),
    ];
});
