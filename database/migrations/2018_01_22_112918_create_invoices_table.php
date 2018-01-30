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
            $table->string('issuer')->nullable();
            $table->integer('order_number')->nullable();
            $table->integer('delivery_permission_number')->nullable();
            $table->string('finance_check_out')->nullable()->default('لم يتم الاطلاع');
            $table->dateTime('release_date')->nullable();
            $table->text('descriptions')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('indexation_id')->unsigned()->nullable();
            $table->foreign('indexation_id')->references('id')->on('indexations')->onDelete('set null');
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
