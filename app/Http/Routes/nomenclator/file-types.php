<?php

Route::group(['namespace' => 'Superadmin\Nomenclatoare'], function () {

    Route::get('superadmin/nomenclatoare/file-types', 'FileTypesController@getGrid')
        ->name('superadmin.nomenclatoare.file-types.index');

    Route::post('superadmin/nomenclatoare/file-types-source', 'FileTypesController@dataSource')
        ->name('superadmin.nomenclatoare.file-types.data-source');

    /*
     * Sa se incarce formularul de actiun (actions form)
     */
    Route::post('superadmin/nomenclatoare/file-types-get-action-form/{action}/{id?}', 'FileTypesController@getActionForm')
        ->name('superadmin.nomenclatoare.file-types.get-action-form');

    /*
     * ce se intampla la Adauga/Salveaza/Sterge
     */
    Route::post('superadmin/nomenclatoare/file-types-action/{action}/{id?}', 'FileTypesController@doAction')
        ->name('superadmin.nomenclatoare.file-types-do-action');
});