<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TimeReport extends Model
{
    protected $fillable = ['report_no', 'name'];

    public function timeReportDetails()
    {
        return $this->hasMany('App\TimeReportDetail');
    }
    public function validateReport($fileName)
    {
        //$record =  DB::table('user')->find(1);
    }
}
