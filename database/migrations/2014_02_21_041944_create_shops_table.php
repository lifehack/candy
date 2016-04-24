<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{

    /**
     * Create the table for the packages.
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function ($table) {
            $table->increments('id');
            $table->string('shop_name');
            $table->string('shop_tel');
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
        Schema::drop('shops');
    }

}
