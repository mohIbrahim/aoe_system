<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallationRecordOtherItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_r_other_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('installation_record_id')->unsigned()->nullable();
            $table->string('item_name')->nullable();
            $table->text('item_description')->nullable();
            $table->timestamps();

            $table->foreign('installation_record_id')->references('id')->on('installation_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_r_other_items');
    }
}
