<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('notebook_number')->nullable();
            $table->string('type')->nullable();
            $table->dateTime('received_date')->nullable();
            $table->text('malfunctions_type')->nullable();
            $table->text('works_done_on_the_machine')->nullable();
            $table->string('readings_of_printing_machine')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('references');
    }
}
