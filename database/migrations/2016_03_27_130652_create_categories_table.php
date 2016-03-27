<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nom_categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('denumire', 128);
            $table->timestamps();
            $table->softDeletes();
            $table->unique('denumire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nom_categories');
    }
}
