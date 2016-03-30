<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PsCreateTabelVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ps_vehicles', function(Blueprint $t){
            $t->increments('id');
            $t->string('location');
            $t->string('make');
            $t->string('model');
            $t->float('rental_price');
            $t->integer('year');
            $t->integer('mileage');
            $t->string('fuel_type');
            $t->string('vehicle_type');
            $t->tinyInteger('is_blocked')->default(0);
            $t->string('features');
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
        Schema::drop('ps_vehicles');
    }
}
