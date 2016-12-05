<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')
              ->references('id')->on('subcategories')
              ->onDelete('cascade');
            $table->string('name');
            $table->string('rate');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('address');
            $table->string('thumbnail');
            $table->string('working_from');
            $table->string('working_to');
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
        Schema::drop('places');
    }
}
