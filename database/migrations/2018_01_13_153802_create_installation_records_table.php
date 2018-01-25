<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallationRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installation_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trainee_name')->nullable();
            $table->dateTime('installation_date')->nullable();

            $table->string('feeder_model')->nullable();
            $table->string('feeder_serial_number')->nullable();
            $table->string('feeder_product_key')->nullable();

            $table->string('finisher_model')->nullable();
            $table->string('finisher_serial_number')->nullable();
            $table->string('finisher_product_key')->nullable();

            $table->string('hard_disk_model')->nullable();
            $table->string('hard_disk_serial_number')->nullable();
            $table->string('hard_disk_product_key')->nullable();

            $table->string('paper_drawer_model')->nullable();
            $table->string('paper_drawer_serial_number')->nullable();
            $table->string('paper_drawer_product_key')->nullable();

            $table->string('network_scanner_model')->nullable();
            $table->string('network_scanner_serial_number')->nullable();
            $table->string('network_scanner_product_key')->nullable();

            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('contract_of_guarantee_id')->unsigned()->nullable();
            $table->foreign('contract_of_guarantee_id')->references('id')->on('contracts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installation_records');
    }
}
