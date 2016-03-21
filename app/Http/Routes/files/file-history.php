<?php

Route::group(['namespace' => 'History'], function () {

    Route::get('file-history/{file_id}', 'FileHistoryController@getGrid')
        ->name('file-history.index');

    Route::post('file-history-source/{file_id}/{file_id?}', 'FileHistoryController@dataSource')
        ->name('file-history.data-source');

    /*
     * Sa se incarce formularul de actiun (actions form)
     */
    Route::post('file-history-get-action-form/{file_id}/{action}/{file_id?}/{id?}', 'FileHistoryController@getActionForm')
        ->name('file-history.get-action-form');

    /*
     * ce se intampla la Adauga/Salveaza/Sterge
     */
    Route::post('file-history-action/{file_id}/{action}/{id?}', 'FileHistoryController@doAction')
        ->name('file-history-do-action');
});