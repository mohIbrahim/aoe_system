<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowUpCardSpecialReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_up_card_special_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('the_date')->nullable();
            $table->string('readings_of_printing_machine')->nullable();
            $table->string('indexation_number')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('the_payment')->nullable();
            $table->text('report')->nullable();
            $table->string('auditor_name')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_up_card_special_reports');
    }
}
