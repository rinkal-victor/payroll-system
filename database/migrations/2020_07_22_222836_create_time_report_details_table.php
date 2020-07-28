<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeReportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_report_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_report_id');
            $table->date('date');
            $table->bigInteger('hours_worked');
            $table->bigInteger('employee_id');
            $table->string('job_group');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_report_details');
    }
}
