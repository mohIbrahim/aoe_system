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
            $table->integer('indexation_id')->unsigned()->index();
            $table->integer('part_id')->unsigned()->index();
            $table->string('price')->nullable();
            $table->string('serial_number')->nullable();
            $table->timestamps();

            $table->primary(['indexation_id', 'part_id']);
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
