<?php

Route::group(['namespace' => 'PS'], function () {

    Route::get('parsator', 'ParsatorController@index')
        ->name('ps.parsator.index');

    Route::get('parsator-report', 'ParsatorController@report')
        ->name('ps.parsator.report');

    Route::get('parsator-report-user-json', 'ParsatorController@user_json')
        ->name('ps.parsator.report.user_json');

    Route::get('parsator-report-user-xml', 'ParsatorController@user_xml')
        ->name('ps.parsator.report.user_xml');

        Route::get('parsator-report-vehicle-json', 'ParsatorController@vehicle_json')
        ->name('ps.parsator.report.vehicle_json');

    Route::get('parsator-report-vehicle-xml', 'ParsatorController@vehicle_xml')
        ->name('ps.parsator.report.vehicle_xml');

    Route::get('parsator-report-vehicle-reserved', 'ParsatorController@reserved')
        ->name('ps.parsator.report.reserved');

    Route::get('parsator-report-vehicle-reserved-email', 'ParsatorController@reserved_email')
        ->name('ps.parsator.report.reserved_email');

    Route::post('parsator-upload-xml', 'ParsatorController@uploadxml')
        ->name('ps.parsator.uploadxml');

//    Route::post('parsator-source', 'ParsatorController@dataSource')
//        ->name('ps.parsator.data-source');
//
//    /*
//     * Sa se incarce formularul de actiun (actions form)
//     */
//    Route::post('parsator-get-action-form/{action}/{id?}', 'ParsatorController@getActionForm')
//        ->name('ps.parsator.get-action-form');
//
//    /*
//     * ce se intampla la Adauga/Salveaza/Sterge
//     */
//    Route::post('parsator-action/{action}/{id?}', 'ParsatorController@doAction')
//        ->name('ps.parsator-do-action');
});