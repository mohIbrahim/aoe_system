<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexationPartPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indexation_part', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indexation_id')->unsigned()->index();
            $table->integer('part_id')->unsigned()->index();
            $table->float('price', 10, 2)->nullable();
            $table->string('serial_number')->nullable();
            $table->integer('number_of_parts')->nullable();
            $table->integer('discount_rate')->nullable();
            $table->timestamps();
            
            $table->foreign('indexation_id')->references('id')->on('indexations')->onDelete('cascade');
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indexation_part');
    }
}
