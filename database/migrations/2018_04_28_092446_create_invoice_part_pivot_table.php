<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePartPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_part', function (Blueprint $table) {
            $table->integer('invoice_id')->unsigned();
            $table->integer('part_id')->unsigned();
            $table->primary(['invoice_id', 'part_id']);

            $table->text('printing_machines_serial')->nullable();
            $table->float('price', 10,2)->nullable();
            $table->string('part_serial_number')->nullable();
            $table->smallInteger('number_of_parts')->nullable();
            $table->smallInteger('discount_rate')->nullable();

            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
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
        Schema::dropIfExists('invoice_part');
    }
}
