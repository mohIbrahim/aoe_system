<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->dateTime('visit_date');
            $table->string('representative_customer_name')->nullable();
            $table->bigInteger('readings_of_printing_machine')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('printing_machine_id')->unsigned();
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
        Schema::dropIfExists('visits');
    }
}
