<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingOfPrintingMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_of_printing_machines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value')->nullable();
            $table->datetime('reading_date')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('visit_id')->unsigned()->nullable();
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reading_of_printing_machines');
    }
}
