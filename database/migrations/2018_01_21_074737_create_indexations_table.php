<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indexations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->dateTime('the_date')->nullable();
            $table->string('customer_approval')->nullable();
            $table->string('technical_manager_approval')->nullable();
            $table->string('warehouse_approval')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('reference_id')->unsigned()->nullable();
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('set null');

            $table->integer('visit_id')->unsigned()->nullable();
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indexations');
    }
}
