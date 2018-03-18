<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->nullable();
            $table->string('type')->nullable();
            $table->string('issuer')->nullable();
            $table->integer('order_number')->nullable();
            $table->integer('delivery_permission_number')->nullable();
            $table->string('finance_check_out')->nullable()->default('لم يتم الاطلاع');
            $table->dateTime('release_date')->nullable();
            $table->text('descriptions')->nullable();
            $table->float('total', 10, 2)->nullable()->default(0);
            $table->text('comments')->nullable();
            $table->string('collect_date')->nullable();
            $table->string('collector_employee_name')->nullable();
            $table->timestamps();

            $table->integer('indexation_id')->unsigned()->nullable();
            $table->foreign('indexation_id')->references('id')->on('indexations')->onDelete('set null');

            $table->integer('contract_id')->unsigned()->nullable();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');

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
        Schema::dropIfExists('invoices');
    }
}
