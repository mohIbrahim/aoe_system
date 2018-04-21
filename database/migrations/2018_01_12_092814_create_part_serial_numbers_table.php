<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartSerialNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_serial_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('part_id')->unsigned();
            $table->string('serial_number');
            $table->string('code')->nullable();
            $table->string('availability')->nullable()->default('متوفرة');
            $table->string('status')->nullable()->default('جديدة');
            $table->dateTime('production_date')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->dateTime('date_of_entry')->nullable();
            $table->dateTime('date_of_departure')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('part_serial_numbers');
    }
}
