<?php

namespace App\Http\Controllers;

use App\PayrollReport;
use App\TimeReport;
use App\TimeReportDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Http\File;

class TimeReportController extends Controller
{

    public function upload()
    {
        return view('time_report_upload');
    }

    public function processUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            //Step 1 : Validate file
            $fileName = $request->file('file')->getClientOriginalName();
            $report_no = substr($fileName, -6,2);
            $fileCheck = $this->validateFile($report_no);
            if($fileCheck){
                return response()->json(['data' => 'File already exist'], 400);
            }

            //Step 2: Save report meta data
            $id = TimeReport::create([
                'report_no' => $report_no,
                'name' => $fileName
            ])->id;

            //Step 3: Save raw report data & calculate and save payroll info
            $rawData = $this->parseCsv( $request);
            for($i=1; $i<sizeof($rawData); $i++){
                TimeReportDetail::create([
                    'time_report_id' =>$id,
                    'date' => $rawData[$i][0],
                    'hours_worked' =>$rawData[$i][1],
                    'employee_id' =>$rawData[$i][2],
                    'job_group' =>$rawData[$i][3]
                ]);
            }

            //Step 4: Calculate and save payroll report
            $payrollData = $this->calculatePayroll($rawData);
            foreach ($payrollData as $val){
                PayrollReport::create([
                    'employee_id' =>$val['employee_id'],
                    'start_date' => $val['start_date'],
                    'end_date' =>$val['end_date'],
                    'amount' =>$val['amount']
                ]);
            }// end foreach payroll save
            return response()->json(['data' => 'Data uploaded successfully'], 200);
        }
    }

    public function calculatePayroll($data)
    {
        $payDetails = [];
        for($i=1; $i<sizeof($data); $i++){

            $amount = 0;
            $day = Carbon::parse($data[$i][0])->format('d');
            $monthYear = Carbon::parse($data[$i][0])->format('M Y');
            $firstDate = new Carbon('First day of'. $monthYear);

            if(1<=$day && $day <=15){
                $startDate = $firstDate;
                $endDate = Carbon::parse($firstDate)->addDays(14);
            }else{
                $startDate = Carbon::parse($firstDate)->addDays(15);
                $endDate = new Carbon('Last day of'. $monthYear);
            }
            $amount += (float)$data[$i][1] * (int)(($data[$i][3] == 'A' )? 20 :30);

            //if key exists for a given record and pay period, dont create new record, instead update the record
            $key = $data[$i][2].'_'.$startDate->toDateString();
            if(array_key_exists($key, $payDetails)){
                $amount += $payDetails[$key]['amount'];
            }
            $payDetails[$key] = array(
                'start_date' =>$startDate,
                'end_date' =>$endDate,
                'employee_id' => $data[$i][2],
                'amount' => $amount
            );
        }//end for
        return $payDetails;
    }

    public function validateFile($report_no)
    {
        return TimeReport::where('report_no', $report_no)->exists();
    }

    public function parseCsv(Request $request)
    {
        //$file = $request->file('csv_file');
        $path = $request->file('file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }
        return $data;
    }

    /*public function store(Request $request)
    {
        $timeReport = TimeReport::create($request->all());

        return response()->json($timeReport, 201);
    }*/
}
