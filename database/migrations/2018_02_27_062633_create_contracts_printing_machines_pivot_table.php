<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsPrintingMachinesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_printing_machine', function (Blueprint $table) {
            $table->integer('contract_id')->unsigned()->index();
			$table->integer('p_machine_id')->unsigned()->index();
			$table->primary(['contract_id', 'p_machine_id']);

			$table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
			$table->foreign('p_machine_id')->references('id')->on('printing_machines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_printing_machine');
    }
}
