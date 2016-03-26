<?php
Route::group(['middleware' => 'auth'], function() {
    Route::group(['namespace' => 'History'], function () {

        Route::get('file-history/{parent_file_id}', 'FileHistoryController@getGrid')
            ->name('file-history.index');

        Route::post('file-history-source/{parent_file_id}/{grid_id}', 'FileHistoryController@dataSource')
            ->name('file-history.data-source');

        /*
         * Sa se incarce formularul de actiun (actions form)
         */
        Route::post('file-history-get-action-form/{parent_file_id}/{action}/{grid_id}/{id?}', 'FileHistoryController@getActionForm')
            ->name('file-history.get-action-form');

        /*
         * ce se intampla la Adauga/Salveaza/Sterge
         */
        Route::post('file-history-action/{parent_file_id}/{action}/{id?}', 'FileHistoryController@doAction')
            ->name('file-history-do-action');
    });
});