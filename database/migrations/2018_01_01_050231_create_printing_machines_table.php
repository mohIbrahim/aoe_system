<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintingMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_machines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('folder_number')->nullable();
            $table->string('status')->nullable();
            $table->string('the_manufacture_company')->nullable();
            $table->string('model_prefix')->nullable();
            $table->string('model_suffix')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('product_key')->nullable();
            $table->string('manufacturing_year')->nullable();
            $table->text('description')->nullable();
            $table->float('price_without_tax', 10, 2)->nullable()->default(0);
            $table->float('price_with_tax', 10, 2)->nullable()->default(0);
            $table->boolean('is_sold_by_aoe')->nullable()->default(0);
			$table->string('employee_delivered_the_machine')->nullable();
			$table->string('feeder_model')->nullable();
			$table->string('finisher_model')->nullable();
			$table->string('hard_disk_model')->nullable();
			$table->string('paper_drawer_model')->nullable();
			$table->string('network_scanner_model')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printing_machines');
    }
}
