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
