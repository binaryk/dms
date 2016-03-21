<?php

Route::group(['namespace' => 'Directors'], function () {

    Route::get('director-files/{dir_id}', 'DirectorFilesController@getGrid')
        ->name('director-files.index');

    Route::post('director-files-source/{dir_id}/{grid_id?}', 'DirectorFilesController@dataSource')
        ->name('director-files.data-source');

    /*
     * Sa se incarce formularul de actiun (actions form)
     */
    Route::post('director-files-get-action-form/{dir_id}/{action}/{grid_id?}/{id?}', 'DirectorFilesController@getActionForm')
        ->name('director-files.get-action-form');

    /*
     * ce se intampla la Adauga/Salveaza/Sterge
     */
    Route::post('director-files-action/{dir_id}/{action}/{id?}', 'DirectorFilesController@doAction')
        ->name('director-files-do-action');
});