<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayrollReportResource;
use App\PayrollReport;
use Illuminate\Http\Request;

class PayrollReportController extends Controller
{
    public function index()
    {

        return PayrollReportResource::collection(PayrollReport::all()->sortBy('employee_id'));
    }
}
