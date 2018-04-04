<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('is_serialized')->nullable();
            $table->text('compatible_printing_machines')->nullable();
            $table->text('location_in_warehouse')->nullable();
            $table->string('part_number')->nullable();
            $table->dateTime('production_date')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->string('product_number')->nullable();
            $table->float('price_without_tax', 8, 2)->nullable()->default(0);
            $table->float('price_with_tax', 8, 2)->nullable()->default(0);
            $table->integer('life')->nullable()->default(0);
            $table->integer('qty')->nullable()->default(0);
            $table->integer('no_serial_qty')->nullable()->default(0);
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
        Schema::dropIfExists('parts');
    }
}
