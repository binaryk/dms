<?php

Route::group(['namespace' => 'PS'], function () {

    Route::get('vehicles', 'VehiclesController@getGrid')
        ->name('ps.vehicles.index');

    Route::post('vehicles-source', 'VehiclesController@dataSource')
        ->name('ps.vehicles.data-source');

    /*
     * Sa se incarce formularul de actiun (actions form)
     */
    Route::post('vehicles-get-action-form/{action}/{id?}', 'VehiclesController@getActionForm')
        ->name('ps.vehicles.get-action-form');

    /*
     * ce se intampla la Adauga/Salveaza/Sterge
     */
    Route::post('vehicles-action/{action}/{id?}', 'VehiclesController@doAction')
        ->name('ps.vehicles-do-action');
});