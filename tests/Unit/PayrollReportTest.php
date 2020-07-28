<?php

namespace Tests\Unit;

use App\PayrollReport;
use Tests\TestCase;
use Faker\Factory;

class PayrollReportTest extends TestCase
{
    public function test_can_list_payroll() {

        factory(PayrollReport::class)->create([
            'employee_id' => '1',
            'start_date' => '2020-01-01',
            'end_date' => '2020-01-15',
            'amount' => '300.00'
        ]);

        factory(PayrollReport::class)->create([
            'employee_id' => '1',
            'start_date' => '2020-01-16',
            'end_date' => '2020-01-31',
            'amount' => '80.00'
        ]);

        $this->withoutExceptionHandling();
        $response = $this->json('GET', 'api/payrollReport')
            ->assertStatus(200)
            ->assertJson(
                [
                    'payrollReport' => [
                        'employeeReports' => [
                            'employeeId' => '1',
                            'payPeriod'=> [
                                'startDate' => '2020-01-01',
                                'endDate' => '2020-01-15',
                            ],
                            'amountPaid' => '300.00',
                        ]
                    ]
                ],
                [
                    'payrollReport' => [
                        'employeeReports' => [
                            'employeeId' => '1',
                            'payPeriod'=> [
                                'startDate' => '2020-01-16',
                                'endDate' => '2020-01-31',
                            ],
                            'amountPaid' => '80.00'
                        ]
                    ]
                ]
            )
            ->assertJsonStructure([
                '*' => ['employee_id', 'start_date', 'end_date', 'amount'],
            ]);
    }
}
