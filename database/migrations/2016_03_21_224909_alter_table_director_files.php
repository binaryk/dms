<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDirectorFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files',function(Blueprint $t){
            $t->string('location');
        });
        Schema::table('directors',function(Blueprint $t){
            $t->string('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files',function(Blueprint $t){
            $t->dropColumn(['location']);
        });
        Schema::table('directors',function(Blueprint $t){
            $t->dropColumn(['location']);
        });
    }
}
