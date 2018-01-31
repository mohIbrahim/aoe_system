<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('responsible_person_name')->nullable();
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('governorate')->nullable();
            $table->string('administration')->nullable();
            $table->string('department')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->integer('main_branch_id')->unsigned()->nullable();
            $table->foreign('main_branch_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
