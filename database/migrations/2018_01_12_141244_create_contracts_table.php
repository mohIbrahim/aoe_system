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
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('status')->nullable();
            $table->float('price', 8, 2)->nullable()->default(0);
            $table->smallInteger('tax')->nullable()->default(0);
            $table->float('total_price', 8, 2)->nullable()->default(0);
            $table->string('payment_system')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('printing_machine_id')->unsigned()->nullable();
            $table->foreign('printing_machine_id')->references('id')->on('printing_machines')->onDelete('set null');

            $table->integer('employee_id_who_edits_the_contract')->unsigned()->nullable();
            $table->foreign('employee_id_who_edits_the_contract')->references('id')->on('employees')->onDelete('set null');
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
