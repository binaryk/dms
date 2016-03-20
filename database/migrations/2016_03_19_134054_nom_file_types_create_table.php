<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NomFileTypesCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nom_file_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('categorie', 128);
            $table->string('extensie', 128);
            $table->timestamps();
            $table->softDeletes();
            // Add Foreign/Unique/Index
            $table->unique('extensie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nom_file_types', function (Blueprint $table) {
            $table->dropUnique('nom_file_types_extensie_unique');
        });

        Schema::drop('nom_file_types');
    }
}
