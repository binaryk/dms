<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PsUserAccountsCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ps_user_account', function(Blueprint $t){
            $t->increments('id');
            $t->string('identification_number');
            $t->string('type');
            $t->float('amount_money');
            $t->integer('user_id');
            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ps_user_account');
    }
}
