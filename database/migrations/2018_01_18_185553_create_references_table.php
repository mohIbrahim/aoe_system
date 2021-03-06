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
            $table->string('status')->nullable()->nullable();
            $table->dateTime('received_date')->nullable();
            $table->dateTime('closing_date')->nullable();
            $table->string('readings_of_printing_machine')->nullable();
            $table->text('comments')->nullable();
            $table->string('informer_name')->nullable();
            $table->string('informer_phone')->nullable();
            $table->string('reviewed_by_the_chief_engineer')->nullable();
            $table->timestamps();

            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');

            $table->integer('employee_id_who_receive_the_reference')->unsigned()->nullable();
            $table->foreign('employee_id_who_receive_the_reference')->references('id')->on('employees')->onDelete('set null');

            $table->integer('printing_machine_id')->unsigned()->nullable();
            $table->foreign('printing_machine_id')->references('id')->on('printing_machines')->onDelete('set null');
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
