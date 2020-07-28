<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeReportDetail extends Model
{
    protected $fillable = ['time_report_id', 'date', 'hours_worked', 'employee_id', 'job_group'];

    public function timeReport()
    {
        return $this->belongsTo('App\TimeReport');
    }
}
