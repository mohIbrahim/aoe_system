<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ['code', 'type', 'start', 'end', 'status', 'price', 'tax', 'total_price', 'payment_system', 'comments'];
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('type');

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
        Schema::dropIfExists('contracts');
    }
}
