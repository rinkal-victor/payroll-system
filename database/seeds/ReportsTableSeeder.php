<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Report::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few reports in our database:
        for ($i = 0; $i < 25; $i++) {
            Report::create([
                'employeeId' => $faker->numberBetween(1,100),
                'startDate' => $faker->date(),
                'endDate' => $faker->date(),
                'amount' => $faker->numberBetween(1000,2000),
            ]);
        }
    }
}
