<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePrintingMachinePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_mach_assignments', function (Blueprint $table) {
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('printing_machine_id')->unsigned()->index();
            $table->timestamps();
            $table->primary(['employee_id', 'printing_machine_id']);

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('printing_machine_id')->references('id')->on('printing_machines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_mach_assignments');
    }
}
