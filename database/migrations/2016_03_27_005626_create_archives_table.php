<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('file_id');
            $table->string('name', 128);
            $table->string('description', 128);
            $table->string('version', 128);
            $table->integer('author');
            $table->integer('director')->comment('foreign');
            $table->text('path');
            $table->string('extention',20);
            $table->float('storage');
            $table->string('location');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('archives');
    }
}
