<?php

namespace App\Imports;

use App\TimeReport;
use Maatwebsite\Excel\Concerns\ToModel;

class TimeReportImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TimeReport([
            //
        ]);
    }
}
