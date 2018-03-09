<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowUpCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_up_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('contract_id')->unsigned()->nullable();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');

            $table->integer('printing_machine_id')->unsigned()->nullable();
            $table->foreign('printing_machine_id')->references('id')->on('printing_machines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_up_cards');
    }
}
