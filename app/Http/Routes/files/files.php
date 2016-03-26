<?php
Route::group(['middleware' => 'auth'], function() {
    Route::group(['namespace' => 'Files'], function () {

        Route::get('director-files/{dir_id}', 'FilesController@getGrid')
            ->name('director-files.index');

        Route::post('director-files-source/{dir_id}/{grid_id?}', 'FilesController@dataSource')
            ->name('director-files.data-source');

        /*
         * Sa se incarce formularul de actiun (actions form)
         */
        Route::post('director-files-get-action-form/{dir_id}/{action}/{grid_id?}/{id?}', 'FilesController@getActionForm')
            ->name('director-files.get-action-form');

        /*
         * ce se intampla la Adauga/Salveaza/Sterge
         */
        Route::post('director-files-action/{dir_id}/{action}/{id?}', 'FilesController@doAction')
            ->name('director-files-do-action');

        Route::post('director-files-archive/{id}', 'FilesController@archive')
            ->name('director-files.archive-file');
    });
});