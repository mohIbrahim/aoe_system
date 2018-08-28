<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPerformedEmployeeIdToIndexationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indexations', function (Blueprint $table) {
            $table->integer('performed_employee_id')->unsigned()->nullable();
            $table->foreign('performed_employee_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indexations', function (Blueprint $table) {
            $table->dropForeign('indexations_performed_employee_id_foreign');
            $table->dropColumn('performed_employee_id');
        });
    }
}
