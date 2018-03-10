<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceMalfunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_malfunctions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('malfunction_type')->nullable();
            $table->text('works_were_done')->nullable();
            $table->timestamps();
            
            $table->integer('reference_id')->unsigned()->nullable();
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reference_malfunctions');
    }
}
