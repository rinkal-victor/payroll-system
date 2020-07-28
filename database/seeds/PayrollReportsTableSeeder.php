<?php

use Illuminate\Database\Seeder;
use App\PayrollReport;

class PayrollReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        PayrollReport::truncate();

        $faker = \Faker\Factory::create();


        // And now, let's create a few reports in our database:
        for ($i = 0; $i < 25; $i++) {
            PayrollReport::create([
                'employee_id' => $faker->numberBetween(1,100),
                'start_date' => $faker->date(),
                'end_date' => $faker->date(),
                'amount' => $faker->numberBetween(1000,2000),
            ]);
        }
    }
}
