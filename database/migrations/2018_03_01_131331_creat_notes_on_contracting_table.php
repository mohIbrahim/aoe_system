<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatNotesOnContractingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes_on_contracting', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('contract_id')->unsigned();
			$table->string('item_name')->nullable();
			$table->text('item_description')->nullable();
            $table->timestamps();
			
			$table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes_on_contracting');
    }
}
