<?php

Route::group(['namespace' => 'Directors'], function () {

    Route::get('director-files/{dir_id}', 'DirectorFilesController@getGrid')
        ->name('director-files.index');

    Route::post('director-files-source', 'DirectorFilesController@dataSource')
        ->name('director-files.data-source');

    /*
     * Sa se incarce formularul de actiun (actions form)
     */
    Route::post('director-files-get-action-form/{action}/{id?}', 'DirectorFilesController@getActionForm')
        ->name('director-files.get-action-form');

    /*
     * ce se intampla la Adauga/Salveaza/Sterge
     */
    Route::post('director-files-action/{action}/{id?}', 'DirectorFilesController@doAction')
        ->name('director-files-do-action');
});