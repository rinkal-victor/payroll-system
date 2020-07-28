<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayrollReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'payrollReport' => [
                'employeeReports' => [
                    'employeeId' => $this->employee_id,
                    'payPeriod'=> [
                        'startDate' => $this->start_date,
                        'endDate' => $this->end_date,
                    ],
                    'amountPaid' => $this->amount,
                ]
            ]
        ];
    }
}
