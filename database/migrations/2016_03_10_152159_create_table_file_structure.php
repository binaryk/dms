<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFileStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_structure', function(Blueprint $t){
            $t->increments('id');

            $t->integer('parent_id')->nullable();
            $t->integer('lft')->nullable();
            $t->integer('rgt')->nullable();
            $t->integer('depth')->nullable();

            $t->string('name', 255);
            $t->string('path', 255);
            $t->string('type', 10);
            $t->integer('user_id');

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('files_structure');
    }
}
