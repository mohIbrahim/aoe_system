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
            $table->string('recipient_of_the_printing_machine')->nullable();
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

            $table->integer('printing_machine_id')->unsigned()->nullable();
            $table->foreign('printing_machine_id')->references('id')->on('printing_machines')->onDelete('cascade');

            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
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
